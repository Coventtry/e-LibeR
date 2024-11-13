<?php
require 'conexion_BD.php';

$message = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta para eliminar la noticia
    $sql = "DELETE FROM noticias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Noticia eliminada correctamente. Redirigiendo...</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error al eliminar la noticia. Redirigiendo...</div>";
    }
} else {
    $message = "<div class='alert alert-warning'>No se recibió un ID válido para eliminar. Redirigiendo...</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Eliminar Noticia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
            color: #2e7d32;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
        .alert {
            font-weight: bold;
            margin-top: 10px;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #388e3c;
            text-decoration: none;
            font-size: 1.1rem;
        }
        a:hover {
            color: #2e7d32;
        }
    </style>
    <script>
        // Redirigir después de 1 segundo
        setTimeout(function() {
            window.location.href = 'avisador.php';
        }, 1000); // 1000 milisegundos = 1 segundo
    </script>
</head>
<body>
<div class="container">
    <h2>Eliminar Noticia</h2>
    <?php echo $message; ?>
</div>
</body>
</html>

