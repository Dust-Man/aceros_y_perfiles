<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="./css/principal.css">
</head>

<body>
    <?php
    include "header.php"
?>
    <main>
        <div class="layout1 --sucursal">
            <h1 class="l1__title">SUCURSALES</h1>
            <p class="l1__caption --upper --mbottom60">Todas nuestras sucursales para ti</p>
            <a href="#contacto" class="boton-accion">Ir</a>
        </div>

    <section id="experiencia-ubicaciones" class="layout2 --sucursal-matriz">
            <div>
                <p class="texto-medio-grande --no-mbottom">
                    <span class="texto-medio ">Aceros y Perfiles Arciniega "Matriz"</span>
                </p>
                <div class="contenedor-de-texto">
                    <p>Ubicados en Jilotepec Centro, tenemos los mejores aceros y perfiles al mejor precio y de la mayor
                        calidad para tu proyecto. Da clic en "ir" para conocer más de esta sucursal</p>
                </div>
                <a href="" class="boton-accion">Ir</a>
            </div>
            <div>

                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d150.69417751034832!2d-99.5641527!3d19.940208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d249df153488f7%3A0xe939d90f4e7af2c!2sConcretos%20Arciniega!5e0!3m2!1ses-419!2smx!4v1700000000000!5m2!1ses-419!2smx"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>

    
    </div>
</section>


<section id="experiencia-ubicaciones" class="layout2 --imagen-paredes-concreto">
    <!-- Primera parte: Información de experiencia -->
    <div>
        <p class="texto-medio-grande">
            <span>Más de</span><span class="texto-medio">30 años</span><span>Construyendo sueños</span>
        </p>
        <div class="contenedor-de-texto">
            <p>Desde 1992 nos hemos encargado de distribuir materiales para construcción a los lugares más importantes de la zona norte del Estado de México.</p>
            <p>Con dos sucursales especializadas en aceros, perfiles y materiales; una sucursal dedicada a baños y azulejos, y otra a pavimentaciones, tenemos todo para hacer realidad tus sueños.</p>
        </div>
    </div>

    <!-- Segunda parte: Mapas de las ubicaciones -->
    <div>
        <h2>Ubicaciones de nuestras sucursales</h2>
        <p>Encuentra nuestras sucursales en los siguientes mapas:</p>

        <!-- Mapa 1: Concretos Arciniega -->
        <h3>Concretos Arciniega</h3>
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d150.69417751034832!2d-99.5641527!3d19.940208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d249df153488f7%3A0xe939d90f4e7af2c!2sConcretos%20Arciniega!5e0!3m2!1ses-419!2smx!4v1700000000000!5m2!1ses-419!2smx"
                width="100%" 
                height="300" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
            ></iframe>
        </div>

    
    </div>
</section>




        <section id="contacto" class="layout2 --imagen-bano-aesteri">
            <div>
                <h2 class="texto-contacto">Ingresa tus datos y nos pondremos en contacto</h2>
            </div>
            <div>
                <?php
                    include("./form-contacto.php")
                ?>
            </div>
        </section>
    </main>
</body>

<script src="./scripts/header.js"></script>

</html>