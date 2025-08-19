<?php
session_start();
require 'conexion/conexion_BD.php';

// Redirigir al login si no hay sesión activa
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="icon" href="assets/img/icono.ico" type="image/x-icon">
  <title>e-LibeR - I.E.S. - ESCUELA NORMAL SUPERIOR "GENERAL MANUEL BELGRANO"</title>
  <?php include 'componentes/encabezado.html'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
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
      margin-bottom: 0;
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

    .navbar {
      position: relative;
      z-index: 10;
      margin-bottom: 0;
    }

    .content {
      flex: 1;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 0;
    }

    .content img {
      max-width: 100%;
      height: auto;
      flex-grow: 1;
    }

    .calendar-wrapper {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255, 0.7);
      padding: 20px;
      border-radius: 10px;
      z-index: 1;
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
      margin-top: 0;
    }

    hr {
      border: 0;
      height: 20px;
      background-color: white;
      width: 2px;
      margin: 12px 0;
    }

    .disabled-link {
      pointer-events: none;
      color: grey;
    }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <img src="assets/img/logo.png" alt="Bibliotecario" width="400" height="120">
  <h4 style="margin-top: 20px;"><u>ADMINISTRACION DE BIBLIOTECA</u></h4>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <img src="assets/img/login.png" alt="Bibliotecario" width="60" height="60">
    
    <!-- Menú desplegable del usuario -->
    <div class="user-menu">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display:inline; color:white;">
        <?php echo $_SESSION['usuario']; ?>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="CONTRASEÑA_USU.php"><i class="bi bi-key"></i> Cambiar contraseña</a>
        <a class="dropdown-item" href="MODIF_USU.php"><i class="bi bi-person-lines-fill"></i> Modificar datos</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php" style="color:red;"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
      </div>
    </div>
    
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="bi bi-people"></i> Socios</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="SOCIOS/agregarsocio.html"><i class="bi bi-person-plus"></i> Nuevo Socio</a>
          <a class="dropdown-item" href="socios/modificar_socio.php"><i class="bi bi-pencil-square"></i> Modificar Información</a>
          <a class="dropdown-item" href="socios/baja_socio.php"><i class="bi bi-trash"></i> Dar de Baja</a>
        </div>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="bi bi-journals"></i> Materiales</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="materiales/agregar_material.php"><i class="bi bi-journal-plus"></i> Nuevo Material</a>
          <a class="dropdown-item" href="materiales/unificado.php"><i class="bi bi-pencil-square"></i> Buscar / Modificar</a>
          <!--<a class="dropdown-item" href="materiales/LISTA_MATERIALES.php">LISTA DE MATERIALES</a>
          <a class="dropdown-item" href="materiales/CONTEMOS.php">3</a>-->
          <a class="dropdown-item" href="materiales/eliminar_material.php"><i class="bi bi-trash"></i> Dar de Baja</a>
          
        </div>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="bi bi-diagram-3"></i> Áreas</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="areas/cargar_area.php"><i class="bi bi-plus-square"></i> Nueva Área</a>
          <a class="dropdown-item" href="areas/modificar_area.php"><i class="bi bi-pencil-square"></i> Modificar</a>
          <a class="dropdown-item" href="areas/eliminar_area.php"><i class="bi bi-trash"></i> Dar de Baja</a>
        </div>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="bi bi-megaphone-fill"></i> Avisador</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="avisador/noticia.php"><i class="bi bi-plus-square"></i> Nuevo Aviso</a>
          <a class="dropdown-item" href="avisador/avisador.php"><i class="bi bi-pencil-square"></i> Modificar/eliminar</a>
        </div>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="bi bi-arrow-left-right"></i> Préstamos</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="prestamos/prestamo.php"><i class="bi bi-plus-square"></i> Nuevo Préstamo</a>
          <a class="dropdown-item" href="prestamos/Devolvamos_juntos.php"><i class="bi bi-arrow-return-left"></i> Listado/Devolución</a>
        </div>
      </li>
      <hr>
      <li class="nav-item">
        <a class="nav-link" href="materiales/carga_material.php"><i class="bi bi-printer"></i> Imprimir Código</a>
      </li>
      <hr>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" style="color:green" href="#" data-toggle="dropdown">Notas</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="notas/crear_nota.php"><i class="bi bi-file-earmark-plus"></i> Crear Nota</a>
          <a class="dropdown-item" href="notas/consultar_nota.php"><i class="bi bi-list-ul"></i> Consultar notas</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="content">
  <img src="assets/img/imagen13.jpg" alt="Imagen de fondo">
  <div class="calendar-wrapper">
    <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=America%2FNew_York" frameborder="0" scrolling="no"></iframe>
  </div>
</div>

<?php require 'componentes/ALERTA_PRESTAMO.PHP'; ?>

<footer>
  <?php include 'componentes/footer1.html'; ?>
</footer>

</body>
</html>