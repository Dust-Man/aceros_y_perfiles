<?php
require_once '../../php/conexionPDO.php'; // Archivo de conexión PDO

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $cliente_id = $_GET['id'];

    try {
        // Intentar borrar el cliente
        $eliminar = $conexion->prepare("DELETE FROM clientes WHERE cliente_id = :cliente_id");
        $eliminar->execute(['cliente_id' => $cliente_id]);

        header("Location: clientes.php?mensaje=Cliente eliminado correctamente");
        exit;

    } catch (PDOException $e) {
        // Verificar si el error es debido a una restricción de llave foránea
        if ($e->getCode() == 23000) { // Código 23000 corresponde a restricción de llave foránea
            $error_mensaje = "No se puede eliminar el cliente porque está relacionado con otros registros.";
        } else {
            $error_mensaje = "Ocurrió un error inesperado: " . $e->getMessage();
        }
    }
} else {
    die("Solicitud no válida.");
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
        <h1>Error al eliminar cliente</h1>
        <p><?= htmlspecialchars($error_mensaje) ?></p>
        <a href="clientes.php">Volver a la lista de clientes</a>
    </div>
</body>
</html>
