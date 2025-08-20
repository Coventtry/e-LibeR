<?php
require '../conexion/CONECTOR.PHP'; // Conexión con SQLite usando PDO

$sql = "SELECT id, anotacion, fecha FROM anotaciones ORDER BY fecha DESC";

try {
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al consultar anotaciones: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Búsqueda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            font-size: 18px;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .anotacion-container {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            position: relative;
        }
        .fecha {
            font-weight: bold;
            color: #495057;
            margin-bottom: 8px;
        }
        h2 {
            color: #28a745;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            text-align: center;
        }
        .btn-secondary {
            background-color: #218838;
        }
        .btn:hover {
            background-color: #6c757d;
        }
        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        footer {
            background-color: #052442;
            color: white;
            padding: 40px;
            text-align: center;
            margin-top: 135px;
        }
    </style>
</head>
<body>
<h2>Anotaciones</h2>
<div class="container">
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            echo "<div class='anotacion-container'>";
            echo "<div class='fecha'>" . htmlspecialchars($row["fecha"]) . "</div>";
            echo "<div class='contenido'><strong>" . htmlspecialchars($row["anotacion"]) . "</strong></div>";
            echo "<form action='/e-LibeR/notas/eliminar_anotacion.php' method='post' style='display:inline;' onsubmit='return confirmDeletion();'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
            echo "<button type='submit' class='delete-btn'>x</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay anotaciones.</p>";
    }
    echo "<br>";
    echo "<a href='/e-LibeR/ingreso_bibliotecario_1.php' class='btn btn-secondary'>Volver al Menú Principal</a>";
    ?>
</div>

<?php include 'footer1.html'; ?>

<script>
    function confirmDeletion() {
        return confirm("¿Estás seguro de que deseas eliminar esta anotación?");
    }
</script>

<?php
$conn = null;
?>
</body>

</html>
