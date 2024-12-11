<?php
require_once '../../php/conexionPDO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nota_id'])) {
    $nota_id = $_GET['nota_id'];

    $consulta = $conexion->prepare("SELECT * FROM notas WHERE nota_id = :nota_id");
    $consulta->bindValue(':nota_id', $nota_id, PDO::PARAM_INT);
    $consulta->execute();
    $nota = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$nota) {
        die("Nota no encontrada");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nota_id = $_POST['nota_id'];
    $cliente_id = $_POST['cliente_id'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];
    $metodo_de_pago = $_POST['metodo_de_pago'];
    $estatus = $_POST['estatus'];

    $consulta = $conexion->prepare("UPDATE notas SET cliente_id = :cliente_id, fecha = :fecha, total = :total, metodo_de_pago = :metodo_de_pago, estatus = :estatus WHERE nota_id = :nota_id");
    $consulta->bindValue(':cliente_id', $cliente_id);
    $consulta->bindValue(':fecha', $fecha);
    $consulta->bindValue(':total', $total);
    $consulta->bindValue(':metodo_de_pago', $metodo_de_pago);
    $consulta->bindValue(':estatus', $estatus);
    $consulta->bindValue(':nota_id', $nota_id, PDO::PARAM_INT);

    if ($consulta->execute()) {
        header("Location: notas.php");
        exit;
    } else {
        $error = "Error al actualizar la nota.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
</head>
<body>
    
    <?php
include "./side_bar.php";
?>
    <div class="main-content">
    <h1>Editar Nota</h1>
        <form method="POST">
            <input type="hidden" name="nota_id" value="<?= htmlspecialchars($nota['nota_id']) ?>">
            <label>Cliente ID:</label>
            <input type="text" name="cliente_id" value="<?= htmlspecialchars($nota['cliente_id']) ?>"><br>
            <label>Fecha:</label>
            <input type="date" name="fecha" value="<?= htmlspecialchars($nota['fecha']) ?>"><br>
            <label>Total:</label>
            <input type="text" name="total" value="<?= htmlspecialchars($nota['total']) ?>"><br>
            <label>Método de Pago:</label>
            <select name="metodo_de_pago">
                <option value="efectivo" <?= $nota['metodo_de_pago'] == 'efectivo' ? 'selected' : '' ?>>Efectivo</option>
                <option value="tarjeta" <?= $nota['metodo_de_pago'] == 'tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
            </select><br>
            <label>Estatus:</label>
            <select name="estatus">
                <option value="pendiente" <?= $nota['estatus'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="facturado" <?= $nota['estatus'] == 'facturado' ? 'selected' : '' ?>>Facturado</option>
                <option value="cancelado" <?= $nota['estatus'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
            </select><br>
            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
