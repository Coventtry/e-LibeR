<?php
require 'conectatew.php'; // Conexión PDO

$mensaje_exito = '';
$mensaje = '';
$material_seleccionado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        // Buscar material con LIKE, usando prepare para evitar inyección
        $busqueda = $_POST['busqueda'];
        $sql = "SELECT * FROM materiales WHERE titulo LIKE :busqueda LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':busqueda' => "%$busqueda%"]);
        $material_seleccionado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$material_seleccionado) {
            $mensaje = "No se encontró el material.";
        }
    } elseif (isset($_POST['eliminar'])) {
        // Eliminar material con id seguro
        $id = $_POST['id'];
        $sql = "DELETE FROM materiales WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([':id' => $id])) {
            $mensaje_exito = "Material eliminado exitosamente.";
            $material_seleccionado = null;
        } else {
            $mensaje = "Error al eliminar el material.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Eliminar Material</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
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
            font-family: 'Arial', sans-serif;
            color: #2e7d32;
        }
        .container {
            margin-top: 50px;
            border: 1px solid #2e7d32;
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .btn-verde {
            background-color: #2e7d32;
            border-color: #2e7d32;
            color: white;
        }
        .btn-verde:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }
        .btn-danger {
            background-color: #c62828;
            border-color: #c62828;
        }
        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .alert-success {
            background-color: #c8e6c9;
            color: #2e7d32;
            border-color: #2e7d32;
        }
        footer {
            background-color: #161245;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 440px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 id="inicio">Eliminar Material</h1>

    <!-- Formulario de búsqueda -->
    <form method="post">
        <div class="form-group">
            <label for="busqueda">Buscar por Título</label>
            <input type="text" class="form-control" name="busqueda" required />
        </div>
        <button type="submit" class="btn btn-verde btn-block" name="buscar">Buscar Material</button>
    </form>

    <!-- Confirmar eliminación -->
    <?php if ($material_seleccionado): ?>
        <div class="alert alert-warning mt-4">
            <strong>¿Estás seguro de que deseas eliminar este material?</strong>
            <p><strong>Título:</strong> <?php echo htmlspecialchars($material_seleccionado['titulo']); ?></p>
            <p><strong>Autor:</strong> <?php echo htmlspecialchars($material_seleccionado['autor']); ?></p>
            <p><strong>Año de Publicación:</strong> <?php echo htmlspecialchars($material_seleccionado['anio_publicacion']); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($material_seleccionado['categoria']); ?></p>

            <form method="post">
                <input type="hidden" name="id" value="<?php echo $material_seleccionado['id']; ?>" />
                <button type="submit" class="btn btn-danger btn-block" name="eliminar">Eliminar Material</button>
            </form>
        </div>
    <?php endif; ?>

    <!-- Mensajes -->
    <?php if ($mensaje_exito): ?>
        <div class="alert alert-success text-center mt-4"><?php echo $mensaje_exito; ?></div>
    <?php elseif ($mensaje): ?>
        <div class="alert alert-warning text-center mt-4"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <a href="ingreso_bibliotecario.php">Volver a la página principal</a>
</div>

<footer>
    <p>Practica Profesionalizante I<br>
    Esta página fue desarrollada utilizando HTML5, CSS, Bootstrap 5, PHP y PDO
    </p>
</footer>
</body>
</html>
