<?php
// Habilitar reporte de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicializar variables
$mensaje = '';
$error = false;

// Incluir archivo de conexión
try {
    require '../conexion/CONECTAR_2.php'; // Asegúrate que este es el nombre correcto del archivo
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar datos de entrada
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $anio = trim($_POST['anio'] ?? '');
    $division = trim($_POST['division'] ?? '');

    // Validaciones básicas
    if (empty($nombre) || empty($apellido)) {
        $mensaje = "Error: Nombre y apellido son obligatorios.";
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
        $mensaje = "Error: El formato del email no es válido.";
        $error = true;
    }

    if (!$error) {
        try {
            // Insertar los datos en la base de datos
            $sql = "INSERT INTO socios (nombre, apellido, email, telefono, direccion, anio, division) 
                    VALUES (:nombre, :apellido, :email, :telefono, :direccion, :anio, :division)";
            $stmt = $conn->prepare($sql);
            
            $stmt->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':email' => $email,
                ':telefono' => $telefono,
                ':direccion' => $direccion,
                ':anio' => $anio,
                ':division' => $division
            ]);
            
            $mensaje = "¡Socio agregado exitosamente!";
        } catch (PDOException $e) {
            $error = true;
            // Manejo específico de errores comunes
            if ($e->getCode() == '23000') {
                $mensaje = "Error: El email ya está registrado para otro socio.";
            } else {
                $mensaje = "Error al agregar el socio: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            background-color: #28a745;
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 600px;
            width: 90%;
        }
        .error-box {
            background-color: #dc3545;
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 600px;
            width: 90%;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 30px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<?php if (!empty($mensaje)): ?>
    <div class="<?php echo $error ? 'error-box' : 'message-box'; ?>">
        <h2><?php echo htmlspecialchars($mensaje); ?></h2>
        <?php if ($error && strpos($mensaje, 'Error') !== false): ?>
            <p>Por favor, verifica los datos e intenta nuevamente.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script>
    setTimeout(function(){
        window.location.href = "../ingreso_bibliotecario_1.php";
    }, 3000);
</script>

<footer>
    <h6>Practica Profesionalizante I</h6>
    <h6>Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</h6>
</footer>
</body>
</html>