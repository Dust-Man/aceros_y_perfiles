<?php
// Conexión a la base de datos
include('../php/conexion.php');

// Consulta para obtener los mejores choferes
$consulta = "SELECT 
                empleado.empleado_id, 
                empleado.nombre, 
                COUNT(envio.envio_id) AS total_envios
             FROM 
                envios AS envio
             JOIN 
                empleados AS empleado ON envio.empleado_id = empleado.empleado_id
             WHERE 
                empleado.rol = 'chofer' 
             GROUP BY 
                envio.empleado_id
             ORDER BY 
                total_envios DESC
             LIMIT 5";

$resultado = mysqli_query($conexion, $consulta);

$mejores_choferes = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $mejores_choferes[] = $fila;
}

// Retornar los resultados como JSON
echo json_encode($mejores_choferes);
?>
