<?php
require '../conexion/CONECTAR_2.PHP';
$mensaje = '';
$areas = [];
$area = null;

// Función para cargar áreas desde la base de datos SQLite
function cargarAreas($conn) {
    $areas = [];
    $stmt = $conn->query("SELECT * FROM areas");
    if ($stmt) {
        $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $areas;
}

try {
    $areas = cargarAreas($conn);
} catch (Exception $e) {
    $mensaje = $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !isset($_POST['nombre_area'])) {
    // Solo se envió el id para seleccionar área
    $id_area = $_POST['id'];

    $stmt = $conn->prepare("SELECT * FROM areas WHERE id = :id");
    $stmt->bindValue(':id', $id_area, PDO::PARAM_INT);
    $stmt->execute();
    $area = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$area) {
        $mensaje = "Área no encontrada.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre_area'], $_POST['codigo_area'],$_POST['Abreviado'], $_POST['id'])) {
    $id_area = $_POST['id'];
    $nombre_area = $_POST['nombre_area'];
    $codigo_area = $_POST['codigo_area'];
    $Abreviado =$_POST['Abreviado'];

   $stmt = $conn->prepare("UPDATE areas SET nombre = :nombre, codigo_dewey = :codigo_dewey, Abreviado = :abreviado WHERE id = :id");
    $stmt->bindValue(':nombre', $nombre_area, PDO::PARAM_STR);
$stmt->bindValue(':codigo_dewey', $codigo_area, PDO::PARAM_STR);
$stmt->bindValue(':abreviado', $Abreviado, PDO::PARAM_STR);
$stmt->bindValue(':id', $id_area, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $mensaje = "¡Área modificada exitosamente!";
        $area = null; // Resetea el área

        // Recargar lista áreas
        try {
            $areas = cargarAreas($conn);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    } else {
        $mensaje = "Error al modificar el área.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modificar Área</title>
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #e8f5e9;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .main-content {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

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

    .container {
        text-align: center;
        width: 80%;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
    }

    h1 {
        color: #2e7d32;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    input[type="text"],
    select {
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
        border-top: 2px solid #2e7d32;
        border-radius: 0;
    }
</style>

</head>
<body>
<div class="wrapper">
  <div class="main-content">
<div class="container">
    <h1>Modificar Área</h1>

    <?php if ($mensaje): ?>
        <div class="<?php echo (strpos($mensaje, 'Error') === false) ? 'alert-success' : 'alert-error'; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
        <?php if (strpos($mensaje, 'exitosamente') !== false): ?>
            <script>
                setTimeout(() => { location.reload(); }, 2000);
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <form method="post" action="">
        <select name="id" required>
            <option value="">Seleccione un Área</option>
            <?php foreach ($areas as $area_item): ?>
                <option value="<?php echo $area_item['id']; ?>" <?php if ($area && $area_item['id'] == $area['id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($area_item['nombre'] . " - " . $area_item['codigo_dewey']. " - ". $area_item['Abreviado']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-primary">Modificar Área</button>
    </form>

    <?php if ($area): ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $area['id']; ?>" />
            <input type="text" name="nombre_area" value="<?php echo htmlspecialchars($area['nombre']); ?>" placeholder="Nombre del Área" required />
            <input type="text" name="codigo_area" value="<?php echo htmlspecialchars($area['codigo_dewey']); ?>" placeholder="Código del Área" required />
            <input type="text" name="Abreviado" value="<?php echo htmlspecialchars($area['Abreviado']); ?>" placeholder="Abreviatura" required />
            <button type="submit" class="btn-primary">Guardar Cambios</button>
        </form>
    <?php else: ?>
        <p>Por favor, seleccione un área para modificar.</p>
    <?php endif; ?>
</div>

<div>
    <a href="../ingreso_bibliotecario_1.php">Volver a la página principal</a>
</div>
<div class="text-center mt-4">
    <a href="../AREAS/areas.php" class="btn btn-success">Listado</a>
    </div>
    </div>
</div>
<?php include 'footer1.html';  ?>
</body>
</html>
