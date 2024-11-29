<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$nombre_bd = "arciniega";

try {
    // Crear conexión PDO
    $conexion = new PDO("mysql:host=$servidor;dbname=$nombre_bd;charset=utf8", $usuario, $password);

    // Configurar PDO para manejar errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Opción: Deshabilitar emulación de consultas preparadas (mejora seguridad y rendimiento)
    $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Mensaje opcional (solo para pruebas)
    // echo "Conexión exitosa con PDO.";
} catch (PDOException $e) {
    // Manejo de errores
    die("Error en la conexión: " . $e->getMessage());
}
?>
