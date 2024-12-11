<?php
header('Content-Type: application/json');
include '../php/conexion.php';

$query_dias = "SELECT DAYNAME(fecha) AS dia, SUM(total) AS total
               FROM notas
               WHERE fecha >= CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY
               GROUP BY dia
               ORDER BY FIELD(dia, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');";

$result_dias = $conexion->query($query_dias);
$data_dias = [
    'labels' => [],
    'values' => []
];

if ($result_dias && $result_dias->num_rows > 0) {
    while ($row = $result_dias->fetch_assoc()) {
        $data_dias['labels'][] = $row['dia'];
        $data_dias['values'][] = (float)$row['total'];
    }
}

echo json_encode($data_dias);
?>
