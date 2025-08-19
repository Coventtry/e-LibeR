<?php
require '../conexion/conectatew.php'; // Conexión PDO

$mensaje_exito = '';
$mensaje = '';
$materiales_seleccionados = []; // Para almacenar múltiples materiales seleccionados
$materiales_encontrados = []; // Para almacenar múltiples resultados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        // Buscar material con LIKE, usando prepare para evitar inyección
        $busqueda = $_POST['busqueda'];
        $sql = "SELECT * FROM materiales WHERE titulo LIKE :busqueda ORDER BY titulo, autor";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':busqueda' => "%$busqueda%"]);
        $materiales_encontrados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($materiales_encontrados)) {
            $mensaje = "No se encontraron materiales.";
        }
    } elseif (isset($_POST['seleccionar'])) {
        // Seleccionar múltiples materiales para eliminar
        if (!empty($_POST['id_material'])) {
            // Asegurarnos de que siempre trabajamos con un array
            $ids = is_array($_POST['id_material']) ? $_POST['id_material'] : [$_POST['id_material']];
            
            // Filtrar valores vacíos o nulos
            $ids = array_filter($ids, function($id) {
                return !empty($id);
            });

            if (!empty($ids)) {
                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                $sql = "SELECT * FROM materiales WHERE id IN ($placeholders)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($ids);
                $materiales_seleccionados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $mensaje = "No se seleccionaron materiales válidos.";
            }
        } else {
            $mensaje = "No se seleccionaron materiales.";
        }
    } elseif (isset($_POST['eliminar'])) {
        // Eliminar múltiples materiales
        if (!empty($_POST['id'])) {
            // Asegurarnos de que siempre trabajamos con un array
            $ids = is_array($_POST['id']) ? $_POST['id'] : [$_POST['id']];
            
            // Filtrar valores vacíos o nulos
            $ids = array_filter($ids, function($id) {
                return !empty($id);
            });

            if (!empty($ids)) {
                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                $sql = "DELETE FROM materiales WHERE id IN ($placeholders)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute($ids)) {
                    $mensaje_exito = count($ids) > 1 
                        ? "Materiales eliminados exitosamente." 
                        : "Material eliminado exitosamente.";
                    $materiales_seleccionados = [];
                    $materiales_encontrados = [];
                } else {
                    $mensaje = "Error al eliminar los materiales.";
                }
            } else {
                $mensaje = "No se seleccionaron materiales válidos para eliminar.";
            }
        } else {
            $mensaje = "No se seleccionaron materiales para eliminar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Eliminar Materiales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
   <style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #e8f5e9;
    font-family: 'Arial', sans-serif;
    color: #2e7d32;
  }

  /* Envoltura general para forzar footer al fondo */
  .wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .main-content {
    flex: 1;
    padding-left: 40px;
    padding-right: 20px;
  }

  a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #6c757d;
    text-decoration: none;
    font-size: 1.1rem;
  }

  a:hover {
    color: #218838;
  }

  .container {
    margin-top: 50px;
    border: 1px solid #2e7d32;
    border-radius: 10px;
    padding: 20px;
    background-color: #ffffff;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
  }

  h1 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: bold;
  }

  .btn-verde {
    background-color: #2e7d32;
    border-color: #2e7d32;
    color: white;
  }

  .btn-verde:hover {
    background-color: #1b5e20;
    border-color: #1b5e20;
  }

  .btn-danger {
    background-color: #c62828;
    border-color: #c62828;
    color: white;
  }

  .btn-danger:hover {
    background-color: #b71c1c;
    border-color: #b71c1c;
  }

  .alert-warning {
    background-color: #fff3cd;
    color: #856404;
  }

  .alert-success {
    background-color: #c8e6c9;
    color: #2e7d32;
    border-color: #2e7d32;
  }

  footer {
    background-color: #161245;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: auto;
    border-top: 2px solid #2e7d32;
    border-radius: 0;
  }

  .material-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 10px;
    background-color: #f8f9fa;
  }

  .material-card h5 {
    color: #2e7d32;
  }

  .material-card p {
    margin-bottom: 5px;
  }

  .resultados-busqueda {
    margin-top: 20px;
  }

  .seleccion-multiple {
    margin: 15px 0;
  }

  .contador-seleccion {
    font-weight: bold;
    color: #2e7d32;
    margin-bottom: 10px;
  }
</style>

</head>
<body>
<div class="wrapper">
  <div class="main-content">
    <div class="container">
      <h1 id="inicio">Eliminar Materiales</h1>

      <!-- Formulario de búsqueda -->
      <form method="post">
        <div class="form-group">
          <label for="busqueda">Buscar por Título</label>
          <input type="text" class="form-control" name="busqueda" required />
        </div>
        <button type="submit" class="btn btn-verde btn-block" name="buscar">Buscar Materiales</button>
      </form>

      <!-- Resultados de búsqueda -->
      <?php if (!empty($materiales_encontrados)): ?>
        <div class="resultados-busqueda">
          <h3>Resultados de la búsqueda:</h3>
          <p>Se encontraron <?= count($materiales_encontrados); ?> materiales. Seleccione los que desea eliminar:</p>

          <form method="post" id="formSeleccion">
            <div class="seleccion-multiple mb-2">
              <button type="button" class="btn btn-outline-secondary btn-sm" onclick="seleccionarTodos()">Seleccionar todos</button>
              <button type="button" class="btn btn-outline-secondary btn-sm" onclick="deseleccionarTodos()">Deseleccionar todos</button>
              <span class="contador-seleccion" id="contadorSeleccion">0 materiales seleccionados</span>
            </div>

            <?php foreach ($materiales_encontrados as $material): ?>
              <div class="material-card mb-3">
                <div class="form-check">
                  <input class="form-check-input material-checkbox" type="checkbox" name="id_material[]" 
                         id="material_<?= $material['id']; ?>" 
                         value="<?= $material['id']; ?>" onchange="actualizarContador()">
                  <label class="form-check-label" for="material_<?= $material['id']; ?>">
                    <h5><?= htmlspecialchars($material['titulo']); ?></h5>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($material['autor']); ?></p>
                    <p><strong>Año:</strong> <?= htmlspecialchars($material['anio_publicacion']); ?></p>
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($material['categoria']); ?></p>
                    <p><strong>Disponibilidad:</strong> <?= htmlspecialchars($material['disponibilidad']); ?></p>
                  </label>
                </div>
              </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-verde btn-block" name="seleccionar">Seleccionar materiales</button>
          </form>
        </div>
      <?php endif; ?>

      <!-- Confirmar eliminación -->
      <?php if (!empty($materiales_seleccionados)): ?>
        <div class="alert alert-warning mt-4">
          <strong>¿Estás seguro de que deseas eliminar <?= count($materiales_seleccionados); ?> material(es)?</strong>

          <?php foreach ($materiales_seleccionados as $material): ?>
            <div class="material-card">
              <p><strong>Título:</strong> <?= htmlspecialchars($material['titulo']); ?></p>
              <p><strong>Autor:</strong> <?= htmlspecialchars($material['autor']); ?></p>
              <p><strong>Año de Publicación:</strong> <?= htmlspecialchars($material['anio_publicacion']); ?></p>
              <p><strong>Categoría:</strong> <?= htmlspecialchars($material['categoria']); ?></p>
            </div>
          <?php endforeach; ?>

          <!-- Nuevo formulario separado para confirmación -->
          <form method="post">
            <?php foreach ($materiales_seleccionados as $material): ?>
              <input type="hidden" name="id[]" value="<?= $material['id']; ?>" />
            <?php endforeach; ?>
            <button type="submit" class="btn btn-danger btn-block" name="eliminar">Eliminar Materiales Seleccionados</button>
          </form>
        </div>
      <?php endif; ?>

      <!-- Mensajes -->
      <?php if (!empty($mensaje_exito)): ?>
        <div class="alert alert-success text-center mt-4"><?= $mensaje_exito; ?></div>
      <?php elseif (!empty($mensaje)): ?>
        <div class="alert alert-warning text-center mt-4"><?= $mensaje; ?></div>
      <?php endif; ?>

      <a href="../ingreso_bibliotecario_1.php" class="d-block text-center mt-4">← Volver a la página principal</a>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include 'footer1.html'; ?>
</div>


<script>
    // Función para seleccionar todos los checkboxes
    function seleccionarTodos() {
        const checkboxes = document.querySelectorAll('.material-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
        actualizarContador();
    }

    // Función para deseleccionar todos los checkboxes
    function deseleccionarTodos() {
        const checkboxes = document.querySelectorAll('.material-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        actualizarContador();
    }

    // Función para actualizar el contador de selección
    function actualizarContador() {
        const checkboxes = document.querySelectorAll('.material-checkbox');
        const seleccionados = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
        const contador = document.getElementById('contadorSeleccion');
        
        if (seleccionados === 0) {
            contador.textContent = '0 materiales seleccionados';
        } else if (seleccionados === 1) {
            contador.textContent = '1 material seleccionado';
        } else {
            contador.textContent = `${seleccionados} materiales seleccionados`;
        }
    }
</script>
</body>
</html>