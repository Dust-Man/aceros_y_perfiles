<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/secundario.css">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
</head>

<body>

    <?php
    include "../../dashboard/admin/autentifiacion_admin.php";
    include "./obtener_rol.php";
    ?>

    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">SGBD Arciniega</div>
            <ul class="menu">
                <div class="rol">
                    <li>Rol: <?php echo htmlspecialchars($rol); ?></li>
                </div>

                <li><a href="./clientes.php" data-section="dashboard">Clientes</a></li>
                <li><a href="./productos.php">Productos</a></li>
                <li><a href="./vehiculos.php">Vehículos</a></li>
                <li><a href="./empleados.php">Empleados</a></li>
                <li><a href="./notas.php">Notas</a></li>
                <li><a href="./envios.php">Envíos</a></li>
                <li><a href="./catalogo.php">Catálogo</a></li>
                <li><a href="./form_nuevo_usuario.php">Crear nuevos usuarios</a></li>
                <li><a href="../index.php">Regresar al sistema de control</a></li>
            </ul>

            <!-- <div class="rol">Rol: </div> -->
        </div>

        <div class="main-content">
            <div class="content">
                <div class="login" id="login">
                    <form class="form" id="form_new_user">
                        <h1>
                            Crear nuevo usuario
                        </h1>
                        <div class="flex-column">
                            <label for="usuario">Nombre:</label>
                        </div>
                        <div class="inputForm">
                            <span class="material-symbols-outlined">person</span>
                            <input type="text" name="usuario" id="usuario" class="input">
                        </div>

                        <p id="usernameError" class="error-message">El campo usuario no puede estar vacío.</p>

                        <div class="flex-column">
                            <label for="rol">Rol:</label>
                        </div>
                        <div class="inputForm">
                            <span class="material-symbols-outlined">
                                shield_person
                            </span>
                            <select name="rol" id="rol" class="input">
                                <option value="superusuario">Administrador</option>
                                <option value="usuario">Usuario</option>
                            </select>
                        </div>
                        <div class="flex-column">
                            <label for="password">Contraseña:</label>
                        </div>
                        <div class="inputForm">
                            <span class="material-symbols-outlined">lock</span>
                            <input type="password" id="password" name="password" class="input" placeholder="Enter your Password">

                            <svg id="seepassword" viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path>
                            </svg>
                        </div>
                        <p id="passwordError" class="error-message">
                            La contraseña debe tener entre 8 y 15 caracteres y al menos un símbolo especial.
                        </p>
                        <p class="password-instructions">
                            La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una minúscula, un número y un símbolo especial (!, @, #, $, %, etc.).
                        </p>
                        <button type="submit" class="button-submit">Crear usuario</button>
                    </form>

                </div>

                <!-- Alerta de creacion de usuario -->
                <div class="success" id="success" style="display:none;">
                    <div class="success__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
                            <path fill-rule="evenodd" fill="#393a37" d="m12 1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm4.768 9.14c.0878-.1004.1546-.21726.1966-.34383.0419-.12657.0581-.26026.0477-.39319-.0105-.13293-.0475-.26242-.1087-.38085-.0613-.11844-.1456-.22342-.2481-.30879-.1024-.08536-.2209-.14938-.3484-.18828s-.2616-.0519-.3942-.03823c-.1327.01366-.2612.05372-.3782.1178-.1169.06409-.2198.15091-.3027.25537l-4.3 5.159-2.225-2.226c-.1886-.1822-.4412-.283-.7034-.2807s-.51301.1075-.69842.2929-.29058.4362-.29285.6984c-.00228.2622.09851.5148.28067.7034l3 3c.0983.0982.2159.1748.3454.2251.1295.0502.2681.0729.4069.0665.1387-.0063.2747-.0414.3991-.1032.1244-.0617.2347-.1487.3236-.2554z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="success__title">Usuario creado exitosamente.</div>
                    <div class="success__close" onclick="cerrarAlerta()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20" id="close">
                            <path fill="#393A37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path>
                        </svg>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
</body>
<script src="../../scripts/ver_password.js" defer></script>
<script src="./crear_nuevo_usuario.js" defer></script>

</html>