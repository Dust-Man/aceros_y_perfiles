<?php
header('Content-Type: application/json');
include '../php/conexion.php';

$query_meses = "SELECT MONTHNAME(fecha) AS mes, SUM(total) AS total
                FROM notas
                WHERE YEAR(fecha) = YEAR(CURDATE())
                GROUP BY mes
                ORDER BY MONTH(fecha);";

$result_meses = $conexion->query($query_meses);
$data_meses = [
    'labels' => [],
    'values' => []
];

if ($result_meses && $result_meses->num_rows > 0) {
    while ($row = $result_meses->fetch_assoc()) {
        $data_meses['labels'][] = $row['mes'];
        $data_meses['values'][] = (float)$row['total'];
    }
}

echo json_encode($data_meses);
?>
