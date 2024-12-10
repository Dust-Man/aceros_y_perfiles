<?php
require_once '../../php/conexionPDO.php'; // Archivo de conexión PDO

// Configuración de paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) {
    $pagina_actual = 1;
}

$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener vehículos con paginación
$consulta = $conexion->prepare("SELECT vehiculo_id, placa, modelo, capacidad_carga, estado FROM vehiculos LIMIT :inicio, :registros");
$consulta->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$consulta->bindValue(':registros', $registros_por_pagina, PDO::PARAM_INT);
$consulta->execute();
$vehiculos = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Contar total de vehículos
$total_vehiculos = $conexion->query("SELECT COUNT(*) FROM vehiculos")->fetchColumn();
$total_paginas = ceil($total_vehiculos / $registros_por_pagina);

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
    <title>Vehículos</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
<div  class="main-content">
        <div>
            <h1>Gestionar Vehículos</h1>
            <!-- <a href="agregar_vehiculo.php">Agregar Nuevo Vehículo</a> -->
            <table class="table" border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Capacidad de Carga</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehiculos as $vehiculo): ?>
                        <tr>
                            <td><?= htmlspecialchars($vehiculo['vehiculo_id']) ?></td>
                            <td><?= htmlspecialchars($vehiculo['placa']) ?></td>
                            <td><?= htmlspecialchars($vehiculo['modelo']) ?></td>
                            <td><?= htmlspecialchars($vehiculo['capacidad_carga']) ?></td>
                            <td><?= htmlspecialchars($vehiculo['estado']) ?></td>
                            <td>
                                <a href="editar_vehiculo.php?vehiculo_id=<?= $vehiculo['vehiculo_id'] ?>">Editar</a>
                                <a href="borrar_vehiculo.php?vehiculo_id=<?= $vehiculo['vehiculo_id'] ?>">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
        <!-- Paginación -->
        <div class="paginacion">
            <?php if ($pagina_actual > 1): ?>
                <a href="vehiculos.php?pagina=1">Primera</a>
                <a href="vehiculos.php?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
            <?php endif; ?>
    
            <?php for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
                <?php if ($i == $pagina_actual): ?>
                    <a>
                        <strong><?= $i ?></strong>
                    </a>
                <?php else: ?>
                    <a href="vehiculos.php?pagina=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
    
            <?php if ($pagina_actual < $total_paginas): ?>
                <a href="vehiculos.php?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
                <a href="vehiculos.php?pagina=<?= $total_paginas ?>">Última</a>
            <?php endif; ?>
        </div>
</div>
</body>
</html>
