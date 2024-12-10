<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['vehiculo_id'])) {
    $vehiculo_id = $_GET['vehiculo_id'];

    $consulta = $conexion->prepare("SELECT * FROM vehiculos WHERE vehiculo_id = :vehiculo_id");
    $consulta->bindValue(':vehiculo_id', $vehiculo_id, PDO::PARAM_INT);
    $consulta->execute();
    $vehiculo = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$vehiculo) {
        die("Vehículo no encontrado");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehiculo_id = $_POST['vehiculo_id'];
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $capacidad_carga = $_POST['capacidad_carga'];
    $estado = $_POST['estado'];

    $consulta = $conexion->prepare("UPDATE vehiculos SET placa = :placa, modelo = :modelo, capacidad_carga = :capacidad_carga, estado = :estado WHERE vehiculo_id = :vehiculo_id");
    $consulta->bindValue(':placa', $placa);
    $consulta->bindValue(':modelo', $modelo);
    $consulta->bindValue(':capacidad_carga', $capacidad_carga);
    $consulta->bindValue(':estado', $estado);
    $consulta->bindValue(':vehiculo_id', $vehiculo_id, PDO::PARAM_INT);

    if ($consulta->execute()) {
        header("Location: vehiculos.php");
        exit;
    } else {
        $error = "Error al actualizar el vehículo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
   <div class="main-content">
     <h1>Editar Vehículo</h1>
     <form method="POST">
         <input type="hidden" name="vehiculo_id" value="<?= htmlspecialchars($vehiculo['vehiculo_id']) ?>">
         <label>Placa:</label>
         <input type="text" name="placa" value="<?= htmlspecialchars($vehiculo['placa']) ?>"><br>
         <label>Modelo:</label>
         <input type="text" name="modelo" value="<?= htmlspecialchars($vehiculo['modelo']) ?>"><br>
         <label>Capacidad de Carga:</label>
         <input type="number" name="capacidad_carga" value="<?= htmlspecialchars($vehiculo['capacidad_carga']) ?>"><br>
         <label>Estado:</label>
         <input type="text" name="estado" value="<?= htmlspecialchars($vehiculo['estado']) ?>"><br>
         <button type="submit">Guardar</button>
     </form>
   </div>
</body>
</html>
