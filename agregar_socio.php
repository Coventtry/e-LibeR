<?php
require 'conexion_BD.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$anio = $_POST['anio'];
$division = $_POST['division'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO socios (nombre, apellido, email, telefono, direccion,anio,division) VALUES (?, ?, ?, ?, ?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nombre, $apellido, $email, $telefono, $direccion, $anio, $division);

// Crear el HTML para el resultado
echo '<!DOCTYPE html>
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
            flex-direction: column; /* Alinear el contenido verticalmente */
            height: 100vh;
            margin: 0; /* Quitar margen para que el footer se alinee correctamente */
        }
        .message-box {
            background-color: #28a745;
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Espacio entre el mensaje y el footer */
        }
        .error-box {
            background-color: #dc3545;
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Espacio entre el error y el footer */
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%; /* Asegurarse de que el footer ocupe todo el ancho */
            position: absolute; /* Mantener el footer en la parte inferior */
            bottom: 0; /* Alinar al fondo */
        }
    </style>
</head>
<body>';

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    echo '<div class="message-box">
            <h2>¡Socio agregado exitosamente!</h2>
          </div>';
} else {
    echo '<div class="error-box">
            <h2>Error al agregar el socio</h2>
            <p>Ocurrió un error: ' . $conn->error . '</p>
          </div>';
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Redireccionamiento automático
echo '<script>
        setTimeout(function(){
            window.location.href = "ingreso_bibliotecario.php";
        }, 3000);
      </script>';
?>
<footer>
    <h6>Practica Profesionalizante I</h6>
    <h6>Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</h6>
</footer>
</body>
</html>

