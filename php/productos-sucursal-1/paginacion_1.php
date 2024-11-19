<?php
include '../conexion.php';

// Configuración de la paginación
$elementosPorPagina = 12;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $elementosPorPagina;

$busqueda = isset($_GET['search']) ? mysqli_real_escape_string($conexion, trim($_GET['search'])) : '';

$filtroBusqueda = '';
if (!empty($busqueda)) {
// Aqui se ajusta cuantos caracteres se tomaran de la busqueda
    if (strlen($busqueda) > 0) {
        $filtroBusqueda = " WHERE nombre LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%'";
    }
}

$sql = "SELECT DISTINCT * FROM productos 
        $filtroBusqueda 
        ORDER BY producto_id ASC 
        LIMIT $inicio, $elementosPorPagina";

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

usort($productos, function($a, $b) {
    return $a['distancia'] - $b['distancia'];
});

$sqlTotal = "SELECT COUNT(DISTINCT producto_id) as total FROM productos $filtroBusqueda";
$resultTotal = mysqli_query($conexion, $sqlTotal);

if (!$resultTotal) {
    echo json_encode(['error' => "Database error: " . mysqli_error($conexion)]);
    exit;
}

$filaTotal = mysqli_fetch_assoc($resultTotal);
$totalElementos = $filaTotal['total'];
$totalPaginas = ceil($totalElementos / $elementosPorPagina);

// Enviar los datos como respuesta JSON
echo json_encode([
    'productos' => $productos,
    'totalPaginas' => $totalPaginas
]);

mysqli_close($conexion);
?>
