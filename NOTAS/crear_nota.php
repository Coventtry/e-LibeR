<?php
require '../conexion/conexion_BD.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="img/icono.ico" type="image/x-icon">
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
            font-size: 1.2rem; /* Aumentar el tamaño de fuente del enlace */
        }
        a:hover {
            color: darkgreen;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            font-size: 18px; /* Aumentar tamaño de texto en el body */
        }
        .container {
            width: 90%; /* Aumentar el tamaño del contenedor */
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px; /* Aumentar padding para más espacio interno */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #28a745;
            font-size: 2rem; /* Aumentar tamaño de fuente del título */
            margin-bottom: 20px;
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 1.1rem; /* Aumentar tamaño de fuente en la tabla */
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
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            text-align: center;
        }
        .btn-secondary {
            background-color: #218838;

        }
        .btn:hover {
            
            background-color: #6c757d;
        }
        footer {
            background-color: #052442; /* Usar un color coherente con el tema */
            color: white;
            padding: 40px; /* Aumentar padding para un pie de página más grande */
            text-align: center;
            margin-top: 50px; /* Ajustar el margen superior para separar más el contenido */
        }
    </style>
</head>
<body>
<h2>Resultados de la Búsqueda</h2>
<div class="container">


    <!-- Formulario de anotación -->
    <form action="cargar_nota.php" method="post">
        <label for="anotacion" style="font-size: 1.2rem;">Anotación:</label><br><br>
        <textarea id="anotacion" name="anotacion" rows="8" cols="60" placeholder="Escribe aquí tus anotaciones, cambios, implementaciones, fallas, etc." style="font-size: 1.1rem;"></textarea><br><br>
        <button type="submit" class="btn"><h3>Guardar Anotación</h3></button>
    </form>

    <!-- Enlace para volver al menú principal -->
    <a href="../ingreso_bibliotecario_1.php" class="btn btn-secondary">Volver al Menú Principal</a>
</div>

<!-- Pie de página -->
<?php include 'footer1.html'; ?>

</body>
</html>
