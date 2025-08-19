<?php
require 'CONECTOR.PHP'; // Debe crear $conn con PDO y SQLite

// Obtener la anotación del formulario (asegurarse de que venga con POST)
$anotacion = $_POST['anotacion'] ?? '';

// Preparar y ejecutar la consulta SQL para insertar la anotación
$sql = "INSERT INTO anotaciones (anotacion) VALUES (:anotacion)";
$stmt = $conn->prepare($sql);
$success = false;

try {
    $success = $stmt->execute([':anotacion' => $anotacion]);
    if ($success) {
        $message = "Anotación guardada exitosamente.";
    } else {
        $message = "Error al guardar la anotación.";
    }
} catch (PDOException $e) {
    $message = "Error al guardar la anotación: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include 'icono.php'; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-message {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .error-message {
            background-color: #dc3545;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
    <?php if ($success): ?>
        <div class="success-message"><?= htmlspecialchars($message) ?></div>
    <?php else: ?>
        <div class="error-message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
</div>

<footer>
    <h6>Practica Profesionalizante I</h6>
    <h6>Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</h6>
</footer>

<script>
    setTimeout(function() {
        window.location.href = 'crear_nota.php';
    }, 3000);
</script>

</body>
</html>
