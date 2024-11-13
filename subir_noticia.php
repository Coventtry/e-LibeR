<?php
// Datos de conexión
$servername = "localhost";  
$username = "rodrigogar24";         
$password = "";              
$dbname = "biblioteca";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$titulo = $conn->real_escape_string($_POST["titulo"]);
$descripcion = $conn->real_escape_string($_POST["descripcion"]);

// Procesar la imagen
$target_dir = "img/";  // Cambia el directorio de almacenamiento a "img/"
$imagen = $target_dir . basename($_FILES["imagen"]["name"]);
$imageFileType = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));

// Validar el tipo de imagen
$check = getimagesize($_FILES["imagen"]["tmp_name"]);
if ($check !== false) {
    // Verificar si el directorio img existe, si no, crearlo
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen)) {
        // Guardar la noticia en la base de datos
        $sql = "INSERT INTO noticias (titulo, descripcion, imagen) VALUES ('$titulo', '$descripcion', '$imagen')";

        if ($conn->query($sql) === TRUE) {
            $mensaje_exito = "La noticia ha sido subida exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $mensaje = "Hubo un error al subir la imagen.";
    }
} else {
    $mensaje = "El archivo no es una imagen válida.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Noticia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            margin-top: 50px;
        }
        h1 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }
        .volver-arriba {
            position: fixed;
            bottom: 30px;
            right: 20px;
            background-color: #2e7d32;
            color: white;
            padding: 10px;
            border-radius: 50%;
            text-align: center;
            font-size: 28px;
        }
        .alert-success {
            background-color: #c8e6c9;
            color: #2e7d32;
            border-color: #2e7d32;
        }
        footer {
            background-color:#161245;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 485px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 id="inicio">Subir Noticia</h1>

        <!-- Formulario de subida de noticia -->
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagen">Subir Imagen</label>
                <input type="file" class="form-control-file" name="imagen" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Subir Noticia</button>
        </form>

        <!-- Mensajes de éxito o error -->
        <?php if (isset($mensaje_exito)): ?>
            <div class="alert alert-success text-center" style="margin-top: 20px;">
                <?php echo $mensaje_exito; ?>
            </div>
        <?php elseif (isset($mensaje)): ?>
            <div class="alert alert-warning text-center" style="margin-top: 20px;">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- Botón para volver al inicio -->
        <a href="http://localhost/Biblioteca/ingreso_bibliotecario.php" class="volver-arriba" title="Volver arriba">&#x2191;</a>
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
