<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

    <?php
    include "./side_bar.php";
    include "./autentificacion.php";

    ?>


    <!-- Main Content -->
    <div class="main-content">
        <div class="content">

            <form id="notaForm">
                <h2>Registrar Nota</h2>

                <!-- Información General de la Nota -->
                <label for="cliente_id">Cliente:</label>
                <select name="cliente_id" id="cliente_id" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <?php
                    include "../php/conexion.php";
                    $consulta = "SELECT * FROM clientes";
                    $resultado = mysqli_query($conexion, $consulta);

                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<option value='" . $fila["cliente_id"] . "'>" . $fila['nombre'] . "</option>";
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
                    <option value="Pendiente">Pendiente</option>
                    <option value="Pagado">Pagado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>

                <!-- Buscar Productos -->
                <label for="productos">Seleccionar Productos:</label>
                <input type="search" id="search" placeholder="Buscar producto...">
                <table id="resultTable" style="display: none;" class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Resultados dinámicos -->
                    </tbody>
                </table>
                <div  class="pagination" id="pagination">
    <!--Y aqui la paginacion  -->
</div>


                <!-- Productos Seleccionados -->
                <h3>Productos Seleccionados</h3>
                <table id="selectedProductsTable" class="table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="selectedProducts">
                        <!-- Productos seleccionados dinámicamente -->
                    </tbody>
                </table>

                <button type="button" id="submitBtn">Registrar Nota</button>
            </form>

        </div>
    </div>
    </div>
</body>
<script defer  src="./nota.js"></script>

</html>