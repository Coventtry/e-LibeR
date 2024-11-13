<?php
require 'conexion_BD.php';
$mensaje_exito = '';
$material_seleccionado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        // Buscar material
        $busqueda = $_POST['busqueda'];
        $sql = "SELECT * FROM materiales WHERE titulo LIKE '%$busqueda%'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $material_seleccionado = $resultado->fetch_assoc();
        } else {
            $mensaje = "No se encontró el material.";
        }
    } elseif (isset($_POST['modificar'])) {
        // Modificar material
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $anio_publicacion = $_POST['anio_publicacion'];
        $categoria = $_POST['categoria']; // Ahora usando 'categoria' en lugar de 'tipo'

        $sql = "UPDATE materiales SET titulo='$titulo', autor='$autor', anio_publicacion=$anio_publicacion, categoria='$categoria' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $mensaje_exito = "Material modificado exitosamente.";
            // Limpiar campos después de la actualización
            $material_seleccionado = null;
        } else {
            echo "Error al modificar: " . $conn->error;
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
    <title>Modificar Material</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
          a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem; /* Aumentar el tamaño de fuente del enlace */
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
        .alert-success {
            background-color: #c8e6c9;
            color: #2e7d32;
            border-color: #2e7d32;
        }
        footer {
            background-color:#161245;; /* Color de fondo más claro */
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 485px; /* Espacio antes del footer */
            border: 2px solid #2e7d32; /* Borde verde */
            border-radius: 5px; /* Esquinas redondeadas */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 id="inicio">Modificar Material</h1>

        <!-- Formulario de búsqueda de material -->
        <form method="post">
            <div class="form-group">
                <label for="busqueda">Buscar por Título</label>
                <input type="text" class="form-control" name="busqueda" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Material</button>
        </form>

        <!-- Mostrar datos del material para modificar -->
        <?php if ($material_seleccionado): ?>
            <form method="post" style="margin-top: 20px;">
                <input type="hidden" name="id" value="<?php echo $material_seleccionado['id']; ?>">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" name="titulo" value="<?php echo $material_seleccionado['titulo']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control" name="autor" value="<?php echo $material_seleccionado['autor']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="anio_publicacion">Año de Publicación</label>
                    <input type="number" class="form-control" name="anio_publicacion" value="<?php echo $material_seleccionado['anio_publicacion']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría</label> <!-- Cambié 'tipo' a 'categoria' -->
                    <input type="text" class="form-control" name="categoria" value="<?php echo $material_seleccionado['categoria']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="modificar">Modificar Material</button>
            </form>
        <?php endif; ?>

        <!-- Mensaje de éxito -->
        <?php if ($mensaje_exito): ?>
            <div class="alert alert-success text-center" style="margin-top: 20px;">
                <?php echo $mensaje_exito; ?>
            </div>
        <?php elseif (isset($mensaje)): ?>
            <div class="alert alert-warning text-center" style="margin-top: 20px;">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
    </div>
    <a href="ingreso_bibliotecario.php">Volver a la página principal</a>

    <!-- Pie de página como un cuadro -->
    <footer>
        <p>Practica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5,CSS, Bootstrap 5, PHP
        </p>
    </footer>
</body>
</html>
