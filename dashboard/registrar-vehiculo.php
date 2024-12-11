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
    $placa = mysqli_real_escape_string($conexion, $_POST['placa']);
    $marca = mysqli_real_escape_string($conexion, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conexion, $_POST['modelo']);
    $carga = mysqli_real_escape_string($conexion, $_POST['carga']);
    $estado = mysqli_real_escape_string($conexion, $_POST['estado']);
   
    $sql = "INSERT INTO vehiculos (placa, marca, modelo, capacidad_carga, estado) VALUES ('$placa', '$marca', '$modelo','$carga','$estado')";
    if (mysqli_query($conexion, $sql)) {
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
<form action="registrar-vehiculo.php" method="POST" enctype="multipart/form-data">
<h1>Registrar Vehículo</h1>

    <label for="placa">Placa:</label>
    <input type="text" id="placa" name="placa" required>

    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" required>
    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" required>

    <label for="carga">Capacidad de carga:</label>
    <input type="number" id="carga" name="carga" min="0"required>
    <label for="estado">Estado:</label>
    <select name="estado" id="estado">
        <option value="nuevo">nuevo</option>
        <option value="seminuevo">seminuevo</option>
        <option value="mas de 3 años">mas de 3 años</option>
    </select>

    <button type="submit">Guardar</button>
</form>


            </div>
        </div>
    </div>



    
</body>
</html>




