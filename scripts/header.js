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

document.addEventListener("DOMContentLoaded", () => {
    const fadeElements = document.querySelectorAll(".fade-in");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
                entry.target.classList.remove("hide");  // Asegura que se quite la clase hide
            } else {
                entry.target.classList.add("hide");
                // Mantiene el "fade-in" para que se pueda reactivar después de un pequeño retraso
                setTimeout(() => {
                    entry.target.classList.remove("show");
                    entry.target.classList.add("fade-in"); // Vuelve a permitir la animación de entrada
                }, 800); // Tiempo de espera antes de volver a aplicar la animación
            }
        });
    }, { threshold: 0.1 }); // Activa cuando el 10% del elemento es visible

    fadeElements.forEach(element => {
        observer.observe(element);
    });
});
