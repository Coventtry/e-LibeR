<?php
require 'conexion_BD.php'; // Asegúrate de tener la conexión a la base de datos en este archivo

// Inicializar mensaje de éxito o error
$mensaje = '';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_area = $conn->real_escape_string($_POST['nombre_area']);
    $codigo_area = $conn->real_escape_string($_POST['codigo_area']);
    
    // Validar que los campos no estén vacíos
    if (!empty($nombre_area) && !empty($codigo_area)) {
        // Insertar en la base de datos
        $sql = "INSERT INTO areas (nombre, codigo_dewey) VALUES ('$nombre_area', '$codigo_area')";
        if ($conn->query($sql) === TRUE) {
            $mensaje = "¡Área agregada exitosamente!";
        } else {
            $mensaje = "Error al agregar el área: " . $conn->error;
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Áreas</title>
    <style>
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem;
        }
        a:hover {
            color: #218838;
        }
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="text"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
            width: 100%;
        }
        .btn-primary {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
        }
        .alert-success {
            background-color: #c8e6c9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
        }
        footer {
            background-color: #161245;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 340px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Cargar Nueva Área</h1>

    <!-- Formulario para cargar áreas -->
    <form method="post" action="">
        <input type="text" name="nombre_area" placeholder="Nombre del Área" required>
        <input type="text" name="codigo_area" placeholder="Código Dewey del Área" required>
        <button type="submit" class="btn-primary">Guardar Área</button>
    </form>

    <!-- Mensaje de éxito o error -->
    <?php if ($mensaje): ?>
        <div class="<?php echo strpos($mensaje, 'Error') === false ? 'alert-success' : 'alert-error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    
    <div>
    <a href="ingreso_bibliotecario.php" class="btn btn-secondary">Volver al Menú Principal</a>
</div>
    </div>
<!-- Footer -->
<footer>
    <h6>Práctica Profesionalizante I</h6>
    <p>Esta página fue desarrollada utilizando HTML 5, CSS, PHP</p>
</footer>

</body>
</html>
