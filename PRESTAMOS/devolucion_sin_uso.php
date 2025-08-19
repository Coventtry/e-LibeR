<?php
require 'CONECTOR.PHP'; // Conexión a SQLite con PDO

// Inicializar variables
$socios = [];
$prestamos = [];
$mensaje = "";

// Devolver material
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['devolver_material'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $material_id = $_POST['material_id'];

    $sql1 = "UPDATE prestamos SET estado = 'devuelto' WHERE id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute([$prestamo_id]);

    $sql2 = "UPDATE materiales SET disponibilidad = disponibilidad + 1 WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$material_id]);

    $mensaje = '<div class="alert alert-success text-center">Material devuelto correctamente.</div>';
}


// Ver préstamos del socio
if (isset($_POST['socio_id'])) {
    $socio_id = $_POST['socio_id'];
    $stmt = $db->prepare("SELECT prestamos.id, prestamos.material_id, materiales.titulo, materiales.autor, prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.estado 
                          FROM prestamos 
                          JOIN materiales ON prestamos.material_id = materiales.id 
                          WHERE prestamos.socio_id = :socio_id");
    $stmt->bindValue(':socio_id', $socio_id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $prestamos[] = $row;
    }
    if (empty($prestamos)) {
        $mensaje = "<div class='alert alert-info mt-3'>Este socio no tiene préstamos registrados.</div>";
    }
}

// Devolver material
if (isset($_POST['devolver_material'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $material_id = $_POST['material_id'];

    // Actualizar estado del préstamo
    $db->exec("UPDATE prestamos SET estado = 'devuelto' WHERE id = $prestamo_id");

    // Marcar el material como disponible
    $db->exec("UPDATE materiales SET disponible = 1 WHERE id = $material_id");

    $mensaje = "<div class='alert alert-success mt-3'>Material devuelto con éxito.</div>";
}

// Extender préstamo
if (isset($_POST['extender_prestamo'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $dias_extender = (int)$_POST['dias_extender'];

    // Obtener fecha actual de devolución
    $result = $db->querySingle("SELECT fecha_devolucion FROM prestamos WHERE id = $prestamo_id", true);
    $fecha_actual = new DateTime($result['fecha_devolucion']);
    $fecha_actual->modify("+$dias_extender days");
    $nueva_fecha = $fecha_actual->format('Y-m-d');

    // Actualizar fecha
    $db->exec("UPDATE prestamos SET fecha_devolucion = '$nueva_fecha' WHERE id = $prestamo_id");

    $mensaje = "<div class='alert alert-success mt-3'>Préstamo extendido hasta $nueva_fecha.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Préstamos</title>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #e8f5e9; font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 50px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        h1, h2 { color: #2e7d32; }
        .btn-primary { background-color: #2e7d32; }
        .btn-primary:hover { background-color: #1b5e20; }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Préstamos</h1>

        <!-- Formulario: Buscar socio -->
        <form method="POST">
            <div class="form-group">
                <label for="email">Buscar Socio (email, nombre o apellido):</label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar</button>
        </form>

        <!-- Formulario: Selección de socios -->
        <?php if ($socios): ?>
            <form method="POST" class="mt-4">
                <div class="form-group">
                    <label for="socio_id">Seleccionar Socio:</label>
                    <select class="form-control" name="socio_id">
                        <?php foreach ($socios as $s): ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nombre'] . " " . $s['apellido']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ver Préstamos</button>
            </form>
        <?php endif; ?>

        <!-- Tabla de préstamos -->
        <?php if ($prestamos): ?>
            <h2 class="mt-4">Préstamos del Socio</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Fecha Préstamo</th>
                        <th>Fecha Devolución</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestamos as $p): ?>
                        <tr>
                            <td><?= $p['titulo']; ?></td>
                            <td><?= $p['autor']; ?></td>
                            <td><?= $p['fecha_prestamo']; ?></td>
                            <td><?= $p['fecha_devolucion']; ?></td>
                            <td><?= $p['estado']; ?></td>
                            <td>
                                <?php if ($p['estado'] !== 'devuelto'): ?>
                                    <!-- Devolver -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="prestamo_id" value="<?= $p['id']; ?>">
                                        <input type="hidden" name="material_id" value="<?= $p['material_id']; ?>">
                                        <button class="btn btn-danger btn-sm" name="devolver_material">Devolver</button>
                                    </form>
                                    <!-- Extender -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="prestamo_id" value="<?= $p['id']; ?>">
                                        <input type="number" name="dias_extender" value="7" min="1" style="width:70px;" required>
                                        <button class="btn btn-warning btn-sm" name="extender_prestamo">Extender</button>
                                    </form>
                                <?php else: ?>
                                    <em>Devuelto</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Mensajes -->
        <?= $mensaje; ?>

        <a href="ingreso_bibliotecario.php">Volver a la página principal</a>
    </div>

    <!-- Footer -->
    <footer>
        <p>Practica Profesionalizante I<br>Desarrollado con HTML5, CSS, Bootstrap y PHP</p>
    </footer>
</body>
</html>
