<?php
require '../conexion/CONECTOR.PHP'; // Conexión vía PDO (SQLite)

// Consultar áreas de la base de datos
$stmt = $conn->query("SELECT nombre, codigo_dewey FROM areas");
$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión correctamente en PDO
$conn = null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php include '../icono.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÁREAS</title>
    <style>
        a {
            display: block;
            text-align: center;
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
            text-align: center;
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-secondary {
            margin-top: 20px;
        }
        footer {
            background-color: #161245;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
        li {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h1>Áreas</h1>
<div class="container">

<?php if (!empty($areas)): ?>
    <ul style="list-style-type: none; padding: 0;">
        <?php foreach ($areas as $row): ?>
            <li>
                <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                <p>Cod: <?php echo htmlspecialchars($row['codigo_dewey']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron áreas registradas.</p>
<?php endif; ?>

    <a href="../ingreso_bibliotecario_1.php" class="btn btn-secondary">Volver al Menú Principal</a>
</div>
</body>
</html>
<!-- Footer -->
<?php include 'footer1.html'; ?>