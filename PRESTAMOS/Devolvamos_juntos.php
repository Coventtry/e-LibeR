    <link rel="icon" href="../assets/img/icono.ico" type="image/x-icon">
<?php
require '../conexion/CONECTOR.PHP'; // Conexión a la base de datos

$mensaje = "";

// Devolución de material
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['devolver_material'])) {
    $prestamo_id = $_POST['prestamo_id'];

    $sql_materiales = "SELECT material_id, cantidad FROM prestamos WHERE id = ?";
    $stmt_materiales = $conn->prepare($sql_materiales);
    $stmt_materiales->execute([$prestamo_id]);
    $materiales_prestamo = $stmt_materiales->fetchAll(PDO::FETCH_ASSOC);

    $sql_estado = "UPDATE prestamos SET estado = 'devuelto' WHERE id = ?";
    $stmt_estado = $conn->prepare($sql_estado);
    $stmt_estado->execute([$prestamo_id]);

    foreach ($materiales_prestamo as $material) {
        $sql_disponibilidad = "UPDATE materiales SET disponibilidad = disponibilidad + ? WHERE id = ?";
        $stmt_disponibilidad = $conn->prepare($sql_disponibilidad);
        $stmt_disponibilidad->execute([$material['cantidad'], $material['material_id']]);
    }

    $mensaje = '<div class="alert alert-success text-center">Devolución realizada correctamente.</div>';
}

// Extensión de préstamo — ✅ CORREGIDO PARA MYSQL
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['extender_prestamo'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $dias = isset($_POST['dias_extender']) ? (int)$_POST['dias_extender'] : 0;

    if ($dias > 0) {
  $sql = "UPDATE prestamos SET fecha_devolucion = DATE_ADD(fecha_devolucion, INTERVAL ? DAY) WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dias, $prestamo_id]);
        $mensaje = '<div class="alert alert-info text-center">La fecha de devolución se extendió ' . $dias . ' días.</div>';
    } else {
        $mensaje = '<div class="alert alert-danger text-center">Ingrese un número válido de días.</div>';
    }
}

// Recordatorio (puede mejorarse luego con email real)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar_recordatorio'])) {
    $mensaje = '<div class="alert alert-info text-center">Recordatorio enviado correctamente.</div>';
}

// Consulta SQL — ✅ CORREGIDO GROUP_CONCAT PARA MYSQL
$sql = "SELECT 
            p.id AS prestamo_id,
            s.id AS socio_id,
            s.nombre AS socio, 
            s.apellido, 
            s.email,
            s.telefono, -- AÑADIR ESTA LÍNEA
            p.fecha_prestamo, 
            p.fecha_devolucion, 
            p.estado,
            SUM(p.cantidad) AS cantidad_total,
            GROUP_CONCAT(m.titulo, ' (Cant: ', p.cantidad, ')<br>') AS materiales_detalle,
            GROUP_CONCAT(m.id) AS materiales_ids
        FROM prestamos p
        JOIN socios s ON p.socio_id = s.id
        JOIN materiales m ON p.material_id = m.id
        GROUP BY p.id, s.id, p.fecha_prestamo, p.fecha_devolucion, p.estado
        ORDER BY 
            CASE WHEN p.estado = 'atrasado' THEN 1
                 WHEN p.estado = 'pendiente' THEN 2
                 ELSE 3 END,
            p.fecha_devolucion";


$stmt = $conn->prepare($sql);
$stmt->execute();
$prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Actualizar estado a "atrasado"
foreach ($prestamos as &$p) {
    if ($p['estado'] === 'pendiente') {
        $fecha_dev = new DateTime($p['fecha_devolucion']);
        $ahora = new DateTime();
        if ($ahora > $fecha_dev) {
            $p['estado'] = 'atrasado';
            $sql_update = "UPDATE prestamos SET estado = 'atrasado' WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->execute([$p['prestamo_id']]);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado Completo de Préstamos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   <style>
    body {
        background-color: #e8f5e9;
        font-family: Arial, sans-serif;
        margin: 0;
        /* Ya no es necesario padding-bottom porque usaremos spacer */
    }

    .container {
        width: 95%;
        margin: 30px auto;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px #ccc;
        overflow-x: auto;
    }

    h1, h2 {
        color: #2e7d32;
    }

    .btn-primary {
        background-color: #2e7d32;
        border-color: #2e7d32;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #1b5e20;
        border-color: #1b5e20;
    }

    /* Espacio invisible para que el footer fijo no tape contenido */
    .footer-spacer {
        height: 80px; /* Igual a la altura del footer */
        width: 100%;
    }

    footer {
        background-color: #343a40;
        color: white;
        padding: 20px;
        text-align: center;
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        z-index: 1000;
        box-sizing: border-box;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #6c757d;
        text-decoration: none;
        font-size: 1.1rem;
        transition: color 0.3s;
    }

    a:hover {
        color: #218838;
    }

    .search-container {
        margin-bottom: 20px;
    }

    .badge-atrasado {
        background-color: #dc3545;
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.85rem;
        display: inline-block;
    }

    .badge-pendiente {
        background-color: #ffc107;
        color: #212529;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.85rem;
        display: inline-block;
    }

    .badge-devuelto {
        background-color: #28a745;
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.85rem;
        display: inline-block;
    }

    .actions-column {
        white-space: nowrap;
    }

    .materiales-cell {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table th {
        white-space: nowrap;
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 10;
        padding: 0.75rem 1rem;
        border-bottom: 2px solid #dee2e6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            width: 100%;
            padding: 15px;
        }
        .table td, .table th {
            padding: 0.5rem;
            font-size: 0.9rem;
        }
        .actions-column {
            white-space: normal;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        a {
            font-size: 1rem;
        }
    }
</style>


</head>
<body>
    <div class="container">
        <h1 class="mb-4">Listado Completo de Préstamos</h1>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">📚 Gestión de Préstamos</h4>
            </div>

            <div class="card-body">
                <!-- Buscador -->
                <div class="search-container">
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por socio, material, fecha o estado..." aria-label="Buscar">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <?= $mensaje; ?>

                <?php if (!empty($prestamos)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>SOCIO</th>
                                    <th>MATERIALES</th>
                                    <th>CANTIDAD</th>
                                    <th>F. PRÉSTAMO</th>
                                    <th>F. DEVOLUCIÓN</th>
                                    <th>ESTADO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php foreach ($prestamos as $p): ?>
                                    <tr>
                                        <td><?= $p['prestamo_id'] ?></td>
                                        <td>
                                            <?= htmlspecialchars($p['socio'] . ' ' . $p['apellido']) ?><br>
                                            <small class="text-muted"><?= htmlspecialchars($p['email']) ?></small>
                                        </td>
                                        <td class="materiales-cell"><?= $p['materiales_detalle'] ?></td>
                                        <td class="text-center"><?= $p['cantidad_total'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($p['fecha_prestamo'])) ?></td>
                                        <td><?= date('d/m/Y', strtotime($p['fecha_devolucion'])) ?></td>
                                        <td>
                                            <?php if ($p['estado'] === 'devuelto'): ?>
                                                <span class="badge bg-success">Devuelto</span>
                                            <?php elseif ($p['estado'] === 'atrasado'): ?>
                                                <span class="badge bg-danger">Atrasado</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Pendiente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="actions-column">
                                            <?php if ($p['estado'] !== 'devuelto'): ?>
                                                <!-- Devolver -->
                                                <form method="POST" class="mb-2">
                                                    <input type="hidden" name="prestamo_id" value="<?= $p['prestamo_id'] ?>">
                                                    <button class="btn btn-danger btn-sm w-100 mb-1" name="devolver_material" title="Devolver todos los materiales">
                                                        <i class="bi bi-arrow-return-left"></i> Devolver
                                                    </button>
                                                </form>

                                                <!-- Extender -->
                                                <form method="POST" class="mb-2">
                                                    <input type="hidden" name="prestamo_id" value="<?= $p['prestamo_id'] ?>">
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" name="dias_extender" value="7" min="1" class="form-control" style="width: 60px;" title="Días a extender">
                                                        <button class="btn btn-warning btn-sm" name="extender_prestamo" title="Extender préstamo">
                                                            <i class="bi bi-calendar-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- Recordatorio -->
                                                <?php
$telefono = preg_replace('/[^0-9]/', '', $p['telefono']); // Limpiar caracteres

$materiales = strip_tags($p['materiales_detalle']); // Eliminar etiquetas HTML

$mensajeWhatsapp = rawurlencode("Hola {$p['socio']}, te recordamos que debés devolver el/los siguiente/s material/es:\n\n{$materiales}\nFecha límite: " . date('d/m/Y', strtotime($p['fecha_devolucion'])) . "\n\nGracias.");

$linkWhatsapp = "https://wa.me/{$telefono}?text={$mensajeWhatsapp}";

?>
<a href="<?= $linkWhatsapp ?>" target="_blank" class="btn btn-success btn-sm w-100" title="Enviar recordatorio por WhatsApp">
    <i class="bi bi-whatsapp"></i> Recordar
</a>
                                                
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">No hay registros de préstamos.</div>
                <?php endif; ?>
            </div>
        </div>

        <a href="../ingreso_bibliotecario_1.php" class="mt-3">
            <i class="bi bi-arrow-left"></i> Volver a la página principal
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Búsqueda en la tabla
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tableBody tr');
            
            rows.forEach(function(row) {
                let textContent = row.textContent.toLowerCase();
                row.style.display = textContent.includes(filter) ? '' : 'none';
            });
        });
    </script> 
</body>
 </div>
</html>