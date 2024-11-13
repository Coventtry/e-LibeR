<?php
require 'conexion_BD.php';

$mensaje_exito = '';

// Obtener áreas para el campo tipo
$areas = [];
$sql_areas = "SELECT * FROM areas";
$result_areas = $conn->query($sql_areas);
if ($result_areas) {
    while ($row = $result_areas->fetch_assoc()) {
        $areas[] = $row;
    }
} else {
    echo "Error al consultar áreas: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo']; // Captura del nuevo campo código
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $anio_publicacion = $_POST['anio_publicacion'];
    $disponibilidad = $_POST['disponibilidad'];
    $tipo = $_POST['tipo']; // Tipo ahora proviene del select de áreas

    // Validación para asegurarse de que el año de publicación es un número válido
    if (!is_numeric($anio_publicacion) || strlen($anio_publicacion) != 4) {
        echo "Error: El año de publicación debe ser un número de 4 dígitos.";
    } else {
        // Inserción en la base de datos
        $sql = "INSERT INTO materiales (codigo, titulo, autor, anio_publicacion, disponibilidad, categoria) 
                VALUES ('$codigo', '$titulo', '$autor', $anio_publicacion, '$disponibilidad', '$tipo')";
        
        if ($conn->query($sql) === TRUE) {
            $mensaje_exito = "Material agregado exitosamente.";

            // Redireccionar después de 3 segundos
            header("refresh:3; url=#inicio");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Material</title>
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
        .form-group label {
            color: #1b5e20;
        }
        .btn-primary {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
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
            margin-top: 225px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 id="inicio">Agregar Nuevo Material</h1>

        <?php if ($mensaje_exito): ?>
            <div class="alert alert-success text-center">
                <?php echo $mensaje_exito; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" name="codigo" required>
            </div>
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" class="form-control" name="autor" required>
            </div>
            <div class="form-group">
                <label for="anio_publicacion">Año de Publicación</label>
                <input type="number" class="form-control" name="anio_publicacion" min="1000" max="9999" required>
            </div>
            <div class="form-group">
                <label for="disponibilidad">Disponibilidad</label>
                <input type="text" class="form-control" name="disponibilidad" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select class="form-control" name="tipo" required>
                    <option value="">Seleccione un Tipo</option>
                    <?php foreach ($areas as $area): ?>
                        <option value="<?php echo $area['id']; ?>"><?php echo htmlspecialchars($area['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Agregar Material</button>
        </form>
    </div>
    <a href="ingreso_bibliotecario.php">Volver a la página principal</a>

    <footer>
        <p>Práctica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</p>
    </footer>
</body>
</html>
