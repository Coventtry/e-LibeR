<?php
require 'conexion_BD.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>I.E.S. ESCUELA NORMAL SUPERIOR "GENERAL MANUEL BELGRANO"</title>
  <?php include 'encabezado.html'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }
    
    .jumbotron {
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1)), 
              url('img/biblioadmin.webp');
  background-size: cover;
  background-position: center;
  color: white;
  height: 300px;
}

    .navbar-nav {
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    .navbar .navbar-collapse {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .content img {
      max-width: 100%;
      height: auto;
      flex-grow: 1;
    }

    footer {
      background-color: #052442;
      color: white;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

<a href="ingreso_bibliotecario.php">Volver a la página principal</a>

<footer>
  <?php include 'footer.html'; ?>
</footer>

</body>
</html>
