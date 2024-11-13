<?php
require 'conexion_BD.php';

// Establecer el conjunto de caracteres
$conn->set_charset("utf8mb4");

// Inicializar la variable de búsqueda
$email = '';

// Obtener el email desde el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
}

// Preparar la consulta para buscar el socio por email que contenga la letra
$sql = "SELECT * FROM socios WHERE email LIKE ?";
$stmt = $conn->prepare($sql);
$param_email = '%' . $email . '%'; // Buscar correos que contengan la cadena ingresada
$stmt->bind_param("s", $param_email); 
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php
include 'icono.php';
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Búsqueda</title>
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
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #28a745;
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #28a745;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
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
            background-color: #6c757d;
        }
        .btn:hover {
            background-color: #218838;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 32px;
            text-align: center;
            margin-top: 246px; /* Añadir un margen superior para separarlo del contenido */
            position: relative;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if ($result->num_rows > 0) {
        echo '<h2>Datos del Socio</h2>';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Año</th>
        <th>Division</th>
        </tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row["nombre"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["apellido"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["telefono"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["direccion"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["anio"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["division"]) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert">No se encontró ningún socio con ese email.</div>';
    }

    // Cerrar la conexión
    $conn->close();
    ?>
    <a href="ingreso_bibliotecario.php" class="btn btn-secondary">Volver al Menú Principal</a>
</div>

 <!-- Footer -->
 <footer class="footer">
            <h6 style="margin-left: 34px; margin-top: 50px;">Practica Profesionalizante I<br></h6>
            <h6 style="margin-left: 34px;">Esta página fue desarrollada utilizando HTML 5,<br>CSS, Bootstrap 5, PHP<br></h6>
          </footer>
</body>
</html>
