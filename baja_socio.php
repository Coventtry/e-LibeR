<?php
require 'conexion_BD.php';

// Establecer el conjunto de caracteres
$conn->set_charset("utf8mb4");

// Inicializar variables
$socios = [];
$nombre = '';
$apellido = '';
$mensaje = '';

// Si se envió el formulario para buscar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';

    // Filtrar por nombre y apellido
    $sql = "SELECT * FROM socios WHERE nombre LIKE ? AND apellido LIKE ?";
    $stmt = $conn->prepare($sql);
    
    $param_nombre = '%' . $nombre . '%';
    $param_apellido = '%' . $apellido . '%';
    $stmt->bind_param("ss", $param_nombre, $param_apellido);
    $stmt->execute();
    $result = $stmt->get_result();

    // Guardar los socios encontrados en un array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $socios[] = $row; // Almacenar el socio
        }
    } else {
        $mensaje = 'No se encontraron socios que coincidan con la búsqueda.';
    }

    $stmt->close();
}

// Si se seleccionó un socio para dar de baja
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dar_baja'])) {
    $socio_id = $_POST['socio_id'];

    // Aquí puedes hacer la lógica para dar de baja al socio
    $sql_delete = "DELETE FROM socios WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $socio_id);

    if ($stmt_delete->execute()) {
        $mensaje = 'Socio dado de baja exitosamente.';
    } else {
        $mensaje = 'Error al dar de baja al socio.';
    }

    $stmt_delete->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar de Baja a un Socio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #e8f5e9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #388e3c;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        button {
            background-color: #388e3c;
            color: white;
            border: none;
        }
        button:hover {
            background-color: #2e7d32;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #388e3c;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .alert {
            color: #721c24;
            padding: 10px;
            background-color: #f8d7da;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Dar de Baja a un Socio</h1>

    <?php if ($mensaje): ?>
        <div class="alert"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form action="baja_socio.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" 
                oninput="document.getElementById('apellido').disabled = this.value !== '';" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" 
                oninput="document.getElementById('nombre').disabled = this.value !== '';" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Socio</button>
    </form>

    <?php if (!empty($socios)): ?>
        <form action="baja_socio.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="socio_id">Selecciona un Socio:</label>
                <select class="form-control" id="socio_id" name="socio_id" required>
                    <option value="">Seleccione...</option>
                    <?php foreach ($socios as $socio): ?>
                        <option value="<?php echo $socio['id']; ?>">
                            <?php echo htmlspecialchars($socio['nombre'] . ' ' . $socio['apellido']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-danger btn-block" name="dar_baja">Dar de Baja</button>
        </form>
    <?php endif; ?>

    <a class="back-link" href="ingreso_bibliotecario.php">Volver a la página principal</a>
</div>
</body>
</html>
