<?php
require_once '../conexion/conectatew.php'; // conexión a la base de datos

// Consulta SQL a la tabla 'prestamos', ahora incluye el email
$sql = "
    SELECT p.id, s.nombre AS socio, s.email, m.titulo AS material, 
           p.fecha_prestamo, p.fecha_devolucion, p.estado
    FROM prestamos p
    JOIN socios s ON p.socio_id = s.id
    JOIN materiales m ON p.material_id = m.id
";

try {
    $stmt = $pdo->query($sql);
    $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error al obtener los préstamos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem;
        }
        .search-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light p-4">

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📚 Listado de Préstamos</h4>
        </div>

        <div class="card-body">
            <!-- Buscador -->
            <div class="search-container">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar por socio, material, fecha préstamo o fecha devolución" aria-label="Buscar" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <?php if (!empty($prestamos)): ?>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>SOCIO</th>
                            <th>MATERIAL</th>
                            <th>FECHA PRÉSTAMO</th>
                            <th>FECHA DEVOLUCIÓN</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach ($prestamos as $fila): ?>
                            <tr>
                                <td><?= htmlspecialchars($fila['socio']) ?></td>
                                <td><?= htmlspecialchars($fila['material']) ?></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($fila['fecha_prestamo']))) ?></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($fila['fecha_devolucion']))) ?></td>
                                <td>
                                    <?php if (strtolower($fila['estado']) === 'devuelto'): ?>
                                        <span class="badge bg-success">Devuelto</span>
                                    <?php elseif (strtolower($fila['estado']) === 'pendiente'): ?>
                                        <span class="badge bg-danger">Pendiente</span>
                                        <!-- Botón de enviar recordatorio -->
                                        <form action="enviar_recordatorio.php" method="post" class="d-inline">
                                            <input type="hidden" name="email" value="<?= htmlspecialchars($fila['email']) ?>">
                                            <input type="hidden" name="nombre" value="<?= htmlspecialchars($fila['socio']) ?>">
                                            <input type="hidden" name="material" value="<?= htmlspecialchars($fila['material']) ?>">
                                            <input type="hidden" name="fecha_devolucion" value="<?= htmlspecialchars($fila['fecha_devolucion']) ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-primary" title="Enviar recordatorio por email">
    <i class="bi bi-envelope-fill"></i>
</button>

                                        </form>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= htmlspecialchars($fila['estado']) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning">No hay registros de préstamos.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<a href="ingreso_bibliotecario.php">Volver a la página principal</a>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(function(row) {
            let cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(function(cell) {
                if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                }
            });
            row.style.display = match ? '' : 'none';
        });
    });
</script>
</body>
</html>
