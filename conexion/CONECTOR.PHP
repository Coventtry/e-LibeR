<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=biblioteca", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configuraciones importantes para evitar bloqueos
    $conn->exec("SET SESSION wait_timeout=30000;"); // 30 segundos de espera
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>