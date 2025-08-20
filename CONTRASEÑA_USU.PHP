    <link rel="icon" href="assets/img/icono.ico" type="image/x-icon">
<?php
session_start();
try {
    // Conectar a la base de datos MySQL con PDO
    $host = 'localhost';
    $dbname = 'biblioteca';
    $username = 'root';
    $password = '';

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_SESSION['usuario'];
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Validaciones
    if (strlen($nueva_contrasena) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres";
    } elseif (!preg_match('/[A-Z]/', $nueva_contrasena)) {
        $error = "La contraseña debe contener al menos una letra mayúscula";
    } elseif (!preg_match('/[0-9]/', $nueva_contrasena)) {
        $error = "La contraseña debe contener al menos un número";
    } elseif (!preg_match('/[^A-Za-z0-9]/', $nueva_contrasena)) {
        $error = "La contraseña debe contener al menos un carácter especial";
    } elseif ($nueva_contrasena !== $confirmar_contrasena) {
        $error = "Las nuevas contraseñas no coinciden";
    } else {
        // Verificar contraseña actual
        $sql = "SELECT password FROM bibliotecarios WHERE usuario = :usuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila && password_verify($contrasena_actual, $fila['password'])) {
            // Actualizar la contraseña
            $hash_nueva = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
            $sql_update = "UPDATE bibliotecarios SET password = :password WHERE usuario = :usuario";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':password', $hash_nueva);
            $stmt_update->bindParam(':usuario', $usuario);

            if ($stmt_update->execute()) {
                $mensaje = "Contraseña cambiada exitosamente";
            } else {
                $error = "Error al actualizar la contraseña";
            }
        } else {
            $error = "La contraseña actual es incorrecta";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .contenedor {
            max-width: 500px;
            margin: 100px auto 50px auto; /* 100px arriba, 50px abajo, centrado horizontal */
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .titulo {
            color: #052442;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-primary {
            background-color: #052442;
            border-color: #052442;
        }
        .requisitos-contrasena {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
        .requisito-cumplido {
            color: #28a745;
        }
        .requisito-no-cumplido {
            color: #dc3545;
        }
        #fortaleza-contrasena {
            height: 5px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .progress-bar {
            transition: width 0.5s ease;
        }
    </style>
</head>
<body>
    <div class="contenedor">
   <form method="POST" id="formCambioContrasena">
    <!-- Contraseña Actual -->
    <div class="mb-3">
        <label for="contrasena_actual" class="form-label">Contraseña Actual</label>
        <input type="password" class="form-control" id="contrasena_actual" name="contrasena_actual" required>
    </div>
    
    <!-- Nueva Contraseña -->
    <div class="mb-3">
        <label for="nueva_contrasena" class="form-label">Nueva Contraseña</label>
        <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena" required 
               oninput="validarFortalezaContrasena()">
        
        <!-- Barra de Progreso -->
        <div id="fortaleza-contrasena" class="progress">
            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
        </div>
        
        <!-- Requisitos de Contraseña -->
        <div class="requisitos-contrasena">
            <p id="longitud" class="requisito-no-cumplido" data-texto="Mínimo 8 caracteres">
                <i class="bi bi-x-circle"></i> Mínimo 8 caracteres
            </p>
            <p id="mayuscula" class="requisito-no-cumplido" data-texto="Al menos una mayúscula">
                <i class="bi bi-x-circle"></i> Al menos una mayúscula
            </p>
            <p id="numero" class="requisito-no-cumplido" data-texto="Al menos un número">
                <i class="bi bi-x-circle"></i> Al menos un número
            </p>
            <p id="especial" class="requisito-no-cumplido" data-texto="Al menos un carácter especial">
                <i class="bi bi-x-circle"></i> Al menos un carácter especial
            </p>
        </div>
    </div>
    
    <!-- Confirmar Nueva Contraseña -->
    <div class="mb-3">
        <label for="confirmar_contrasena" class="form-label">Confirmar Nueva Contraseña</label>
        <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required
               oninput="verificarCoincidencia()">
        <small id="mensaje-coincidencia" class="text-muted"></small>
    </div>
    
    <!-- Botones -->
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary" id="btnSubmit">Cambiar Contraseña</button>
        <a href="ingreso_bibliotecario_1.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* =====================================================
   VALIDACIÓN DE FORTALEZA DE CONTRASEÑA
===================================================== */
function validarFortalezaContrasena() {
    const contrasena = document.getElementById('nueva_contrasena').value;

    // Requisitos de la contraseña
    const requisitos = [
        {id: 'longitud', cumple: contrasena.length >= 8},
        {id: 'mayuscula', cumple: /[A-Z]/.test(contrasena)},
        {id: 'numero', cumple: /[0-9]/.test(contrasena)},
        {id: 'especial', cumple: /[^A-Za-z0-9]/.test(contrasena)}
    ];

    // Actualizar visualización de requisitos
    requisitos.forEach(r => actualizarRequisito(document.getElementById(r.id), r.cumple));

    // Calcular fortaleza de la contraseña (0-100)
    const fortaleza = requisitos.filter(r => r.cumple).length * 25;

    // Actualizar barra de progreso
    const barraProgreso = document.querySelector('.progress-bar');
    barraProgreso.style.width = fortaleza + '%';

    // Cambiar color según fortaleza
    barraProgreso.className = 'progress-bar ' + (
        fortaleza < 50 ? 'bg-danger' :
        fortaleza < 75 ? 'bg-warning' :
        'bg-success'
    );

    // Verificar coincidencia con confirmación
    verificarCoincidencia();
}

/* =====================================================
   ACTUALIZAR REQUISITOS VISUALMENTE
===================================================== */
function actualizarRequisito(elemento, cumple) {
    const textoOriginal = elemento.getAttribute('data-texto');
    if (cumple) {
        elemento.className = 'requisito-cumplido';
        elemento.innerHTML = '<i class="bi bi-check-circle"></i> ' + textoOriginal;
    } else {
        elemento.className = 'requisito-no-cumplido';
        elemento.innerHTML = '<i class="bi bi-x-circle"></i> ' + textoOriginal;
    }
}

/* =====================================================
   VERIFICAR COINCIDENCIA DE CONTRASEÑAS
===================================================== */
function verificarCoincidencia() {
    const contrasena = document.getElementById('nueva_contrasena').value;
    const confirmacion = document.getElementById('confirmar_contrasena').value;
    const mensaje = document.getElementById('mensaje-coincidencia');

    if (confirmacion === '') {
        mensaje.textContent = '';
        mensaje.className = 'text-muted';
    } else if (contrasena === confirmacion) {
        mensaje.textContent = 'Las contraseñas coinciden';
        mensaje.className = 'text-success';
    } else {
        mensaje.textContent = 'Las contraseñas no coinciden';
        mensaje.className = 'text-danger';
    }

    // Habilitar/deshabilitar botón de envío
    document.getElementById('btnSubmit').disabled = 
        document.querySelectorAll('.requisito-no-cumplido').length > 0 || 
        contrasena !== confirmacion;
}

/* =====================================================
   INICIALIZACIÓN AL CARGAR LA PÁGINA
===================================================== */
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnSubmit').disabled = true;
});
</script>
</div>
<footer>
  <?php include 'componentes/footer1.html'; ?>
</footer>
</body>
</html>