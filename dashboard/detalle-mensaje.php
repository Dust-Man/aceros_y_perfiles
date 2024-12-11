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
$mensaje = $_GET['mensaje'];

?>
    <!-- Main Content -->
    <div class="main-content">
        <div>
        <?php
$consulta = "SELECT * FROM contacto WHERE id_contacto = '$mensaje' ";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
        echo "<div class='card --envio'>
                <h1>Mensaje de:
                {$fila['nombre']}</h1>
                <p><b>Correo:</b> {$fila['email']}</p>
                <p><b>Teléfono:</b> {$fila['telefono']}</p><p><b>Mensaje:</b></p><p>";
        echo htmlspecialchars($fila['mensaje']);
        echo"</p></div>";
    
} else {
    echo "<p>No se ecnontro el detalle del envio.</p>";
}
?>
        <a href="mensajes.php">Regresar a mensajes</a>
        </div>
       
</body>
<script defer src="./gestionar_envios.js"></script>

</html>