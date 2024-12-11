<?php
session_start();
include "../php/conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['password']);

    // Validación 
    if (empty($usuario) || empty($contrasena)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }
    // Consulta
    $stmt = $conexion->prepare("SELECT usuario_id, password , rol FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($contrasena, $user['password'])) {
            // Autenticación exitosa: guardar datos en la sesión
            $_SESSION['usuario_id'] = $user['usuario_id'];
            $_SESSION['nombre_usuario'] = $usuario;
            $_SESSION['rol'] = $user['rol'];
            if ($user['rol'] === 'superusuario') {

                echo json_encode(['status' => 'success', 'redirect' => '../../dashboard/index.php
']);
            } else {
                echo json_encode(['status' => 'success', 'redirect' => '../../dashboard/index.php
']);

            }
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conexion->close();
}
?>
