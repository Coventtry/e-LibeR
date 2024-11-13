<?php
session_start(); // Iniciar la sesión al principio del archivo
require 'conexion_BD.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="img/icono.ico" type="image/x-icon">
  <title>e-LibeR - I.E.S. - ESCUELA NORMAL SUPERIOR "GENERAL MANUEL BELGRANO"</title>
  <?php include 'encabezado.html'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0; /* Eliminamos cualquier padding o margen */
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
      margin-bottom: 0; /* Aseguramos que no haya margen */
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

    /* Aseguramos que la barra de navegación siempre esté encima */
    .navbar {
      position: relative;
      z-index: 10;
      margin-bottom: 0; /* Aseguramos que no haya margen debajo */
    }

    .content {
      flex: 1;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 0; /* Eliminamos el espacio adicional */
    }

    .content img {
      max-width: 100%;
      height: auto;
      flex-grow: 1;
    }
    .disabled-link {
  pointer-events: none;
  color: grey;
}

    /* Estilo para el iframe del calendario */
    .calendar-wrapper {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255, 0.7); /* Fondo semitransparente */
      padding: 20px;
      border-radius: 10px;
      z-index: 1; /* Colocamos el calendario por debajo de la barra de navegación */
    }

    iframe {
      border: 0;
      width: 600px;
      height: 400px;
      border-radius: 10px;
    }

    footer {
      background-color: #052442;
      color: white;
      padding: 10px;
      text-align: center;
      margin-top: 0; /* Eliminamos cualquier margen adicional */
    }

    hr {
      border: 0;
      height: 20px;
      background-color: white;
      width: 2px;
      margin: 12px 0;
    }
  </style>
</head>
<body>
<div class="jumbotron text-center" style="margin-bottom:0">
  <img src="img/logo.png" alt="Bibliotecario" width="400" height="120">
  <h4 style="margin-top: 20px;"><u>ADMINISTRACION DE BIBLIOTECA</u></h4>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <img src="img/login.png" alt="Bibliotecario" width="60" height="60">
    <h6 style="display:inline; margin-left:23px; color:white"> <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado'; ?></h6>
    <ul class="navbar-nav">
      <!--
      <li class="nav-item">
        <a class="nav-link" href="listamateriales.html">Busqueda</a>
      </li>
  -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Administrar Socio
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="socio.html">Buscar Socio</a>
          <a class="dropdown-item" href="agregarsocio.html">Agregar Nuevo Socio</a>
          <a class="dropdown-item" href="modificar_socio.php">Modificar Información de Socio</a>
          <a class="dropdown-item" href="baja_socio.php">Dar de Baja a un Socio</a>
        </div>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Administrar Materiales
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="buscar_material.php">Buscar Material</a>
          <a class="dropdown-item" href="agregar_material.php">Agregar Nuevo Material</a>
          <a class="dropdown-item" href="modificar_material.php">Modificar Información del Material</a>
          <a class="dropdown-item" href="eliminar_material.php">Dar de Baja a Material</a>
        </div>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Administrar Áreas
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item"  href="cargar_area.php">Cargar Áreas</a>
          <a class="dropdown-item" href="modificar_area.php">Modificar Áreas</a>
          <a class="dropdown-item" href="eliminar_area.php">Dar de Baja Áreas</a>
        </div>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Avisador
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item"  href="noticia.php">Cargar Aviso</a>
          <a class="dropdown-item" href="avisador.php">Modificar/eliminar Aviso</a>
        </div>
  </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
         Administar Prestamos
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item"  href="prestamo.php">Generar Prestamo</a>
          <!--<a href="#" aria-disabled="true" class="disabled-link">Prestamos/Notificación</a>-->
          <a class="dropdown-item" href="devolver_prestamo.php" >Devolver Prestamo</a>
        </div>
      </li>
      <hr>
      <li class="nav-item">
        <a class="nav-link" href="carga_material.php">Imprimir Codigo</a>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" style="color:green" href="#" id="navbardrop" data-toggle="dropdown">
       Anotaciones
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item"  href="crear_nota.php">Crear Nota</a>
          <a class="dropdown-item" href="consultar_nota.php">Consultar notas</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:red; margin-left:250px" href="logout.php">Cerrar Sesión</a>
      </li>
    </ul>
  </div>
</nav>
</div>
<div class="content">
  <!-- Imagen de fondo -->
  <img src="img/imagen13.jpg" alt="Imagen de fondo">
  <!-- Calendario sobre la imagen -->
  <div class="calendar-wrapper">
    <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=America%2FNew_York" 
    frameborder="0" scrolling="no"></iframe>
  </div>
</div>
<footer>
  <?php include 'footer.html'; ?>
</footer>

</body>
</html>