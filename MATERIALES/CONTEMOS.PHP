<?php
// Conexión a la base de datos
$servername = "127.0.0.1";
$database = "Biblioteca";
$username = "root"; // Reemplaza con tu usuario
$password = ""; // Reemplaza con tu contraseña

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar eliminación de materiales
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eliminar_todos_duplicados'])) {
        // Eliminar todos los duplicados dejando solo 1 copia
        $sql_titulos_repetidos = "SELECT titulo FROM materiales GROUP BY titulo HAVING COUNT(*) > 1";
        $result = $conn->query($sql_titulos_repetidos);
        $total_eliminados = 0;
        
        while ($row = $result->fetch_assoc()) {
            $titulo = $row['titulo'];
            
            // Obtener el ID del registro más reciente a mantener
            $sql_id_a_mantener = "SELECT id FROM materiales WHERE titulo = ? 
                                 ORDER BY anio_publicacion DESC, id DESC LIMIT 1";
            $stmt = $conn->prepare($sql_id_a_mantener);
            $stmt->bind_param("s", $titulo);
            $stmt->execute();
            $id_a_mantener = $stmt->get_result()->fetch_assoc()['id'];
            $stmt->close();
            
            // Eliminar todos los demás
            $sql_eliminar = "DELETE FROM materiales WHERE titulo = ? AND id != ?";
            $stmt = $conn->prepare($sql_eliminar);
            $stmt->bind_param("si", $titulo, $id_a_mantener);
            $stmt->execute();
            $total_eliminados += $conn->affected_rows;
            $stmt->close();
        }
        
        $mensaje_exito = "Se eliminaron $total_eliminados ejemplares duplicados, dejando solo 1 copia de cada título.";
        
    } elseif (isset($_POST['eliminar_repetidos'])) {
        // Eliminar selectivamente según cantidad a mantener
        $titulo = $_POST['titulo'];
        $cantidad_a_mantener = intval($_POST['cantidad_a_mantener']);
        
        // Obtener IDs a mantener (los más recientes)
        $sql_ids_a_mantener = "SELECT id FROM materiales 
                              WHERE titulo = ? 
                              ORDER BY anio_publicacion DESC, id DESC 
                              LIMIT ?";
        
        $stmt = $conn->prepare($sql_ids_a_mantener);
        $stmt->bind_param("si", $titulo, $cantidad_a_mantener);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ids_a_mantener = [];
        while ($row = $result->fetch_assoc()) {
            $ids_a_mantener[] = $row['id'];
        }
        $stmt->close();
        
        if (!empty($ids_a_mantener)) {
            $placeholders = implode(',', array_fill(0, count($ids_a_mantener), '?'));
            $sql_eliminar = "DELETE FROM materiales 
                            WHERE titulo = ? 
                            AND id NOT IN ($placeholders)";
            
            $stmt = $conn->prepare($sql_eliminar);
            $types = 's' . str_repeat('i', count($ids_a_mantener));
            $params = array_merge([$titulo], $ids_a_mantener);
            $stmt->bind_param($types, ...$params);
            
            if ($stmt->execute()) {
                $filas_afectadas = $conn->affected_rows;
                $mensaje_exito = "Se eliminaron $filas_afectadas ejemplar(es) de '$titulo', manteniendo $cantidad_a_mantener.";
            } else {
                $mensaje_error = "Error al eliminar materiales: " . $conn->error;
            }
            $stmt->close();
        } else {
            $mensaje_error = "No se encontraron materiales para mantener con el título '$titulo'";
        }
    }
}

// Consultas para mostrar los materiales
$sql_count = "SELECT COUNT(*) as total_materiales FROM materiales";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();

$sql_repetidos = "SELECT titulo, COUNT(*) as cantidad 
                  FROM materiales 
                  GROUP BY titulo 
                  HAVING COUNT(*) > 1
                  ORDER BY cantidad DESC";

$result_repetidos = $conn->query($sql_repetidos);

$sql_codigos_repetidos = "SELECT codigo, COUNT(*) as cantidad 
                          FROM materiales 
                          GROUP BY codigo 
                          HAVING COUNT(*) > 1";

$result_codigos = $conn->query($sql_codigos_repetidos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Materiales - Biblioteca</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        h2, h3 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .success { color: green; padding: 10px; background-color: #e8f5e9; border: 1px solid #a5d6a7; margin: 10px 0; }
        .error { color: red; padding: 10px; background-color: #ffebee; border: 1px solid #ef9a9a; margin: 10px 0; }
        .eliminar-form { display: inline-block; margin-left: 10px; }
        input[type="number"] { width: 50px; padding: 5px; }
        button { padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; }
        .btn-danger { background-color: #e74c3c; color: white; }
        .btn-danger:hover { background-color: #c0392b; }
        .btn-primary { background-color: #3498db; color: white; }
        .btn-primary:hover { background-color: #2980b9; }
        .global-action { margin: 20px 0; padding: 10px; background: #f8f9fa; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Total de materiales en la biblioteca: <?php echo $row_count['total_materiales']; ?></h2>

    <?php if (isset($mensaje_exito)): ?>
        <div class="success"><?php echo $mensaje_exito; ?></div>
    <?php endif; ?>
    
    <?php if (isset($mensaje_error)): ?>
        <div class="error"><?php echo $mensaje_error; ?></div>
    <?php endif; ?>

    <div class="global-action">
        <form method="post" onsubmit="return confirm('¿Está seguro que desea eliminar TODOS los duplicados, dejando solo 1 copia de cada título?');">
            <button type="submit" name="eliminar_todos_duplicados" class="btn-primary">
                Eliminar todos los duplicados (dejar 1 copia de cada título)
            </button>
        </form>
    </div>

    <?php if ($result_repetidos->num_rows > 0): ?>
        <h3>Materiales repetidos:</h3>
        <table>
            <tr><th>Título</th><th>Cantidad</th><th>Acciones</th></tr>
            
            <?php while($row = $result_repetidos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td>
                        <form method="post" class="eliminar-form">
                            <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($row['titulo']); ?>">
                            Mantener <input type="number" name="cantidad_a_mantener" min="1" max="<?php echo ($row['cantidad']-1); ?>" value="1">
                            <button type="submit" name="eliminar_repetidos" class="btn-danger">Eliminar excedentes</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No se encontraron materiales repetidos por título.</p>
    <?php endif; ?>

    <?php if ($result_codigos->num_rows > 0): ?>
        <h3>Materiales con códigos duplicados:</h3>
        <table>
            <tr><th>Código</th><th>Cantidad</th></tr>
            
            <?php while($row = $result_codigos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['codigo']); ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No se encontraron materiales con códigos duplicados.</p>
    <?php endif; ?>
        <div><a href="../ingreso_bibliotecario.php" class="btn btn-primary btn-volver">Volver al Menú Principal</a></div>
    <?php $conn->close(); ?>
</body>
</html>