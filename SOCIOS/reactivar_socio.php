<?php
$db = new PDO("sqlite:biblioteca2.db");
$id_socio = $_POST['id_socio'];

// Insertar acción de alta en historial
$stmt = $db->prepare("INSERT INTO historial_socios (id_socio, accion, observaciones) VALUES (?, 'ALTA', 'Reactivado desde el historial')");
$stmt->execute([$id_socio]);

header("Location: registro_socios.php");
exit;
