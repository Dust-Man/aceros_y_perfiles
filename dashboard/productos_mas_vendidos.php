<?php
header('Content-Type: application/json');
include '../php/conexion.php';

$query_productos = "SELECT productos.nombre, SUM(encabezado.cantidad) AS cantidad
                    FROM productos
                    JOIN encabezado ON productos.producto_id = encabezado.producto_id
                    GROUP BY productos.nombre
                    ORDER BY cantidad DESC
                    LIMIT 10;";

$result_productos = $conexion->query($query_productos);
$data_productos = [];

if ($result_productos && $result_productos->num_rows > 0) {
    while ($row = $result_productos->fetch_assoc()) {
        $data_productos[] = [
            'nombre' => $row['nombre'],
            'cantidad' => (int)$row['cantidad']
        ];
    }
}

echo json_encode($data_productos);
?>
