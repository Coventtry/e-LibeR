<?php
// Conectar a la base de datos SQLite
$dbfile = 'biblioteca2.db';
try {
    $conn = new PDO("sqlite:" . $dbfile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$resultados = [];
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = $_POST['busqueda'];

    // CONSULTA ACTUALIZADA USANDO area_id Y MOSTRANDO EL NOMBRE DEL ÁREA
    $sql = "SELECT m.*, a.nombre AS area_nombre 
            FROM materiales m 
            LEFT JOIN areas a ON m.area_id = a.id 
            WHERE m.titulo LIKE :busqueda";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':busqueda', '%' . $busqueda . '%', PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['area_nombre'] = $row['area_nombre'] ?? 'Área no encontrada';
            $resultados[] = $row;
        }
    } else {
        $mensaje = "No se encontraron materiales.";
    }
}

$conn = null;
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
                        <th>Área</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $material): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($material['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($material['autor']); ?></td>
                            <td><?php echo htmlspecialchars($material['anio_publicacion']); ?></td>
                            <td><?php echo htmlspecialchars($material['area_nombre']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($mensaje): ?>
            <div class="alert alert-warning text-center">
                <?php echo htmlspecialchars($mensaje); ?>
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
