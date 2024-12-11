<?php
require_once '../../php/conexionPDO.php';

// Configuración de paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) {
    $pagina_actual = 1;
}

$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener envíos con paginación
$consulta = $conexion->prepare("
    SELECT envio_id, nota_id, vehiculo_id, hora, fecha_envio, empleado_id, ruta, direccion
    FROM envios
    LIMIT :inicio, :registros
");
$consulta->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$consulta->bindValue(':registros', $registros_por_pagina, PDO::PARAM_INT);
$consulta->execute();
$envios = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Contar total de registros
$total_envios = $conexion->query("SELECT COUNT(*) FROM envios")->fetchColumn();
$total_paginas = ceil($total_envios / $registros_por_pagina);

// Configuración de rango de páginas
$rango_paginas = 5;
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
    <title>Envíos</title>
</head>

<body>
<?php
include "./side_bar.php";
?>
    <div class="main-content">
        <h1>Lista de Envíos</h1>
        <!-- <a href="agregar_envio.php">Agregar Nuevo Envío</a> -->
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nota ID</th>
                    <th>Vehículo ID</th>
                    <th>Hora</th>
                    <th>Fecha de Envío</th>
                    <th>Empleado ID</th>
                    <th>Ruta</th>
                    <th>Dirección</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($envios as $envio): ?>
                <tr>
                    <td><?= htmlspecialchars($envio['envio_id']) ?></td>
                    <td><?= htmlspecialchars($envio['nota_id']) ?></td>
                    <td><?= htmlspecialchars($envio['vehiculo_id']) ?></td>
                    <td><?= htmlspecialchars($envio['hora']) ?></td>
                    <td><?= htmlspecialchars($envio['fecha_envio']) ?></td>
                    <td><?= htmlspecialchars($envio['empleado_id']) ?></td>
                    <td><?= htmlspecialchars($envio['ruta']) ?></td>
                    <td><?= htmlspecialchars($envio['direccion']) ?></td>
                    <td>
                        <a href="editar_envio.php?envio_id=<?= $envio['envio_id'] ?>">Editar</a>
                        <a href="borrar_envio.php?envio_id=<?= $envio['envio_id'] ?>">Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="paginacion">
            <?php if ($pagina_actual > 1): ?>
            <a href="envios.php?pagina=1">Primera</a>
            <a href="envios.php?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
            <?php endif; ?>

            <?php for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
            <?php if ($i == $pagina_actual): ?>
            <a>
                <strong><?= $i ?></strong>
            </a>
            <?php else: ?>
            <a href="envios.php?pagina=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
            <?php endfor; ?>

            <?php if ($pagina_actual < $total_paginas): ?>
            <a href="envios.php?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
            <a href="envios.php?pagina=<?= $total_paginas ?>">Última</a>
            <?php endif; ?>
        </div>
        </ class="main-content">
</body>

</html>