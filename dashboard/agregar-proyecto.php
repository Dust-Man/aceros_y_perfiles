<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

include "./side_bar.php";
// include "./autentificacion.php";

?>

   <!-- Main Content -->
   <div class="main-content">
            <div class="content">
                
<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);

    $banner_url = '';
            if(isset($_FILES['banner']) && $_FILES['banner']['error'] === 0){    
                $banner = $_FILES['banner'];
                $rutaDestino = "../uploads/banners/proyectos/";  // Define la carpeta donde se guardarán las imágenes
                $nombreArchivo = uniqid() . "-" . basename($banner['name']);  // Nombre único para la imagen
                $rutaCompleta = $rutaDestino . $nombreArchivo;

                if(move_uploaded_file($banner['tmp_name'], $rutaCompleta)){
                    $banner_url = "uploads/banners/proyectos/".$nombreArchivo;  // Guardar la ruta para almacenarla en la base de datos
                } else {
                    echo "Error al subir la imagen.";
                }
            }// Nueva línea para el banner

    $sql = "INSERT INTO proyectos (nombre,img_src) VALUES ('$nombre','$banner_url')";
    if (mysqli_query($conexion, $sql)) {
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
<form action="agregar-proyecto.php" method="POST" enctype="multipart/form-data">
<h1>Agregar Proyecto</h1>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

   
    <label for="banner">Imagen:</label>
    <input type="file" name="banner" id="banner" accept="image/*">


    <button type="submit">Guardar</button>
</form>


            </div>
        </div>
    </div>



    
</body>
</html>




