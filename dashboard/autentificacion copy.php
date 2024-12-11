<?php
session_start(); 

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Redirige al login si no hay sesión activa
    header('Location: ../administracion/forms/login.php');
    exit();
}

// Verifica el rol del usuario
$rol = $_SESSION['rol'] ?? '';

// Si el rol no es 'usuario', no permite acceder al catálogo
if ($rol !== 'superusuario') {
    // Redirige a una página específica o muestra un mensaje de error
    header('Location: ./index.php');
    exit();
}
?>
