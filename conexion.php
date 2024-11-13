<?php
require 'conexion_BD.php';

// Obtener los datos del formulario de login
$email = $_POST['email'];
$password = $_POST['password'];

// Preparar la consulta SQL para verificar si el email existe en la base de datos
$sql = "SELECT * FROM bibliotecarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró el usuario
if ($result->num_rows > 0) {
    // El usuario existe, ahora verificamos la contraseña
    $row = $result->fetch_assoc();

    // Verificar la contraseña usando password_verify
    if (password_verify($password, $row['password'])) {
        // Iniciar la sesión
        session_start();
        $_SESSION['usuario'] = $row['usuario']; // Almacena el nombre del usuario en la sesión

        // Redirigir al archivo ingreso_bibliotecario.php
        header("Location: ingreso_bibliotecario.php");
        exit();
    } else {
        // Contraseña incorrecta
        echo '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin: 20px auto; width: 80%; text-align: center; border-radius: 10px; font-size: 18px; font-weight: bold;">';
        echo "Error: Contraseña incorrecta.";
        echo '</div>';
        // Redirigir a login.html después de 1 segundo
        echo '<meta http-equiv="refresh" content="1;url=login.html">';
    }
} else {
    // Usuario no encontrado
    echo '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin: 20px auto; width: 80%; text-align: center; border-radius: 10px; font-size: 18px; font-weight: bold;">';
    echo "Error: Usuario no encontrado.";
    echo '</div>';
    // Redirigir a login.html después de 1 segundo
    echo '<meta http-equiv="refresh" content="1;url=login.html">';
}

// Cerrar declaración y conexión
$stmt->close();
$conn->close();
?>
