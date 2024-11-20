<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aceros y Perfiles Arciniega</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="icon" href="./img/logos/logo.png" type="png/jpg">
    <style>
        /* Estilos para las animaciones */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <?php include("./header.php"); ?>

    <main>
        <!-- Sección Hero -->
        <section id="hero" class="layout1 --imagen-cemento-c-azul fade-in">
            <h1 class="l1__title">ACEROS Y PERFILES <br> ARCINIEGA</h1>
            <p class="l1__caption --upper --mbottom60">Materiales de calidad para tu proyecto</p>
            <a href="#contacto" class="boton-accion">Contáctanos</a>
        </section>

        <!-- Sección Experiencia -->
        <section id="experiencia" class="layout2 --imagen-paredes-concreto fade-in">
            <div>
                <p class="texto-medio-grande">
                    <span>Más de</span><span class="texto-medio">30 años</span><span>Construyendo sueños</span>
                </p>
            </div>
            <div>
                <div class="contenedor-de-texto">
                    <p>Desde 1992 nos hemos encargado de distribuir materiales para construcción a los lugares más
                        importantes de la zona norte del Estado de México.</p>
                    <p>Con dos sucursales especializadas en aceros, perfiles y materiales; una sucursal dedicada a baños
                        y azulejos y otra a pavimentaciones, tenemos todo para hacer realidad tus sueños.</p>
                </div>
            </div>
        </section>

        <!-- Sección Servicios -->
        <h2 class="section-title fade-in">Nuestros Servicios</h2>
        <section id="servicios" class="layout3 fade-in">
            <div class="servicio-landing servicio-aceros">
                <a href="" class="asubbold">Aceros, perfiles y<br> materiales de <br>construcción</a>
            </div>
            <div class="servicio-landing servicio-azulejos">
                <a href="" class="asubbold">Baños y azulejos</a>
            </div>
            <div class="servicio-landing servicio-pavimentaciones">
                <a href="" class="asubbold">Construcciones y <br> pavimentaciones</a>
            </div>
        </section>

        <!-- Sección Sucursales -->
        <section id="sucursales" class="fade-in">
            <div class="caption-sucursales">
                <a href="" class="boton-accion --accion-secundario --bold">Conoce nuestras sucursales</a>
            </div>
            <div class="contenedor-imagen-sucursales">
                <img class="imagen-sucursales" src="./img/sucursalazulejos.png" alt="Baños y azulejos Arciniega">
            </div>
        </section>

        <!-- Sección Clientes -->
        <section id="clientes">
            <h2 class="section-title fade-in">Nuestros clientes</h2>
            <div class="layout3 --l390vh fade-in">
                <div class="cliente">
                    <div class="contenedor-cliente">
                        <img src="./img/cliente1.png" alt="Cliente 1">
                    </div>
                    <p class="--resalte-secundario">Jorge Eugenio Gigante</p>
                    <p>"Concretos Arciniega ha sido el elemento fundamental que me permitió hacer realidad todos mis
                        proyectos"</p>
                </div>
                <div class="cliente">
                    <div class="contenedor-cliente">
                        <img src="./img/cliente2.png" alt="Cliente 2">
                    </div>
                    <p class="--resalte-secundario">María de Jesús Casillas</p>
                    <p>"Los mejores precios y envíos en el momento en el que lo necesito"</p>
                </div>
                <div class="cliente">
                    <div class="contenedor-cliente">
                        <img src="./img/cliente3.png" alt="Cliente 3">
                    </div>
                    <p class="--resalte-secundario">"DJ Tilin Insano 4000"</p>
                    <p>"Gracias a ellos construí mi discoteca"</p>
                </div>
            </div>
        </section>

        <!-- Sección Contacto -->
        <section id="contacto" class="layout2 --imagen-bano-aesteri fade-in">
            <div>
                <h2 class="texto-contacto">Ingresa tus datos y nos pondremos en contacto</h2>
            </div>
            <div>
                <?php include("./form-contacto.php"); ?>
            </div>
        </section>
    </main>
<script src="./scripts/header.js"></script>
</body>

</html>
