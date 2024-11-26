<?php
include "../php/conexion.php";

$usuario =trim($_POST['usuario']);
$rol = trim($_POST['rol']);
$password = trim($_POST['password']);

// Hash de la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, password, rol) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $usuario, $hashed_password, $rol);

if ($stmt->execute()) {
    echo "Usuario registrado con éxito.";
} else {
    echo "Error: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
