<?php
// Validar si la sesión ya está activa antes de iniciar una nueva
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, redirigir al login
    header('Location: ../administracion/forms/login.php');
    exit();
}
?>
