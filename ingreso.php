<?php
require 'conexion_BD.php';

// Consultar las noticias
$sql = "SELECT titulo, descripcion, imagen FROM noticias ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
include 'icono.php';
?>
<title>e-LibeR - I.E.S. - ESCUELA NORMAL SUPERIOR "GENERAL MANUEL BELGRANO"</title>
<?php include 'encabezado.html'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* Estilo para la imagen del título */
    .jumbotron {
      position: relative;
      background-image: url('img/imagen12.jpg'); /* Reemplaza con tu imagen */
      background-size: cover;
      background-position: center;
      color: white; /* Color del texto */
      height: 300px; /* Ajusta la altura según tu preferencia */
    }
    .noticias{
      text-align: center;
      
            color: #6c757d;
    }
    .jumbotron {
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1)), 
              url('img/biblioadmin.webp');
  background-size: cover;
  background-position: center;
  color: white;
  height: 300px;
}
    .fakeimg {
      height: 200px;
      background: #aaa;
    }
    .navbar-nav {
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
    h2, h3 {
      color: #28a745; /* Color del título en verde */
    }
    /* Estilo del footer */
    footer{
      margin-top:28px;
      background-color: #343a40;
      color: white;
      padding: 10px;
      text-align: center;
    }
    .container {
            margin-top: 50px;
            background-color: #e8f5e9; /* Color verde claro */
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    /* Cambiar color de la barra de navegación a verde translúcido */
    .navbar-custom {
      background-color: rgba(64, 128, 0, 0.8); /* Verde Bootstrap con 80% de opacidad */
    }
  /* Estilos personalizados para el enlace "¿eres bibliotecario?" */
.nav-link-custom {
  color: white !important; /* Rojo inicial, con prioridad */
  margin-left: 300px;
  transition: color 0.3s ease, transform 0.3s ease; /* Transiciones suaves */
}

.nav-link-custom:hover {
  color: white !important; /* Rojo más intenso al pasar el cursor, con prioridad */
  transform: scale(1.1); /* Aumentar el tamaño del botón */
}
hr{
  border: 0;
  height: 20px;
  background-color: white;
  width: 2px; /*ancho de la inea*/
  margin: 12px 0;
}
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <img src="img/logo.png" alt="Bibliotecario" width="400" height="120">
  <h4 style="margin-top: 20px;"><u>SISTEMA BIBLIOTECARIO ONLINE</u></h4>
</div>


<nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="listar_materiales.php"><strong>Búsqueda</strong></a>
      </li>
   <hr>
      <li class="nav-item">
        <a class="nav-link" href="areas.php">Áreas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-link-custom" href="login.html">¿eres bibliotecario?</a> 
      </li>
    </ul>
  </div>  
</nav>
<!-- Seccion Noticias-->
<br><h3 class="noticias">Seccion Noticias</h3>
<div class="container">
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4">';
                echo '<h3>' . $row["titulo"] . '</h3>';
                echo '<img src="' . $row["imagen"] . '" alt="Noticia" class="img-fluid">';
                echo '<br>';
                echo '<br>';
                echo '<p>' . $row["descripcion"] . '</p>';
               
                echo '</div>';
            }
        } else {
            echo " No hay noticias disponibles.";
        }
        $conn->close();
        ?>
    </div>
</div>
 <!--Pie de pagina con los datos del TSDS-->
 <?php include 'footer.html';?>
</div>

</body>
</html>



