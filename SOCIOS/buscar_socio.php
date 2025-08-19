<?php
// Conectar a la base de datos SQLite
require '../conexion/CONECTOR.php';

// Activar o inactivar socio si se recibió un ID y acción por GET
if (isset($_GET['accion']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $accion = $_GET['accion'] === 'activar' ? 1 : 0;

    $update_sql = "UPDATE socios SET activo = :activo WHERE id = :id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->execute([':activo' => $accion, ':id' => $id]);
}

// Inicializar término de búsqueda
$searchTerm = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST['email'] ?? '';
}

// Buscar socios por email o nombre
$sql = "SELECT * FROM socios WHERE email LIKE :search OR nombre LIKE :search";
$stmt = $conn->prepare($sql);
$param_search = '%' . $searchTerm . '%';
$stmt->execute([':search' => $param_search]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php /* Si tienes un archivo icono.php para el favicon, mantenlo. Sino, puedes quitar esta línea */ ?>
    <?php // include 'icono.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Búsqueda</title>
    <style>
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem;
        }
        a:hover { color: #218838; }
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #28a745;
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #28a745;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            text-align: center;
        }
        .btn-secondary { background-color: #6c757d; }
        .btn:hover { background-color: #218838; }
        footer {
            background-color: #343a40;
            color: white;
            padding: 32px;
            text-align: center;
            margin-top: 100px;
        }
    </style>
    <script>
        function confirmarCambio(nombre, accion) {
            return confirm("¿Estás seguro de que deseas " + accion + " al socio '" + nombre + "'?");
        }
    </script>
</head>
<body>
<div class="container">
    <?php
    if (count($results) > 0) {
        echo '<h2>Datos del Socio</h2>';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Año</th>
                <th>División</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($results as $row) {
    $estado = (isset($row["activo"]) && $row["activo"]) ? "Activo" : "Inactivo";
    $accion = $estado === "Activo" ? "inactivar" : "activar";
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row["nombre"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["apellido"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["telefono"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["direccion"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["anio"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["division"]) . '</td>';
            echo '<td>' . $estado . '</td>';
            echo '<td><a class="btn" href="?accion=' . $accion . '&id=' . $row["id"] . '" onclick="return confirmarCambio(\'' . htmlspecialchars($row["nombre"]) . '\', \'' . $accion . '\');">' . ucfirst($accion) . '</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert">No se encontró ningún socio con ese email o nombre.</div>';
    }
    ?>
    <a href="ingreso_bibliotecario.php" class="btn btn-secondary">Volver al Menú Principal</a>
</div>

<footer class="footer">
    <h6 style="margin-left: 34px; margin-top: 50px;">Practica Profesionalizante I<br></h6>
    <h6 style="margin-left: 34px;">Esta página fue desarrollada utilizando HTML 5,<br>CSS, Bootstrap 5, PHP<br></h6>
</footer>
</body>
</html>
