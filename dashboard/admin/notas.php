<?php
require_once '../../php/conexionPDO.php';

// Configuración de paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) {
    $pagina_actual = 1;
}

$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener notas con paginación
$consulta = $conexion->prepare("SELECT nota_id, cliente_id, fecha, total, metodo_de_pago, estatus FROM notas LIMIT :inicio, :registros");
$consulta->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$consulta->bindValue(':registros', $registros_por_pagina, PDO::PARAM_INT);
$consulta->execute();
$notas = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Contar total de registros
$total_notas = $conexion->query("SELECT COUNT(*) FROM notas")->fetchColumn();
$total_paginas = ceil($total_notas / $registros_por_pagina);

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
    <title>Notas</title>
</head>
<body><?php
include "./side_bar.php";
?>
   <div class="main-content">
     <h1>Lista de Notas</h1>
     <!-- <a href="agregar_nota.php">Agregar Nueva Nota</a> -->
     <table class="table" border="1">
         <thead >
             <tr>
                 <th>ID</th>
                 <th>Cliente ID</th>
                 <th>Fecha</th>
                 <th>Total</th>
                 <th>Método de Pago</th>
                 <th>Estatus</th>
                 <th>Opciones</th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($notas as $nota): ?>
                 <tr>
                     <td><?= htmlspecialchars($nota['nota_id']) ?></td>
                     <td><?= htmlspecialchars($nota['cliente_id']) ?></td>
                     <td><?= htmlspecialchars($nota['fecha']) ?></td>
                     <td><?= htmlspecialchars($nota['total']) ?></td>
                     <td><?= htmlspecialchars($nota['metodo_de_pago']) ?></td>
                     <td><?= htmlspecialchars($nota['estatus']) ?></td>
                     <td>
                         <a href="editar_nota.php?nota_id=<?= $nota['nota_id'] ?>">Editar</a>
                         <a href="borrar_nota.php?nota_id=<?= $nota['nota_id'] ?>">Borrar</a>
                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
    
     <!-- Paginación -->
     <div class="paginacion">
         <?php if ($pagina_actual > 1): ?>
             <a href="notas.php?pagina=1">Primera</a>
             <a href="notas.php?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
         <?php endif; ?>
    
         <?php for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
             <?php if ($i == $pagina_actual): ?>
                 <a>
                    <strong><?= $i ?></strong>
                 </a>
             <?php else: ?>
                 <a href="notas.php?pagina=<?= $i ?>"><?= $i ?></a>
             <?php endif; ?>
         <?php endfor; ?>
    
         <?php if ($pagina_actual < $total_paginas): ?>
             <a href="notas.php?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
             <a href="notas.php?pagina=<?= $total_paginas ?>">Última</a>
         <?php endif; ?>
     </div>
   </div>
</body>
</html>
