
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../php/conexionPDO.php';
    try {
        $conexion->beginTransaction();
        $nota_id = $_POST['nota_id'];
        $vehiculo_id = $_POST['vehiculo_id'];
        $hora = $_POST['hora'];
        $fecha = $_POST['fecha'];
        $empleado_id = $_POST['empleado_id'];
        $ruta = $_POST['ruta'];
        $activo = isset($_POST['tienda']) ? true : false;
        $direccion = $_POST['ruta'];

        $sqlEnvio = "INSERT INTO envios (nota_id, vehiculo_id, hora, fecha_envio,empleado_id, ruta, direccion)
                        VALUES (:nota_id, :vehiculo_id, :hora, :fecha_envio,:empleado_id, :ruta, :direccion)";
        $stmtEnvio = $conexion->prepare($sqlEnvio);
        $stmtEnvio->execute([
            ':nota_id' => $nota_id,
            ':vehiculo_id' => $vehiculo_id,
            ':hora' => $hora,
            ':fecha_envio' => $fecha,
            ':empleado_id' => $empleado_id,
            ':ruta' => $ruta,
            ':direccion' => $direccion,
        ]);

        $envio_id = $conexion->lastInsertId();

        $productos = $_POST['producto_id'];
        $cantidades = $_POST['cantidad'];
        $ids_prod_env = $_POST['id_prod_env'];
       

        foreach ($productos as $index => $producto_id) {
            $cantidad = $cantidades[$index];
            $id_prod_env = $ids_prod_env[$index];
            if ($cantidad > 0) {
                $sqlEnvioEncabezado = "INSERT INTO envios_encabezado (nota_id, envio_id,producto_id, cantidad)
                                        VALUES (:nota_id, :envio_id,:producto_id, :cantidad)";
                $stmtEnvioEncabezado = $conexion->prepare($sqlEnvioEncabezado);
                $stmtEnvioEncabezado->execute([
                    ':nota_id' => $nota_id,
                    ':envio_id' => $envio_id,
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