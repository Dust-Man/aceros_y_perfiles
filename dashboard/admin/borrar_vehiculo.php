<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['vehiculo_id'])) {
    $vehiculo_id = $_GET['vehiculo_id'];

    try {
        // Intentar borrar el producto
        $eliminar = $conexion->prepare("DELETE FROM vehiculos WHERE vehiculo_id = :vehiculo_id");
        $eliminar->execute(['vehiculo_id' => $vehiculo_id]);

        header("Location: vehiculos.php?mensaje=vehiculo eliminado correctamente");
        exit;

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Restricción de llave foránea
            $error_mensaje = "No se puede eliminar el producto porque está relacionado con otros registros.";
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
        <h1>Error al eliminar producto</h1>
        <p><?= htmlspecialchars($error_mensaje) ?></p>
        <a href="vehiculos.php">Volver a la lista de vehiculos</a>
    </div>
</body>
</html>
