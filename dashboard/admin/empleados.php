<?php
require_once '../../php/conexionPDO.php'; // Archivo de conexión PDO

// Configuración de paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) {
    $pagina_actual = 1;
}

$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener empleados con paginación
$consulta = $conexion->prepare("SELECT empleado_id, nombre, rol, telefono, rfc FROM empleados LIMIT :inicio, :registros");
$consulta->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$consulta->bindValue(':registros', $registros_por_pagina, PDO::PARAM_INT);
$consulta->execute();
$empleados = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Contar total de empleados
$total_empleados = $conexion->query("SELECT COUNT(*) FROM empleados")->fetchColumn();
$total_paginas = ceil($total_empleados / $registros_por_pagina);

// Configuración de rango de páginas a mostrar
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
    <title>Empleados</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
 <div class="main-content">
       <h1>Gestionar Empleados</h1>
       <!-- <a href="agregar_empleado.php">Agregar Nuevo Empleado</a> -->
       <table class="table" border="1">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Nombre</th>
                   <th>Rol</th>
                   <th>Teléfono</th>
                   <th>RFC</th>
                   <th>Opciones</th>
               </tr>
           </thead>
           <tbody>
               <?php foreach ($empleados as $empleado): ?>
                   <tr>
                       <td><?= htmlspecialchars($empleado['empleado_id']) ?></td>
                       <td><?= htmlspecialchars($empleado['nombre']) ?></td>
                       <td><?= htmlspecialchars($empleado['rol']) ?></td>
                       <td><?= htmlspecialchars($empleado['telefono']) ?></td>
                       <td><?= htmlspecialchars($empleado['rfc']) ?></td>
                       <td>
                           <a href="editar_empleado.php?empleado_id=<?= $empleado['empleado_id'] ?>">Editar</a>
                           <a href="borrar_empleado.php?empleado_id=<?= $empleado['empleado_id'] ?>">Borrar</a>
                       </td>
                   </tr>
               <?php endforeach; ?>
           </tbody>
       </table>
    
       <!-- Paginación -->
       <div class="paginacion">
           <?php if ($pagina_actual > 1): ?>
               <a href="empleados.php?pagina=1">Primera</a>
               <a href="empleados.php?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
           <?php endif; ?>
    
           <?php for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
               <?php if ($i == $pagina_actual): ?>
                   <a>
                    <strong><?= $i ?></strong>
                   </a>
               <?php else: ?>
                   <a href="empleados.php?pagina=<?= $i ?>"><?= $i ?></a>
               <?php endif; ?>
           <?php endfor; ?>
    
           <?php if ($pagina_actual < $total_paginas): ?>
               <a href="empleados.php?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
               <a href="empleados.php?pagina=<?= $total_paginas ?>">Última</a>
           <?php endif; ?>
       </div>
 </div>
</body>
</html>
