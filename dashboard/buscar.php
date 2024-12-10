<?php
include '../php/conexion.php';

$busqueda = isset($_GET['search']) ? mysqli_real_escape_string($conexion, trim($_GET['search'])) : '';

$filtroBusqueda = '';
if (!empty($busqueda)) {
    $filtroBusqueda = " WHERE nombre LIKE '%$busqueda%' OR clave LIKE '%$busqueda%'";
}

$sql = "SELECT DISTINCT * FROM productos $filtroBusqueda";
$resultset = mysqli_query($conexion, $sql);

if (!$resultset) {
    echo json_encode(['error' => "Database error: " . mysqli_error($conexion)]);
    exit;
}

$productos = [];
while ($record = mysqli_fetch_assoc($resultset)) {
    // Calcular la distancia Levenshtein con el término de búsqueda
    $record['distancia'] = levenshtein(strtolower($record['nombre']), strtolower($busqueda));
    $productos[] = $record;
}

// Ordenar los resultados según la distancia Levenshtein
usort($productos, function($a, $b) {
    return $a['distancia'] - $b['distancia'];
});

// Enviar los resultados como respuesta JSON
echo json_encode(['productos' => $productos]);

mysqli_close($conexion);
?>
