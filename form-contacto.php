<?php
include './php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $mensaje = mysqli_real_escape_string($conexion, $_POST['mensaje']);
   
    $sql = "INSERT INTO CONTACTO (nombre, email, telefono, mensaje) VALUES ('$nombre', '$email', '$telefono','$mensaje')";
    if (mysqli_query($conexion, $sql)) {
        echo "<div class='exito' id='mensaje'><span>Tu mensaje se ha enviado. Nos pondremos en contacto contigo.</span><span id='cerrar-mensaje'>X</span></div>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
<form  action="form-contacto.php" method="post" class="form-contacto --form-landing padding-top-30px">
    <input class="padding-top-30px" type="text" name="nombre" id="nombre" placeholder="Nombre">
    <input type="tel" name="telefono" id="telefono" placeholder="teléfono">
    <input type="email" name="email" id="email" placeholder="Correo Electrónico">
    <textarea name="mensaje" id="mensaje" placeholder="mensaje"></textarea>
    <div class="boton-centro">
        <button type="submit" name="enviar" class="boton-envio ">Enviar</button>
    </div>
</form>
<script src="./scripts/mensajes.js"></script>