<?php
include("conectatew.php");

// VALIDACIÓN 1: VERIFICAR CAMPOS COMPLETOS
if (empty($_POST['prestamo_id']) || empty($_POST['material_id']) || empty($_POST['cantidad_prestada'])) {
    echo '<div class="alert alert-danger text-center">⚠ Debe completar todos los campos requeridos.</div>';
    exit;
}

$prestamo_id = $_POST['prestamo_id'];
$material_id = $_POST['material_id'];
$cantidad_prestada = $_POST['cantidad_prestada'];

// VALIDACIÓN 2: EVITAR PRÉSTAMO DUPLICADO
$sqlCheck = "SELECT * FROM prestamos_detalle 
             WHERE prestamo_id = ? AND material_id = ? AND cantidad_devuelta < cantidad_prestada";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $prestamo_id, $material_id);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo '<div class="alert alert-warning text-center">⚠ Ya existe un préstamo activo para este material.</div>';
    exit;
}

// VALIDACIÓN 3: VERIFICAR DISPONIBILIDAD DE MATERIAL
$sqlMaterial = "SELECT disponibilidad FROM materiales WHERE id = ?";
$stmtMaterial = $conn->prepare($sqlMaterial);
$stmtMaterial->bind_param("i", $material_id);
$stmtMaterial->execute();
$resultMaterial = $stmtMaterial->get_result();
$rowMaterial = $resultMaterial->fetch_assoc();

if ($rowMaterial['disponibilidad'] < $cantidad_prestada) {
    echo '<div class="alert alert-danger text-center">❌ No hay suficiente stock disponible para prestar.</div>';
    exit;
}

// INSERTAR EL DETALLE DEL PRÉSTAMO
$sqlInsert = "INSERT INTO prestamos_detalle (prestamo_id, material_id, cantidad_prestada, cantidad_devuelta)
              VALUES (?, ?, ?, 0)";
$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("iii", $prestamo_id, $material_id, $cantidad_prestada);
$stmtInsert->execute();

// ACTUALIZAR STOCK DE MATERIAL
$sqlUpdate = "UPDATE materiales SET disponibilidad = disponibilidad - ? WHERE id = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("ii", $cantidad_prestada, $material_id);
$stmtUpdate->execute();

echo '<div class="alert alert-success text-center">✅ Préstamo registrado exitosamente.</div>';
?>
