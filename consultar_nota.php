<?php
require 'conexion_BD.php'; // Asegúrate de tener la conexión a la base de datos en este archivo

$sql = "SELECT id, anotacion, fecha FROM anotaciones ORDER BY fecha DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Búsqueda</title>
    <style>
        /* Estilos previos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            font-size: 18px; /* Aumentar tamaño de texto en el body */
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
            background-color: #052442; /* Usar un color coherente con el tema */
            color: white;
            padding: 40px; /* Aumentar padding para un pie de página más grande */
            text-align: center;
            margin-top: 135px; /* Ajustar el margen superior para separar más el contenido */
        }
    </style>
</head>
<body>
<h2>Anotaciones</h2>
<div class="container">
   
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='anotacion-container'>";
            echo "<div class='fecha'>" . $row["fecha"] . "</div>";
            echo "<div class='contenido'><strong>" . $row["anotacion"] . "</strong></div>";
            echo "<form action='eliminar_anotacion.php' method='post' style='display:inline;' onsubmit='return confirmDeletion();'>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "<button type='submit' class='delete-btn'>x</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay anotaciones.</p>";
    }
    echo "<br>";
    echo "<a href='ingreso_bibliotecario.php' class='btn btn-secondary'>Volver al Menú Principal</a>";
    ?>
</div>

<footer class="footer">
    <h6 style="margin-left: 34px; margin-top: 50px;">Practica Profesionalizante I<br></h6>
    <h6 style="margin-left: 34px;">Esta página fue desarrollada utilizando HTML 5,<br>CSS, Bootstrap 5, PHP<br></h6>
</footer>

<script>
    // Función de confirmación de eliminación
    function confirmDeletion() {
        return confirm("¿Estás seguro de que deseas eliminar esta anotación?");
    }
</script>

<?php
$conn->close();
?>

</body>
</html>
