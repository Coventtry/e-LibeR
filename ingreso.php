<?php
require_once './conexion/CONECTOR.PHP';

// Consultar las noticias con PDO (SQLite)
$sql = "SELECT titulo, descripcion, imagen FROM noticias ORDER BY id DESC";
$stmt = $conn->query($sql);
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include 'icono.php'; ?>
<title>e-LibeR - I.E.S. - ESCUELA NORMAL SUPERIOR "GENERAL MANUEL BELGRANO"</title>
<?php include './componentes/encabezado.html'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    
    .jumbotron {
      position: relative;
      background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1)), 
                  url('img/biblioadmin.webp');
      background-size: cover;
      background-position: center;
      color: white;
      height: 300px;
    }
    .noticias {
      text-align: center;
      color: #6c757d;
    }
    .navbar-nav {
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
    h2, h3 {
      color: #28a745;
    }
    footer {
      margin-top:28px;
      background-color: #343a40;
      color: white;
      padding: 10px;
      text-align: center;
    }
    .container {
      margin-top: 50px;
      background-color: #e8f5e9;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .navbar-custom {
      background-color: rgba(64, 128, 0, 0.8);
    }
    .nav-link-custom {
      color: white !important;
      margin-left: 300px;
      transition: color 0.3s ease, transform 0.3s ease;
    }
    .nav-link-custom:hover {
      color: white !important;
      transform: scale(1.1);
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
  <h4 style="margin-top: 20px;"><u>SISTEMA BIBLIOTECARIO ONLINE</u></h4>
</div>

<nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../e-LibeR/materiales/listar_materiales.php"><strong>Búsqueda</strong></a>
      </li>
      <hr>
      <li class="nav-item">
        <a class="nav-link" href="../e-LibeR/areas/areas.php">Áreas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-link-custom" href="login.html">¿Eres Bibliotecario?</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Seccion Noticias -->
<br><h3 class="noticias">Sección Noticias</h3>
<div class="container">
  <div class="row">
    <?php
    if (count($noticias) > 0) {
        foreach ($noticias as $row) {
            $imagenPath = basename($row["imagen"]); // ej: 'foto.jpg'
            $rutaWeb = "/e-LibeR/img/" . $imagenPath;
            ?>
            <div class="col-md-4 mb-4">
              <div class="news-container">
                <h3 class="news-title"><?= htmlspecialchars($row["titulo"]) ?></h3>
                <img src="<?= htmlspecialchars($rutaWeb) ?>" alt="Noticia" class="img-fluid mb-3 rounded">
                <p class="news-description"><?= htmlspecialchars($row["descripcion"]) ?></p>
              </div>
            </div>
            <?php
        }
    } else {
        echo "<p class='text-center'>No hay noticias disponibles.</p>";
    }

    // Cerrar conexión
    $conn = null;
    ?>
  </div>
</div>
<!-- Pie de página -->
 <?php include 'componentes/footer1.html'; ?>
</body>
</html>
