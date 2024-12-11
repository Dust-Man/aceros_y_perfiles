<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
include "./side_bar.php";
include "./autentificacion.php";
?>

<div class="dashboard-main-content">
        <h1 class="header">Dashboard de Ventas</h1>

        <div class="dashboard-content">
            <!-- Gráfica de ventas por días de la semana -->
            <div class="grafica1 dashboard-card">
                <h3>Ventas por Día de la Semana</h3>
                <canvas id="ventasDia" width="400" height="200"></canvas>
            </div>

            <!-- Gráfica de ventas por semanas del mes actual -->
            <div class="grafica2 dashboard-card">
                <h3>Ventas por Semana</h3>
                <canvas id="ventasSemana" width="400" height="200"></canvas>
            </div>

            <!-- Gráfica de ventas anuales -->
            <div class="grafica3 dashboard-card">
                <h3>Ventas Anuales</h3>
                <canvas id="ventasAnuales" width="400" height="200"></canvas>
            </div>

            <!-- Productos más vendidos -->
            <div class="productos product-card">
                <h3>Productos Más Vendidos</h3>
                <ul id="productosMasVendidos"></ul>
            </div>

            <div class="choferes chofer-card">
                <h3>Mejores choferes</h3>
                <ul id="mejoresChoferes"></ul>
            </div>
          

        </div>
    </div>

</body>
<script src="./cargar_graficas.js" defer></script>
</html>
