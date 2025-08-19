<?php
require 'conectatew.php'; // Usamos conexión central con PDO

$mensaje_exito = '';
$material_seleccionado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        // BUSCAR MATERIAL POR TÍTULO
        $busqueda = $_POST['busqueda'];
        $sql = "SELECT * FROM materiales WHERE titulo LIKE :busqueda";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':busqueda' => "%$busqueda%"]);
        $material_seleccionado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$material_seleccionado) {
            $mensaje = "No se encontró el material.";
        }
    } elseif (isset($_POST['modificar'])) {
        // MODIFICAR MATERIAL
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $anio_publicacion = $_POST['anio_publicacion'];
        $categoria = $_POST['categoria'];
        $disponibilidad = $_POST['disponibilidad'];

        $sql = "UPDATE materiales 
                SET titulo = :titulo,
                    autor = :autor,
                    anio_publicacion = :anio_publicacion,
                    categoria = :categoria,
                    disponibilidad = :disponibilidad
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute([
            ':titulo' => $titulo,
            ':autor' => $autor,
            ':anio_publicacion' => $anio_publicacion,
            ':categoria' => $categoria,
            ':disponibilidad' => $disponibilidad,
            ':id' => $id
        ]);

        if ($resultado) {
            $mensaje_exito = "Material modificado exitosamente.";
            $material_seleccionado = null;
        } else {
            echo "Error al modificar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
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
        <h1>Modificar Material</h1>

        <!-- FORMULARIO DE BÚSQUEDA -->
        <form method="post">
            <div class="form-group">
                <label for="busqueda">Buscar por Título</label>
                <input type="text" class="form-control" name="busqueda" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Material</button>
        </form>

        <!-- FORMULARIO DE MODIFICACIÓN -->
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
                    <label for="categoria">Categoría</label>
                    <input type="text" class="form-control" name="categoria" value="<?php echo $material_seleccionado['categoria']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="disponibilidad">Disponibilidad</label>
                    <input type="text" class="form-control" name="disponibilidad" value="<?php echo $material_seleccionado['disponibilidad']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="modificar">Modificar Material</button>
            </form>
        <?php endif; ?>

        <!-- MENSAJES -->
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

    <footer>
        <p>Practica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</p>
    </footer>
</body>
</html>
