<?php
// conexion_BD.php - Conexión a SQLite

try {
    // Ruta a tu archivo de base de datos SQLite
    $dbFile = __DIR__ . 'LA_BIBLIOTECA.db';
    
    // Crear conexión PDO a SQLite
    $conn = new PDO("sqlite:$dbFile");
    
    // Configurar atributos de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Opcional: Activar claves foráneas (si es necesario)
    $conn->exec('PRAGMA foreign_keys = ON;');
    
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>