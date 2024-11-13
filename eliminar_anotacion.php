<?php
require 'conexion_BD.php'; // Archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Preparar y ejecutar la consulta SQL para eliminar la anotación
    $sql = "DELETE FROM anotaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Anotación eliminada exitosamente.";
    } else {
        echo "Error al eliminar la anotación: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirigir a la página de anotaciones
    header("Location: consultar_nota.php"); // Cambia "resultados_busqueda.php" al nombre del archivo principal
    exit();
}
?>
