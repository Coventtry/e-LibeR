<?php
require 'conexion_BD.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta para obtener los datos de la noticia
    $sql = "SELECT titulo, descripcion, imagen FROM noticias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontró la noticia.";
        exit;
    }
}

// Guardar los cambios
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen']; // Ajusta esto para la carga de imágenes

    $sql = "UPDATE noticias SET titulo = ?, descripcion = ?, imagen = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $titulo, $descripcion, $imagen, $id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Noticia actualizada correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar la noticia.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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
    </style>
</head>
<body>
<div class="container">
    <h2>Modificar Noticia</h2>
    <form action="modifcar_avisador" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" value="<?php echo $row['titulo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" name="descripcion" required><?php echo $row['descripcion']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen URL:</label>
            <input type="text" class="form-control" name="imagen" value="<?php echo $row['imagen']; ?>">
        </div>
        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar Noticia</button>
    </form>
    <a href="avisador.php" class="back-link">Volver a la página principal</a>
</div>
</body>
</html>

