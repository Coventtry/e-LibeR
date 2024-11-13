<?php
require 'conexion_BD.php';

// Obtener la anotación del formulario
$anotacion = $_POST['anotacion'];

// Preparar y ejecutar la consulta SQL para insertar la anotación
$sql = "INSERT INTO anotaciones (anotacion) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $anotacion);

if ($stmt->execute()) {
    $message = "Anotación guardada exitosamente.";
    $success = true;
} else {
    $message = "Error al guardar la anotación: " . $stmt->error;
    $success = false;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php
include 'icono.php';
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Carga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success-message {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            background-color: #dc3545;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            text-align: center;
        }

        .btn-secondary {
            background-color: #218838;
        }

        footer {
            background-color: blue;
            color: white;
            padding: 32px;
            text-align: center;
            margin-top: 428px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Mostrar el mensaje dependiendo del tipo de resultado -->
    <?php if ($success): ?>
        <div class="success-message">
            <?= $message ?>
        </div>
    <?php else: ?>
        <div class="error-message">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Enlace para volver al menú principal -->
</div>

<!-- Footer -->
<footer>
    <h6>Practica Profesionalizante I</h6>
    <h6>Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</h6>
</footer>

</body>
</html>

<script>
    // Redirigir después de 3 segundos
    setTimeout(function() {
        window.location.href = 'crear_nota.php'; // Redirigir a la página de crear nota
    }, 3000); // Redirigir después de 3 segundos
</script>
