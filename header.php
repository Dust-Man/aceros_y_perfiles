<!-- Enlace a Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Enlace a Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

<!-- Header -->
<header id="header">
    <div class="contenedor-logo">
        <a href="index.php">
            <img src="./img/logos/logo.png" alt="logo cementos arciniega" class="logo">
        </a>
    </div>

    <!-- Botón para abrir el menú en dispositivos pequeños -->
    <button id="abrir" class="abrir-menu"><i class="bi bi-list"></i>
    </button>

    <nav class="nav" id="nav">
        <!-- Botón para cerrar el menú -->
        <button id="cerrar" class="cerrar-menu"><i class="bi bi-box-arrow-right"></i></>
    
    </button>

        <!-- Lista de navegación -->
        <ul class="nav__lista">
            <li><a href="#">Sobre nosotros</a></li>
            <li><a href="./productos_1.php">Productos</a></li>
            <li><a href="sucursales.php">Sucursales</a></li>
            <li><a href="#">Contacto</a></li>
            <li><a href="noticias.php">Noticias</a></li>
            <li><a href="productos_1.php">Preguntas F</a></li>
        </ul>
    </nav>

    <!-- Enlace al script de tu header -->
    <script src="/scripts/header.js"></script>
</header>
