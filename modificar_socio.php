<?php
require 'conexion_BD.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos.

// Inicializar variables
$socio = null;
$socios = [];
$mensaje = "";

// Si se envió el email para buscar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $email_busqueda = $_POST['email'];

    // Validar que el email sea correcto y solo tomar los primeros 3 caracteres antes del '@'
    if (preg_match('/^[^@]+$/', $email_busqueda)) {
        // Extraer los primeros 3 caracteres antes del '@'
        $email_base = substr($email_busqueda, 0, 3);
        
        // Consultar la base de datos para encontrar socios cuyo email contenga los primeros 3 caracteres antes del '@'
        $sql_busqueda = "SELECT * FROM socios WHERE SUBSTRING_INDEX(email, '@', 1) LIKE ?";
        $stmt_busqueda = $conn->prepare($sql_busqueda);
        $param_email = '%' . $email_base . '%'; // Buscar por los primeros 3 caracteres
        $stmt_busqueda->bind_param("s", $param_email);
        $stmt_busqueda->execute();
        $resultado_busqueda = $stmt_busqueda->get_result();

        // Si se encuentran socios
        if ($resultado_busqueda->num_rows > 0) {
            while ($socio = $resultado_busqueda->fetch_assoc()) {
                $socios[] = $socio; // Almacenar los resultados
            }
        } else {
            echo '<div class="alert alert-danger text-center">No se encontraron socios con ese email.</div>';
        }
        $stmt_busqueda->close();
    } else {
        echo '<div class="alert alert-danger text-center">El email debe ser válido hasta el símbolo "@".</div>';
    }
}

// Actualizar los datos del socio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $socio_id = $_POST['socio_id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $anio = $_POST['anio'];
    $division = $_POST['division'];

    // Actualizar los datos del socio en la base de datos
    $sqlActualizar = "UPDATE socios SET nombre = ?, apellido = ?, email = ?, telefono = ?, anio = ?, division = ? WHERE id = ?";
    $stmtActualizar = $conn->prepare($sqlActualizar);
    $stmtActualizar->bind_param("ssssiii", $nombre, $apellido, $email, $telefono, $anio, $division, $socio_id);

    if ($stmtActualizar->execute()) {
        $mensaje = '<div class="alert alert-success text-center">Datos del socio actualizados correctamente.</div>';
    } else {
        $mensaje = '<div class="alert alert-danger text-center">Error al actualizar los datos del socio.</div>';
    }
    $stmtActualizar->close();
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Socio</title>
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
            text-align:center;
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
            margin-top: 200px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modificar Socio</h1>

        <!-- Formulario para buscar al socio por email -->
        <form action="modificar_socio.php" method="POST">
            <div class="form-group">
                <label for="email">Email del Socio:</label>
                <input type="text" class="form-control" name="email" id="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Socio</button>
        </form>

        <?php if (!empty($socios)): ?>
            <form action="modificar_socio.php" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="socio_id">Selecciona un Socio:</label>
                    <select class="form-control" id="socio_id" name="socio_id" onchange="mostrarDatosSocio(this.value)">
                        <option value="">Selecciona un socio</option>
                        <?php foreach ($socios as $socio): ?>
                            <option value="<?php echo $socio['id']; ?>" data-nombre="<?php echo htmlspecialchars($socio['nombre']); ?>"
                                    data-apellido="<?php echo htmlspecialchars($socio['apellido']); ?>"
                                    data-email="<?php echo htmlspecialchars($socio['email']); ?>"
                                    data-telefono="<?php echo htmlspecialchars($socio['telefono']); ?>"
                                    data-anio="<?php echo htmlspecialchars($socio['anio']); ?>"
                                    data-division="<?php echo htmlspecialchars($socio['division']); ?>">
                                <?php echo htmlspecialchars($socio['email']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>

            <div id="datosSocio" style="display: none;"><br>
                <h3>Datos del Socio:</h3>
                <form action="modificar_socio.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="emailSocio" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="anio">Año:</label>
                        <select class="form-control" id="anio" name="anio" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="division">División:</label>
                        <select class="form-control" id="division" name="division" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <input type="hidden" name="socio_id" id="socio_id_hidden">
                    <button type="submit" class="btn btn-success btn-block" name="actualizar">Actualizar Datos</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Mostrar mensaje de actualización -->
        <?php if ($mensaje): ?>
            <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
        <?php endif; ?>

    </div>

    <script>
        function mostrarDatosSocio(socio_id) {
            const selectedOption = document.querySelector(`#socio_id option[value="${socio_id}"]`);
            const nombre = selectedOption.dataset.nombre;
            const apellido = selectedOption.dataset.apellido;
            const email = selectedOption.dataset.email;
            const telefono = selectedOption.dataset.telefono;
            const anio = selectedOption.dataset.anio;
            const division = selectedOption.dataset.division;

            // Mostrar los datos del socio seleccionando
            document.getElementById('nombre').value = nombre;
            document.getElementById('apellido').value = apellido;
            document.getElementById('emailSocio').value = email;
            document.getElementById('telefono').value = telefono;
            document.getElementById('anio').value = anio;
            document.getElementById('division').value = division;
            document.getElementById('socio_id_hidden').value = socio_id;

            document.getElementById('datosSocio').style.display = 'block'; // Mostrar los datos
        }
    </script>
           <a href="ingreso_bibliotecario.php">Volver a la página principal</a>
    <!-- Pie de página -->
    <footer>
        <p>Practica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP
        </p>
    </footer>
</body>
</html>
