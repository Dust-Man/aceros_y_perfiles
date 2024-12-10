<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../php/conexionPDO.php';
    try {
        $conexion->beginTransaction();
        $nota_id = $_GET['nota_id'];
        $vehiculo_id = $_POST['vehiculo_id'];
        $hora = $_POST['hora'];
        $fecha = $_POST['fecha'];
        $empleado_id = $_POST['empleado_id'];
        $ruta = $_POST['ruta'];
        $activo = isset($_POST['tienda']) ? true : false;

        $sqlEnvio = "INSERT INTO envios (nota_id, vehiculo_id, hora, fecha_envio,empleado_id, ruta)
                        VALUES (:nota_id, :vehiculo_id, :hora, :fecha_envio,:empleado_id, :ruta)";
        $stmtEnvio = $conexion->prepare($sqlEnvio);
        $stmtEnvio->execute([
            ':nota_id' => $nota_id,
            ':vehiculo_id' => $vehiculo_id,
            ':hora' => $hora,
            ':fecha_envio' => $fecha,
            ':empleado_id' => $empleado_id,
            ':ruta' => $ruta,
        ]);

        $envio_id = $conexion->lastInsertId();

        $productos = $_POST['producto_id'];
        $cantidades = $_POST['cantidad'];
        $ids_prod_env = $_POST['id_prod_env'];

        foreach ($productos as $index => $producto_id) {
            $cantidad = $cantidades[$index];
            $id_prod_env = $ids_prod_env[$index];
            if ($cantidad > 0) {
                $sqlEnvioEncabezado = "INSERT INTO envios_encabezado (nota_id, envio_id,direccion,producto_id, cantidad)
                                        VALUES (:nota_id, :envio_id,:direccion,:producto_id, :cantidad)";
                $stmtEnvioEncabezado = $conexion->prepare($sqlEnvioEncabezado);
                $stmtEnvioEncabezado->execute([
                    ':nota_id' => $nota_id,
                    ':envio_id' => $envio_id,
                    ':direccion' => 'ejemplo',
                    ':producto_id' => $producto_id,
                    ':cantidad' => $cantidad,
                ]);
                $sqlActualizarProdEnviar = "UPDATE prod_por_enviar 
                                            SET enviados = enviados + :enviados_add, por_enviar = por_enviar - :enviados_sub 
                                            WHERE id_productos_enviar = :id_prod_env";
                $stmtActualizarProdEnviar = $conexion->prepare($sqlActualizarProdEnviar);
                $stmtActualizarProdEnviar->execute([
                    ':enviados_add' => $cantidad,
                    ':enviados_sub' => $cantidad,
                    ':id_prod_env' => $id_prod_env,
                ]);


            }

        }

        $conexion->commit();
    } catch (Exception $e) {
        $conexion->rollback();
        echo "Error al registrar el envio: " . $e->getMessage();
    }
}
?>
<?php
include '../php/conexion.php';

if (isset($_GET['nota_id'])) {
    $nota_id = $_GET['nota_id'];

    // Obtener datos de la nota
    $consulta = "SELECT * FROM notas WHERE nota_id = '$nota_id'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && $resultado->num_rows > 0) {
        $nota = $resultado->fetch_assoc();

        // Obtener cliente
        $id_cliente = $nota['cliente_id'];
        $consulta_cliente = "SELECT nombre FROM clientes WHERE cliente_id = '$id_cliente'";
        $resultado_cliente = mysqli_query($conexion, $consulta_cliente);
        $cliente = $resultado_cliente->fetch_assoc();

        // Generar formulario

    } else {
        echo "<p>Nota no encontrada.</p>";
    }
} else {
    echo "<p>ID de nota no especificado.</p>";
}
?>

<h3>Gestionar Envío para Nota <?= $nota_id ?></h3>
<p>Cliente: <?= htmlspecialchars($cliente['nombre']) ?></p>
<form id="formEnvio"  method="POST">

    <input type="hidden" name="nota_id" value="<?= $nota_id ?>">
    <label for="vehiculo_id">Vehículo:</label>
    <select name="vehiculo_id" id="vehiculo_id" required>
        <option value="0" disabled selected>Seleccione una opción</option>
        <?php

        $consulta = "SELECT * FROM vehiculos";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["vehiculo_id"] . "'>" . $fila['placa'] . " | " . $fila['marca'] . "</option>";
            }
        }
        ?>
    </select>
    <label for="empleado_id">Empleado:</label>
    <select name="empleado_id" id="empleado_id" required>
        <option value="0" disabled selected>Seleccione una opción</option>
        <?php


        $consulta = "SELECT * FROM empleados";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila["empleado_id"] . "'>" . $fila['nombre'] . "</option>";
            }
        }
        ?>
    </select>
    <label for="ruta">Ruta:</label>
    <input type="text" name="ruta" id="ruta" required>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" required>

    <label for="hora">Hora:</label>
    <input type="time" name="hora" id="hora" required>

    <div class="table-container">
    <table>
    <tr>
        <th>Producto</th>
        <th>Por Enviar</th>
        <th>Enviar</th>
    <?php
    $consulta = "SELECT * FROM productos_en_prod_env WHERE id_nota = '$nota_id' AND por_enviar > 0";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['por_enviar'] . "</td>";
            echo "<td>";
            echo "<input type='hidden' name='producto_id[]' value='" . $fila['producto_id'] . "'>";
            echo "<input type='hidden' name='id_prod_env[]' value='" . $fila['id_productos_enviar'] . "'>";
            echo "<input type='number' min='0' name='cantidad[]' class='cantidad'>";
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>
       
    </div>

    <button type="submit">Guardar Envío</button>
</form>
<script src="./envio.js" defer></script>