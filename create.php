<?php
include 'php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conexion, $_POST['title']);
    $content = mysqli_real_escape_string($conexion, $_POST['content']);
    $banner_url = '';
            if(isset($_FILES['banner']) && $_FILES['banner']['error'] === 0){
                echo"Hola";    
                $banner = $_FILES['banner'];
                $rutaDestino = "uploads/banners/";  // Define la carpeta donde se guardarán las imágenes
                $nombreArchivo = uniqid() . "-" . basename($banner['name']);  // Nombre único para la imagen
                $rutaCompleta = $rutaDestino . $nombreArchivo;

                if(move_uploaded_file($banner['tmp_name'], $rutaCompleta)){
                    $banner_url = $rutaCompleta;  // Guardar la ruta para almacenarla en la base de datos
                } else {
                    echo "Error al subir la imagen.";
                }
            }// Nueva línea para el banner

    $sql = "INSERT INTO productos (nombre, descripcion, imagen) VALUES ('$title', '$content', '$banner_url')";
    if (mysqli_query($conexion, $sql)) {
        echo "simon";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Artículo</title>
</head>
<body>
    <h1>Crear Nuevo Artículo</h1>
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="content">Contenido:</label>
        <textarea id="content" name="content" rows="5" required></textarea>
        
        <label for="foto">Banner:</label>
        <input type="file" name="banner" id="banner" accept="image/*">
        
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
