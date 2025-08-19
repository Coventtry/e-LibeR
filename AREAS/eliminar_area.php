<?php
require '../conexion/conectatew.php'; // Conexión PDO
// Inicializar variables
$mensaje = '';
$areas = [];

// Función para cargar áreas desde la base de datos
function cargarAreas($pdo) {
    $stmt = $pdo->query("SELECT * FROM areas");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Cargar áreas inicialmente
try {
    $areas = cargarAreas($pdo);
} catch (Exception $e) {
    $mensaje = "Error al cargar áreas: " . $e->getMessage();
}

// Verificar si se ha enviado el formulario para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_area = (int)$_POST['id']; // Cast a entero para mayor seguridad
    
    try {
        $sql = "DELETE FROM areas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id_area]);
        $mensaje = "¡Área eliminada exitosamente!";

        // Recargar la lista de áreas después de la eliminación
        $areas = cargarAreas($pdo);
    } catch (Exception $e) {
        $mensaje = "Error al eliminar el área: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Área</title>
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
        flex-direction: column;
        align-items: center;
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
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
        margin-bottom: 30px;
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
        margin-top: auto;
    }
</style>

</head>
<body>
<div class="wrapper">
  <div class="main-content">
    <div class="container">
<div class="container">
    <h1>Eliminar Área</h1>

    <?php if ($mensaje): ?>
        <div class="<?php echo strpos($mensaje, 'Error') === false ? 'alert-success' : 'alert-error'; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <!-- Formulario para seleccionar el área a eliminar -->
    <form method="post" action="">
        <select name="id" required>
            <option value="">Seleccione un Área</option>
            <?php foreach ($areas as $area_item): ?>
                <option value="<?php echo htmlspecialchars($area_item['id']); ?>">
                    <?php echo htmlspecialchars($area_item['nombre']); ?> - <?php echo htmlspecialchars($area_item['codigo_dewey']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-primary">Eliminar Área</button>
    </form>
</div>

<div>
    <a href="../ingreso_bibliotecario_1.php">Volver a la página principal</a>
</div>
</div>
</div>
<!-- Footer -->
<?php include 'footer1.html'; ?>

</body>
</html>
