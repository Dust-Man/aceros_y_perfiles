const imprimir = document.querySelector("#btn-imprimir");
const regresar = document.querySelector("#btn-regresar");
console.log(imprimir);
imprimir.addEventListener("click",imprimir_pagina);

function imprimir_pagina(){
    imprimir.classList.toggle("ocultar");
    regresar.classList.toggle("ocultar");
    window.print();
    imprimir.classList.remove("ocultar");
    regresar.classList.toggle("ocultar");
}