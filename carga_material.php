<?php
require 'conexion_BD.php';

$material_seleccionado = null;
$codigo_barra = '';

// Manejar búsqueda del material
if (isset($_POST['buscar'])) {
    $busqueda = $conn->real_escape_string($_POST['busqueda']);
    $sql = "SELECT * FROM materiales WHERE titulo LIKE '%$busqueda%'"; // Cambia 'materiales' y 'titulo' según tu estructura de BD
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Guardar el material encontrado
        $material_seleccionado = $result->fetch_assoc();
        $codigo_barra = $material_seleccionado['id']; // Cambia esto si deseas usar otro campo como código de barras
    } else {
        echo "<p>No se encontró material con ese título.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Libros - Biblioteca</title>
    <style>
/* Estilos generales de la página */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente moderna */
    background-color: #f4f6f8; /* Color de fondo más suave */
    color: #444; /* Texto en un gris oscuro */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Estilos para enlaces */
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

/* Estilos del contenedor principal */
.container {
    background-color: #ffffff; /* Fondo blanco para el contenedor */
    padding: 30px; /* Aumentar el padding para un mejor espaciado */
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); /* Sombra más sutil */
    max-width: 600px; /* Aumentar el ancho máximo */
    width: 100%;
    text-align: center;
    margin: 30px auto; /* Añadir margen superior e inferior */
}

h1 {
    color: #2e7d32;
    font-size: 2em; /* Tamaño de fuente más grande */
    margin-bottom: 20px; /* Espacio inferior */
}

form {
    display: flex;
    flex-direction: column;
    gap: 20px; /* Espaciado mayor entre los elementos del formulario */
}

input[type="text"], input[type="number"] {
    padding: 12px; /* Aumentar el padding para campos de entrada */
    border: 1px solid #ccc; /* Color de borde más claro */
    border-radius: 5px;
    width: 100%;
    font-size: 16px;
}

/* Estilos para botones */
input[type="submit"], #downloadBtn, .btn-primary {
    background-color: #28a745; /* Verde moderno */
    color: white;
    padding: 14px 24px; /* Aumentar el padding para mayor tamaño */
    border: none;
    border-radius: 8px; /* Borde más redondeado */
    cursor: pointer;
    font-size: 18px; /* Aumentar tamaño de fuente */
    font-weight: bold; /* Hacer el texto en negrita */
    transition: background-color 0.3s ease, transform 0.2s ease; /* Transición suave */
}

input[type="submit"]:hover, #downloadBtn:hover, .btn-primary:hover {
    background-color: #218838; /* Verde más oscuro al pasar el ratón */
    transform: scale(1.05); /* Aumentar ligeramente el tamaño al pasar el ratón */
}

input[type="submit"]:active, #downloadBtn:active, .btn-primary:active {
    transform: scale(0.98); /* Reducir ligeramente el tamaño al hacer clic */
}

/* Estilos para el contenedor de código de barras */
#barcode-container {
    margin-top: 30px; /* Aumentar el margen superior */
    padding: 20px;
    background-color: #e9f5ff; /* Fondo azul claro */
    border-radius: 10px;
    border: 1px solid #b0bec5; /* Borde sutil */
    max-width: 300px; /* Establecer un ancho máximo más pequeño */
    margin-left: auto; /* Centrar el contenedor */
    margin-right: auto; /* Centrar el contenedor */
}

svg {
    width: 100%; /* Mantener el ancho al 100% del contenedor */
    height: auto; /* Altura automática para mantener la proporción */
    max-height: 60px; /* Establecer una altura máxima para el SVG */
}

#downloadBtn {
    margin-top: 15px; /* Espaciado adecuado para el botón de descarga */
}

/* Estilos del pie de página */
footer {
    margin-top: 20px;
    color: #666; /* Color del texto del pie de página */
    text-align: center;
    padding: 20px;
    background-color: #f8f9fa; /* Fondo claro para el pie de página */
    position: relative;
    width: 100%;
    border-top: 1px solid #ccc; /* Línea divisoria superior */
}
</style>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
</head>
<body>
<div class="container">
    <h1 id="inicio">Materiales</h1>

    <!-- Formulario de búsqueda de material -->
    <form method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="busqueda" placeholder='Buscar por Título' required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="buscar">Buscar Material</button>
    </form>

    <!-- Mostrar datos del material para modificar -->
    <?php if ($material_seleccionado): ?>
        <form method="post" style="margin-top: 20px;">
            <input type="hidden" name="id" value="<?php echo $material_seleccionado['id']; ?>">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" value="<?php echo $material_seleccionado['titulo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" class="form-control" name="autor" value="<?php echo $material_seleccionado['autor']; ?>" required>
            </div>
            <div class="form-group">
                <label for="anio_publicacion">Año de Publicación</label>
                <input type="number" class="form-control" name="anio_publicacion" value="<?php echo $material_seleccionado['anio_publicacion']; ?>" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <input type="text" class="form-control" name="categoria" value="<?php echo $material_seleccionado['categoria']; ?>" required>
            </div>
        </form>

        <?php if (!empty($codigo_barra)): ?>
            <div id="barcode-container">
                <h2>Código de barras generado:</h2>
                <svg id="barcode"></svg><br><br>
                <button id="downloadBtn">Descargar Código de Barras (SVG)</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    var codigo_barra = '<?php echo $codigo_barra; ?>';
    if (codigo_barra) {
        JsBarcode("#barcode", codigo_barra, {
            format: "CODE128",
            displayValue: true,
            fontSize: 18
        });
    }

    document.getElementById('downloadBtn').addEventListener('click', function() {
        var svg = document.getElementById('barcode');
        var svgData = new XMLSerializer().serializeToString(svg);
        var svgBlob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
        var svgUrl = URL.createObjectURL(svgBlob);
        var downloadLink = document.createElement('a');
        downloadLink.href = svgUrl;
        downloadLink.download = codigo_barra + ".svg";
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });
</script>
<a href="ingreso_bibliotecario.php">Volver a la página principal</a>
<!-- Pie de página -->
<footer>
    <?php include 'footer.html'; ?>
</footer>
</body>
</html>