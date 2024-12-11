<?php
include '../php/conexion.php';

$busqueda = isset($_GET['search']) ? mysqli_real_escape_string($conexion, trim($_GET['search'])) : '';

// Parámetros de paginación
$productosPorPagina = 10; // Número de productos por página
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página actual (por defecto 1)
$offset = ($paginaActual - 1) * $productosPorPagina; // Desplazamiento para la consulta LIMIT

// Filtro de búsqueda
$filtroBusqueda = '';
if (!empty($busqueda)) {
    $filtroBusqueda = " WHERE nombre LIKE '%$busqueda%' OR clave LIKE '%$busqueda%'";
}

// Consultar el total de productos para calcular el número de páginas
$sqlTotal = "SELECT COUNT(*) as total FROM productos $filtroBusqueda";
$resultTotal = mysqli_query($conexion, $sqlTotal);
$totalProductos = mysqli_fetch_assoc($resultTotal)['total'];
$totalPaginas = ceil($totalProductos / $productosPorPagina);

// Obtener los productos para la página actual
$sql = "SELECT DISTINCT * FROM productos $filtroBusqueda LIMIT $offset, $productosPorPagina";
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

// Enviar los resultados y la información de paginación como respuesta JSON
echo json_encode([
    'productos' => $productos,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas
]);

mysqli_close($conexion);    
?>
