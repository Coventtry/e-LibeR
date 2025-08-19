<?php
require 'conexion_BD.php'; // Conexión a la base de datos

// Consulta para obtener los socios con deuda
$sql = "
    SELECT s.id, s.nombre, s.apellido, s.email, p.material_id, p.fecha_devolucion 
    FROM socios s
    JOIN prestamos p ON s.id = p.socio_id
    WHERE p.estado IN ('pendiente', 'atrasado')
    GROUP BY s.id";
$result = $conn->query($sql);

// Verificamos si se han encontrado socios con deuda
if ($result->num_rows > 0) {
    $socios = [];
    while ($row = $result->fetch_assoc()) {
        // Guardar los datos de cada socio y préstamo
        $socios[] = $row;
    }
} else {
    echo "<p>No hay socios con deuda.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socios con Deuda</title>
    <style>
        /* Aquí van los estilos */
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
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #28a745;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
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
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Socios con Deuda</h2>

        <?php
        if (!empty($socios)) {
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Apellido</th><th>Email</th><th>Material Adeudado</th><th>Fecha de Devolución</th><th>Enviar Mensaje</th></tr>";

            foreach ($socios as $socio) {
                $email = $socio['email'];
                $material_id = $socio['material_id'];
                $fecha_devolucion = $socio['fecha_devolucion'];

                // Crear un mensaje predeterminado con la información
                $subject = "Recordatorio de Deuda - Material Adeudado";
                $body = "Estimado/a " . $socio['nombre'] . " " . $socio['apellido'] . ",\n\nLe recordamos que tiene un material adeudado con la siguiente información:\n\nMaterial ID: $material_id\nFecha de Devolución: $fecha_devolucion\n\nPor favor, realice la devolución a la mayor brevedad posible.\n\nSaludos,\nBiblioteca";

                // Codificar el asunto y el cuerpo del mensaje
                $subjectEncoded = urlencode($subject);
                $bodyEncoded = urlencode($body);

                // Crear el enlace mailto
                $mailtoLink = "mailto:$email?subject=$subjectEncoded&body=$bodyEncoded";

                echo "<tr>";
                echo "<td>" . $socio['nombre'] . "</td>";
                echo "<td>" . $socio['apellido'] . "</td>";
                echo "<td>" . $socio['email'] . "</td>";
                echo "<td>$material_id</td>";
                echo "<td>$fecha_devolucion</td>";
                echo "<td><a href='$mailtoLink' class='btn' target='_blank'>Enviar Recordatorio</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>

    </div>
</body>
</html>
