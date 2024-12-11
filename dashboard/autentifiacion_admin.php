<?php
// Inicia la sesión si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Redirige al login si no hay sesión activa
    header('Location: ../administracion/forms/login.php');
    exit();
}

// Verifica el rol del usuario
$rol = $_SESSION['rol'] ?? '';

// Si el rol no es 'superusuario' y el usuario intenta acceder al dashboard
if ($rol !== 'superusuario' && strpos($_SERVER['PHP_SELF'], 'dashboard') !== false) {
    header('Location: ./index.php'); // Cambiar a la página deseada
    exit();
}

// Si el rol no es 'usuario' (o el rol requerido para la sección actual), puedes manejarlo aquí.
if ($rol !== 'superusuario') {
    // Redirige a una página específica o muestra un mensaje de error
    header('Location: ');
    exit();
}
?>
