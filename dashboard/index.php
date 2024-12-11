<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración CA</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <?php
        
        include "./autentificacion.php";
    ?>
</head>

<body>
   <?php

   include "./side_bar.php";
   ?>
        <!-- Main Content -->
        <div class="main-content">
            <div class="content">
                <!-- Aquí es donde se cargarán las secciones -->
                <div class="card">Aquí una grafica</div>
                <div class="card">Aquí otra</div>
                <div class="card">Aquí una foto de tilin</div>
            </div>
        </div>
    </div>
    
</body>
</html>
