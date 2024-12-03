<?php
session_start(); 

if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa  redirigir al login
    header('Location: ../administracion/forms/login.php');
    exit();
}

$rol = $_SESSION['rol'] ?? '';

if ($rol !== 'superusuario' && strpos($_SERVER['PHP_SELF'], 'dashboard') !== false) {
    // Si el usuario no es superusuario e intenta acceder al dashboard, redirigir
    header('Location: ');
    exit();
}
?>
