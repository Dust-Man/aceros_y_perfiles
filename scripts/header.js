let lastScrollTop = 0;
const header = document.querySelector('header');
const threshold = 10; // Ajusta para controlar la sensibilidad

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (Math.abs(lastScrollTop - currentScroll) > threshold) {
        if (currentScroll > lastScrollTop) {
            // Scroll hacia abajo - Oculta el header
            header.classList.add('hide');
        } else {
            // Scroll hacia arriba - Muestra el header
            header.classList.remove('hide');
        }
        lastScrollTop = currentScroll;
    }
});

const nav = document.querySelector("#nav");
const abrir = document.querySelector("#abrir");
const cerrar = document.querySelector("#cerrar");

// Al hacer clic en el botón de abrir, mostrar el menú y ocultar el botón de abrir
abrir.addEventListener("click", () => {
    nav.classList.add("visible");  // Mostrar el menú
    abrir.style.display = "none";  // Ocultar el botón de abrir
    cerrar.style.display = "block";  // Mostrar el botón de cerrar
});

// Al hacer clic en el botón de cerrar, ocultar el menú y mostrar el botón de abrir
cerrar.addEventListener("click", () => {
    nav.classList.remove("visible");  // Ocultar el menú
    cerrar.style.display = "none";  // Ocultar el botón de cerrar
    abrir.style.display = "block";  // Mostrar el botón de abrir
});

///////////////////////////////////////////////////////////////////////////animaciones///////////////////////////////////////////////

// Función para revelar elementos al hacer scroll
function revealOnScroll() {
    const reveals = document.querySelectorAll('.reveal');
    for (let i = 0; i < reveals.length; i++) {
        const windowHeight = window.innerHeight;
        const elementTop = reveals[i].getBoundingClientRect().top;
        const elementVisible = 150; // Distancia desde la parte superior de la ventana

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add('active');
        } else {
            reveals[i].classList.remove('active');
        }
    }
}

// Ejecutar la función al hacer scroll
window.addEventListener('scroll', revealOnScroll);

// Ejecutar la función al cargar la página para verificar elementos visibles
window.onload = revealOnScroll;

// Desplazamiento suave hacia la sección de contacto
document.addEventListener("DOMContentLoaded", function() {
    const botonContacto = document.querySelector('.boton-accion'); // Selecciona el botón "Contáctanos"
    
    botonContacto.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento por defecto del enlace
        const targetId = this.getAttribute('href'); // Obtiene el ID del destino
        const targetElement = document.querySelector(targetId); // Selecciona el elemento destino

        // Desplazamiento suave personalizado
        const startPosition = window.pageYOffset;
        const targetPosition = targetElement.getBoundingClientRect().top + startPosition;
        const distance = targetPosition - startPosition;
        const duration = 1500; // Duración en milisegundos (1.5 segundos)
        let start = null;

        function animation(currentTime) {
            if (start === null) start = currentTime;
            const timeElapsed = currentTime - start;
            const run = ease(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        function ease(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    });
});