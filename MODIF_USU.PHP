<?php
session_start();
try {
    $host = 'localhost';
    $dbname = 'biblioteca';
    $username = 'root';
    $password = '';

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$usuario_actual = $_SESSION['usuario'];
$mensaje = '';
$error = '';

// Obtener datos actuales
$sql = "SELECT nombre, email, usuario FROM bibliotecarios WHERE usuario = :usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':usuario', $usuario_actual);
$stmt->execute();
$datos_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $nuevo_usuario = $_POST['usuario'];

    // Validar que el nuevo nombre de usuario no esté duplicado
    $sql_check = "SELECT COUNT(*) FROM bibliotecarios WHERE usuario = :nuevo_usuario AND usuario != :actual";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':nuevo_usuario', $nuevo_usuario);
    $stmt_check->bindParam(':actual', $usuario_actual);
    $stmt_check->execute();
    $existe = $stmt_check->fetchColumn();

    if ($existe > 0) {
        $error = "El nombre de usuario ya está en uso.";
    } else {
        $sql_update = "UPDATE bibliotecarios SET nombre = :nombre, email = :email, usuario = :nuevo_usuario WHERE usuario = :usuario_actual";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':nombre', $nombre);
        $stmt_update->bindParam(':email', $email);
        $stmt_update->bindParam(':nuevo_usuario', $nuevo_usuario);
        $stmt_update->bindParam(':usuario_actual', $usuario_actual);

        if ($stmt_update->execute()) {
            $mensaje = "Datos actualizados correctamente";
            $_SESSION['usuario'] = $nuevo_usuario; // Actualiza la sesión
            $datos_usuario['nombre'] = $nombre;
            $datos_usuario['email'] = $email;
            $datos_usuario['usuario'] = $nuevo_usuario;
        } else {
            $error = "Error al actualizar los datos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .contenedor {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .titulo {
            color: #052442;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-primary {
            background-color: #052442;
            border-color: #052442;
        }
        .info-usuario {
            background-color: #f0f8ff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2 class="titulo"><i class="bi bi-person-lines-fill"></i> Modificar Datos Personales</h2>
        
        <div class="info-usuario">
<p><strong>Usuario:</strong> <?php echo htmlspecialchars($datos_usuario['usuario']); ?></p>
        </div>
        
        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
    <label for="usuario" class="form-label">Nombre de Usuario</label>
    <input type="text" class="form-control" id="usuario" name="usuario" 
           value="<?php echo htmlspecialchars($datos_usuario['usuario']); ?>" required>
</div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" 
                       value="<?php echo htmlspecialchars($datos_usuario['nombre']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?php echo htmlspecialchars($datos_usuario['email']); ?>" required>
            </div>            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="ingreso_bibliotecario_1.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
             <a href="ingreso_bibliotecario_1.php" class="volver d-block text-center mt-4">← Volver al menú principal</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>