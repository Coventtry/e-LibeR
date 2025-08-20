<?php
// Conexión a la base de datos SQLite usando PDO
require '../conexion/conectatew.php';

$mensaje = '';
$mensaje_exito = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario con filtro para seguridad
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);

    // Carpeta destino (en el servidor)
    $target_dir = "../img/";  // la carpeta está en la raíz del proyecto
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        // 🔹 Solo guardamos el nombre de archivo en la BD
        $nombreArchivo = basename($_FILES["imagen"]["name"]);
        $rutaServidor = $target_dir . $nombreArchivo; // ruta física donde se guarda
        $imageFileType = strtolower(pathinfo($rutaServidor, PATHINFO_EXTENSION));

        // Validar que sea una imagen real
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            // Mover archivo a la carpeta /img/
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaServidor)) {
                // Insertar noticia en la base de datos usando consulta preparada
                try {
                    $sql = "INSERT INTO noticias (titulo, descripcion, imagen) 
                            VALUES (:titulo, :descripcion, :imagen)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':titulo' => $titulo,
                        ':descripcion' => $descripcion,
                        ':imagen' => $nombreArchivo  // ✅ Guardamos solo el nombre
                    ]);
                    $mensaje_exito = "La noticia ha sido subida exitosamente.";
                } catch (Exception $e) {
                    $mensaje = "Error al guardar la noticia: " . $e->getMessage();
                }
            } else {
                $mensaje = "Hubo un error al subir la imagen.";
            }
        } else {
            $mensaje = "El archivo no es una imagen válida.";
        }
    } else {
        $mensaje = "No se ha seleccionado ninguna imagen o ocurrió un error al subirla.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Subir Noticia</title>
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
            cursor: pointer;
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
            <input type="text" class="form-control" name="titulo" required />
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="imagen">Subir Imagen</label>
            <input type="file" class="form-control-file" name="imagen" required />
        </div>
        <button type="submit" class="btn btn-primary btn-block">Subir Noticia</button>
    </form>

    <!-- Mensajes de éxito o error -->
    <?php if (!empty($mensaje_exito)): ?>
        <div class="alert alert-success text-center mt-3">
            <?= htmlspecialchars($mensaje_exito) ?>
        </div>
    <?php elseif (!empty($mensaje)): ?>
        <div class="alert alert-warning text-center mt-3">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <!-- Botón para volver al inicio -->
    <a href="../ingreso.php" class="volver-arriba" title="Volver arriba">&#x2191;</a>
</div>
<a href="../ingreso_bibliotecario_1.php">Volver a la página principal</a>

<!-- Pie de página -->
<footer>
    <p>Practica Profesionalizante I<br />
    Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP
    </p>
</footer>
</body>
</html>
