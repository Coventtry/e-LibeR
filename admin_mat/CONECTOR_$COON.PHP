<?php
try {
    $conn = new PDO("sqlite:biblioteca2.db"); // Ajustá el DSN si usás MySQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
