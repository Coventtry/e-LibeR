<?php
session_start(); // Siempre al inicio para usar $_SESSION

try {
    // Conectar a la base de datos SQLite
    $db_path = __DIR__ . '/LA_BIBLIOTECA.db'; // Ruta relativa segura
    $conn = new PDO("sqlite:" . $db_path);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Obtener los datos del formulario de login
$email = $_POST['email'];
$password = $_POST['password'];

// Preparar la consulta SQL para verificar si el email existe en la base de datos
$sql = "SELECT * FROM bibliotecarios WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // Verificar la contraseña usando password_verify
    if (password_verify($password, $row['password'])) {
        // Guardar sesión
        $_SESSION['usuario'] = $row['usuario'];

        // Redirigir al ingreso
        header("Location: ingreso_bibliotecario.php");
        exit();
    } else {
        // Contraseña incorrecta
        echo '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin: 20px auto; width: 80%; text-align: center; border-radius: 10px; font-size: 18px; font-weight: bold;">';
        echo "Error: Contraseña incorrecta.";
        echo '</div>';
        echo '<meta http-equiv="refresh" content="1;url=login.html">';
    }
} else {
    // Usuario no encontrado
    echo '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin: 20px auto; width: 80%; text-align: center; border-radius: 10px; font-size: 18px; font-weight: bold;">';
    echo "Error: Usuario no encontrado.";
    echo '</div>';
    echo '<meta http-equiv="refresh" content="1;url=login.html">';
}
?>
