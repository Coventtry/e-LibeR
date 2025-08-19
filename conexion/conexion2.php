<?php
session_start();

// Conectar a la base de datos MySQL
try {
    $pdo = new PDO("mysql:host=localhost;dbname=biblioteca", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar si el bibliotecario está registrado
    $stmt = $pdo->prepare("SELECT * FROM bibliotecarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $bibliotecario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validar email y contraseña
    if ($bibliotecario && $bibliotecario['password'] === $password) {
        $_SESSION['bibliotecario'] = $bibliotecario['nombre'];
        header("Location: ingreso_bibliotecario.php");
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='index.html';</script>";
        exit();
    }
}
?>