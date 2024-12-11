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
// include "./autentificacion.php";

?>
   <!-- Main Content -->
   <div class="main-content">
   <h1>Envíos Próximos</h1>
            <div class="content">
            <?php 
include '../php/conexion.php';
?>
<div class="content">

<?php
$consulta = "SELECT * FROM envio_completo WHERE fecha_envio >= CURDATE() ";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<div class='card'>
                <h3>Envío #{$fila['envio_id']}</h3>
                <p>Nota  #{$fila['nota_id']}</p>
                <p>Fecha: {$fila['fecha_envio']}</p>
                <p>Para: {$fila['cliente_nombre']}</p>
                <a class='btn' href='detalle-envio.php?envio={$fila['envio_id']}'>Ver detalles del envío</a>
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
