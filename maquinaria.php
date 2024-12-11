<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="icon" href="./img/logos/logo.png" type="png/jpg">
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="stylesheet" href="./css/carrusel.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css'>
</head>
<body>
<?php
    include "header.php"
?>
  <main>
  <section id="hero" class="layout1 --sucursal-sur-oriente">
      <h1 class="l1__title">CONOCE NUESTRA MAQUINARÍA</h1>
      
    </section>

  <section id="hero" class= "game-section">
              
              <div class= "contenmedor-de-texto">
 
                <p class="texto-medio"><span>Nuestra Maquinaria</span></p>
 
                <p class="descripcionsg"> Contamos con una gran variedad de maquinaria para cumplir con tus necesidades.</p>
 

                <div class="owl-carousel custom-carousel owl-theme">
                    
                <div class="item active"
                    style="background-image: url(./img/maquinaria/revolvedora.jpg);">
                    <div class="item-desc">
                        <h3>REVOLVEDORA DE CEMNTO</h3>
                        
                    </div>
                </div>
                <div class="item"
                    style="background-image: url(./img/maquinaria/bomba-pluma.jpg);">
                    <div class="item-desc">
                        <h3>DIVERSAS BOMBAS TIPO PLUMA</h3>
                        
                    </div>
                </div>
                <div class="item"
                    style="background-image: url(./img/maquinaria/vibrocompactador.jpg);">
                    <div class="item-desc">
                        <h3>VIBROCOMPACTADORES</h3>
                    </div>
                </div>
                <div class="item"
                    style="background-image: url(./img/maquinaria/petrolizadora.jpg);">
                    <div class="item-desc">
                        <h3>PETROLIZADORA</h3>
                    </div>
                </div>
                <div class="item"
                    style="background-image: url(./img/maquinaria/martillo-hidraulico.jpg);">
                    <div class="item-desc">
                        <h3>MARTILLO HIDRAULICO</h3>
                    </div>
                </div>
                <div class="item"
                    style="background-image: url(./img/maquinaria/cargador-frontal.jpg);">
                    <div class="item-desc">
                        <h3>CARGADOR FRONTAL</h3>
                    </div>
                </div>
            </div>
            </div>
        </section>
  </main>
  <?php
    include "footer.php"
?> 
  <script src="./scripts/header.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script><script  src="./script.js"></script>

    <script src="./scripts/carousel.js"></script>
</body>
<script src="./scripts/header.js"></script>
<?php
    include "footer.php"
?> 
</html>