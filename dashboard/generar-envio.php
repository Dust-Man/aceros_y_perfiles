<?php 
include '../php/conexion.php';
?>
<div class="content">
<?php
$consulta = "SELECT * FROM notas";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $id_cliente = $fila['cliente_id'];
        $consulta_cliente = "SELECT nombre FROM clientes WHERE cliente_id = '$id_cliente'";
        $resultado_cliente = mysqli_query($conexion, $consulta_cliente);
        $fila_cliente = mysqli_fetch_assoc($resultado_cliente);
        $nombre_cliente = $fila_cliente['nombre'];

        echo "<div class='card' data-nota-id='{$fila['nota_id']}'>
                <h3>Nota: {$fila['nota_id']}</h3>
                <p>Generada: {$fila['fecha']}</p>
                <p>Para: {$nombre_cliente}</p>
                <button class='cargarFormulario' data-nota-id='{$fila['nota_id']}'>Gestionar Envío</button>
              </div>";
    }
}
?>
</div>
