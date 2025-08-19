<?php
// conexion_BD.php - Conexión a MySQL

try {
    // Detalles de la base de datos MySQL
    $host = 'localhost';
    $dbname = 'biblioteca';
    $username = 'root';
    $password = '';

    // Crear conexión PDO a MySQL
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configurar atributos de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>