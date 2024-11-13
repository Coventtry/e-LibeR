<?php
require 'conexion_BD.php';

$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = $_POST['busqueda'];

    // Buscar en la base de datos con JOIN para obtener el nombre de la categoría (área)
    $sql = "SELECT m.*, a.nombre AS categoria_nombre FROM materiales m 
            LEFT JOIN areas a ON m.categoria = a.nombre 
            WHERE m.titulo LIKE '%$busqueda%'";

    // Ejecutar la consulta
    $resultado = $conn->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        if ($resultado->num_rows > 0) {
            // Guardar resultados
            while ($row = $resultado->fetch_assoc()) {
                // Si 'categoria_nombre' no está presente, asignar un valor predeterminado
                $row['categoria_nombre'] = $row['categoria_nombre'] ?? 'Categoría no encontrada';
                $resultados[] = $row;
            }
        } else {
            $mensaje = "No se encontraron materiales.";
        }
    } else {
        // Mostrar mensaje de error en caso de que la consulta falle
        $mensaje = "Error en la consulta: " . $conn->error;
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
    <title>Buscar Material</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        a { display: block; text-align: center; margin-top: 20px; color: #6c757d; text-decoration: none; font-size: 1.1rem; }
        a:hover { color: #218838; }
        body { background-color: #e8f5e9; font-family: Arial, sans-serif; }
        .container { margin-top: 50px; }
        h1 { color: #2e7d32; text-align: center; margin-bottom: 30px; }
        .btn-primary { background-color: #2e7d32; border-color: #2e7d32; }
        .btn-primary:hover { background-color: #1b5e20; border-color: #1b5e20; }
        table { margin-top: 20px; }
        table th, table td { color: #1b5e20; }
        footer { background-color: #161245; color: white; text-align: center; padding: 20px; margin-top: 485px; border: 2px solid #2e7d32; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 id="inicio">Buscar Material</h1>

        <form method="post">
            <div class="form-group">
                <label for="busqueda">Buscar por Título</label>
                <input type="text" class="form-control" name="busqueda" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
        </form>

        <?php if (!empty($resultados)): ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Año de Publicación</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $material): ?>
                        <tr>
                            <td><?php echo $material['titulo']; ?></td>
                            <td><?php echo $material['autor']; ?></td>
                            <td><?php echo $material['anio_publicacion']; ?></td>
                            <td><?php echo $material['categoria_nombre']; ?></td> <!-- Se muestra la categoría -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (isset($mensaje)): ?>
            <div class="alert alert-warning text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
    </div>
    <a href="ingreso_bibliotecario.php">Volver a la página principal</a>

    <footer>
        <p>Práctica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</p>
    </footer>
</body>
</html>
