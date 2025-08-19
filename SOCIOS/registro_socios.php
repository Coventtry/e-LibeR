<?php
// Conectar a MySQL
try {
    // Reemplazá con tus propios datos: nombre de base, usuario y contraseña
    $conn = new PDO("mysql:
    host=localhost;
    dbname=biblioteca;
    charset=utf8mb4", 
    "root", 
    "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta del historial de socios
$query = $conn->query("SELECT hs.*, s.nombre 
                       FROM historial_socios hs 
                       JOIN socios s ON s.id = hs.id_socio 
                       ORDER BY hs.fecha DESC");
$historial = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registro de Socios</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        .boton { padding: 8px 12px; margin-right: 10px; }
        textarea { width: 100%; height: 100px; }
    </style>
</head>
<body>
    <h2>Historial de Socios (Altas y Bajas)</h2>

    <table>
        <tr>
            <th>Socio</th>
            <th>Acción</th>
            <th>Fecha</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($historial as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['nombre']) ?></td>
                <td><?= $fila['accion'] ?></td>
                <td><?= $fila['fecha'] ?></td>
                <td><?= htmlspecialchars($fila['observaciones']) ?></td>
                <td>
                    <form method="POST" action="reactivar_socio.php" style="display:inline;">
                        <input type="hidden" name="id_socio" value="<?= $fila['id_socio'] ?>">
                        <button class="boton" type="submit">Reactivar</button>
                    </form>

                    <form method="POST" action="enviar_correo.php" style="display:inline;">
                        <input type="hidden" name="id_socio" value="<?= $fila['id_socio'] ?>">
                        <button class="boton" type="submit">Enviar Correo</button>
                    </form>

                    <button class="boton" onclick="imprimirCertificado(`<?= htmlspecialchars($fila['nombre']) ?>`, `<?= $fila['accion'] ?>`, `<?= $fila['fecha'] ?>`)">Imprimir</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Espacio para Certificado</h3>
    <textarea id="certificado">Aquí aparecerá el certificado para imprimir...</textarea>
    <br>
    <button onclick="window.print()">Imprimir Certificado</button>

    <script>
        function imprimirCertificado(nombre, accion, fecha) {
            const texto = `Se certifica que el/la socio/a ${nombre} fue dado de ${accion === 'ALTA' ? 'alta' : 'baja'} el día ${fecha}.`;
            document.getElementById('certificado').value = texto;
        }
    </script>
</body>
</html>
