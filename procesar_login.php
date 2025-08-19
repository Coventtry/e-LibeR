<?php
session_start();

// Validar token CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Token de seguridad inválido";
    header("Location: login.php");
    exit();
}

// Sanitizar entradas
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';
$clave_unica = htmlspecialchars($_POST['clave_unica'] ?? '');

// Validaciones básicas
if (empty($email) || empty($password) || empty($clave_unica)) {
    $_SESSION['error'] = "Todos los campos son obligatorios";
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos (usar PDO)
require 'conexion_BD.php';

try {
    // Buscar usuario en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND clave_unica = ?");
    $stmt->execute([$email, $clave_unica]);
    $usuario = $stmt->fetch();
    
    // Verificar credenciales
    if (!$usuario || !password_verify($password, $usuario['password'])) {
        $_SESSION['error'] = "Credenciales inválidas";
        header("Location: login.php");
        exit();
    }
    
    // Autenticación exitosa
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nombre' => $usuario['nombre'],
        'email' => $usuario['email'],
        'rol' => $usuario['rol']
    ];
    
    // Redirigir al dashboard
    header("Location: dashboard.php");
    exit();
    
} catch (PDOException $e) {
    $_SESSION['error'] = "Error en el sistema: " . $e->getMessage();
    header("Location: login.php");
    exit();
}