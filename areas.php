<?php
require 'conexion_BD.php'; // Asegúrate de tener la conexión a la base de datos en este archivo

// Consultar áreas de la base de datos
$result = $conn->query("SELECT nombre, codigo_dewey FROM areas");

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php
include 'icono.php';
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AREAS</title>
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
    </style>
</head>
<body>
<h1>Áreas</h1>
<div class="container">

    <?php if ($result && $result->num_rows > 0): ?>
        <ul style="list-style-type: none; padding: 0;">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                    <p>Cod: <?php echo htmlspecialchars($row['codigo_dewey']); ?></p><br>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron áreas.</p>
    <?php endif; ?>
    <a href="ingreso.php" class="btn btn-secondary">Volver al Menú Principal</a>
</div>

<!-- Footer -->
<footer class="footer">
    <h6 style="margin-left: 34px; margin-top: 50px;">Práctica Profesionalizante I<br></h6>
    <h6 style="margin-left: 34px;">Esta página fue desarrollada utilizando HTML 5,<br>CSS, Bootstrap 5, PHP<br></h6>
</footer>

</body>
</html>
