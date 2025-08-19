<?php
require '../conexion/conectatew.php'; // tu conexión PDO SQLite

// Inicializar variables
$row = ['titulo' => '', 'descripcion' => '', 'imagen' => ''];
$message = "";

// Obtener datos para mostrar en el formulario
if (isset($_POST['id']) && !isset($_POST['actualizar'])) {
    $id = $_POST['id'];

    $sql = "SELECT titulo, descripcion, imagen FROM noticias WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo "No se encontró la noticia.";
        exit;
    }
}

// Guardar los cambios
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    $sql = "UPDATE noticias SET titulo = :titulo, descripcion = :descripcion, imagen = :imagen WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        ':titulo' => $titulo,
        ':descripcion' => $descripcion,
        ':imagen' => $imagen,
        ':id' => $id
    ]);

    if ($success) {
        $message = "<div class='alert alert-success'>Noticia actualizada correctamente.</div>";
        // Refrescar datos para mostrar actualizados
        $row = ['titulo' => $titulo, 'descripcion' => $descripcion, 'imagen' => $imagen];
    } else {
        $message = "<div class='alert alert-danger'>Error al actualizar la noticia.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar Noticia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
            color: #2e7d32;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            margin-top: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        h2 {
            color: #1b5e20;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group label {
            color: #388e3c;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #66bb6a;
            border-color: #66bb6a;
            font-weight: bold;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #43a047;
            border-color: #43a047;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #388e3c;
            text-decoration: none;
        }
        .back-link:hover {
            color: #2e7d32;
        }
        .alert {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Modificar Noticia</h2>

    <?php if (!empty($message)) echo $message; ?>

    <form action="../avisador/modifcar_avisador.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id ?? ''); ?>">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" value="<?php echo htmlspecialchars($row['titulo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" name="descripcion" required><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen URL:</label>
            <input type="text" class="form-control" name="imagen" value="<?php echo htmlspecialchars($row['imagen']); ?>">
        </div>
        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar Noticia</button>
    </form>
    <a href="../avisador/avisador.php" class="back-link">Volver a la página principal</a>
</div>
</body>
</html>
