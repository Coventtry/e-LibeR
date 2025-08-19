<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=biblioteca", "root", ""); // Conecta con el servidor MySQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Para que lance excepciones en errores
} catch (Exception $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>