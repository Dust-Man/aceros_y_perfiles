<?php
require_once '../../php/conexionPDO.php';

// Verificar si se envió el ID del producto a editar
if (!isset($_GET['producto_id'])) {
    die("ID de producto no proporcionado.");
}

$producto_id = (int)$_GET['producto_id'];

// Obtener datos del producto a editar
$consulta = $conexion->prepare("SELECT * FROM productos_mostrar WHERE producto_id = :producto_id");
$consulta->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
$consulta->execute();
$producto = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    die("Producto no encontrado.");
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $clave = $_POST['clave'];

    // Validación básica
    if (empty($nombre) || empty($precio) || empty($stock) || empty($categoria) || empty($clave)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Actualizar el registro en la base de datos
        $consulta_actualizar = $conexion->prepare("
            UPDATE productos_mostrar
            SET nombre = :nombre,
                precio = :precio,
                stock = :stock,
                categoria = :categoria,
                descripcion = :descripcion,
                clave = :clave
            WHERE producto_id = :producto_id
        ");

        $consulta_actualizar->bindParam(':nombre', $nombre);
        $consulta_actualizar->bindParam(':precio', $precio);
        $consulta_actualizar->bindParam(':stock', $stock);
        $consulta_actualizar->bindParam(':categoria', $categoria);
        $consulta_actualizar->bindParam(':descripcion', $descripcion);
        $consulta_actualizar->bindParam(':clave', $clave);
        $consulta_actualizar->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);

        try {
            $consulta_actualizar->execute();
            header("Location: catalogo.php?mensaje=Producto actualizado con éxito.");
            exit;
        } catch (PDOException $e) {
            $error = "Error al actualizar el producto: " . $e->getMessage();
        }
    }
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

        <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>ID:</label>
            <input type="text" value="<?= htmlspecialchars($producto['producto_id']) ?>" disabled>
            <br>

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
            <br>

            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>"
                required>
            <br>

            <label>Stock:</label>
            <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required>
            <br>

            <label>Categoría:</label>
            <select name="categoria" required>
                <option value="materiales" <?= $producto['categoria'] === 'materiales' ? 'selected' : '' ?>>Materiales
                </option>
                <option value="herramientas" <?= $producto['categoria'] === 'herramientas' ? 'selected' : '' ?>>
                    Herramientas</option>
            </select>
            <br>

            <label>Descripción:</label>
            <textarea name="descripcion" rows="4" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            <br>

            <label>Clave:</label>
            <input type="text" name="clave" value="<?= htmlspecialchars($producto['clave']) ?>" required>
            <br>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>

</html>