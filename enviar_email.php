<?php
require 'conexion_BD.php'; // Asegúrate de que tienes la conexión a la base de datos aquí

// Consulta para obtener los socios que adeudan
$sql = "SELECT id, nombre, apellido, email FROM socios WHERE deuda > 0";
$result = $conn->query($sql);

// Verificamos si se han encontrado socios con deuda
if ($result->num_rows > 0) {
    echo "<h2>Socios que adeudan</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Apellido</th><th>Email</th><th>Enviar mensaje</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellido'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><form action='enviar_email.php' method='post'>
                  <input type='hidden' name='email' value='" . $row['email'] . "'>
                  <textarea name='mensaje' placeholder='Escribe el mensaje aquí'></textarea>
                  <button type='submit'>Enviar Email</button>
              </form></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay socios con deuda.</p>";
}

$conn->close();
?>

<a href="ingreso_bibliotecario.php" class="btn btn-secondary">Volver al Menú Principal</a>
