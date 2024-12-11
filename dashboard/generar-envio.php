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
            <div class="content">
            <?php 
include '../php/conexion.php';
?>
<div class="content">
<?php
$consulta = "
    SELECT notas.*, clientes.nombre AS nombre_cliente 
    FROM notas
    INNER JOIN clientes ON notas.cliente_id = clientes.cliente_id
    WHERE EXISTS (
        SELECT 1 
        FROM prod_por_enviar 
        WHERE prod_por_enviar.id_nota = notas.nota_id 
        AND prod_por_enviar.por_enviar != 0
    )";

$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<div class='card' data-nota-id='{$fila['nota_id']}'>
                <h3>Nota: {$fila['nota_id']}</h3>
                <p>Generada: {$fila['fecha']}</p>
                <p>Para: {$fila['nombre_cliente']}</p>
                <button class='cargarFormulario' data-nota-id='{$fila['nota_id']}'>Gestionar Envío</button>
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
