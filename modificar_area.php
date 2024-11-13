<?php
require 'conexion_BD.php'; // Asegúrate de tener la conexión a la base de datos en este archivo

// Inicializar variables
$mensaje = '';
$areas = [];
$area = null; // Inicializar la variable para almacenar el área seleccionada

// Función para cargar áreas desde la base de datos
function cargarAreas($conn) {
    $areas = [];
    $result = $conn->query("SELECT * FROM areas");
    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $areas[] = $row;
            }
        }
    } else {
        throw new Exception("Error al consultar áreas: " . $conn->error);
    }
    return $areas;
}

// Cargar áreas inicialmente
try {
    $areas = cargarAreas($conn);
} catch (Exception $e) {
    $mensaje = $e->getMessage();
}

// Verificar si se ha enviado el formulario para modificar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_area = $_POST['id']; // Cambiado a 'id' en lugar de 'id_area'
    
    // Consultar los datos del área seleccionada
    $result = $conn->query("SELECT * FROM areas WHERE id = $id_area");

    if ($result) {
        if ($result->num_rows > 0) {
            $area = $result->fetch_assoc();
        } else {
            $mensaje = "Área no encontrada.";
        }
    } else {
        $mensaje = "Error al consultar el área: " . $conn->error;
    }
}

// Procesar el formulario para modificar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre_area'], $_POST['codigo_area'])) {
    $nombre_area = $conn->real_escape_string($_POST['nombre_area']);
    $codigo_area = $conn->real_escape_string($_POST['codigo_area']);
    
    // Actualizar en la base de datos
    $sql = "UPDATE areas SET nombre = '$nombre_area', codigo_dewey = '$codigo_area' WHERE id = $id_area"; // Cambiado a 'id' en lugar de 'id_area'
    if ($conn->query($sql) === TRUE) {
        $mensaje = "¡Área modificada exitosamente!";
        $area = null; // Resetea el área para evitar mostrar datos después de la modificación

        // Recargar la lista de áreas
        try {
            $areas = cargarAreas($conn);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    } else {
        $mensaje = "Error al modificar el área: " . $conn->error;
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
    <title>Modificar Área</title>
    <style>
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem; /* Aumentar el tamaño de fuente del enlace */
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
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="text"], select {
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
            margin-top: 20px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Modificar Área</h1>

    <?php if ($mensaje): ?>
        <div class="<?php echo strpos($mensaje, 'Error') === false ? 'alert-success' : 'alert-error'; ?>">
            <?php echo $mensaje; ?>
        </div>
        <?php if (strpos($mensaje, 'Éxito') !== false): ?>
            <script>
                setTimeout(function() {
                    location.reload(); // Refresca la página después de 2 segundos
                }, 2000);
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Formulario para seleccionar el área a modificar -->
    <form method="post" action="">
        <select name="id" required> <!-- Cambiado a 'id' en lugar de 'id_area' -->
            <option value="">Seleccione un Área</option>
            <?php foreach ($areas as $area_item): ?>
                <option value="<?php echo $area_item['id']; ?>"><?php echo htmlspecialchars($area_item['nombre']); ?> - <?php echo htmlspecialchars($area_item['codigo_dewey']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-primary">Modificar Área</button>
    </form>

    <!-- Formulario para modificar los datos si se ha seleccionado un área -->
    <?php if ($area): ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $area['id']; ?>"> <!-- Cambiado a 'id' en lugar de 'id_area' -->
            <input type="text" name="nombre_area" value="<?php echo htmlspecialchars($area['nombre']); ?>" placeholder="Nombre del Área" required>
            <input type="text" name="codigo_area" value="<?php echo htmlspecialchars($area['codigo_dewey']); ?>" placeholder="Código del Área" required>
            <button type="submit" class="btn-primary">Guardar Cambios</button>
        </form>
    <?php else: ?>
        <p>Por favor, seleccione un área para modificar.</p>
    <?php endif; ?>
</div>

<div>
    <a href="ingreso_bibliotecario.php">Volver a la página principal</a>
</div>

<!-- Footer -->
<footer>
    <h6>Práctica Profesionalizante I</h6>
    <p>Esta página fue desarrollada utilizando HTML 5, CSS, PHP</p>
</footer>

</body>
</html>
