<?php 
include "./autentifiacion_admin.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">
<div class="dashboard">
    <?php
include "./obtener_rol.php";
?>
<!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">SGBD Arciniega</div>
            <ul class="menu">
            <div class="rol"> <li>Rol: <?php echo htmlspecialchars($rol);?></li></div>
                <li><a href="./clientes.php" data-section="dashboard">Clientes</a></li>
                <li><a href="./productos.php" >Productos</a></li>
                <li><a href="./vehiculos.php" >Vehículos</a></li>
                <li><a href="./empleados.php" >Empleados</a></li>
                <li><a href="./notas.php" >Notas</a></li>
                <li><a href="./envios.php" >Envíos</a></li>
                <li><a href="./catalogo.php" >Catálogo</a></li>
                <li><a href="./form_nuevo_usuario.php" >Crear nuevos usuarios</a></li>
                <li><a href="../index.php" >Regresar al sistema de control</a></li>
            </ul>

            <!-- <div class="rol">Rol: </div> -->
        </div>
