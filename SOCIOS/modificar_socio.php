    <link rel="icon" href="../assets/img/icono.ico" type="image/x-icon">
    <?php
require '../conexion/conectatew.php'; // Conexión PDO centralizada

$mensaje_exito = '';
$socio_seleccionado = null;
$socios_encontrados = [];
$mensaje = '';

// Buscar socio por email o nombre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        $busqueda = trim($_POST['busqueda']);
        
        try {
            $sql = "SELECT * FROM socios 
                    WHERE nombre LIKE :busqueda 
                    OR apellido LIKE :busqueda 
                    OR email LIKE :busqueda
                    ORDER BY apellido, nombre";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':busqueda' => "%$busqueda%"]);
            $socios_encontrados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($socios_encontrados)) {
                $mensaje = "No se encontraron socios con ese criterio de búsqueda.";
            }
        } catch (PDOException $e) {
            die("Error al buscar socios: " . $e->getMessage());
        }
    } elseif (isset($_POST['seleccionar'])) {
        // Selección de socio para modificar
        $id = $_POST['id_socio'];
        
        try {
            $sql = "SELECT * FROM socios WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $socio_seleccionado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$socio_seleccionado) {
                $mensaje = "El socio seleccionado no existe.";
            }
        } catch (PDOException $e) {
            die("Error al obtener socio: " . $e->getMessage());
        }
    } elseif (isset($_POST['modificar'])) {
        // Procesar actualización del socio
        $id = $_POST['id'];
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $anio = intval($_POST['anio']);
        $division = intval($_POST['division']);
        $activo = intval($_POST['activo']);
        
        // Validaciones
        if ($anio < 1 || $anio > 6) {
            $mensaje = "Error: El año debe estar entre 1 y 6.";
        } elseif ($division < 1 || $division > 6) {
            $mensaje = "Error: La división debe estar entre 1 y 6.";
        } else {
            try {
                $pdo->beginTransaction();
                
                $sql = "UPDATE socios 
                        SET nombre = :nombre,
                            apellido = :apellido,
                            email = :email,
                            telefono = :telefono,
                            anio = :anio,
                            division = :division,
                            activo = :activo
                        WHERE id = :id";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':nombre' => $nombre,
                    ':apellido' => $apellido,
                    ':email' => $email,
                    ':telefono' => $telefono,
                    ':anio' => $anio,
                    ':division' => $division,
                    ':activo' => $activo,
                    ':id' => $id
                ]);
                
                $pdo->commit();
                $mensaje_exito = "Datos del socio actualizados correctamente.";
                $socio_seleccionado = null; // Limpiar selección después de actualizar
                
            } catch (PDOException $e) {
                $pdo->rollBack();
                $mensaje = "Error al actualizar socio: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Socio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #e8f5e9; font-family: Arial, sans-serif; }
        .container { margin-top: 50px; max-width: 900px; }
        h1 { color: #2e7d32; text-align: center; margin-bottom: 30px; }
        .btn-primary { background-color: #2e7d32; border-color: #2e7d32; }
        .btn-primary:hover { background-color: #1b5e20; border-color: #1b5e20; }
        .alert-success { background-color: #c8e6c9; color: #2e7d32; border-color: #2e7d32; }
        .form-group label { color: #1b5e20; font-weight: 500; }
        .socio-card { border-left: 4px solid #2e7d32; margin-bottom: 15px; }
        footer { background-color: #161245; color: white; padding: 20px; margin-top: 40px; }
        a.volver { color: #6c757d; text-decoration: none; }
        a.volver:hover { color: #218838; }
        .invalid-feedback { display: none; color: #dc3545; }
        .is-invalid { border-color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buscar o modificar Socio</h1>

        <!-- Formulario de Búsqueda -->
        <form method="post" class="mb-4">
            <div class="form-group">
                <label for="busqueda">Buscar por Nombre, Apellido o Email</label>
                <input type="text" class="form-control" name="busqueda" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Socio</button>
        </form>

        <!-- Resultados de Búsqueda -->
        <?php if (!empty($socios_encontrados)): ?>
            <div class="resultados-busqueda mb-4">
                <h3>Resultados de la búsqueda</h3>
                <p class="text-muted">Se encontraron <?= count($socios_encontrados) ?> socios.</p>
                
                <form method="post">
                    <?php foreach ($socios_encontrados as $socio): ?>
                        <div class="card socio-card mb-2">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="id_socio" 
                                           id="socio_<?= $socio['id'] ?>" 
                                           value="<?= $socio['id'] ?>" required>
                                    <label class="form-check-label" for="socio_<?= $socio['id'] ?>">
                                        <h5><?= htmlspecialchars($socio['nombre'] . ' ' . $socio['apellido']) ?></h5>
                                        <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($socio['email']) ?></p>
                                        <p class="mb-1"><strong>Teléfono:</strong> <?= htmlspecialchars($socio['telefono']) ?></p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary btn-block mt-3" name="seleccionar">Seleccionar este socio</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Formulario de Modificación -->
        <?php if ($socio_seleccionado): ?>
            <form method="post" class="mt-4">
                <input type="hidden" name="id" value="<?= $socio_seleccionado['id'] ?>">
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($socio_seleccionado['nombre']) ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" name="apellido" value="<?= htmlspecialchars($socio_seleccionado['apellido']) ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($socio_seleccionado['email']) ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="<?= htmlspecialchars($socio_seleccionado['telefono']) ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="anio">Año</label>
                        <select name="anio" id="anio" class="form-control" required>
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <option value="<?= $i ?>" <?= $i == $socio_seleccionado['anio'] ? 'selected' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                        <div class="invalid-feedback" id="anio-error">El año debe estar entre 1 y 6</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="division">División</label>
                        <select name="division" id="division" class="form-control" required>
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <option value="<?= $i ?>" <?= $i == $socio_seleccionado['division'] ? 'selected' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                        <div class="invalid-feedback" id="division-error">La división debe estar entre 1 y 6</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="activo">Estado</label>
                    <select name="activo" class="form-control" required>
                        <option value="1" <?= $socio_seleccionado['activo'] ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= !$socio_seleccionado['activo'] ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block" name="modificar">Guardar Cambios</button>
            </form>
        <?php endif; ?>

        <!-- Mensajes de Retroalimentación -->
        <?php if ($mensaje_exito): ?>
            <div class="alert alert-success text-center mt-4">
                <?= $mensaje_exito ?>
            </div>
        <?php elseif ($mensaje): ?>
            <div class="alert alert-warning text-center mt-4">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>
        
        <a href="../ingreso_bibliotecario_1.php" class="volver d-block text-center mt-4">← Volver al menú principal</a>
    </div>
<footer>
   <?php include 'footer1.html'; ?>
   <footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        // Validación del formulario antes de enviar
        $('form').on('submit', function(e) {
            const anio = parseInt($('#anio').val());
            const division = parseInt($('#division').val());
            let isValid = true;

            // Validar año
            if (anio < 1 || anio > 6) {
                $('#anio').addClass('is-invalid');
                $('#anio-error').show();
                isValid = false;
            } else {
                $('#anio').removeClass('is-invalid');
                $('#anio-error').hide();
            }

            // Validar división
            if (division < 1 || division > 6) {
                $('#division').addClass('is-invalid');
                $('#division-error').show();
                isValid = false;
            } else {
                $('#division').removeClass('is-invalid');
                $('#division-error').hide();
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    </script>
</body>
</html>