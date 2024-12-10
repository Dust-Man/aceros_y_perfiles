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
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
   
    $sql = "INSERT INTO clientes (nombre, telefono, correo, direccion) VALUES ('$nombre', '$telefono', '$correo','$direccion')";
    if (mysqli_query($conexion, $sql)) {
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
<form action="registrar-cliente.php" method="POST" enctype="multipart/form-data">
<h1>Registrar Cliente</h1>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" required>
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" required>

    <button type="submit">Guardar</button>
</form>


            </div>
        </div>
    </div>



    
</body>
</html>




