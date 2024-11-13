<?php
// Datos de conexión a la base de datos
$host = "localhost";   // Cambiar si es necesario
$user = "rodrigogar24"; // Usuario de la base de datos
$pass = "";            // Contraseña de la base de datos (dejar en blanco si no hay)
$db = "biblioteca";    // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si los datos han sido enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $correo = strtolower($_POST['email']); // Convertir el correo a minúsculas
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Hashear la contraseña
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Verificar si el correo ya está registrado
    $sql = "SELECT * FROM bibliotecarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el usuario ya existe, mostrar mensaje en rojo
        echo "<div style='color: #fff; background-color: #e74c3c; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;'>
                Usuario existente, por favor <a href='login.html' style='color: #fff; text-decoration: underline;'>loguearse</a>
              </div>";
    } else {
        // Si no existe, crear nuevo registro
        $sql = "INSERT INTO bibliotecarios (nombre, email, usuario, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $correo, $usuario, $hashedPassword);
        
        if ($stmt->execute()) {
            // Si se registra correctamente, mostrar mensaje de éxito en verde
            echo "<div style='color: #fff; background-color: #2ecc71; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;'>
                    Registro exitoso. Ya puedes <a href='login.html' style='color: #fff; text-decoration: underline;'>iniciar sesión</a>
                  </div>";
        } else {
            // Si ocurre un error al registrar, mensaje de error en rojo
            echo "<div style='color: #fff; background-color: #e74c3c; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;'>
                    Error en el registro. Inténtalo de nuevo.
                  </div>";
        }
    }

    // Cerrar la conexión y la declaración
    $stmt->close();
}
$conn->close();
?>
