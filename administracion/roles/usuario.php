<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../forms/login.php");
    exit;
}

// Contenido solo para usuarios
echo "Bienvenido, " . htmlspecialchars($_SESSION['nombre_usuario']) . ". Eres un usuario.";
?>
