<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Eventos</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="icon" href="./img/logos/logo.png" type="image/png">
    <style>
        body {
            background-color: #ffffff; /* Fondo blanco */
        }
        .reveal {
            transition: opacity 1.5s ease-out, transform 0.5s ease-out; /* Transición suave */
        }
    </style>
</head>
<body>
    <?php 
        include "header.php"; 
    ?> 

    <main>
    <div class="layout1 --imagen-lugar">
   
        <h1 class="l1__title reveal">EVENTOS</h1>
        <p class="l1__caption --upper --mbottom60 reveal">MOMENTOS QUE NOS MARCAN POR SIEMPRE</p>
    </div>


        <section class="layout2 --imagen-rifa --derecha">
    <div class="reveal">
        <p class="texto-medio-grande --no-mbottom">
            <span class="texto-medio">Rifa de Aniversario</span>
        </p>
        <div class="contenedor-de-texto --mbottom30">
            <p>Con motivo del aniversario de Aceros y Perfiles Arciniega se realiza un evento, en 
            el cual, además de la tradicional rifa, se instala una exposición con nuestros principales
            proveedores, quienes muestran al público general los nuevos productos. Este evento es uno 
            de los más importantes para nosotros, ya que nos permite entablar una mejor relación con 
            nuestros clientes.</p>
        </div>
    </div>
</section>

        <section class="layout2 --imagen-ladrillos">
            <div class="reveal">
                <p class="texto-medio-grande --no-mbottom">
                    <span class="texto-medio">Día de la Santa Cruz</span>
                </p>
                <div class="contenedor-de-texto --mbottom30">
                    <p>Aceros y Perfiles Arciniega, cada 3 de Mayo, celebra el Día de la Santa Cruz, donde se festeja a los maestros 
                    en construcción. El evento incluye una misa tradicional, seguida de una comida para todos nuestros clientes, con 
                    entrega de algunos obsequios.</p>
                </div>
            </div>
        </section>
    </main>

    <script src="./scripts/header.js"></script> 
</body>
</html>