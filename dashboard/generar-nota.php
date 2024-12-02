
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    require '../php/conexionPDO.php';

    try {
        $conexion->beginTransaction();

        // Insertar en la tabla 'notas'
        $cliente_id = $_POST['cliente_id'];
        $metodo_de_pago = $_POST['metodo_de_pago'];
        $estatus = $_POST['estatus'];
        $fecha = date('Y-m-d H:i:s'); // Fecha actual
        $total = 0; // Se calculará después

        $sqlNota = "INSERT INTO notas (cliente_id, fecha, total, metodo_de_pago, estatus) 
                    VALUES (:cliente_id, :fecha, :total, :metodo_de_pago, :estatus)";
        $stmtNota = $conexion->prepare($sqlNota);
        $stmtNota->execute([
            ':cliente_id' => $cliente_id,
            ':fecha' => $fecha,
            ':total' => $total,
            ':metodo_de_pago' => $metodo_de_pago,
            ':estatus' => $estatus,
        ]);

        // Obtener el ID de la nota insertada
        $nota_id = $conexion->lastInsertId();

        // Insertar en la tabla 'encabezado'
        $productos = $_POST['producto_id'];
        $cantidades = $_POST['cantidad'];

        foreach ($productos as $index => $producto_id) {
            $cantidad = $cantidades[$index];

            // Obtener precio del producto
            $sqlProducto = "SELECT precio FROM productos WHERE producto_id = :producto_id";
            $stmtProducto = $conexion->prepare($sqlProducto);
            $stmtProducto->execute([':producto_id' => $producto_id]);
            $producto = $stmtProducto->fetch(PDO::FETCH_ASSOC);

            if (!$producto) {
                throw new Exception("Producto no encontrado: $producto_id");
            }

            $subtotal = $producto['precio'] * $cantidad;
            $total += $subtotal;

            // Insertar detalle en 'encabezado'
            $sqlEncabezado = "INSERT INTO encabezado (nota_id, producto_id, cantidad, subtotal) 
                              VALUES (:nota_id, :producto_id, :cantidad, :subtotal)";
            $stmtEncabezado = $conexion->prepare($sqlEncabezado);
            $stmtEncabezado->execute([
                ':nota_id' => $nota_id,
                ':producto_id' => $producto_id,
                ':cantidad' => $cantidad,
                ':subtotal' => $subtotal,
            ]);
            $encabezado_productos_id = $conexion->lastInsertId();
            $sqlProdEnviar ="INSERT INTO prod_por_enviar(id_nota,encabezado_productos_id,enviados,por_enviar) 
                            VALUES (:id_nota, :encabezado_productos_id, :enviados, :por_enviar)";
            $stmtProdEnviar = $conexion -> prepare($sqlProdEnviar);
            $stmtProdEnviar-> execute([
                ':id_nota' => $nota_id,
                ':encabezado_productos_id' => $encabezado_productos_id,
                ':enviados' => 0,
                ':por_enviar' => $cantidad
            ]);

        }

        // Actualizar el total en la tabla 'notas'
        $sqlActualizarNota = "UPDATE notas SET total = :total WHERE nota_id = :nota_id";
        $stmtActualizarNota = $conexion->prepare($sqlActualizarNota);
        $stmtActualizarNota->execute([':total' => $total, ':nota_id' => $nota_id]);

        $conexion->commit();
    } catch (Exception $e) {
        $conexion->rollBack();
        echo "Error al registrar la nota: " . $e->getMessage();
    }
}
?>
<?php
include '../php/conexion.php';
?>
<form id="notaForm" action="generar-nota.php" method="POST">
    <h2>Registrar Nota</h2>

    <!-- Información General de la Nota -->
    <label for="cliente_id">Cliente:</label>
    <select name="cliente_id" id="cliente_id" required>
    <option value="0" disabled selected>Seleccione una opción</option>
    <?php

                $consulta = "SELECT * FROM clientes";
                $resultado = mysqli_query($conexion, $consulta);

                if($resultado->num_rows >0){
                    while($fila = $resultado->fetch_assoc()){
                        echo "<option value='".$fila["cliente_id"]."'>".$fila['nombre']."</option>";
                    }
                }
?>
    </select>

    <label for="metodo_de_pago">Método de Pago:</label>
    <select name="metodo_de_pago" id="metodo_de_pago" required>
        <option value="Efectivo">Efectivo</option>
        <option value="Tarjeta">Tarjeta</option>
        <option value="Transferencia">Transferencia</option>
    </select>

    <label for="estatus">Estatus:</label>
    <select name="estatus" id="estatus" required>
        <option value="pendiente">Pendiente</option>
        <option value="facturado">Facturado</option>
        <option value="cancelado">Cancelado</option>
    </select>

    <!-- Productos -->
    <h3>Productos</h3>
    <div id="productosContainer">
        <!-- Aquí se añadirán los productos dinámicamente -->
    </div>

    <button type="button" id="agregarProducto">Agregar Producto</button>

    <br><br>
    <button type="submit">Guardar Nota</button>
</form>

<!-- Plantilla para un nuevo producto -->
<template id="productoTemplate">
    <div class="producto">
        <label for="producto_id">Producto:</label>
        <select name="producto_id[]" required>
        <option value="0" disabled selected>Seleccione una opción</option>
    <?php

                $consulta = "SELECT * FROM productos";
                $resultado = mysqli_query($conexion, $consulta);

                if($resultado->num_rows >0){
                    while($fila = $resultado->fetch_assoc()){
                        echo "<option value='".$fila["producto_id"]."'>".$fila['nombre']."</option>";
                    }
                }
?>
        </select>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad[]" min="1" required>

        <button type="button" class="eliminarProducto">Eliminar</button>
    </div>
</template>
<script>


</script>