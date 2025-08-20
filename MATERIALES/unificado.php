    <link rel="icon" href="../assets/img/icono.ico" type="image/x-icon">
<?php
require '../conexion/conectatew.php'; // Conexión PDO centralizada

$mensaje_exito = '';
$material_seleccionado = null;
$materiales_encontrados = [];
$areas = [];

// Obtener todas las áreas con sus abreviaturas
try {
    $sql_areas = "SELECT id, nombre, abreviado FROM areas ORDER BY nombre";
    $stmt_areas = $pdo->query($sql_areas);
    $areas = $stmt_areas->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al consultar áreas: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        // Búsqueda de materiales
        $busqueda = trim($_POST['busqueda']);
        $sql = "SELECT m.*, a.abreviado 
                FROM materiales m
                JOIN areas a ON m.area_id = a.id
                WHERE m.titulo LIKE :busqueda 
                ORDER BY m.titulo, m.autor";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':busqueda' => "%$busqueda%"]);
        $materiales_encontrados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($materiales_encontrados)) {
            $mensaje = "No se encontraron materiales.";
        }
    } elseif (isset($_POST['seleccionar'])) {
        // Selección de material para modificar
        $id = $_POST['id_material'];
        $sql = "SELECT m.*, a.abreviado 
                FROM materiales m
                JOIN areas a ON m.area_id = a.id
                WHERE m.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $material_seleccionado = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } elseif (isset($_POST['modificar'])) {
    // Datos del formulario
    $id = $_POST['id'];
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $anio_publicacion = trim($_POST['anio_publicacion']);
    $disponibilidad = trim($_POST['disponibilidad']);
    $area_id = $_POST['area_id'];
    $categoria = trim($_POST['categoria']);
    $editorial = trim($_POST['editorial']);
    $pasillo = $_POST['pasillo'];
    $estante = $_POST['estante'];
    $nivel = $_POST['nivel'];
    
    // Obtener abreviatura del área
    $abreviatura = '';
    foreach ($areas as $area) {
        if ($area['id'] == $area_id) {
            $abreviatura = $area['abreviado'];
            break;
        }
    }
    
    $codigo_ubicacion = "$abreviatura-$pasillo-$estante-$nivel";

    try {
        $pdo->beginTransaction();
        
        // 1. Actualizar datos básicos del material - CORREGIDO
        $sql_material = "UPDATE materiales 
                        SET titulo = :titulo,
                            autor = :autor,
                            anio_publicacion = :anio_publicacion,
                            disponibilidad = :disponibilidad,
                            area_id = :area_id,
                            categoria = :categoria,
                            editorial = :editorial,
                            clasificacion_fisica = :codigo_ubicacion
                        WHERE id = :id";
        
        $stmt_material = $pdo->prepare($sql_material);
        $stmt_material->execute([
            ':titulo' => $titulo,
            ':autor' => $autor,
            ':anio_publicacion' => $anio_publicacion,
            ':disponibilidad' => $disponibilidad,
            ':area_id' => $area_id,
            ':categoria' => $categoria,
            ':editorial' => $editorial,
            ':codigo_ubicacion' => $codigo_ubicacion,
            ':id' => $id
        ]);
        
        // 2. Actualizar o insertar ubicación física
        $sql_check = "SELECT id FROM ubicaciones_fisicas WHERE material_id = :material_id";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute([':material_id' => $id]);
        $existe_ubicacion = $stmt_check->fetch();
        
        if ($existe_ubicacion) {
            // Actualizar ubicación existente
            $sql_ubicacion = "UPDATE ubicaciones_fisicas 
                             SET pasillo = :pasillo,
                                 estante = :estante,
                                 nivel = :nivel,
                                 codigo_ubicacion = :codigo_ubicacion,
                                 fecha_asignacion = CURRENT_DATE
                             WHERE material_id = :material_id";
        } else {
            // Insertar nueva ubicación
            $sql_ubicacion = "INSERT INTO ubicaciones_fisicas 
                            (material_id, pasillo, estante, nivel, codigo_ubicacion, fecha_asignacion)
                            VALUES (:material_id, :pasillo, :estante, :nivel, :codigo_ubicacion, CURRENT_DATE)";
        }
        
        $stmt_ubicacion = $pdo->prepare($sql_ubicacion);
        $stmt_ubicacion->execute([
            ':material_id' => $id,
            ':pasillo' => $pasillo,
            ':estante' => $estante,
            ':nivel' => $nivel,
            ':codigo_ubicacion' => $codigo_ubicacion
        ]);
        
        $pdo->commit();
        $mensaje_exito = "Material y ubicación actualizados correctamente.";
        
        // Actualizar $material_seleccionado para mostrar los cambios
        $sql = "SELECT m.*, a.abreviado, u.fecha_asignacion 
                FROM materiales m
                JOIN areas a ON m.area_id = a.id
                LEFT JOIN ubicaciones_fisicas u ON m.id = u.material_id
                WHERE m.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $material_seleccionado = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        $mensaje = "Error al actualizar: " . $e->getMessage();
    }
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Material</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .main-content {
        flex: 1;
    }

    body { background-color: #e8f5e9; font-family: Arial, sans-serif; }
    .container { margin-top: 50px; max-width: 900px; }
    h1 { color: #2e7d32; text-align: center; margin-bottom: 30px; }
    .btn-primary { background-color: #2e7d32; border-color: #2e7d32; }
    .btn-primary:hover { background-color: #1b5e20; border-color: #1b5e20; }
    .alert-success { background-color: #c8e6c9; color: #2e7d32; border-color: #2e7d32; }
    .form-group label { color: #1b5e20; font-weight: 500; }
    .material-card { border-left: 4px solid #2e7d32; margin-bottom: 15px; }
    .location-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
    #clasificacion-fisica { background-color: #f8f9fa; font-weight: bold; }
    a.volver { color: #6c757d; text-decoration: none; }
    a.volver:hover { color: #218838; }
</style>

</head>
<body>
  <div class="wrapper">
  <div class="main-content">
    <div class="container">
      <h1>Modificar Material</h1>

      <!-- Formulario de Búsqueda -->
      <form method="post" class="mb-4">
        <div class="form-group">
          <label for="busqueda">Buscar por Título</label>
          <input type="text" class="form-control" name="busqueda" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Material</button>
      </form>

      <!-- Resultados de Búsqueda -->
      <?php if (!empty($materiales_encontrados)): ?>
        <div class="resultados-busqueda mb-4">
          <h3>Resultados de la búsqueda</h3>
          <p class="text-muted">Se encontraron <?= count($materiales_encontrados) ?> materiales.</p>

          <form method="post">
            <?php foreach ($materiales_encontrados as $material): ?>
              <div class="card material-card mb-2">
                <div class="card-body">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="id_material" 
                      id="material_<?= $material['id'] ?>" value="<?= $material['id'] ?>" required>
                    <label class="form-check-label" for="material_<?= $material['id'] ?>">
                      <h5><?= htmlspecialchars($material['titulo']) ?></h5>
                      <p class="mb-1"><strong>Autor:</strong> <?= htmlspecialchars($material['autor']) ?></p>
                      <p class="mb-1"><strong>Ubicación:</strong> <?= htmlspecialchars($material['clasificacion_fisica'] ?? 'No asignada') ?></p>
                    </label>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary btn-block mt-3" name="seleccionar">Seleccionar este material</button>
          </form>
        </div>
      <?php endif; ?>

      <!-- Formulario de Modificación -->
      <?php if ($material_seleccionado): ?>
        <form method="post" class="mt-4">
          <input type="hidden" name="id" value="<?= $material_seleccionado['id'] ?>">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="titulo">Título</label>
              <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($material_seleccionado['titulo']) ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label for="autor">Autor</label>
              <input type="text" class="form-control" name="autor" value="<?= htmlspecialchars($material_seleccionado['autor']) ?>" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="anio_publicacion">Año</label>
              <input type="number" class="form-control" name="anio_publicacion" min="1000" max="<?= date('Y') ?>" value="<?= htmlspecialchars($material_seleccionado['anio_publicacion']) ?>" required>
            </div>
            <div class="form-group col-md-4">
              <label for="disponibilidad">Disponibilidad</label>
              <input type="text" class="form-control" name="disponibilidad" value="<?= htmlspecialchars($material_seleccionado['disponibilidad']) ?>" required>
            </div>
            <div class="form-group col-md-4">
              <label for="area_id">Área</label>
              <select class="form-control" name="area_id" required>
                <?php foreach ($areas as $area): ?>
                  <option value="<?= $area['id'] ?>" <?= $area['id'] == $material_seleccionado['area_id'] ? 'selected' : '' ?> data-abreviado="<?= $area['abreviado'] ?>">
                    <?= htmlspecialchars($area['nombre']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="categoria">Categoría</label>
              <input type="text" class="form-control" name="categoria" value="<?= htmlspecialchars($material_seleccionado['categoria']) ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label for="editorial">Editorial</label>
              <input type="text" class="form-control" name="editorial" value="<?= htmlspecialchars($material_seleccionado['editorial']) ?>" required>
            </div>
          </div>

          <!-- Sección de Ubicación Física -->
          <div class="card mt-3 mb-4">
            <div class="card-header bg-success text-white">
              <h5 class="mb-0">Ubicación Física</h5>
            </div>
            <div class="card-body">
              <div class="location-grid">
                <div class="form-group">
                  <label for="pasillo">Pasillo (A-J)</label>
                  <select class="form-control" name="pasillo" required>
                    <option value="">Seleccione pasillo</option>
                    <?php foreach (range('A', 'J') as $letra): ?>
                      <option value="<?= $letra ?>" <?= ($material_seleccionado['pasillo'] ?? '') == $letra ? 'selected' : '' ?>><?= $letra ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="estante">Estante (1-30)</label>
                  <select class="form-control" name="estante" required>
                    <option value="">Seleccione estante</option>
                    <?php foreach (range(1, 30) as $numero): ?>
                      <option value="<?= $numero ?>" <?= ($material_seleccionado['estante'] ?? '') == $numero ? 'selected' : '' ?>><?= $numero ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="nivel">Nivel (1-6)</label>
                  <select class="form-control" name="nivel" required>
                    <option value="">Seleccione nivel</option>
                    <?php foreach (range(1, 6) as $nivel): ?>
                      <option value="<?= $nivel ?>" <?= ($material_seleccionado['nivel'] ?? '') == $nivel ? 'selected' : '' ?>><?= $nivel ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group mt-3">
                <label for="clasificacion-fisica">Código de Ubicación</label>
                <input type="text" class="form-control" id="clasificacion-fisica" value="<?= $material_seleccionado['clasificacion_fisica'] ?? '' ?>" readonly>
              </div>

              <div class="form-group mt-3">
                <label for="fecha-modificacion">Última Modificación</label>
                <input type="text" class="form-control" id="fecha-modificacion" value="<?= !empty($material_seleccionado['fecha_asignacion']) ? htmlspecialchars($material_seleccionado['fecha_asignacion']) : 'No registrada' ?>" readonly>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block" name="modificar">Guardar Cambios</button>
        </form>
      <?php endif; ?>

      <!-- Mensajes -->
      <?php if ($mensaje_exito): ?>
        <div class="alert alert-success text-center mt-4"><?= $mensaje_exito ?></div>
      <?php elseif (isset($mensaje)): ?>
        <div class="alert alert-warning text-center mt-4"><?= $mensaje ?></div>
      <?php endif; ?>

      <a href="../ingreso_bibliotecario_1.php" class="volver d-block text-center mt-4">← Volver al menú principal</a>

      <div class="text-center mt-4">
        <a href="../MATERIALES/listar_materiales.PHP" class="btn btn-success">Lista</a>
      </div>
    </div>
  </div>

  <?php include 'footer1.html'; ?>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        // Generar código de ubicación automáticamente
        function actualizarCodigoUbicacion() {
            const areaAbrev = $('select[name="area_id"] option:selected').data('abreviado');
            const pasillo = $('select[name="pasillo"]').val();
            const estante = $('select[name="estante"]').val();
            const nivel = $('select[name="nivel"]').val();
            
            if (areaAbrev && pasillo && estante && nivel) {
                const codigo = `${areaAbrev}-${pasillo}-${estante}-${nivel}`;
                $('#clasificacion-fisica').val(codigo);
            }
        }
        
        // Escuchar cambios en los selects
        $('select[name="abreviado"], select[name="pasillo"], select[name="estante"], select[name="nivel"]').change(function() {
            actualizarCodigoUbicacion();
        });
        
        // Inicializar código al cargar el formulario
        if ($('#clasificacion-fisica').val() === '') {
            actualizarCodigoUbicacion();
        }
    });
    </script>
</body>
</html>