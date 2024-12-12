<?php
// Incluir tu archivo de conexión a la base de datos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../php/conexion.php');

// Obtener el ID del usuario de la sesión
$usuario_id = $_SESSION['usuario_id'];

// Preparar la consulta para obtener el rol
$query = "SELECT rol FROM usuarios WHERE usuario_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

// Obtener el rol
$rol = '';
if ($row = $result->fetch_assoc()) {
    $rol = $row['rol'];
}
$stmt->close();
?>
