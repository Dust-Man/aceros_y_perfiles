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

?>

   <!-- Main Content -->
   <div class="main-content">
            <div class="content">
                
<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conexion, $_POST['title']);
    $content = mysqli_real_escape_string($conexion, $_POST['content']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $stock = mysqli_real_escape_string($conexion, $_POST['stock']);
    $categoria = mysqli_real_escape_string($conexion,$_POST['categoria']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

    $banner_url = '';
            if(isset($_FILES['banner']) && $_FILES['banner']['error'] === 0){    
                $banner = $_FILES['banner'];
                $rutaDestino = "../uploads/banners/";  // Define la carpeta donde se guardarán las imágenes
                $nombreArchivo = uniqid() . "-" . basename($banner['name']);  // Nombre único para la imagen
                $rutaCompleta = $rutaDestino . $nombreArchivo;

                if(move_uploaded_file($banner['tmp_name'], $rutaCompleta)){
                    $banner_url = "uploads/banners/".$nombreArchivo;  // Guardar la ruta para almacenarla en la base de datos
                } else {
                    echo "Error al subir la imagen.";
                }
            }// Nueva línea para el banner

    $sql = "INSERT INTO productos_mostrar (nombre, descripcion, imagen, precio, stock, categoria, clave) VALUES ('$title', '$content', '$banner_url','$precio', '$stock','$categoria', '$clave')";
    if (mysqli_query($conexion, $sql)) {
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
<form action="registrar-producto.php" method="POST" enctype="multipart/form-data">
<h1>Agregar al catalogo</h1>

    <label for="title">Nombre:</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Descripción:</label>
    <textarea id="content" name="content" rows="5" required></textarea>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required>

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" required>

    <label for="categoria">Categoría:</label>
    <select name="categoria" id="categoria">
        <option value="materiales">materiales</option>
        <option value="herramientas">herramientas</option>
    </select>

    <label for="clave">Clave:</label>
    <input type="text" id="clave" name="clave" required>

   
    <label for="foto">Banner:</label>
    <input type="file" name="banner" id="banner" accept="image/*">


    <button type="submit">Guardar</button>
</form>


            </div>
        </div>
    </div>



    
</body>
</html>




