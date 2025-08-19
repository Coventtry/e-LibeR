<?php
// Verifica que la ruta del require sea correcta
require '../conexion/conectatew.php';

// Verifica que la conexión se estableció
if (!isset($pdo)) {
    die("Error: No se pudo establecer la conexión a la base de datos");
}

// Consulta para obtener todos los materiales
try {
    $sql = "SELECT * FROM materiales ORDER BY titulo ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $materiales = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al consultar materiales: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Materiales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
      html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
.main-content {
  flex: 1;
  padding-left: 40px; /* ✅ Solo el contenido principal tiene margen izquierdo */
  padding-right: 20px; /* Opcional */
}
        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .btn-volver {
            margin-top: 20px;
        }
        .search-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-container">
            <h1>Listado Completo de Materiales</h1>
            
            <div class="search-container">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar por título, autor o año" aria-label="Buscar por título, autor o año" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Año Publicación</th>
                            <th>Código</th>
                            <th>Disponibilidad</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach ($materiales as $material): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($material['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($material['autor']); ?></td>
                            <td><?php echo htmlspecialchars($material['anio_publicacion']); ?></td>
                            <td><?php echo htmlspecialchars($material['codigo']); ?></td>
                            <td><?php echo htmlspecialchars($material['disponibilidad']); ?></td>
                            <td><?php echo htmlspecialchars($material['clasificacion_fisica']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
           <!-- <a href="../ingreso_bibliotecario.php" class="btn btn-primary btn-volver">Volver al Menú Principal</a>
            <div class="text-center mt-4">
    <a href="../MATERIALES/CONTEMOS.PHP" class="btn btn-success">Control de libros</a>!-->
    </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
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
                
                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    
</body>
</html>
<?php

// Cerrar conexión
$pdo = null;
include 'footer1.html';
?>

