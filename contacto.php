<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="icon" href="./img/logos/logo.png" type="png/jpg">
    <script src="https://kit.fontawesome.com/67ae9cb33f.js" crossorigin="anonymous"></script>
    
</head>
<style>
    form input, form textarea{
        width: 100% !important;
        border-radius: 5px !important;
        border-color: #0e8abb !important;
        color: #000 !important;
    }
    input::placeholder,textarea::placeholder{
        color:#0e8abb !important;
    }
    form{
        margin: 0 auto !important;
        padding-top: 50px !important;
    }
    .boton-envio{
        color:#0e8abb !important;
        border-color: #0e8abb !important;
    }
</style>
<body>
    <?php
        include("./header.php");
    ?>
    <main>
        <div class="layout1 --imagen-cemento-c-azul">
            <section id="contacto" class="contenedor-texto-grande --color-dark">
                <div class="formulario-contacto">
                    <h2 class="section-title --color-principal">Contacto</h2>
                    <p class="center title-caption ">Estamos felices de atenderte. Rellena el formulario y nos pondremos en contacto.</p>
                    <p class="center title-caption">También nos puedes contactar vía redes sociales.</p>
                    <?php
                            include("./form-contacto.php");?>
                </div>
                <section class="formulario-contacto --color-dark">
    <h2 class="section-title --color-principal reveal">Otras formas de contacto:</h2>
    <div class="formas-contacto reveal">
        <p class="forma-contacto-nombre --color-principal"><i class="fa-solid fa-tty"></i> Teléfonos:</p>
        <ul class="lista-de-formas">
            <li>761-73-4-29-37</li>
            <li>761-73-4-06-60</li>
            <li>761-73-4-03-02</li>
            <li>761-73-4-07-13</li>
        </ul>
    </div>
    <div class="formas-contacto reveal">
        <p class="forma-contacto-nombre --color-principal"><i class="fa-brands fa-whatsapp"></i> WhatsApp:</p>
        <ul class="lista-de-formas">
            <li>55 45 40 98 28</li>
            <li>55 45 40 29 10</li>
            <li><a href="tel:+527221040075">722-10-4-00-75</a></li>
        </ul>
    </div>
    <div class="formas-contacto reveal">
        <p class="forma-contacto-nombre --color-principal"><i class="fa-regular fa-envelope"></i> Correo Electrónico:</p>
        <ul class="lista-de-formas">
            <li><a href="mailto:concretosarciniega@gmail.com">concretosarciniega@gmail.com</a></li>
        </ul>
    </div>
    <div class="formas-contacto reveal">
        <p class="forma-contacto-nombre --color-principal"><i class="fa-brands fa-facebook"></i> Facebook:</p>
        <ul class="lista-de-formas">
            <li><a href="https://www.facebook.com/concretos.arciniega.94/" target="__blank">/Concretos Arciniega</a></li>
        </ul>
        <p class="forma-contacto-nombre --color-principal"><i class="fa-brands fa-instagram"></i> Instagram:</p>
        <ul class="lista-de-formas">
            <li><a href="https://www.instagram.com/concretosarciniega/">@concretosarcinega</a></li>
        </ul>
    </div>
</section>
            </section>
            
        </div>
        
    </main>
</body>
<script src="./scripts/header.js"></script>

</html>