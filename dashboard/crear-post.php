<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

include "./side_bar.php";

?>

</body>
</html>
   <!-- Main Content -->
   <div class="main-content">
            <div class="content">

            <?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conexion, $_POST['title']);
    $content = mysqli_real_escape_string($conexion, $_POST['content']);
    $banner_url = '';
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === 0) {
        $banner = $_FILES['banner'];
        $rutaDestino = "../uploads/banners/";  // Define la carpeta donde se guardarán las imágenes
        $nombreArchivo = uniqid() . "-" . basename($banner['name']);  // Nombre único para la imagen
        $rutaCompleta = $rutaDestino . $nombreArchivo;

        if (move_uploaded_file($banner['tmp_name'], $rutaCompleta)) {
            $banner_url = "uploads/banners/" . $nombreArchivo;  // Guardar la ruta para almacenarla en la base de datos
        } else {
            echo "Error al subir la imagen.";
        }
    }// Nueva línea para el banner


    $sql = "INSERT INTO posts (title, content, banner_url) VALUES ('$title', '$content', '$banner_url')";
    if (mysqli_query($conexion, $sql)) {
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>


<form action="crear-post.php" method="POST" enctype="multipart/form-data">
<h1>Crear Nuevo Post</h1>

    <label for="title">Título:</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Contenido:</label>
    <textarea id="content" name="content" rows="20" required></textarea>

    <label for="foto">Banner:</label>
    <input type="file" name="banner" id="banner" accept="image/*">

    <button type="submit">Guardar</button>
</form>

            </div>
        </div>
    </div>

