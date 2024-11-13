<?php 
require 'conexion_BD.php'; // Conexión a la base de datos

// Inicializar variables
$socio = null;
$socios = [];
$prestamosActivos = [];
$prestamosInactivos = [];
$mensaje = "";

// Función para devolver el material y actualizar la disponibilidad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['devolver_material'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $material_id = $_POST['material_id'];

    // Eliminar el préstamo de la base de datos (cambiar estado a 'devuelto')
    $sqlUpdateEstado = "UPDATE prestamos SET estado = 'devuelto' WHERE id = ?";
    $stmtUpdateEstado = $conn->prepare($sqlUpdateEstado);
    $stmtUpdateEstado->bind_param("i", $prestamo_id);
    $stmtUpdateEstado->execute();

    // Incrementar la disponibilidad del material
    $sqlUpdateMaterial = "UPDATE materiales SET disponibilidad = disponibilidad + 1 WHERE id = ?";
    $stmtUpdateMaterial = $conn->prepare($sqlUpdateMaterial);
    $stmtUpdateMaterial->bind_param("i", $material_id);
    $stmtUpdateMaterial->execute();

    // Mensaje de confirmación
    $mensaje = '<div class="alert alert-success text-center">El material ha sido devuelto y la disponibilidad ha sido actualizada.</div>';

    $stmtUpdateEstado->close();
    $stmtUpdateMaterial->close();
}

// Función para devolver el material anticipadamente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['devolver_material_anticipado'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $material_id = $_POST['material_id'];

    // Eliminar el préstamo de la base de datos (cambiar estado a 'devuelto')
    $sqlUpdateEstado = "UPDATE prestamos SET estado = 'devuelto' WHERE id = ?";
    $stmtUpdateEstado = $conn->prepare($sqlUpdateEstado);
    $stmtUpdateEstado->bind_param("i", $prestamo_id);
    $stmtUpdateEstado->execute();

    // Incrementar la disponibilidad del material
    $sqlUpdateMaterial = "UPDATE materiales SET disponibilidad = disponibilidad + 1 WHERE id = ?";
    $stmtUpdateMaterial = $conn->prepare($sqlUpdateMaterial);
    $stmtUpdateMaterial->bind_param("i", $material_id);
    $stmtUpdateMaterial->execute();

    // Mensaje de confirmación
    $mensaje = '<div class="alert alert-success text-center">El material ha sido devuelto anticipadamente y la disponibilidad ha sido actualizada.</div>';

    $stmtUpdateEstado->close();
    $stmtUpdateMaterial->close();
}

// Si se envió el email para buscar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $email_busqueda = $_POST['email'];

    // Extraer los primeros 3 caracteres antes del '@'
    if (preg_match('/^[^@]+$/', $email_busqueda)) {
        $email_base = substr($email_busqueda, 0, 3);

        // Consultar la base de datos para encontrar socios
        $sql_busqueda = "SELECT * FROM socios WHERE SUBSTRING_INDEX(email, '@', 1) LIKE ?";
        $stmt_busqueda = $conn->prepare($sql_busqueda);
        $param_email = '%' . $email_base . '%';
        $stmt_busqueda->bind_param("s", $param_email);
        $stmt_busqueda->execute();
        $resultado_busqueda = $stmt_busqueda->get_result();

        if ($resultado_busqueda->num_rows > 0) {
            while ($socio = $resultado_busqueda->fetch_assoc()) {
                $socios[] = $socio;
            }
        } else {
            echo '<div class="alert alert-danger text-center">No se encontraron socios con ese email.</div>';
        }
        $stmt_busqueda->close();
    } else {
        echo '<div class="alert alert-danger text-center">El email debe ser válido hasta el símbolo "@".</div>';
    }
}

// Consultar los préstamos del socio seleccionado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['socio_id'])) {
    $socio_id = $_POST['socio_id'];

    // Consultar préstamos (activos e inactivos) basados en el estado
    $sqlPrestamos = "SELECT p.id, m.titulo, m.autor, p.fecha_prestamo, p.fecha_devolucion, p.estado, m.id AS material_id
                     FROM prestamos p
                     JOIN materiales m ON p.material_id = m.id
                     WHERE p.socio_id = ?";
    $stmtPrestamos = $conn->prepare($sqlPrestamos);
    $stmtPrestamos->bind_param("i", $socio_id);
    $stmtPrestamos->execute();
    $resultadoPrestamos = $stmtPrestamos->get_result();

    // Agrupar préstamos activos e inactivos según el estado
    while ($prestamo = $resultadoPrestamos->fetch_assoc()) {
        $fecha_devolucion = new DateTime($prestamo['fecha_devolucion']);
        $fecha_actual = new DateTime();
        $fecha_limite = clone $fecha_devolucion;
        $fecha_limite->modify('+3 days');

        // Si el préstamo está activo y la fecha de devolución es más de 3 días después de la fecha límite
        if ($prestamo['estado'] === 'pendiente' && $fecha_actual > $fecha_limite) {
            $prestamo['estado'] = 'atrasado'; // Marcamos como atrasado
        }

        if ($prestamo['estado'] === 'pendiente' || $prestamo['estado'] === 'atrasado') {
            $prestamosActivos[] = $prestamo;
        } else {
            $prestamosInactivos[] = $prestamo;
        }
    }

    if (empty($prestamosActivos) && empty($prestamosInactivos)) {
        $mensaje = '<div class="alert alert-danger text-center">El socio no posee préstamos activos ni anteriores.</div>';
    }

    $stmtPrestamos->close();
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
    <title>Devolver Prestamos</title>
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
        /* Estilos personalizados */
        body { background-color: #e8f5e9; font-family: Arial, sans-serif; }
        .container { text-align: center; width: 80%; margin: 50px auto; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h1 { color: #2e7d32; margin-bottom: 20px; }
        .btn-primary { background-color: #2e7d32; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s; }
        .btn-primary:hover { background-color: #1b5e20; }
        .alert { font-weight: bold; text-align: center; }
        .cancel-button { color: red; font-weight: bold; cursor: pointer; border: none; background: none; font-size: 1.2em; }
        footer { background-color: #161245; color: white; text-align: center; padding: 20px; margin-top: 20px; border: 2px solid #2e7d32; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Devolver Prestamo</h1>

        <!-- Formulario para buscar al socio por email -->
        <form action="devolver_prestamo.php" method="POST">
            <div class="form-group">
                <label for="email">Email del Socio:</label>
                <input type="text" class="form-control" name="email" id="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Socio</button>
        </form>

        <?php if (!empty($socios)): ?>
            <form action="devolver_prestamo.php" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="socio_id">Seleccionar Socio:</label>
                    <select class="form-control" name="socio_id" id="socio_id">
                        <?php foreach ($socios as $socio): ?>
                            <option value="<?= $socio['id']; ?>"><?= $socio['nombre'] . ' ' . $socio['apellido']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ver Préstamos</button>
            </form>
        <?php endif; ?>

        <!-- Mostrar préstamos activos -->
        <?php if (!empty($prestamosActivos)): ?>
            <h2>Préstamos Activos</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Fecha de Préstamo</th>
                        <th>Fecha de Devolución</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestamosActivos as $prestamo): ?>
                        <tr>
                            <td><?= $prestamo['titulo']; ?></td>
                            <td><?= $prestamo['autor']; ?></td>
                            <td><?= $prestamo['fecha_prestamo']; ?></td>
                            <td><?= $prestamo['fecha_devolucion']; ?></td>
                            <td><?= $prestamo['estado']; ?></td>
                            <td>
                                <form action="devolver_prestamo.php" method="POST">
                                    <input type="hidden" name="prestamo_id" value="<?= $prestamo['id']; ?>">
                                    <input type="hidden" name="material_id" value="<?= $prestamo['material_id']; ?>">
                                    <button type="submit" name="devolver_material" class="btn btn-danger">Devolver</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Mostrar préstamos inactivos -->
        <?php if (!empty($prestamosInactivos)): ?>
            <h2>Préstamos Anteriores</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Fecha de Préstamo</th>
                        <th>Fecha de Devolución</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestamosInactivos as $prestamo): ?>
                        <tr>
                            <td><?= $prestamo['titulo']; ?></td>
                            <td><?= $prestamo['autor']; ?></td>
                            <td><?= $prestamo['fecha_prestamo']; ?></td>
                            <td><?= $prestamo['fecha_devolucion']; ?></td>
                            <td><?= $prestamo['estado']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Mostrar mensajes -->
        <?= $mensaje; ?>
                    </div>
        <a href="ingreso_bibliotecario.php">Volver a la página principal</a>
    <!-- Pie de página -->
    <footer>
        <p>Practica Profesionalizante I<br>
        Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP
        </p>
    </footer>
</body>
</html>
