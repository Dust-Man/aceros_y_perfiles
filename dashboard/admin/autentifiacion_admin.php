<?php 
// Inicia la sesión si no está activa 
if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
} 
 
// Verifica si el usuario ha iniciado sesión 
if (!isset($_SESSION['usuario_id'])) { 
    // Redirige al login si no hay sesión activa 
    header('Location: ../../administracion/forms/login.php'); 
    exit(); 
} 
 

$rol = $_SESSION['rol'] ?? ''; 
 
// Si el rol es  usuario lo regresa a el index del dashboard de usuario
if ($rol === 'usuario') { 
    header('Location: ../index.php'); 
    exit(); 
}

// Si el rol es 'superusuario', permite el acceso 
if ($rol === 'superusuario') { 
    return; 
}

// Si no tiene un rol reconocido, redirige a una página de error o al inicio 
header('Location: ../../administracion/forms/login.php'); 
exit(); 
?>