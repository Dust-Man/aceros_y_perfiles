<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
include "./side_bar.php";
include "./autentificacion.php";

?>
   <!-- Main Content -->
   <div class="main-content">
   <h1>Mensajes recibidos</h1>
            <div class="content">
            <?php 
include '../php/conexion.php';
?>
<div class="content">

<?php
$consulta = "SELECT * FROM contacto";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<div class='card'>
                <h3>Mensaje de:</h3>
                <p>{$fila['nombre']}</p>
                <p>Correo: {$fila['email']}</p>
                <p>Teléfono: {$fila['telefono']}</p>
                <a class='btn' href='detalle-mensaje.php?mensaje={$fila['id_contacto']}'>Ver mensaje</a>
              </div>";
    }
} else {
    echo "<p>No hay notas pendientes con productos por enviar.</p>";
}
?>
</div>          
            </div>
        </div>
    </div>
</body>
<script defer src="./gestionar_envios.js"></script>

</html>
