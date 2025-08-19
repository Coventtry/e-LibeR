<?php
require '../conexion/CONECTOR.PHP';

$material_seleccionado = null;
$codigo_barra = '';
$mensaje_error = '';

// Manejar búsqueda del material
if (isset($_POST['buscar'])) {
    $busqueda = trim($_POST['busqueda']);

    if (!empty($busqueda)) {
        $sql = "SELECT * FROM materiales WHERE titulo LIKE :busqueda";
        $stmt = $conn->prepare($sql);
        $param = '%' . $busqueda . '%';
        $stmt->bindParam(':busqueda', $param, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $material_seleccionado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($material_seleccionado) {
                $codigo_barra = $material_seleccionado['id'];
            } else {
                $mensaje_error = "<p style='color:red;'>No se encontró material con ese título.</p>";
            }
        } catch (PDOException $e) {
            $mensaje_error = "<p style='color:red;'>Error en la búsqueda: " . $e->getMessage() . "</p>";
        }
    } else {
        $mensaje_error = "<p style='color:red;'>Ingrese un título para buscar.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Libros - Biblioteca</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #444;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 120px;
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
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
            margin: 30px auto;
        }

        h1 {
            color: #2e7d32;
            font-size: 2em;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        input[type="text"], input[type="number"], textarea, input[type="file"], select {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #28a745;
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        #barcode-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #e9f5ff;
            border-radius: 10px;
            border: 1px solid #b0bec5;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        #qrcode {
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }

        #downloadQRBtn {
            margin-top: 15px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 100px;
            background-color: #f8f9fa;
            color: #666;
            text-align: center;
            padding: 30px 10px;
            border-top: 1px solid #ccc;
            box-sizing: border-box;
            z-index: 100;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 id="inicio">Materiales</h1>

    <!-- Formulario de búsqueda de material -->
    <form method="post">
        <input type="text" name="busqueda" placeholder="Buscar por Título" required>
        <button type="submit" class="btn-primary" name="buscar">Buscar Material</button>
    </form>

    <?php echo $mensaje_error; ?>

    <?php if ($material_seleccionado): ?>
        <form method="post" style="margin-top: 20px;">
            <input type="hidden" name="id" value="<?php echo $material_seleccionado['id']; ?>">
            <div>
                <label for="titulo">Título</label>
                <input type="text" name="titulo" value="<?php echo $material_seleccionado['titulo']; ?>" required>
            </div>
            <div>
                <label for="autor">Autor</label>
                <input type="text" name="autor" value="<?php echo $material_seleccionado['autor']; ?>" required>
            </div>
            <div>
                <label for="anio_publicacion">Año de Publicación</label>
                <input type="number" name="anio_publicacion" value="<?php echo $material_seleccionado['anio_publicacion']; ?>" required>
            </div>
            <div>
                <label for="categoria">Categoría</label>
                <input type="text" name="categoria" value="<?php echo $material_seleccionado['categoria']; ?>" required>
            </div>
        </form>

        <?php if (!empty($codigo_barra)): ?>
            <div id="barcode-container">
                <h2>Código QR generado:</h2>
                <div id="qrcode"></div>
                <button id="downloadQRBtn" class="btn-primary">Descargar Código QR (PNG)</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<a href="../ingreso_bibliotecario_1.php">← Volver al menú principal</a>
<br><br>
<script>
    var codigo_barra = '<?php echo $codigo_barra; ?>';
    if (codigo_barra) {
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: codigo_barra,
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }

    document.getElementById('downloadQRBtn').addEventListener('click', function() {
        var img = document.querySelector('#qrcode img') || document.querySelector('#qrcode canvas');
        var url = img.src || img.toDataURL("image/png");
        var downloadLink = document.createElement('a');
        downloadLink.href = url;
        downloadLink.download = codigo_barra + ".png";
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });
</script>
</body>
</html>
