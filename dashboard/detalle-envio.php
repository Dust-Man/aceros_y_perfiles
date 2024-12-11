<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=print" />
</head>

<body>
<?php 
include '../php/conexion.php';
?>
    <?php
include "./side_bar.php";
include "./autentificacion.php";
$envio_id = $_GET['envio'];

?>
    <!-- Main Content -->
    <div class="main-content">
        <h1>Envío # <?php echo $envio_id ?></h1>
        <div>
        <?php
$consulta = "SELECT * FROM envio_completo WHERE envio_id = '$envio_id' ";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
        echo "<div class='card --envio'>
                <p><b>Nota  #{$fila['nota_id']} </b></p>
                <p><b>Fecha:</b> {$fila['fecha_envio']}</p>
                <p><b>Para:</b> {$fila['cliente_nombre']}</p>
                <p><b>Hora: </b>{$fila['hora']} </p>
                <p><b>Vehículo: </b>{$fila['marca']} {$fila['modelo']} {$fila['placa']} </p>
                <p><b>Chofer: </b>{$fila['empleado_nombre']} </p>
              </div>";
    
} else {
    echo "<p>No se ecnontro el detalle del envio.</p>";
}
?>
        </div>
        <h2>Productos a enviar</h2>
        <div class="content">

            <div class="content">

                <?php

$consulta = "SELECT * FROM productos_en_envios_encabezado WHERE envio_id = '$envio_id' ";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) 
        echo "<div class='card'>
                <p>Producto: {$fila['nombre']}</p>
                <p>Cantidad: {$fila['cantidad']}</p>
              </div>";
    
} else {
    echo "<p>No hay productos relacionados con este envio.</p>";
}
?>
            </div>
        </div>
    </div>
    </div>
    <a class="imprimir-btn" href="imprimir-envio.php?envio=<?php echo $envio_id?>"><span class="material-symbols-outlined">print</span></a>
</body>
<script defer src="./gestionar_envios.js"></script>

</html>