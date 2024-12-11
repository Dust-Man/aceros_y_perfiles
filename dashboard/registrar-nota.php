<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../php/conexionPDO.php';

    try {
        if (empty($_POST['cliente_id']) || !is_numeric($_POST['cliente_id'])) {
            die("Error: No se seleccionó un cliente o el ID es inválido.");
        }

        $cliente_id = $_POST['cliente_id'];
        $productos = isset($_POST['producto_id']) ? (array)$_POST['producto_id'] : [];
        $cantidades = isset($_POST['cantidad']) ? (array)$_POST['cantidad'] : [];

        if (empty($productos) || empty($cantidades)) {
            die("Error: No se seleccionaron productos o cantidades.");
        }

        // Validación del metodo de pago y estatus
        $metodo_de_pago = $_POST['metodo_de_pago'];
        if (!in_array($metodo_de_pago, ['Efectivo', 'Tarjeta', 'Transferencia'])) {
            die("Error: Método de pago inválido.");
        }

        $estatus = $_POST['estatus'];
        if (!in_array($estatus, ['Pendiente', 'Pagado', 'Cancelado'])) {
            die("Error: Estatus inválido.");
        }

        $conexion->beginTransaction();
        $fecha = date('Y-m-d H:i:s');
        $total = 0;

        // Insertar la nota
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

        $nota_id = $conexion->lastInsertId();

        // Insertar los productos en la tabla encabezado
        foreach ($productos as $index => $producto_id) {
            if (!is_numeric($producto_id)) {
                echo $producto_id;
                die("Error: ID de producto inválido.");
            }

            $cantidad = $cantidades[$index];
            if (!is_numeric($cantidad) || $cantidad <= 0) {
                die("Error: Cantidad inválida.");
            }

            $sqlProducto = "SELECT precio FROM productos WHERE producto_id = :producto_id";
            $stmtProducto = $conexion->prepare($sqlProducto);
            $stmtProducto->execute([':producto_id' => $producto_id]);
            $producto = $stmtProducto->fetch(PDO::FETCH_ASSOC);

            if (!$producto) {
                throw new Exception("Producto no encontrado: ID $producto_id.");
            }

            $subtotal = $producto['precio'] * $cantidad;
            $total += $subtotal;

            // Insertar detalle en encabezado
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

        // Sumar los subtotales de los productos de esta nota (de la tabla encabezado)
        $sqlTotalNota = "SELECT SUM(subtotal) AS total_subtotales 
                         FROM encabezado 
                         WHERE nota_id = :nota_id";
        $stmtTotalNota = $conexion->prepare($sqlTotalNota);
        $stmtTotalNota->execute([':nota_id' => $nota_id]);
        $totalNota = $stmtTotalNota->fetch(PDO::FETCH_ASSOC)['total_subtotales'];

        // Actualizar el total de la nota con la suma de los subtotales
        $sqlActualizarNota = "UPDATE notas SET total = :total WHERE nota_id = :nota_id";
        $stmtActualizarNota = $conexion->prepare($sqlActualizarNota);
        $stmtActualizarNota->execute([ 
            ':total' => $totalNota, 
            ':nota_id' => $nota_id
        ]);

        $conexion->commit();
        echo "Nota registrada exitosamente.";
    } catch (Exception $e) {
        $conexion->rollBack();
        echo "Error al registrar la nota. Por favor, inténtelo más tarde.";
        error_log("Error al registrar la nota: " . $e->getMessage());
    }
}
?>

