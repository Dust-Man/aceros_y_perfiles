<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['producto_id'])) {
    $producto_id = $_GET['producto_id'];

    try {
        // Intentar borrar el producto
        $eliminar = $conexion->prepare("DELETE FROM productos_mostrar WHERE producto_id = :producto_id");
        $eliminar->execute(['producto_id' => $producto_id]);

        header("Location: catalogo.php?mensaje=Producto eliminado correctamente");
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
        <a href="catalogo.php">Volver a la lista de productos</a>
    </div>
</body>
</html>
