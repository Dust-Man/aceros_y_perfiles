<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="stylesheet" href="./css/carrusel.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css'>


</head>
<style>

</style>

<body>
    <?php include "header.php"; 
    include 'php/conexion.php';


    $sql = "SELECT * FROM proyectos";
    $result = mysqli_query($conexion, $sql);
    ?>

    <main>

        <div class="layout4">
            <section class="game-section">
                <h2 class="section-title reveal">Nuestro Trabajo</h2>
                <div class="owl-carousel custom-carousel owl-theme">
                    <div class="item active" style="background-image: url(./img/destileria.png);">
                        <div class="item-desc">
                            <h3>DESTILERIA ABASOLO JILOTEPEC</h3>

                        </div>
                    </div>
                    <div class="item" style="background-image: url(./img/atizapan.png);">
                        <div class="item-desc">
                            <h3>SUMINISTRO AUTOPISTA ATIZAPA-ATLACOMULCO</h3>

                        </div>
                    </div>
                    <div class="item" style="background-image: url(./img/caet.png);">
                        <div class="item-desc">
                            <h3>SUMINISTRO CAET - TRUPER</h3>
                        </div>
                    </div>
                    <div class="item" style="background-image: url(./img/techumbre.png);">
                        <div class="item-desc">
                            <h3>TECHUMBRE DONGU CHAPA DE MOTA</h3>
                        </div>
                    </div>
                    <div class="item" style="background-image: url(./img/caltex.png);">
                        <div class="item-desc">
                            <h3>SUMINISTRO KALTEX</h3>
                        </div>
                    </div>
                    <div class="item" style="background-image: url(./img/bartes.png);">
                        <div class="item-desc">
                            <h3>CONSTRUCCION ESCUELA DE BELLAS ARTES</h3>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        <div class="gallery">
            <?php while ($proyecto = mysqli_fetch_assoc($result)): ?>
            <div>
                <?php echo "<img src='".$proyecto['img_src']."'>" ?>
                <p class="titulo-portafolio"><?php echo $proyecto['nombre']; ?></p>
            </div>

            <?php endwhile; ?>

        </div>
    </main>
    <?php
    include "footer.php"
?> 

</body>

<script src="./scripts/header.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src="./scripts/carousel.js"></script>

</html>