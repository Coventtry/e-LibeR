<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=biblioteca", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
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
    $clave_unica = password_hash($_POST['clave_unica'], PASSWORD_DEFAULT);

    try {
        // Verificar si el correo ya está registrado
        $sql = "SELECT * FROM bibliotecarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $correo);
        $stmt->execute();

        if ($stmt->fetch()) {
            // Si el usuario ya existe, mostrar mensaje en rojo
            echo "<div style='color: #fff; background-color: #e74c3c; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;'>
                    Usuario existente, por favor <a href='login.html' style='color: #fff; text-decoration: underline;'>loguearse</a>
                  </div>";
        } else {
            // Si no existe, crear nuevo registro
           $sql = "INSERT INTO bibliotecarios (nombre, email, usuario, password, Clave_unica) 
        VALUES (:nombre, :email, :usuario, :password, :clave_unica)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':email', $correo);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':password', $hashedPassword);
$stmt->bindParam(':clave_unica', $clave_unica);

            if ($stmt->execute()) {
                echo "<div style='color: #fff; background-color: #2ecc71; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;'>
                        Registro exitoso. Ya puedes <a href='login.html' style='color: #fff; text-decoration: underline;'>iniciar sesión</a>
                      </div>";
            } else {
                echo "<div style='color: #fff; background-color: #e74c3c; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;'>
                        Error en el registro. Inténtalo de nuevo.
                      </div>";
            }
        }
    } catch (PDOException $e) {
        echo "<div style='color: #fff; background-color: #e74c3c; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;'>
                Error de base de datos: " . $e->getMessage() . "
              </div>";
    }
}

$conn = null; // Cerrar conexión
?>
