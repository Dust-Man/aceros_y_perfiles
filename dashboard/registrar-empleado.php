<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

include "./side_bar.php";

?>

   <!-- Main Content -->
   <div class="main-content">
            <div class="content">
                
<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $rol = mysqli_real_escape_string($conexion, $_POST['rol']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $rfc = mysqli_real_escape_string($conexion, $_POST['rfc']);
   
    $sql = "INSERT INTO empleados (nombre, rol, telefono, rfc) VALUES ('$nombre', '$rol', '$telefono','$rfc')";
    if (mysqli_query($conexion, $sql)) {
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
<form action="registrar-empleado.php" method="POST" enctype="multipart/form-data">
<h1>Registrar Empleado</h1>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <label for="rol">Rol:</label>
    <select name="rol" id="rol">
        <option value="cajero">Cajero</option>
        <option value="chofer">Chofer</option>
    </select>
    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" required>
    <label for="rfc">RFC:</label>
    <input type="text" id="rfc" name="rfc" required>

    <button type="submit">Guardar</button>
</form>


            </div>
        </div>
    </div>



    
</body>
</html>




