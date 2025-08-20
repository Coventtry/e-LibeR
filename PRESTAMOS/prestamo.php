    <link rel="icon" href="../assets/img/icono.ico" type="image/x-icon">
<?php
require '../conexion/conectatew.php';

// Configurar tiempo de espera para la conexión
$pdo->setAttribute(PDO::ATTR_TIMEOUT, 30);

$socios = [];
$mensaje_error_fecha = '';
$mostrar_confirmacion = false;
$datos_confirmacion = [];
$materialesEncontrados = [];

// Función para ejecutar consultas con reintentos
function executeWithRetry($stmt, $params = [], $maxRetries = 3) {
    $retryCount = 0;
    while ($retryCount < $maxRetries) {
        try {
            return $stmt->execute($params);
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'database is locked') !== false) {
                $retryCount++;
                usleep(250000); // Esperar 250ms
            } else {
                throw $e;
            }
        }
    }
    return false;
}

// Buscar socios
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $email_busqueda = trim($_POST['email']);
    $email_base = substr($email_busqueda, 0, 3);

    if (preg_match('/^[a-zA-Z0-9]{3}$/', $email_base)) {
        try {
            $sql_busqueda = "SELECT * FROM socios WHERE substr(email, 1, instr(email, '@') - 1) LIKE :email";
            $stmt_busqueda = $pdo->prepare($sql_busqueda);
            $param_email = "%$email_base%";
            if (!executeWithRetry($stmt_busqueda, [':email' => $param_email])) {
                throw new PDOException("Error al ejecutar la consulta de búsqueda");
            }
            $socios = $stmt_busqueda->fetchAll(PDO::FETCH_ASSOC);
            if (empty($socios)) {
                echo '<div class="alert alert-danger text-center">No se encontraron socios con ese email o nombre.</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger text-center">Error al buscar socios: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger text-center">Ingreso incorrecto</div>';
    }
}
// Procesar confirmación de préstamo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_prestamo'])) {
    $material_id = (int) trim($_POST['material_id']);
    $cantidad = (int) trim($_POST['cantidad']);
    $socio_id = (int) trim($_POST['socio_id']);
    $fecha_devolucion = trim($_POST['fecha_devolucion']);

    try {
        $pdo->beginTransaction();

        // Validar socio
        $stmtSocio = $pdo->prepare("SELECT activo FROM socios WHERE id = :id");
        executeWithRetry($stmtSocio, [':id' => $socio_id]);
        $datosSocio = $stmtSocio->fetch(PDO::FETCH_ASSOC);

        if (!$datosSocio) {
            throw new Exception('El socio no existe.');
        } elseif ($datosSocio['activo'] != 1) {
            throw new Exception('El socio está inactivo y no puede realizar préstamos.');
        }

        // Validar material
        $stmtMaterial = $pdo->prepare("SELECT * FROM materiales WHERE id = :id");
        executeWithRetry($stmtMaterial, [':id' => $material_id]);
        $material = $stmtMaterial->fetch(PDO::FETCH_ASSOC);

        if (!$material || $material['disponibilidad'] < $cantidad) {
            throw new Exception('Cantidad inválida o sin disponibilidad suficiente.');
        }

        // Verificar préstamos activos (máximo 3)
        $stmtPrestamos = $pdo->prepare("
            SELECT COUNT(*) as cantidad 
            FROM prestamos 
            WHERE socio_id = :socio_id AND estado = 'activo'
        ");
        executeWithRetry($stmtPrestamos, [':socio_id' => $socio_id]);
        $prestamos = $stmtPrestamos->fetch(PDO::FETCH_ASSOC);

        if ($prestamos['cantidad'] >= 3) {
            throw new Exception('El socio ya tiene 3 préstamos activos.');
        }

        // Verificar duplicado
        $stmtDuplicado = $pdo->prepare("
            SELECT 1 
            FROM prestamos 
            WHERE socio_id = :socio_id AND material_id = :material_id AND estado = 'activo'
        ");
        executeWithRetry($stmtDuplicado, [':socio_id' => $socio_id, ':material_id' => $material_id]);
        if ($stmtDuplicado->fetch()) {
            throw new Exception('El socio ya tiene este material en préstamo.');
        }

        // Registrar préstamo como ACTIVO
        $stmtPrestamo = $pdo->prepare("
            INSERT INTO prestamos 
            (socio_id, material_id, fecha_prestamo, fecha_devolucion, estado, cantidad) 
            VALUES (:socio_id, :material_id, :fecha_prestamo, :fecha_devolucion, 'activo', :cantidad)
        ");
        executeWithRetry($stmtPrestamo, [
            ':socio_id' => $socio_id,
            ':material_id' => $material_id,
            ':fecha_prestamo' => date('Y-m-d H:i:s'),
            ':fecha_devolucion' => $fecha_devolucion,
            ':cantidad' => $cantidad
        ]);

        // Actualizar disponibilidad
        $stmtUpdate = $pdo->prepare("UPDATE materiales SET disponibilidad = disponibilidad - :cantidad WHERE id = :id");
        executeWithRetry($stmtUpdate, [
            ':cantidad' => $cantidad,
            ':id' => $material_id
        ]);

        $pdo->commit();

        // Mostrar confirmación
        echo '<div id="confirmModal" class="confirmacion-box" style="text-align:center;">'
           . '<div class="confirmacion-header"><h4>Préstamo Confirmado</h4>'
           . '<button onclick="document.getElementById(\'confirmModal\').style.display=\'none\'; window.location=\'prestamo.php\'" style="float:right;font-size:18px;background:none;border:none">✖</button>'
           . '</div>'
           . '<p><strong>Clasificación Física:</strong> ' . htmlspecialchars($material['clasificacion_fisica']) . '</p>'
           . '</div>';

    } catch (Exception $e) {
        $pdo->rollBack();
        echo '<div class="alert alert-danger text-center">' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}


// Mostrar formulario de confirmación
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['material_id'], $_POST['cantidad'], $_POST['socio_id'], $_POST['fecha_devolucion'])) {
    $material_id = (int) trim($_POST['material_id']);
    $cantidad = (int) trim($_POST['cantidad']);
    $socio_id = (int) trim($_POST['socio_id']);
    $fecha_devolucion = trim($_POST['fecha_devolucion']);

    if ($material_id <= 0 || $cantidad <= 0 || $socio_id <= 0 || empty($fecha_devolucion)) {
        echo '<div class="alert alert-danger text-center">Todos los campos son obligatorios y deben ser válidos.</div>';
    } else {
        $fecha_actual = date('Y-m-d');
        $fecha_limite = date('Y-m-d', strtotime('+14 days'));

        if ($fecha_devolucion < $fecha_actual) {
            $mensaje_error_fecha = 'La fecha de devolución no puede ser anterior a hoy.';
        } elseif ($fecha_devolucion > $fecha_limite) {
            $mensaje_error_fecha = 'La fecha de devolución no puede superar las dos semanas desde hoy.';
        } else {
            try {
                $stmtSocio = $pdo->prepare("SELECT * FROM socios WHERE id = :id");
                executeWithRetry($stmtSocio, [':id' => $socio_id]);
                $socio = $stmtSocio->fetch(PDO::FETCH_ASSOC);

                $stmtMaterial = $pdo->prepare("SELECT * FROM materiales WHERE id = :id");
                executeWithRetry($stmtMaterial, [':id' => $material_id]);
                $material = $stmtMaterial->fetch(PDO::FETCH_ASSOC);

                if ($socio && $material) {
                    $mostrar_confirmacion = true;
                    $datos_confirmacion = [
                        'socio' => $socio['nombre'] . ' ' . $socio['apellido'] . ' (' . $socio['anio'] . '° ' . $socio['division'] . ')',
                        'material' => $material['titulo'],
                        'clasificacion_fisica' => $material['clasificacion_fisica'],
                        'cantidad' => $cantidad,
                        'fecha_prestamo' => date('d/m/Y'),
                        'fecha_devolucion' => date('d/m/Y', strtotime($fecha_devolucion)),
                        'socio_id' => $socio_id,
                        'material_id' => $material_id
                    ];
                }
            } catch (Exception $e) {
                echo '<div class="alert alert-danger text-center">Error al verificar datos: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }
    }
}

// Obtener materiales disponibles
try {
    $stmtMateriales = $pdo->query("SELECT * FROM materiales WHERE disponibilidad > 0");
    $materialesDisponibles = $stmtMateriales->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $materialesDisponibles = [];
    echo '<div class="alert alert-warning text-center">Error al cargar materiales disponibles: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Préstamo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/STYLE_PREST.CSS">
    <style>
        .confirmacion-box {
            border: 2px solid #28a745;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            background-color: #f8f9fa;
        }
        .confirmacion-header {
            color: #28a745;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
        .confirmacion-datos {
            margin-bottom: 15px;
        }
        .confirmacion-botones {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Realizar Préstamo</h1>

    <!-- Buscar Socio -->
    <form action="prestamo.php" method="POST">
        <div class="form-group">
            <label for="email">Nombre o email:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Ingresar los tres caracteres principales" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Socio</button><br>
    </form>

    <?php if (!empty($socios)): ?>
    <!-- Formulario de préstamo -->
    <form action="prestamo.php" method="POST">
        <div class="form-group">
            <label for="socio_id">Seleccione un Socio:</label>
            <select name="socio_id" id="socio_id" class="form-control" required>
                <?php foreach ($socios as $socio): ?>
                    <option value="<?php echo htmlspecialchars($socio['id']); ?>">
                        <?php echo htmlspecialchars($socio['nombre'] . ' ' . $socio['apellido'] . ' (' . $socio['anio'] . '° ' . $socio['division'] . ')'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="material_id">Seleccione un Material:</label>
            <select name="material_id" id="material_id" class="form-control" required>
                <?php foreach ($materialesDisponibles as $material): ?>
                    <option value="<?php echo htmlspecialchars($material['id']); ?>">
                        <?php echo htmlspecialchars($material['titulo'] . ' - Disponibles: ' . $material['disponibilidad']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" required min="1">
        </div>
        <div class="form-group">
            <label for="fecha_devolucion">Fecha de Devolución:</label>
            <input type="date" class="form-control" name="fecha_devolucion" id="fecha_devolucion" required>
        </div>

        <button type="submit" class="btn btn-success btn-block">Prestar</button>
    </form>
    <?php endif; ?>

    <?php if ($mensaje_error_fecha): ?>
        <div class="alert alert-danger text-center"><?php echo htmlspecialchars($mensaje_error_fecha); ?></div>
    <?php endif; ?>

    <?php if ($mostrar_confirmacion): ?>
    <!-- Cuadro de confirmación -->
    <div class="confirmacion-box">
        <div class="confirmacion-header">
            <h4>Confirmar Préstamo</h4>
            <p>Por favor verifique los datos antes de confirmar</p>
        </div>
        
        <div class="confirmacion-datos">
            <p><strong>Socio:</strong> <?php echo htmlspecialchars($datos_confirmacion['socio']); ?></p>
            <p><strong>Material:</strong> <?php echo htmlspecialchars($datos_confirmacion['material']); ?></p>
            <p><strong>Cantidad:</strong> <?php echo htmlspecialchars($datos_confirmacion['cantidad']); ?></p>
            <p><strong>Fecha de Préstamo:</strong> <?php echo htmlspecialchars($datos_confirmacion['fecha_prestamo']); ?></p>
            <p><strong>Fecha de Devolución:</strong> <?php echo htmlspecialchars($datos_confirmacion['fecha_devolucion']); ?></p>
        </div>
        
        <form action="prestamo.php" method="POST">
            <input type="hidden" name="socio_id" value="<?php echo htmlspecialchars($datos_confirmacion['socio_id']); ?>">
            <input type="hidden" name="material_id" value="<?php echo htmlspecialchars($datos_confirmacion['material_id']); ?>">
            <input type="hidden" name="cantidad" value="<?php echo htmlspecialchars($datos_confirmacion['cantidad']); ?>">
            <input type="hidden" name="fecha_devolucion" value="<?php echo htmlspecialchars($_POST['fecha_devolucion']); ?>">
            
            <div class="confirmacion-botones">
                <button type="submit" name="confirmar_prestamo" class="btn btn-success">Confirmar Préstamo</button>
                <a href="prestamo.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>

<a href="../ingreso_bibliotecario_1.php">Volver a la página principal</a>
<?php include 'footer1.html'; ?>
</body>
</html>