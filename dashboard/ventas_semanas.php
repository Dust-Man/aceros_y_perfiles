<?php
header('Content-Type: application/json');
include '../php/conexion.php';

$query_semanas = "SELECT CONCAT('Semana ', WEEK(fecha)) AS semana, SUM(total) AS total
                  FROM notas
                  WHERE MONTH(fecha) = MONTH(CURDATE())
                  GROUP BY semana
                  ORDER BY WEEK(fecha);";

$result_semanas = $conexion->query($query_semanas);
$data_semanas = [
    'labels' => [],
    'values' => []
];

if ($result_semanas && $result_semanas->num_rows > 0) {
    while ($row = $result_semanas->fetch_assoc()) {
        $data_semanas['labels'][] = $row['semana'];
        $data_semanas['values'][] = (float)$row['total'];
    }
}

echo json_encode($data_semanas);
?>
