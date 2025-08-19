<?php
require '../conexion/CONECTOR.PHP';

$areas = [];
$error = '';

try {
    $sql_areas = "SELECT * FROM areas ORDER BY nombre";
    $stmt_areas = $conn->query($sql_areas);
    $areas = $stmt_areas->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al consultar áreas: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $area_id = (int)($_POST['tipo'] ?? 0);
    $codigo = trim($_POST['codigo'] ?? '');
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $anio_publicacion = trim($_POST['anio_publicacion'] ?? '');
    $disponibilidad = trim($_POST['disponibilidad'] ?? '');
    $editorial = trim($_POST['editorial'] ?? '');
    $clasificacion_fisica = trim($_POST['clasificacion_fisica_hidden'] ?? '');

    if (empty($codigo) || empty($titulo) || empty($autor) || empty($anio_publicacion) || 
        empty($disponibilidad) || empty($editorial) || $area_id <= 0 || empty($clasificacion_fisica)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!preg_match('/^\d{4}$/', $anio_publicacion) || $anio_publicacion < 1000 || $anio_publicacion > date('Y')) {
        $error = "El año debe tener 4 dígitos válidos.";
    } else {
        try {
            $sql = "INSERT INTO materiales (codigo, titulo, autor, anio_publicacion, disponibilidad, editorial, area_id, clasificacion_fisica) 
                    VALUES (:codigo, :titulo, :autor, :anio_publicacion, :disponibilidad, :editorial, :area_id, :clasificacion_fisica)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':anio_publicacion', $anio_publicacion);
            $stmt->bindParam(':disponibilidad', $disponibilidad);
            $stmt->bindParam(':editorial', $editorial);
            $stmt->bindParam(':area_id', $area_id);
            $stmt->bindParam(':clasificacion_fisica', $clasificacion_fisica);

            if ($stmt->execute()) {
                header("Location: ingreso_bibliotecario.php?success=1");
                exit();
            } else {
                $error = "Error al guardar el material.";
            }
        } catch (PDOException $e) {
            $error = "Error de inserción: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Material</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #e8f5e9; font-family: Arial; }
        .container { margin-top: 50px; }
        h1 { color: #2e7d32; text-align: center; margin-bottom: 30px; }
        label { color: #1b5e20; }
        #codigo-container { display: none; }
        .location-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px; }
        #clasificacion-fisica { background-color: #e9e9e9; font-weight: bold; padding: 10px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Material</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <!-- CAMBIO 1: Modifiqué la consulta SQL para incluir la abreviatura -->
            <div class="form-group">
                <label for="tipo">Área</label>
                <select class="form-control" name="tipo" id="tipo" required>
                    <option value="">Seleccione un Área</option>
                    <?php foreach ($areas as $area): ?>
                        <!-- CAMBIO 2: Agregué data-abreviado con la abreviatura del área -->
                        <option value="<?= $area['id'] ?>" data-abreviado="<?= $area['Abreviado'] ?>" data-codigo="<?= $area['codigo_dewey'] ?>">
                            <?= htmlspecialchars($area['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" id="codigo-container">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" name="codigo" id="codigo" readonly required>
                <small class="form-text text-muted">El código se genera automáticamente</small>
            </div>

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" class="form-control" name="autor" required>
            </div>
            <div class="form-group">
                <label for="anio_publicacion">Año</label>
                <input type="number" class="form-control" name="anio_publicacion" min="1000" max="9999" required>
            </div>
            <div class="form-group">
                <label for="disponibilidad">Disponibilidad</label>
                <input type="text" class="form-control" name="disponibilidad" required>
            </div>
            <div class="form-group">
                <label for="editorial">Editorial</label>
                <input type="text" class="form-control" name="editorial" required>
            </div>
            
            <!-- Sistema de clasificación física -->
            <div class="form-group">
    <label>Ubicación Física</label>
    <div class="location-grid">
        <div class="form-group">
            <label for="pasillo">Pasillo (A-Z)</label>
            <select class="form-control" id="pasillo" name="pasillo" required>
                <option value="">Seleccione pasillo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipo_almacenamiento">Tipo</label>
            <select class="form-control" id="tipo_almacenamiento" name="tipo_almacenamiento" required>
                <option value="">Seleccione tipo</option>
                <option value="E">Estante (E)</option>
                <option value="M">Mueble (M)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estante">Número (1-30)</label>
            <select class="form-control" id="estante" name="estante" required>
                <option value="">Seleccione número</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nivel">Nivel (1-6)</label>
            <select class="form-control" id="nivel" name="nivel" required>
                <option value="">Seleccione nivel</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="clasificacion-fisica">Clasificación Física</label>
        <input type="text" class="form-control" id="clasificacion-fisica" name="clasificacion_fisica" readonly>
        <input type="hidden" id="clasificacion-fisica-hidden" name="clasificacion_fisica_hidden">
    </div>
</div>

            <button type="submit" class="btn btn-success btn-block">Guardar</button>
        </form>

        <a href="../ingreso_bibliotecario_1.php" class="d-block text-center mt-4">← Volver</a>
    </div>
<?php include 'footer1.html'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function () {
        // Configuración de pasillos por área
        const pasillosPorArea = {
            <?php foreach ($areas as $area): ?>
                '<?= $area['id'] ?>': <?= json_encode(explode(',', $area['pasillos_disponibles'] ?? 'A,B,C,D,E,F,G,H,I,J')) ?>,
            <?php endforeach; ?>
        }

        // Configuración de estantes por área
        const estantesPorArea = {
            <?php foreach ($areas as $area): ?>
                '<?= $area['id'] ?>': Array.from({length: <?= $area['max_estantes'] ?? 30 ?>}, (_, i) => i + 1),
            <?php endforeach; ?>
        }

        // Función para actualizar pasillos y estantes
        function actualizarUbicacionFisica() {
            const areaId = $('#tipo').val();
            // CAMBIO 3: Usamos data-abreviado en lugar del ID
            const abreviatura = $('#tipo option:selected').data('abreviado');
            
            // Limpiar y llenar pasillos
            $('#pasillo').empty().append('<option value="">Seleccione pasillo</option>');
            if (areaId && pasillosPorArea[areaId]) {
                pasillosPorArea[areaId].forEach(letra => {
                    $('#pasillo').append(`<option value="${letra}">${letra}</option>`);
                });
            }
            
            // Limpiar y llenar estantes
            $('#estante').empty().append('<option value="">Seleccione estante</option>');
            if (areaId && estantesPorArea[areaId]) {
                estantesPorArea[areaId].forEach(numero => {
                    $('#estante').append(`<option value="${numero}">${numero}</option>`);
                });
            }
            
            actualizarClasificacionFisica();
        }

        // Función para actualizar la clasificación física completa
       function actualizarClasificacionFisica() {
    const areaCode = $('#tipo option:selected').data('abreviado');
    const pasillo = $('#pasillo').val();
    const tipoAlmacenamiento = $('#tipo_almacenamiento').val();
    const estante = $('#estante').val();
    const nivel = $('#nivel').val();
    
    if (areaCode && pasillo && tipoAlmacenamiento && estante && nivel) {
        const clasificacion = `${areaCode}-${pasillo}-(${tipoAlmacenamiento})${estante}-${nivel}`;
        $('#clasificacion-fisica').val(clasificacion);
        $('#clasificacion-fisica-hidden').val(clasificacion);
    } else {
        $('#clasificacion-fisica').val('');
        $('#clasificacion-fisica-hidden').val('');
    }
}

        // Event listeners
        $('#tipo').change(function () {
            const selected = $(this).find(':selected');
            const areaId = selected.val();
            const baseCode = selected.data('codigo');

            if (areaId) {
                $('#codigo-container').show();
                $.ajax({
                    url: 'get_last_code.php',
                    type: 'POST',
                    data: { area_id: areaId },
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            let nextNumber = parseInt(res.last_number) + 1;
                            let newCode = baseCode + '-' + String(nextNumber).padStart(3, '0');
                            $('#codigo').val(newCode);
                        } else {
                            $('#codigo').val(baseCode + '-001');
                        }
                    },
                    error: function () {
                        $('#codigo').val(baseCode + '-001');
                    }
                });
                
                // Actualizar ubicación física cuando cambia el área
                actualizarUbicacionFisica();
            } else {
                $('#codigo-container').hide();
                $('#codigo').val('');
                $('#clasificacion-fisica').val('');
            }
        });

        $('#pasillo, #tipo_almacenamiento, #estante, #nivel').change(actualizarClasificacionFisica);

    });
    </script>
</body>
</html>