const close = document.querySelector("#cerrar-mensaje");
console.log(close);
const mensaje = document.querySelector("#mensaje");
console.log(mensaje);
close.addEventListener("click",cerrarMensaje);

function cerrarMensaje(){
    console.log("Clickeado");
    mensaje.classList.toggle("mensaje_hidden");
}