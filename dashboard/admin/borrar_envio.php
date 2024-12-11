<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['envio_id'])) {
    $envio_id = $_GET['envio_id'];

    try {
        // Intentar borrar el producto
        $eliminar = $conexion->prepare("DELETE FROM envios WHERE envio_id = :envio_id");
        $eliminar->execute(['envio_id' => $envio_id]);

        header("Location: empleados.php?mensaje=Producto eliminado correctamente");
        exit;

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Restricción de llave foránea
            $error_mensaje = "No se puede eliminar el envio porque está relacionado con otros registros.";
        } else {
            $error_mensaje = "Ocurrió un error inesperado: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al eliminar</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
    <div class="main-content">
        <h1>Error al eliminar envio</h1>
        <p><?= htmlspecialchars($error_mensaje) ?></p>
        <a href="envios.php">Volver a la lista de envio</a>
    </div>
</body>
</html>
