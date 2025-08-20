    <link rel="icon" href="assets/img/icono.ico" type="image/x-icon">
<?php
session_start();

// Conexión a la base de datos
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

// Verificar si hay sesión activa
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$usuario_actual = $_SESSION['usuario'];
$mensaje = '';
$error = '';

// Obtener datos actuales
$sql = "SELECT nombre, email, usuario, picture FROM bibliotecarios WHERE usuario = :usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':usuario', $usuario_actual);
$stmt->execute();
$datos_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $nuevo_usuario = $_POST['usuario'];

    // Procesar imagen subida o eliminarla
    if (isset($_POST['quitar_imagen']) && $_POST['quitar_imagen'] == 1) {
        // Eliminar referencia en DB
        $picture = '';
        // Borrar archivo físico
        if (!empty($datos_usuario['picture']) && file_exists('uploads/' . $datos_usuario['picture'])) {
            unlink('uploads/' . $datos_usuario['picture']);
        }
    } elseif (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $archivoTmp = $_FILES['picture']['tmp_name'];
        $nombreArchivo = basename($_FILES['picture']['name']);
        $rutaDestino = 'uploads/' . $nombreArchivo;

        // Crear carpeta uploads si no existe
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Mover archivo a la carpeta uploads
        if (move_uploaded_file($archivoTmp, $rutaDestino)) {
            $picture = $nombreArchivo; // nombre que se guarda en la DB
        } else {
            $picture = $datos_usuario['picture']; // Mantener imagen anterior si falla
        }
    } else {
        $picture = $datos_usuario['picture']; // Mantener imagen actual
    }

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
        $sql_update = "UPDATE bibliotecarios 
                       SET nombre = :nombre, email = :email, usuario = :nuevo_usuario, picture = :picture 
                       WHERE usuario = :usuario_actual";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':nombre', $nombre);
        $stmt_update->bindParam(':email', $email);
        $stmt_update->bindParam(':picture', $picture);
        $stmt_update->bindParam(':nuevo_usuario', $nuevo_usuario);
        $stmt_update->bindParam(':usuario_actual', $usuario_actual);

        if ($stmt_update->execute()) {
            $mensaje = "Datos actualizados correctamente";
            $_SESSION['usuario'] = $nuevo_usuario; // Actualiza la sesión
            $datos_usuario['nombre'] = $nombre;
            $datos_usuario['email'] = $email;
            $datos_usuario['picture'] = $picture;
            $datos_usuario['usuario'] = $nuevo_usuario;
        } else {
            $error = "Error al actualizar los datos";
        }
    }
}

// Imagen para mostrar (por defecto si no hay)
$imagen_perfil = !empty($datos_usuario['picture']) 
    ? 'uploads/' . htmlspecialchars($datos_usuario['picture']) 
    : 'assets/img/login.png';
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
        .perfil-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: 10px;
            border: 2px solid #052442;
        }
    </style>
</head>
<body>
<div class="contenedor container mt-4">
    <h2 class="titulo"><i class="bi bi-person-lines-fill"></i> Modificar Datos Personales</h2>
    
    <div class="info-usuario mb-3">
        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($datos_usuario['usuario']); ?></p>
    </div>
    
    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
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

        <div class="mb-3">
            <label for="picture" class="form-label">Imagen de Perfil</label>
            <input type="file" class="form-control" id="picture" name="picture">

            <?php if (!empty($datos_usuario['picture'])): ?>
                <img src="uploads/<?php echo htmlspecialchars($datos_usuario['picture']); ?>" 
                     alt="Imagen de perfil" class="perfil-img">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="1" id="quitar_imagen" name="quitar_imagen">
                    <label class="form-check-label" for="quitar_imagen">
                        Quitar imagen de perfil
                    </label>
                </div>
            <?php else: ?>
                <img src="assets/img/login.png" alt="Imagen de perfil" class="perfil-img">
            <?php endif; ?>
        </div>     

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="ingreso_bibliotecario_1.php" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const inputPicture = document.getElementById('picture');
    const perfilImg = document.querySelector('.perfil-img');

    inputPicture.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                perfilImg.src = e.target.result; // Cambia la imagen al archivo seleccionado
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</div>
<footer>
  <?php include 'componentes/footer1.html'; ?>
</footer>
</body>
</html>
