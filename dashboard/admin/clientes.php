<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
// Configuración de conexión a la base de datos
include "./autentifiacion_admin.php";
require '../../php/conexionPDO.php';

// Configuración de la paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Consulta para obtener los registros
$sql = "SELECT cliente_id, nombre, telefono, correo, direccion FROM clientes LIMIT :inicio, :registros";
$stmt = $conexion->prepare($sql);
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':registros', $registros_por_pagina, PDO::PARAM_INT);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para contar el total de registros
$sql_total = "SELECT COUNT(*) FROM clientes";
$total_registros = $conexion->query($sql_total)->fetchColumn();
$total_paginas = ceil($total_registros / $registros_por_pagina);
?>

    <?php
include "./side_bar.php";
?>

    <!-- Main Content -->
    <div class="main-content">
       
            <div>
                <h1>Gestión de Clientes</h1>
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['cliente_id']) ?></td>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                            <td><?= htmlspecialchars($cliente['correo']) ?></td>
                            <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                            <td>
                                <a href="editar_cliente.php?id=<?= $cliente['cliente_id'] ?>">Editar</a>
                                <a href="borrar_cliente.php?id=<?= $cliente['cliente_id'] ?>"
                                    onclick="return confirm('¿Estás seguro de borrar este cliente?');">Borrar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="paginacion">
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <a href="?pagina=<?= $i ?>" <?= $i === $pagina_actual ? 'class="activo"' : '' ?>><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            </div>



    </div>




</body>

</html>