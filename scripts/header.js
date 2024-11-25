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

////////////animaciones////////////////////

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