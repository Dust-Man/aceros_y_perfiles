<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['empleado_id'])) {
    $empleado_id = $_GET['empleado_id'];

    $consulta = $conexion->prepare("SELECT * FROM empleados WHERE empleado_id = :empleado_id");
    $consulta->bindValue(':empleado_id', $empleado_id, PDO::PARAM_INT);
    $consulta->execute();
    $empleado = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$empleado) {
        die("Empleado no encontrado");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleado_id = $_POST['empleado_id'];
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];
    $telefono = $_POST['telefono'];
    $rfc = $_POST['rfc'];

    $consulta = $conexion->prepare("UPDATE empleados SET nombre = :nombre, rol = :rol, telefono = :telefono, rfc = :rfc WHERE empleado_id = :empleado_id");
    $consulta->bindValue(':nombre', $nombre);
    $consulta->bindValue(':rol', $rol);
    $consulta->bindValue(':telefono', $telefono);
    $consulta->bindValue(':rfc', $rfc);
    $consulta->bindValue(':empleado_id', $empleado_id, PDO::PARAM_INT);

    if ($consulta->execute()) {
        header("Location: empleados.php");
        exit;
    } else {
        $error = "Error al actualizar el empleado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
 <div class="main-content">
       <h1>Editar Empleado</h1>
       <form method="POST">
           <input type="hidden" name="empleado_id" value="<?= htmlspecialchars($empleado['empleado_id']) ?>">
           <label>Nombre:</label>
           <input type="text" name="nombre" value="<?= htmlspecialchars($empleado['nombre']) ?>"><br>
           <label>Rol:</label>
           <select name="rol">
               <option value="cajero" <?= $empleado['rol'] == 'cajero' ? 'selected' : '' ?>>Cajero</option>
               <option value="chofer" <?= $empleado['rol'] == 'chofer' ? 'selected' : '' ?>>Chofer</option>
           </select><br>
           <label>Teléfono:</label>
           <input type="text" name="telefono" value="<?= htmlspecialchars($empleado['telefono']) ?>"><br>
           <label>RFC:</label>
           <input type="text" name="rfc" value="<?= htmlspecialchars($empleado['rfc']) ?>"><br>
           <button type="submit">Guardar</button>
       </form>
 </div>
</body>
</html>
