<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['producto_id'])) {
    $producto_id = $_GET['producto_id'];

    // Obtener datos del producto
    $consulta = $conexion->prepare("SELECT nombre, precio, stock, categoria, clave FROM productos WHERE producto_id = :producto_id");
    $consulta->execute(['producto_id' => $producto_id]);
    $producto = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        die("Producto no encontrado.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    $clave = $_POST['clave'];

    // Procesar imagen

    // Actualizar producto
    $actualizacion = $conexion->prepare("
        UPDATE productos 
        SET nombre = :nombre, precio = :precio, stock = :stock, categoria = :categoria,clave = :clave
        WHERE producto_id = :producto_id
    ");
    $actualizacion->execute([
        'nombre' => $nombre,
        'precio' => $precio,
        'stock' => $stock,
        'categoria' => $categoria,
        'clave' => $clave,
        'producto_id' => $producto_id
    ]);

    header("Location: productos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
<?php
include "./side_bar.php";
?>
    <div class="main-content">
        <h1>Editar Producto</h1>
        <form method="POST" action="editar_producto.php" enctype="multipart/form-data">
            <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto_id) ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br>
        
            <label for="precio">Precio:</label>
            <input type="number" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required><br>
        
            <label for="stock">Stock:</label>
            <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required><br>
        
            <label for="categoria">Categoría:</label>
            <select name="categoria" required>
                <option value="materiales" <?= $producto['categoria'] === 'materiales' ? 'selected' : '' ?>>Materiales</option>
                <option value="herramientas" <?= $producto['categoria'] === 'herramientas' ? 'selected' : '' ?>>Herramientas</option>
            </select><br>
        
            <label for="clave">Clave:</label>
            <input type="text" name="clave" value="<?= htmlspecialchars($producto['clave']) ?>" required><br>
        
            <button type="submit">Guardar Cambios</button>
        </form>
        <a href="productos.php">Volver</a>
    </div>
</body>
</html>
