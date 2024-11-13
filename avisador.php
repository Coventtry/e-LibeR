<?php
require 'conexion_BD.php';

// Consultar las noticias
$sql = "SELECT id, titulo, descripcion, imagen FROM noticias ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="img/icono.ico" type="image/x-icon">
    <title>Avisador de Noticias</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
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
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
            color: #2e7d32;
        }
        .container {
            text-align: center;
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin: 30px 0;
            color: #1b5e20;
        }
        .news-container {
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
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
        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: #388e3c;
            text-decoration: none;
            font-size: 1.1rem;
        }
        .back-link:hover {
            color: #2e7d32;
        }
        footer {
            background-color: #161245;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            border: 2px solid #2e7d32;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h1>Noticias</h1>
<div class="container">
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="news-container">';
                echo '<h3 class="news-title">' . $row["titulo"] . '</h3>';
                echo '<img src="' . $row["imagen"] . '" alt="Noticia" class="img-fluid mb-3 rounded">';
                echo '<p class="news-description">' . $row["descripcion"] . '</p>';

                // Botón para modificar
                echo '<form action="modifcar_avisador.php" method="POST">';
                echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                echo '<button type="submit" class="btn btn-edit">Modificar</button>';
                echo '</form>';

                // Botón para eliminar
                echo '<form action="eliminar_avisador.php" method="POST" onsubmit="return confirm(\'¿Estás seguro de que quieres eliminar esta noticia?\');">';
                echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                echo '<button type="submit" class="btn btn-delete">Eliminar</button>';
                echo '</form>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p class='text-center'>No hay noticias disponibles.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>
<div>
<a href="ingreso_bibliotecario.php" class="back-link">Volver a la página principal</a>
    </div>
    <!-- Footer -->
<footer>
    <h6>Práctica Profesionalizante I</h6>
    <p>Esta página fue desarrollada utilizando HTML 5, CSS, PHP</p>
</footer>
</body>
</html>
