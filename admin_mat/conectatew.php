<?php
try {
    $pdo = new PDO("sqlite:Biblioteca2.db"); // Conecta con el archivo SQLite Biblioteca2.db
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Para que lance excepciones en errores
} catch (Exception $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

?>
