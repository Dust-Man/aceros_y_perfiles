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
