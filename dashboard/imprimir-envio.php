<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=close" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=print" />
</head>

<body>
    <?php 
include '../php/conexion.php';
?>
    <?php
include "./autentificacion.php";
$envio_id = $_GET['envio'];

?>
    <!-- Main Content -->
    <div class="imprimir">
        <div class="header-impresiones">
            <div class="contenedor-logo-impresiones">
                <img src="../img/logos/logo.png" alt="logo">
            </div>
            <div>
                <h1>Envío # <?php echo $envio_id ?></h1>
                <p>Aceros y Perfiles Arciniega S.A. de C.V</p>
            </div>
        </div>

        <div>
            <?php
$consulta = "
SELECT 
    envios.envio_id AS envio_id,
    envios.nota_id AS nota_id,
    notas.cliente_id AS cliente_id,
    clientes.nombre AS cliente_nombre,
    envios.vehiculo_id AS vehiculo_id,
    vehiculos.placa AS placa,
    vehiculos.marca AS marca,
    vehiculos.modelo AS modelo,
    envios.hora AS hora,
    envios.fecha_envio AS fecha_envio,
    envios.empleado_id AS empleado_id,
    empleados.nombre AS empleado_nombre,
    envios.ruta AS ruta,
    envios.direccion AS direccion
FROM 
    envios
    JOIN notas 
        ON notas.nota_id = envios.nota_id
    JOIN vehiculos 
        ON envios.vehiculo_id = vehiculos.vehiculo_id
    JOIN empleados 
        ON envios.empleado_id = empleados.empleado_id
    JOIN clientes 
        ON notas.cliente_id = clientes.cliente_id
   WHERE envio_id = '$envio_id';
";

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

$consulta = "
SELECT 
    envios_encabezado.id_envio_detalle AS id_envio_detalle,
    envios_encabezado.nota_id AS nota_id,
    envios_encabezado.envio_id AS envio_id,
    envios_encabezado.producto_id AS producto_id,
    productos.nombre AS nombre,
    productos.precio AS precio,
    productos.clave AS clave,
    envios_encabezado.cantidad AS cantidad
FROM 
    envios_encabezado
    JOIN productos 
        ON envios_encabezado.producto_id = productos.producto_id
    WHERE envio_id = '$envio_id'
";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) 
        echo "<div class='card'>
                <p><b>Producto:</b> {$fila['nombre']}</p>
                <p><b>Cantidad:</b> {$fila['cantidad']}</p>
              </div>";
    
} else {
    echo "<p>No hay productos relacionados con este envio.</p>";
}
?>
            </div>
        </div>
    </div>
    </div>
    <button id="btn-imprimir" class="imprimir-btn" ><span class="material-symbols-outlined">print</span></button>
    <a id="btn-regresar" class="regresar-btn" href="detalle-envio.php?envio=<?php echo $envio_id?>"><span class="material-symbols-outlined">close</span></a>

</body>
<script defer src="./gestionar_envios.js"></script>
<script defer src="./imprimir.js"></script>

</html>