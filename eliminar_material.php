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
    } elseif (isset($_POST['eliminar'])) {
        // Eliminar material
        $id = $_POST['id'];

        $sql = "DELETE FROM materiales WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $mensaje_exito = "Material eliminado exitosamente.";
            // Limpiar campos después de la eliminación
            $material_seleccionado = null;
        } else {
            echo "Error al eliminar: " . $conn->error;
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
    <title>Eliminar Material</title>
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
            background-color: #e8f5e9; /* Color de fondo verde claro */
            font-family: 'Arial', sans-serif;
            color: #2e7d32; /* Color del texto general */
        }
        .container {
            margin-top: 50px;
            border: 1px solid #2e7d32; /* Borde verde */
            border-radius: 10px; /* Esquinas redondeadas */
            padding: 20px;
            background-color: #ffffff; /* Fondo blanco para el contenedor */
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold; /* Negrita */
        }
        .btn-verde {
            background-color: #2e7d32; /* Color del botón de búsqueda verde */
            border-color: #2e7d32;
            color: white;
        }
        .btn-verde:hover {
            background-color: #1b5e20; /* Color más oscuro al pasar el mouse */
            border-color: #1b5e20;
        }
        .btn-danger {
            background-color: #c62828; /* Color del botón de eliminar */
            border-color: #c62828;
        }
        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }
        .alert-warning {
            background-color: #fff3cd; /* Color de fondo del aviso */
            color: #856404; /* Color del texto del aviso */
        }
        .alert-success {
            background-color: #c8e6c9; /* Color de fondo del éxito */
            color: #2e7d32; /* Color del texto del éxito */
            border-color: #2e7d32;
        }
        footer {
            background-color: #161245; /* Color de fondo más claro */
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 440px; /* Espacio antes del footer */
            border: 2px solid #2e7d32; /* Borde verde */
            border-radius: 5px; /* Esquinas redondeadas */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 id="inicio">Eliminar Material</h1>

        <!-- Formulario de búsqueda de material -->
        <form method="post">
            <div class="form-group">
                <label for="busqueda">Buscar por Título</label>
                <input type="text" class="form-control" name="busqueda" required>
            </div>
            <button type="submit" class="btn btn-verde btn-block" name="buscar">Buscar Material</button>
        </form>

        <!-- Mostrar datos del material para confirmar eliminación -->
        <?php if ($material_seleccionado): ?>
            <div class="alert alert-warning mt-4">
                <strong>¿Estás seguro de que deseas eliminar este material?</strong>
                <p><strong>Título:</strong> <?php echo $material_seleccionado['titulo']; ?></p>
                <p><strong>Autor:</strong> <?php echo $material_seleccionado['autor']; ?></p>
                <p><strong>Año de Publicación:</strong> <?php echo $material_seleccionado['anio_publicacion']; ?></p>
                <p><strong>Categoría:</strong> <?php echo $material_seleccionado['categoria']; ?></p>

                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $material_seleccionado['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-block" name="eliminar">Eliminar Material</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Mensaje de éxito -->
        <?php if ($mensaje_exito): ?>
            <div class="alert alert-success text-center mt-4">
                <?php echo $mensaje_exito; ?>
            </div>
        <?php elseif (isset($mensaje)): ?>
            <div class="alert alert-warning text-center mt-4">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <a href="ingreso_bibliotecario.php">Volver a la página principal</a>

    </div>

    <!-- Pie de página -->
    <footer>
        <p>Practica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5,CSS, Bootstrap 5, PHP
        </p>
    </footer>
</body>
</html>
