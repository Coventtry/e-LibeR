<?php
require '../conexion/conectatew.php'; // archivo con PDO y SQLite

// Consultar las noticias
$stmt = $pdo->prepare("SELECT id, titulo, descripcion, imagen FROM noticias ORDER BY id DESC");
$stmt->execute();
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Avisador de Noticias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../img/icono.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
            color: #2e7d32;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            flex: 1;
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

        h1 {
            text-align: center;
            margin: 30px 0;
            color: #1b5e20;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        .news-container {
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            text-align: center;
        }

        .news-container:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .news-title {
            color: #1b5e20;
            font-weight: bold;
        }

        .news-description {
            color: #2e7d32;
            font-size: 0.95rem;
        }

        .btn-edit, .btn-delete {
            margin-top: 10px;
            width: 100%;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .btn-edit {
            background-color: #66bb6a;
            color: white;
        }

        .btn-edit:hover {
            background-color: #43a047;
        }

        .btn-delete {
            background-color: #ef5350;
            color: white;
        }

        .btn-delete:hover {
            background-color: #e53935;
        }

        footer {
            background-color: #161245;
            color: white;
            text-align: center;
            padding: 20px;
            border-top: 2px solid #2e7d32;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Noticias</h1>
        <div class="container">
            <div class="row">
                <?php if (count($noticias) > 0): ?>
                    <?php foreach ($noticias as $row): ?>
                        <div class="col-md-4 mb-4">
                            <div class="news-container">
                                <h3 class="news-title"><?= htmlspecialchars($row["titulo"]) ?></h3>
                                <?php
                                $imagenPath = basename($row["imagen"]); // ej: 'foto.jpg'
                                $rutaWeb = "/e-LibeR/img/" . $imagenPath;
                                ?>
                                <img src="<?= htmlspecialchars($rutaWeb) ?>" alt="Noticia" class="img-fluid mb-3 rounded">
                                
                                <p class="news-description"><?= htmlspecialchars($row["descripcion"]) ?></p>

                                <!-- Botón Modificar -->
                                <form action="../avisador/modifcar_avisador.php" method="POST">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row["id"]) ?>">
                                    <button type="submit" class="btn btn-edit">Modificar</button>
                                </form>

                                <!-- Botón Eliminar -->
                                <form action="../avisador/eliminar_avisador.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta noticia?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row["id"]) ?>">
                                    <button type="submit" class="btn btn-delete">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class='text-center'>No hay noticias disponibles.</p>
                <?php endif; ?>
            </div>
        </div>

        <a href="../ingreso_bibliotecario_1.php" class="back-link">← Volver a la página principal</a>
    </div>

    <!-- Footer fijo al fondo -->
    <?php include 'footer1.html'; ?>
</body>
</html>
