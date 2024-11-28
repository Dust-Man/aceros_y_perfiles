<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración CA</title>

    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">Panel de Administración CA</div>
            <ul class="menu">
                <li><a href="#" data-section="dashboard">Dashboard</a></li>
                <li><a href="#" data-section="registrar-producto">Registrar producto</a></li>
                <li><a href="#" data-section="crear-post">Crear Post</a></li>
                <li><a href="#" data-section="generar-nota">Generar Nota</a></li>
                <li><a href="#" data-section="generar-envio">Generar Envío</a></li>
                <li><a href="#" data-section="productos-por-enviar">Productos por Enviar</a></li>
                <li><a href="#" data-section="registrar-cliente">Registrar cliente</a></li>
                <li><a href="#" data-section="registrar-empleado">Registrar empleado</a></li>
                <li><a href="#" data-section="registrar-vehiculo">Registrar vehículo</a></li>
            </ul>

            <div class="rol">Rol: </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">

            <div class="content">
                <div class="card">Aquí una grafica</div>
                <div class="card">Aquí otra</div>
                <div class="card">Aquí una foto de tilin</div>
            </div>

        </div>
    </div>
</body>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuLinks = document.querySelectorAll('.menu a');
    const contentDiv = document.querySelector('.main-content');

    // Función para cargar secciones dinámicamente
    const loadSection = (section) => {
        fetch(`${section}.php`)
            .then(response => {
                if (!response.ok) throw new Error('Error al cargar la sección.');
                return response.text();
            })
            .then(html => {
                contentDiv.innerHTML = html;

                // Reasignar eventos a los formularios dinámicamente cargados
                assignFormSubmitHandler();
            })
            .catch(err => {
                contentDiv.innerHTML = "<div><h1>Error</h1><p>No se pudo cargar la sección.</p></div>";
                console.error(err);
            });
    };

    // Añadir evento a los enlaces del menú
    menuLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault(); // Evita el comportamiento por defecto del enlace

            const section = e.target.getAttribute('data-section');
            if (section) {
                loadSection(section);
            }
        });
    });

    // Función para manejar el envío del formulario con AJAX
    const assignFormSubmitHandler = () => {
        const forms = contentDiv.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault(); // Evita la recarga de la página

                const formData = new FormData(form); // Recoge los datos del formulario

                fetch(form.action, {
                    method: form.method,
                    body: formData,
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Error al enviar el formulario.');
                        return response.text();
                    })
                    .then(result => {
                        contentDiv.innerHTML = `<div><h1>Éxito</h1><p>${result}</p></div>`;
                        // Reasignar eventos en caso de contenido nuevo
                        assignFormSubmitHandler();
                    })
                    .catch(err => {
                        contentDiv.innerHTML = `<div><h1>Error</h1><p>Hubo un problema al procesar el formulario.</p></div>`;
                        console.error(err);
                    });
            });
        });
    };

    // Asignar manejadores iniciales
    assignFormSubmitHandler();
});
</script>


</html>