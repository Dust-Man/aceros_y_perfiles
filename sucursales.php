<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="./css/principal.css">
   
</head>
<style>

</style>
<body>
    <?php include "header.php"; ?>

    <main>
        <div class="layout1 --sucursal">
            <h1 class="l1__title reveal">SUCURSALES</h1>
            <p class="l1__caption --upper --mbottom60 reveal">Todas nuestras sucursales para ti</p>
        </div>
        

        <section id="experiencia-ubicaciones" class="layout2 --sucursal-matriz">
            <div class="reveal">
                <p class="texto-medio-grande --no-mbottom">
                    <span class="texto-medio">Aceros y Perfiles Arciniega "Matriz"</span>
                </p>
                <div class="contenedor-de-texto --mbottom30">
                    <p>Ubicados en el corazón de Jilotepec Centro, ofrecemos una amplia variedad de aceros y perfiles de
                        la más alta calidad a precios competitivos. Todo lo que necesitas para que tu proyecto sea un
                        éxito está aquí. Haz clic en "Ir" para descubrir más sobre esta sucursal.</p>
                </div>
                <a href="sucursal-matriz.php" class="boton-accion">Ir</a>
            </div>

            <div class="map-container reveal">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d150.69417751034832!2d-99.5641527!3d19.940208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d249df153488f7%3A0xe939d90f4e7af2c!2sConcretos%20Arciniega!5e0!3m2!1ses-419!2smx!4v1700000000000!5m2!1ses-419!2smx"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>

        <section id="experiencia-ubicaciones" class="layout2 --sucursal-sur-oriente">
            <div class="reveal">
                <p class="texto-medio-grande --no-mbottom">
                    <span class="texto-medio">Aceros y Perfiles Arciniega "Sucursal Sur-Oriente"</span>
                </p>
                <div class="contenedor-de-texto --mbottom30">
                    <p>Ubicados estratégicamente en la carretera Jilotepec-Ixtlahuaca, en nuestra sucursal Sur-Oriente
                        encontrarás todo lo necesario para hacer realidad tus proyectos, desde materiales de
                        construcción hasta aceros y perfiles de alta calidad. Haz clic en "Ir" para descubrir más sobre
                        esta sucursal.</p>
                </div>
                <a href="sucursal-sur-oriente.php" class="boton-accion">Ir</a>
            </div>

            <div class="map-container reveal">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3750.6108593564586!2d-99.56587082494951!3d19.94079678145002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d249c89859a627%3A0x9c840fc353883b14!2sAceros%                y%20Perfiles%20Arciniega!5e0!3m2!1ses-419!2smx!4v1731590916835!5m2!1ses-419!2smx"
                    allowfullscreen=""  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section id="experiencia-ubicaciones" class="layout2 --sucursal-azujelos">
            <div class="reveal">
                <p class="texto-medio-grande --no-mbottom">
                    <span class="texto-medio">Azulejos y Baños Arciniega</span>
                </p> 
                <div class="contenedor-de-texto --mbottom30">
                    <p>Ubicados en Avenida Vicente Guerrero, en Jilotepec, esta sucursal te ofrece lo mejor en azulejos
                        y artículos para baños, con diseños modernos y materiales de alta calidad para tus espacios. Haz
                        clic en "Ir" para conocer más sobre esta sucursal.</p>
                </div>
                <a href="sucursal-banos-azulejos.php" class="boton-accion">Ir</a>
            </div>

            <div class="map-container reveal">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15001.699697493255!2d-99.5577138826172!3d19.948624444062173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2363d6e5be7a7%3A0x569bbac978691f6f!2sCEMENTO%20CRUZ%20AZUL!5e0!3m2!1ses-419!2smx!4v1731592348055!5m2!1ses-419!2smx"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    </main>

    <script src="./scripts/header.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
    <?php
    include "footer.php"
?> 
</body>

</html>