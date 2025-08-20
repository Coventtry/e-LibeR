<?php
require '../conexion/CONECTOR.PHP'; // Conexión PDO a MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Preparar y ejecutar la consulta SQL para eliminar la anotación
        $sql = "DELETE FROM anotaciones WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Anotación eliminada exitosamente.";
        } else {
            echo "Error al eliminar la anotación.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }

    // Redirigir a la página de anotaciones
    header("Location: consultar_nota.php");
    exit();
}
?>
