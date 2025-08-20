    <link rel="icon" href="../assets/img/icono.ico" type="image/x-icon">
<?php
// Inicializar variables
$mensaje = '';

// Incluir el archivo de conexión
try {
    require '../conexion/CONECTAR_2.php';
} catch (Exception $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Procesar el formulario solo si es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos existen antes de usarlos
    $nombre_area = isset($_POST['nombre_area']) ? trim($_POST['nombre_area']) : '';
    $codigo_area = isset($_POST['codigo_area']) ? trim($_POST['codigo_area']) : '';
    $Abreviado = isset($_POST['Abreviado']) ? trim($_POST['Abreviado']) : '';

    if (empty($nombre_area) || empty($codigo_area)) {
        $mensaje = "Por favor, complete todos los campos.";
    } else {
        try {
            // Verificar si el área ya existe
            $sql_verificar = "SELECT COUNT(*) FROM areas WHERE nombre = :nombre";
            $stmt_verificar = $conn->prepare($sql_verificar);
            $stmt_verificar->execute([':nombre' => $nombre_area]);
            $existe = $stmt_verificar->fetchColumn();
            
            if ($existe) {
                $mensaje = "Error: El área '$nombre_area' ya existe en la base de datos.";
            } else {
                // Insertar nueva área
                $sql = "INSERT INTO areas (codigo_dewey, nombre,  Abreviado) VALUES (:codigo, :nombre, :Abreviado)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':nombre' => $nombre_area,
                    ':Abreviado' => $Abreviado,
                    ':codigo' => $codigo_area
                ]);
                $mensaje = "¡Área '$nombre_area' agregada exitosamente!";
            }
        } catch (PDOException $e) {
            // Manejo específico del error de restricción única
            if ($e->getCode() == '23000') {
                $mensaje = "Error: El área '$nombre_area' o su código ya existen en la base de datos.";
            } else {
                $mensaje = "Error al procesar la solicitud: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cargar Áreas</title>
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #e8f5e9;
        font-family: Arial, sans-serif;
    }

    .wrapper {
        min-height: 100vh; /* Altura mínima de la ventana */
        display: flex;
        flex-direction: column;
    }

    .main-content {
        flex: 1; /* Ocupa todo el espacio disponible */
    }

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
        border-top: 2px solid #2e7d32;
    }
</style>

</head>
<body>

<div class="container">
    <h1>Cargar Nueva Área</h1>
    <form method="post" action="">
        <input type="text" name="nombre_area" placeholder="Nombre del Área" required>
        <input type="text" name="codigo_area" placeholder="Código Dewey del Área" required>
        <input type="text" name="Abreviado" placeholder="Abreviado" required>
        <button type="submit" class="btn-primary">Guardar Área</button>
    </form>

    <?php if (!empty($mensaje)): ?>
        <div class="<?php echo strpos($mensaje, 'Error') === false ? 'alert-success' : 'alert-error'; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <a href="../ingreso_bibliotecario_1.php" class="btn btn-secondary">Volver al Menú Principal</a>
</div>

<?php include 'footer1.html'; ?>

</body>
</html>