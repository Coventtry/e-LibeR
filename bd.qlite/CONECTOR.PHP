<?php
try {
    $conn = new PDO("sqlite:LA_BIBLIOTECA.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configuraciones importantes para evitar bloqueos
    $conn->exec("PRAGMA journal_mode=WAL;"); // Modo Write-Ahead Logging
    $conn->exec("PRAGMA busy_timeout=30000;"); // 30 segundos de espera
    $conn->exec("PRAGMA synchronous=NORMAL;"); // Balance entre seguridad y rendimiento
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
