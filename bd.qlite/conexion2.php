<?php
session_start();

// Conectar a la base de datos SQLite
$db = new SQLite3('LA_BIBLIOTECA.db');

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar si el bibliotecario está registrado
    $stmt = $db->prepare("SELECT * FROM bibliotecarios WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $bibliotecario = $result->fetchArray(SQLITE3_ASSOC);

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
