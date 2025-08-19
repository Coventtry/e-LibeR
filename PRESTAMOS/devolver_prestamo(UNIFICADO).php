<?php 
require '../conexion/CONECTOR.PHP'; // Conexión a SQLite con PDO

// Inicializar variables
$socios = [];
$prestamos = [];
$mensaje = "";

// Devolver material
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['devolver_material'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $material_id = $_POST['material_id'];

    // Primero obtenemos la cantidad prestada
    $sql_cantidad = "SELECT cantidad FROM prestamos WHERE id = ?";
    $stmt_cantidad = $conn->prepare($sql_cantidad);
    $stmt_cantidad->execute([$prestamo_id]);
    $cantidad_prestada = $stmt_cantidad->fetchColumn();

    // Actualizamos el estado del préstamo
    $sql1 = "UPDATE prestamos SET estado = 'devuelto' WHERE id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute([$prestamo_id]);

    // Actualizamos la disponibilidad sumando la cantidad prestada
    $sql2 = "UPDATE materiales SET disponibilidad = disponibilidad + ? WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$cantidad_prestada, $material_id]);

    $mensaje = '<div class="alert alert-success text-center">Se devolvieron '.$cantidad_prestada.' materiales correctamente.</div>';
}

// Extender préstamo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['extender_prestamo'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $dias = isset($_POST['dias_extender']) ? (int)$_POST['dias_extender'] : 0;

    if ($dias > 0) {
        $sql = "UPDATE prestamos SET fecha_devolucion = DATE(fecha_devolucion, '+' || ? || ' days') WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dias, $prestamo_id]);
        $mensaje = '<div class="alert alert-info text-center">La fecha de devolución se extendió ' . $dias . ' días.</div>';
    } else {
        $mensaje = '<div class="alert alert-danger text-center">Ingrese un número válido de días.</div>';
    }
}

// Buscar socio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $busqueda = trim($_POST['email']);
    if (!empty($busqueda)) {
        $sql = "SELECT * FROM socios WHERE 
                   substr(email, 1, instr(email, '@') - 1) LIKE :b 
                OR nombre LIKE :b 
                OR apellido LIKE :b";
        $stmt = $conn->prepare($sql);
        $param = "%" . $busqueda . "%";
        $stmt->bindParam(':b', $param);
        $stmt->execute();
        $socios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$socios) {
            $mensaje = '<div class="alert alert-danger text-center">No se encontraron socios.</div>';
        }
    } else {
        $mensaje = '<div class="alert alert-danger text-center">Ingrese nombre, apellido o email.</div>';
    }
}

// Obtener préstamos de un socio
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['socio_id'])) {
    $socio_id = $_POST['socio_id'];
    $sql = "SELECT p.id, m.titulo, m.autor, p.fecha_prestamo, p.fecha_devolucion, p.estado, m.id AS material_id, p.cantidad
            FROM prestamos p
            JOIN materiales m ON p.material_id = m.id
            WHERE p.socio_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$socio_id]);
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultado as &$p) {
        $fecha_dev = new DateTime($p['fecha_devolucion']);
        $ahora = new DateTime();
        $limite = clone $fecha_dev;
        $limite->modify('+3 days');

        if ($p['estado'] === 'pendiente' && $ahora > $limite) {
            $p['estado'] = 'atrasado';
        }
        $prestamos[] = $p;
    }

    if (!$prestamos) {
        $mensaje = '<div class="alert alert-warning text-center">El socio no tiene préstamos registrados.</div>';
    }
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
        .cantidad-badge {
            font-size: 0.9em;
            padding: 3px 6px;
            border-radius: 10px;
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Préstamos</h1>

        <!-- Buscar socio -->
        <form method="POST">
            <div class="form-group">
                <label for="email">Buscar Socio (email, nombre o apellido):</label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar</button>
        </form>

        <!-- Selección de socio -->
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

        <!-- Mostrar préstamos -->
        <?php if ($prestamos): ?>
            <h2 class="mt-4">Préstamos del Socio</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Cantidad</th>
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
                            <td><span class="cantidad-badge"><?= $p['cantidad']; ?></span></td>
                            <td><?= $p['fecha_prestamo']; ?></td>
                            <td><?= $p['fecha_devolucion']; ?></td>
                            <td><?= $p['estado']; ?></td>
                            <td>
                                <?php if ($p['estado'] !== 'devuelto'): ?>
                                    <!-- Devolver -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="prestamo_id" value="<?= $p['id']; ?>">
                                        <input type="hidden" name="material_id" value="<?= $p['material_id']; ?>">
                                        <button class="btn btn-danger btn-sm" name="devolver_material">Devolver (<?= $p['cantidad']; ?>)</button>
                                    </form>

                                    <!-- Extender -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="prestamo_id" value="<?= $p['id']; ?>">
                                        <input type="number" name="dias_extender" value="7" min="1" style="width:70px;" required>
                                        <button class="btn btn-warning btn-sm" name="extender_prestamo">Extender</button>
                                    </form>
                                <?php else: ?>
                                    <em>Devuelto (<?= $p['cantidad']; ?>)</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?= $mensaje; ?>
        <a href="ingreso_bibliotecario.php">Volver a la página principal</a>
    </div>

    <footer>
        <p>Practica Profesionalizante I<br>Desarrollado con HTML5, CSS, Bootstrap y PHP</p>
    </footer>
</body>
</html>