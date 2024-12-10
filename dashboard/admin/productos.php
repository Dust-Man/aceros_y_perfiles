<?php
require_once '../../php/conexionPDO.php'; // Archivo de conexión PDO

// Configuración de paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) {
    $pagina_actual = 1;
}

$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener productos con paginación
$consulta = $conexion->prepare("SELECT producto_id, nombre, precio, stock, categoria, descripcion, clave FROM productos LIMIT :inicio, :registros");
$consulta->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$consulta->bindValue(':registros', $registros_por_pagina, PDO::PARAM_INT);
$consulta->execute();
$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Contar total de productos
$total_productos = $conexion->query("SELECT COUNT(*) FROM productos")->fetchColumn();
$total_paginas = ceil($total_productos / $registros_por_pagina);

// Configuración de rango de páginas a mostrar
$rango_paginas = 5; // Número de páginas a mostrar alrededor de la página actual
$inicio_paginacion = max(1, $pagina_actual - floor($rango_paginas / 2));
$fin_paginacion = min($total_paginas, $inicio_paginacion + $rango_paginas - 1);

if ($fin_paginacion - $inicio_paginacion < $rango_paginas - 1) {
    $inicio_paginacion = max(1, $fin_paginacion - $rango_paginas + 1);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <title>Productos</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
    <div class="main-content">
        
        <h1>Gestionar Productos</h1>
        <!-- <a href="agregar_producto.php">Agregar Nuevo Producto</a> -->
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Clave</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['precio']) ?></td>
                        <td><?= htmlspecialchars($producto['stock']) ?></td>
                        <td><?= htmlspecialchars($producto['categoria']) ?></td>
                        <td><?= htmlspecialchars($producto['clave']) ?></td>
                        <td>
                            <a href="editar_producto.php?producto_id=<?= $producto['producto_id'] ?>">Editar</a>
                            <a href="borrar_producto.php?producto_id=<?= $producto['producto_id'] ?>">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Paginación -->
        <div class="paginacion">
        <?php if ($pagina_actual > 1): ?>
            <a href="productos.php?pagina=1">Primera</a>
            <a href="productos.php?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
        <?php endif; ?>

        <?php for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
            <?php if ($i == $pagina_actual): ?>
                <a>
                    <strong><?= $i ?></strong>
                </a>
            <?php else: ?>
                <a href="productos.php?pagina=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina_actual < $total_paginas): ?>
            <a href="productos.php?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
            <a href="productos.php?pagina=<?= $total_paginas ?>">Última</a>
        <?php endif; ?>
    </div>
    </div>
</body>
</html>
