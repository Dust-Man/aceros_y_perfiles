<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['envio_id'])) {
    $envio_id = $_GET['envio_id'];

    $consulta = $conexion->prepare("SELECT * FROM envios WHERE envio_id = :envio_id");
    $consulta->bindValue(':envio_id', $envio_id, PDO::PARAM_INT);
    $consulta->execute();
    $envio = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$envio) {
        die("Envío no encontrado.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $envio_id = $_POST['envio_id'];
    $nota_id = $_POST['nota_id'];
    $vehiculo_id = $_POST['vehiculo_id'];
    $hora = $_POST['hora'];
    $fecha_envio = $_POST['fecha_envio'];
    $empleado_id = $_POST['empleado_id'];
    $ruta = $_POST['ruta'];
    $direccion = $_POST['direccion'];

    $consulta = $conexion->prepare("
        UPDATE envios 
        SET nota_id = :nota_id, vehiculo_id = :vehiculo_id, hora = :hora, fecha_envio = :fecha_envio,
            empleado_id = :empleado_id, ruta = :ruta, direccion = :direccion 
        WHERE envio_id = :envio_id
    ");
    $consulta->bindValue(':nota_id', $nota_id);
    $consulta->bindValue(':vehiculo_id', $vehiculo_id);
    $consulta->bindValue(':hora', $hora);
    $consulta->bindValue(':fecha_envio', $fecha_envio);
    $consulta->bindValue(':empleado_id', $empleado_id);
    $consulta->bindValue(':ruta', $ruta);
    $consulta->bindValue(':direccion', $direccion);
    $consulta->bindValue(':envio_id', $envio_id, PDO::PARAM_INT);

    if ($consulta->execute()) {
        header("Location: envios.php");
        exit;
    } else {
        $error = "Error al actualizar el envío.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Envío</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
    <div class="main-content">
        <h1>Editar Envío</h1>
        <form method="POST">
            <input type="hidden" name="envio_id" value="<?= htmlspecialchars($envio['envio_id']) ?>">
            <label>Nota ID:</label>
            <input type="text" name="nota_id" value="<?= htmlspecialchars($envio['nota_id']) ?>"><br>
            <label>Vehículo ID:</label>
            <input type="text" name="vehiculo_id" value="<?= htmlspecialchars($envio['vehiculo_id']) ?>"><br>
            <label>Hora:</label>
            <input type="time" name="hora" value="<?= htmlspecialchars($envio['hora']) ?>"><br>
            <label>Fecha de Envío:</label>
            <input type="date" name="fecha_envio" value="<?= htmlspecialchars($envio['fecha_envio']) ?>"><br>
            <label>Empleado ID:</label>
            <input type="text" name="empleado_id" value="<?= htmlspecialchars($envio['empleado_id']) ?>"><br>
            <label>Ruta:</label>
            <input type="text" name="ruta" value="<?= htmlspecialchars($envio['ruta']) ?>"><br>
            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?= htmlspecialchars($envio['direccion']) ?>"><br>
            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
