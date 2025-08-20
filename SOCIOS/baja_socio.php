    <link rel="icon" href="../assets/img/icono.ico" type="image/x-icon">
<?php
// Conexión a MySQL con PDO
require '../conexion/conecta2.php';

// Inicializar variables
$socios = [];
$nombre = '';
$apellido = '';
$mensaje = '';

// Buscar socios
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';

    $sql = "SELECT * FROM socios WHERE nombre LIKE :nombre AND apellido LIKE :apellido";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nombre', '%' . $nombre . '%', PDO::PARAM_STR);
    $stmt->bindValue(':apellido', '%' . $apellido . '%', PDO::PARAM_STR);
    $stmt->execute();
    $socios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($socios)) {
        $mensaje = 'No se encontraron socios.';
    }
}

// Eliminar socio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dar_baja'])) {
    $socio_id = $_POST['socio_id'] ?? null;

    if ($socio_id) {
        $sql = "DELETE FROM socios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $socio_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $mensaje = 'Socio eliminado correctamente.';
            $socios = [];
        } else {
            $mensaje = 'Error al eliminar el socio.';
        }
    } else {
        $mensaje = 'Debe seleccionar un socio.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Baja de Socio - MySQL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        body { background-color: #f9f9f9;
              font-family: Arial, sans-serif; }

        .container {
            margin-top: 200px;
            max-width: 600px;
            background-color: #e8f5e9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h1 { color: #388e3c; text-align: center; }

        .alert {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
    <script>
        function confirmarBaja() {
            return confirm("¿Estás seguro de que querés eliminar este socio?");
        }
    </script>
</head>
<body>
<div class="wrapper">
    <div class="content">
        <div class="container">
            <h1>Dar de Baja a un Socio</h1>

            <?php if ($mensaje): ?>
                <div class="alert"><?php echo htmlspecialchars($mensaje); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                </div>
                <div class="form-group">
                    <label>Apellido:</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>">
                </div>
                <button type="submit" name="buscar" class="btn btn-primary btn-block">Buscar Socios</button>
            </form>

            <?php if (!empty($socios)): ?>
                <form method="POST" class="mt-4" onsubmit="return confirmarBaja();">
                    <div class="form-group">
                        <label>Seleccionar Socio:</label>
                        <select name="socio_id" class="form-control" required>
                            <option value="">Seleccione un socio</option>
                            <?php foreach ($socios as $socio): ?>
                                <option value="<?php echo $socio['id']; ?>">
                                    <?php echo htmlspecialchars($socio['nombre'] . ' ' . $socio['apellido']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="dar_baja" class="btn btn-danger btn-block">Dar de Baja</button>
                </form>
            <?php endif; ?>

            <a href="../ingreso_bibliotecario_1.php" class="btn btn-secondary btn-block mt-4">Volver</a>
          <!--  <a href="registro_socios.php" class="btn btn-info btn-block">Ver Historial de Cambios</a>-->
        </div>
    </div>
</div>

<?php include 'footer1.html'; ?>
</body>
</html>
