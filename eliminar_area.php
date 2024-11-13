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

// Verificar si se ha enviado el formulario para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_area = $_POST['id']; // ID del área seleccionada para eliminar
    
    // Eliminar área de la base de datos
    $sql = "DELETE FROM areas WHERE id = $id_area";
    
    if ($conn->query($sql) === TRUE) {
        $mensaje = "¡Área eliminada exitosamente!";

        // Recargar la lista de áreas después de la eliminación
        try {
            $areas = cargarAreas($conn);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    } else {
        $mensaje = "Error al eliminar el área: " . $conn->error;
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
    <title>Eliminar Área</title>
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
    <h1>Eliminar Área</h1>

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

    <!-- Formulario para seleccionar el área a eliminar -->
    <form method="post" action="">
        <select name="id" required>
            <option value="">Seleccione un Área</option>
            <?php foreach ($areas as $area_item): ?>
                <option value="<?php echo $area_item['id']; ?>"><?php echo htmlspecialchars($area_item['nombre']); ?> - <?php echo htmlspecialchars($area_item['codigo_dewey']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-primary">Eliminar Área</button>
    </form>
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
