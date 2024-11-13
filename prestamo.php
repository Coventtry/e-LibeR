<?php 
require 'conexion_BD.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos.

// Inicializar variables
$socio = null;
$socios = [];
$modificacion_exitosa = false;
$mensaje_error_fecha = '';  // Variable para el mensaje de error de fecha

// Si se envió el email para buscar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $email_busqueda = $_POST['email'];
    
    // Extraer los primeros 3 caracteres antes del '@'
    $email_base = substr($email_busqueda, 0, 3);
    
    // Validar que el email tenga al menos 3 caracteres antes del @
    if (preg_match('/^[a-zA-Z0-9]{3}$/', $email_base)) {
        // Consultar la base de datos para encontrar socios cuyo email contenga los primeros 3 caracteres antes del '@'
        $sql_busqueda = "SELECT * FROM socios WHERE SUBSTRING_INDEX(email, '@', 1) LIKE ?";
        $stmt_busqueda = $conn->prepare($sql_busqueda);
        $param_email = '%' . $email_base . '%'; // Buscar por los primeros 3 caracteres
        $stmt_busqueda->bind_param("s", $param_email);
        $stmt_busqueda->execute();
        $resultado_busqueda = $stmt_busqueda->get_result();

        // Si se encuentran socios
        if ($resultado_busqueda->num_rows > 0) {
            while ($socio = $resultado_busqueda->fetch_assoc()) {
                $socios[] = $socio; // Almacenar los resultados
            }
        } else {
            echo '<div class="alert alert-danger text-center">No se encontraron socios con ese email.</div>';
        }
        $stmt_busqueda->close();
    } else {
        // Si el correo contiene algo después del '@', mostrar un mensaje de error
        echo '<div class="alert alert-danger text-center">El email debe ser válido hasta el símbolo "@".</div>';
    }
}


// Procesar el préstamo si los datos están completos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['material_id']) && isset($_POST['cantidad']) && isset($_POST['socio_id']) && isset($_POST['fecha_devolucion'])) {
    $material_id = $_POST['material_id'];
    $cantidad = $_POST['cantidad'];
    $socio_id = $_POST['socio_id'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    // Verificar si la fecha de devolución es posterior a la fecha actual
    $fecha_actual = date('Y-m-d');
    if ($fecha_devolucion > $fecha_actual) {
        $mensaje_error_fecha = 'La fecha de devolución no puede ser posterior a la fecha actual.';
    } else {
        // Consultar el material seleccionado
        $sqlMaterial = "SELECT * FROM materiales WHERE id = ?";
        $stmtMaterial = $conn->prepare($sqlMaterial);
        $stmtMaterial->bind_param("i", $material_id);
        $stmtMaterial->execute();
        $resultadoMaterial = $stmtMaterial->get_result();
        $material = $resultadoMaterial->fetch_assoc();

        // Verificar la disponibilidad del material
        if ($material['disponibilidad'] < $cantidad || $cantidad <= 0) {
            echo '<div class="alert alert-danger text-center">No hay suficientes materiales disponibles.</div>';
        } else {
            // Verificar el máximo de 3 materiales prestados por socio
            $sqlPrestamos = "SELECT COUNT(*) as cantidad FROM prestamos WHERE socio_id = ? AND estado = 'activo'";
            $stmtPrestamos = $conn->prepare($sqlPrestamos);
            $stmtPrestamos->bind_param("i", $socio_id);
            $stmtPrestamos->execute();
            $resultadoPrestamos = $stmtPrestamos->get_result();
            $prestamos = $resultadoPrestamos->fetch_assoc();
            
            if ($prestamos['cantidad'] >= 3) {
                echo '<div class="alert alert-danger text-center">El socio ya tiene 3 materiales prestados.</div>';
            } else {
                // Realizar el préstamo
                $fecha_prestamo = date('Y-m-d H:i:s');
                $sqlPrestamo = "INSERT INTO prestamos (socio_id, material_id, fecha_prestamo, fecha_devolucion, estado) VALUES (?, ?, ?, ?, 'pendiente')";
                $stmtPrestamo = $conn->prepare($sqlPrestamo);
                $stmtPrestamo->bind_param("iiss", $socio_id, $material_id, $fecha_prestamo, $fecha_devolucion);
                $stmtPrestamo->execute();

                // Actualizar la disponibilidad del material
                $nueva_disponibilidad = $material['disponibilidad'] - $cantidad;
                $sqlUpdateMaterial = "UPDATE materiales SET disponibilidad = ? WHERE id = ?";
                $stmtUpdateMaterial = $conn->prepare($sqlUpdateMaterial);
                $stmtUpdateMaterial->bind_param("ii", $nueva_disponibilidad, $material_id);
                $stmtUpdateMaterial->execute();

                echo '<div class="alert alert-success text-center">Préstamo realizado con éxito.</div>';
            }
        }
    }
}

// Obtener los materiales disponibles
$sqlMateriales = "SELECT * FROM materiales WHERE disponibilidad > 0";
$stmtMateriales = $conn->prepare($sqlMateriales);
$stmtMateriales->execute();
$resultMateriales = $stmtMateriales->get_result();

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Préstamo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem;
        }

        a:hover {
            color: #218838;
        }
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2e7d32;
            margin-bottom: 20px;
            text-align:center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="text"], select, input[type="date"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
            width: 100%;
        }
        .btn-primary {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
        }
        .alert-success {
            background-color: #c8e6c9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
        }
        footer {
            background-color: #161245;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 200px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Realizar Préstamo</h1>

        <!-- Formulario para buscar al socio por email -->
        <form action="prestamo.php" method="POST">
            <div class="form-group">
                <label for="email">Email del Socio (primeros 3 caracteres):</label>
                <input type="text" class="form-control" name="email" id="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Socio</button>
        </form>

        <!-- Mostrar la búsqueda de socios -->
        <?php if (!empty($socios)): ?>
        <form action="prestamo.php" method="POST">
            <div class="form-group">
                <label for="socio_id">Seleccione un Socio:</label>
                <select name="socio_id" id="socio_id" class="form-control" required>
                    <?php foreach ($socios as $socio): ?>
                        <option value="<?php echo $socio['id']; ?>">
                            <?php echo $socio['nombre'] . ' ' . $socio['apellido'] . ' (' . $socio['anio'] . ' - ' . $socio['division'] . ')'; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Opciones de materiales -->
            <div class="form-group">
                <label for="material_id">Seleccione un Material:</label>
                <select name="material_id" id="material_id" class="form-control" required>
                    <?php while ($material = $resultMateriales->fetch_assoc()): ?>
                        <option value="<?php echo $material['id']; ?>"><?php echo $material['titulo'] . ' - Disponibles: ' . $material['disponibilidad']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Cantidad y fecha de devolución -->
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" required>
            </div>
            <div class="form-group">
                <label for="fecha_devolucion">Fecha de Devolución:</label>
                <input type="date" class="form-control" name="fecha_devolucion" id="fecha_devolucion" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Prestar</button>
        </form>
        <?php endif; ?>

        <?php if ($mensaje_error_fecha): ?>
            <div class="alert alert-danger text-center"><?php echo $mensaje_error_fecha; ?></div>
        <?php endif; ?>
    </div>

    <a href="ingreso_bibliotecario.php">Volver a la página principal</a>
    <!-- Pie de página -->
    <footer>
        <p>Practica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP
        </p>
    </footer>
</body>
</html>
