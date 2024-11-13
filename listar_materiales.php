<?php
require 'conexion_BD.php'; // Incluir conexión a la base de datos

// Variable para los resultados
$result = null;

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    // Obtener los parámetros de búsqueda
    $buscar = $_POST['buscar'];
    $tipo_busqueda = $_POST['tipo_busqueda'];

    // Generar el valor de la búsqueda con comodín (primeras letras)
    $buscar_inicial = substr($buscar, 0, 1) . '%'; // Tomamos la primera letra y añadimos un comodín para buscar coincidencias

    // Preparar la consulta SQL según el tipo de búsqueda (por título o por categoría)
    if ($tipo_busqueda == 'titulo') {
        $sql = "SELECT id, titulo, autor, anio_publicacion, categoria, area_id FROM materiales WHERE titulo LIKE ?";
    } else if ($tipo_busqueda == 'categoria') {
        $sql = "SELECT id, titulo, autor, anio_publicacion, categoria, area_id FROM materiales WHERE categoria LIKE ?";
    }

    // Ejecutar la consulta
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        echo "Error en la preparación de la consulta SQL: " . $conn->error;
        exit; // Detener la ejecución si hubo un error
    }

    $stmt->bind_param("s", $buscar_inicial);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php
include 'icono.php';
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Libro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .result {
            margin-top: 20px;
            background: #e9ecef;
            padding: 10px;
            border-radius: 4px;
        }
        footer {
            margin-top: 28%;
            background-color: #052442;
            color: white;
            padding: 10px;
            text-align: center;
        }
        h6 {
            color: white;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 1.1rem; /* Aumentar el tamaño de fuente del enlace */
        }
        a:hover {
            color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Buscar Libro</h1>
        <form method="POST" action="">
            <label for="buscar">Buscar por:</label>
            <input type="text" name="buscar" id="buscar" placeholder="Las primera 3 letras son:" required>
            
            <label for="tipo_busqueda">Seleccione el tipo de búsqueda:</label>
            <select name="tipo_busqueda" id="tipo_busqueda" required>
                <option value="titulo">Título</option>
                <option value="categoria">Categoría</option>
            </select>

            <input type="submit" value="Buscar">
        </form>

        <?php if ($result !== null): ?>
            <div class="result">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<strong>Título:</strong> " . htmlspecialchars($row["titulo"]) . "<br>";
                        echo "<strong>Autor:</strong> " . htmlspecialchars($row["autor"]) . "<br>";
                        echo "<strong>Año de Publicación:</strong> " . htmlspecialchars($row["anio_publicacion"]) . "<br>";
                        echo "<strong>Categoría:</strong> " . htmlspecialchars($row["categoria"]) . "<br>";
                        echo "<strong>Área ID:</strong> " . htmlspecialchars($row["area_id"]) . "<br><hr>";
                    }
                } else {
                    echo "<p>No se encontraron libros que coincidan con el criterio de búsqueda.</p>";
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <a href="ingreso.php">Volver a la página principal</a>

    <!-- Footer -->
    <footer class="footer">
        <h6>Practica Profesionalizante I</h6>
        <h6>Esta página fue desarrollada utilizando HTML 5, CSS, Bootstrap 5, PHP</h6>
    </footer>

</body>
</html>
