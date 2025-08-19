<?php
try {
    // Conexión con MySQL usando tu archivo CONECTAR_2.php
    require 'conexion/CONECTAR_2.PHP';
    
    // Consulta MySQL modificada (las funciones de fecha son diferentes)
    $sql = "SELECT prestamos.id, socios.nombre AS nombre_socio, materiales.titulo AS nombre_material,
                   prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.estado
            FROM prestamos
            JOIN socios ON prestamos.socio_id = socios.id
            JOIN materiales ON prestamos.material_id = materiales.id
            WHERE prestamos.estado = 'pendiente'
            AND DATE(prestamos.fecha_devolucion) <= DATE_ADD(CURDATE(), INTERVAL 4 DAY)
            ORDER BY prestamos.fecha_devolucion ASC";
    
    $resultado = $conn->query($sql); // Usamos $conn en lugar de $conexion
    $prestamos = $resultado->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error en la conexión o consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* [Mantén todos tus estilos CSS igual] */
        .envelope-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            perspective: 1000px;
        }
        .envelope {
            width: 160px;
            height: 100px;
            position: relative;
            transform-style: preserve-3d;
            transition: all 0.5s ease;
            cursor: pointer;
        }
        
        .envelope:hover {
            transform: translateY(-10px);
        }
        
        .envelope-front {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #f8f1e9;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            border: 1px solid #e0d5c8;
            z-index: 3;
            transform-origin: top;
            transition: all 0.5s ease;
        }
        
        .envelope:hover .envelope-front {
            transform: rotateX(180deg);
            z-index: 1;
        }
        
        .envelope-flap {
            position: absolute;
            width: 100%;
            height: 50%;
            background: #f0e6d6;
            border-radius: 5px 5px 0 0;
            clip-path: polygon(0 0, 100% 0, 50% 50%);
            top: 0;
            left: 0;
            z-index: 4;
            transform-origin: top;
            transition: all 0.5s ease;
        }
        
        .envelope:hover .envelope-flap {
            transform: rotateX(180deg);
        }
        
        .envelope-back {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #f5ebe0;
            border-radius: 5px;
            border: 1px solid #e0d5c8;
            z-index: 2;
        }
        
        .envelope-content {
            position: absolute;
            width: 300px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 15px;
            bottom: 120px;
            right: 0;
            display: none;
            z-index: 10;
            border: 1px solid #e0d5c8;
        }
        
        .envelope:hover .envelope-content {
            display: block;
            animation: fadeInUp 0.3s ease-out;
        }
        
        .notification-count {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 25px;
            height: 25px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            border: 2px solid white;
            z-index: 5;
        }
        
        .envelope-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            color: #8b7d6b;
            z-index: 3;
        }
        
        .prestamo-item {
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
        }
        
        .prestamo-item:last-child {
            border-bottom: none;
        }
        
        .days-badge {
            font-size: 11px;
            padding: 3px 7px;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .envelope-stamp {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            background: #e74c3c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: bold;
            transform: rotate(15deg);
            z-index: 3;
        }
    </style>
</head>
<body>

<div class="envelope-container">
    <?php if (count($prestamos) > 0): ?>
        <?php $count = count($prestamos); ?>
        
        <div class="notification-count"><?= $count ?></div>
        
        <div class="envelope">
            <div class="envelope-flap"></div>
            <div class="envelope-front">
                <i class="bi bi-envelope-fill envelope-icon"></i>
                <div class="envelope-stamp">LIB</div>
            </div>
            <div class="envelope-back"></div>
            
            <div class="envelope-content">
                <h6 class="mb-3"><i class="bi bi-exclamation-circle text-danger"></i> Préstamos por vencer</h6>
                
                <?php foreach ($prestamos as $fila): ?>
                    <?php
                    $fechaDevolucion = new DateTime($fila['fecha_devolucion']);
                    $hoy = new DateTime();
                    $diasRestantes = $hoy->diff($fechaDevolucion)->days;
                    $diasRestantes = $fechaDevolucion >= $hoy ? $diasRestantes : -$diasRestantes;
                    $badgeClass = ($diasRestantes <= 0) ? 'bg-danger' : ($diasRestantes == 1 ? 'bg-warning text-dark' : 'bg-primary');
                    ?>
                    
                    <div class="prestamo-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= substr(htmlspecialchars($fila['nombre_material']), 0, 20) ?></strong>
                                <div class="text-muted"><small><?= substr(htmlspecialchars($fila['nombre_socio']), 0, 18) ?></small></div>
                            </div>
                            <span class="badge <?= $badgeClass ?> days-badge"><?= $diasRestantes ?>d</span>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="mt-3 d-flex justify-content-end">
                    <a href="PRESTAMOS/Devolvamos_juntos.php" class="btn btn-sm btn-primary">Gestionar</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Cierre al hacer clic fuera
    document.addEventListener('click', function(e) {
        const envelope = document.querySelector('.envelope');
        if (envelope && !envelope.contains(e.target)) {
            const content = document.querySelector('.envelope-content');
            if (content) content.style.display = 'none';
            
            const front = document.querySelector('.envelope-front');
            if (front) front.style.transform = 'rotateX(0)';
            
            const flap = document.querySelector('.envelope-flap');
            if (flap) flap.style.transform = 'rotateX(0)';
        }
    });
</script>

</body>
</html>

<?php
// No necesitamos cerrar $conexion ya que usamos $conn de CONECTAR_2.php
?>