<?php
require_once '../../php/conexionPDO.php'; // Archivo de conexión PDO

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $cliente_id = $_GET['id'];
    // Obtener datos del cliente
    $consulta = $conexion->prepare("SELECT nombre, telefono, correo, direccion FROM clientes WHERE cliente_id = :cliente_id");
    $consulta->execute(['cliente_id' => $cliente_id]);
    $cliente = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        die("Cliente no encontrado.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    // Actualizar datos del cliente
    $actualizacion = $conexion->prepare("UPDATE clientes SET nombre = :nombre, telefono = :telefono, correo = :correo, direccion = :direccion WHERE cliente_id = :cliente_id");
    $actualizacion->execute([
        'nombre' => $nombre,
        'telefono' => $telefono,
        'correo' => $correo,
        'direccion' => $direccion,
        'cliente_id' => $cliente_id
    ]);

    header("Location: clientes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
   <div class="main-content">
     <h1>Editar Cliente</h1>
     <form method="POST" action="editar_cliente.php">
         <input type="hidden" name="cliente_id" value="<?= htmlspecialchars($cliente_id) ?>">
         <label for="nombre">Nombre:</label>
         <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required><br>
    
         <label for="telefono">Teléfono:</label>
         <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>" required><br>
    
         <label for="correo">Correo:</label>
         <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" required><br>
    
         <label for="direccion">Dirección:</label>
         <input type="text" name="direccion" value="<?= htmlspecialchars($cliente['direccion']) ?>" required><br>
    
         <button type="submit">Guardar Cambios</button>
     </form>
     <a href="clientes.php">Volver</a>
   </div>
</body>
</html>
