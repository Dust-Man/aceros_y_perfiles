<?php
session_start();


if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'superusuario') {
    header("Location: ../forms/login.php");
    exit;
}
echo "Bienvenido, " . htmlspecialchars($_SESSION['nombre_usuario']) . ". Eres un superusuario.";
?>
