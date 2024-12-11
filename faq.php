<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="icon" href="./img/logos/logo.png" type="png/jpg">
    <style>
        #faq {
            /* Estilos adicionales si es necesario */
        }

        .faq-container {
            margin: 10rem auto;
            width: 100%;
            max-width: 800px;
            border-radius: 5px;
            background-color: #fff !important;
            padding: 20px;
            min-height: 75vh;
        }

        .faq-item {
            margin-bottom: 1rem;
            width: 100%;
            border-radius: 5px;
        }

        .faq-question {
            width: 100%;
            text-align: left;
            padding: 1rem;
            background-color: #f3f3f3;
            border: 1px solid #f3f3f3;
            cursor: pointer;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
        }

        .faq-question span {
            font-size: 1.5rem;
            line-height: 0;
            color: #333;
        }

        .faq-answer {
    max-height: 0; /* Start with a height of 0 */
    overflow: hidden; /* Hide overflow */
    opacity: 0; /* Start with opacity 0 */
    transition: max-height 0.4s ease, opacity 0.4s ease; /* Smooth transition for max-height and opacity */
    color: black ;
}

.faq-answer.active {
    max-height: 200px; /* Set to a value that accommodates your content */
    opacity: 1; /* Fully visible */
}


    </style>
</head>

<body>
    <?php
        include("./header.php");
    ?>
    <main>
        <section id="faq" class="layout1 --imagen-cemento-c-azul">
            <div class="faq-container">
                <h2 class="section-title --color-principal">Preguntas Frecuentes</h2>
                <!-- Pregunta 1 -->
                <div class="faq-item">
                    <button class="faq-question">¿Qué tipos de materiales ofrecen? <span>+</span></button>
                    <div class="faq-answer">
                        <p>Ofrecemos una amplia gama de materiales de construcción, como aceros, perfiles, azulejos, baños, y soluciones para pavimentaciones residenciales, comerciales e industriales.</p>
                    </div>
                </div>
                <!-- Pregunta 2 -->
                <div class="faq-item">
                    <button class="faq-question">¿Realizan entregas a domicilio? <span>+</span></button>
                    <div class="faq-answer">
                        <p>Sí, contamos con un servicio de entregas eficiente para garantizar que tus materiales lleguen a tiempo y en perfectas condiciones.</p>
                    </div>
                </div>
                <!-- Pregunta 3 -->
                <div class="faq-item">
                    <button class="faq-question">¿Tienen descuentos por compras al mayoreo? <span>+</span></button>
                    <div class="faq-answer">
                        <p>¡Por supuesto! Ofrecemos precios especiales para compras al mayoreo. Contáctanos para más detalles y cotizaciones personalizadas.</p>
                    </div>
                </div>
                                <!-- Pregunta 4 -->
                                <div class="faq-item">
                    <button class="faq-question">¿Dónde están ubicadas sus sucursales? <span>+</span></button>
                    <div class="faq-answer">
                        <p>Tenemos cuatro sucursales estratégicamente ubicadas en la zona norte del Estado de México. Consulta nuestra sección de sucursales para más información.</p>
                    </div>
                </div>
                <!-- Pregunta 5 -->
                <div class="faq-item">
                    <button class="faq-question">¿Aceptan tarjetas de INFONAVIT? <span>+</span></button>
                    <div class="faq-answer">
                        <p>¡Sí! Aceptamos las tarjetas Mejoravit en todas nuestras sucursales.</p>
                    </div>
                </div>
            </div>
        </section>

        <script>
           document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const answer = button.nextElementSibling;
        const isOpen = answer.classList.contains('active');

        // Cerrar todas las respuestas
        document.querySelectorAll('.faq-answer').forEach(ans => {
            ans.classList.remove('active');
            ans.style.maxHeight = '0'; // Resetea la altura máxima
            ans.style.opacity = '0'; // Resetea la opacidad
        });
        document.querySelectorAll('.faq-question span').forEach(span => span.textContent = '+');

        // Abrir la respuesta seleccionada
        if (!isOpen) {
            answer.classList.add('active');
            answer.style.maxHeight = answer.scrollHeight + 'px'; // Ajusta la altura máxima al contenido
            answer.style.opacity = '1'; // Cambia la opacidad a 1
            button.querySelector('span').textContent = '−';
        }
    });
});
        </script>

    </main>
    <?php
    include "footer.php"
?> 
</body>
<script src="./scripts/header.js"></script>

</html>