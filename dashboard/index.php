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
                <li><a href="#" data-section="envios-proximos">Envíos Próximos</a></li>
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

                    // Reasignar eventos a los elementos dinámicos
                    setupDynamicEvents();
                    assignFormSubmitHandler();
                })
                .catch(err => {
                    contentDiv.innerHTML =
                        "<div><h1>Error</h1><p>No se pudo cargar la sección.</p></div>";
                    console.error(err);
                });
        };

        // Añadir eventos a los enlaces del menú
        menuLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault(); // Evita el comportamiento por defecto del enlace

                const section = e.target.getAttribute('data-section');
                if (section) {
                    loadSection(section);
                }
            });
        });

        // Delegación de eventos para checkboxes y sus campos asociados
        const setupCheckboxHandlers = () => {
            contentDiv.addEventListener('change', (e) => {
                if (e.target && e.target.classList.contains('cboxtienda')) {
                    const row = e.target.closest('tr'); // Encuentra la fila del checkbox
                    const cantidadInput = row.querySelector('.cantidad');

                    if (e.target.checked) {
                        cantidadInput.disabled = true;
                        cantidadInput.value = ''; // Limpia el contenido
                    } else {
                        cantidadInput.disabled = false;
                    }
                }
            });
        };

        // Modificar `setupDynamicEvents` para incluir la nueva función
        const setupDynamicEvents = () => {
            const agregarProductoBtn = document.getElementById('agregarProducto');
            const productosContainer = document.getElementById('productosContainer');
            const productoTemplate = document.getElementById('productoTemplate')?.content;

            if (agregarProductoBtn && productosContainer && productoTemplate) {
                agregarProductoBtn.addEventListener('click', () => {
                    const nuevoProducto = productoTemplate.cloneNode(true);
                    productosContainer.appendChild(nuevoProducto);
                });

                productosContainer.addEventListener('click', (e) => {
                    if (e.target.classList.contains('eliminarProducto')) {
                        e.target.closest('.producto').remove();
                    }
                });
            }
        };

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
                            if (!response.ok) throw new Error(
                                'Error al enviar el formulario.');
                            return response.text();
                        })
                        .then(result => {
                            // Manejar el resultado después de enviar
                            contentDiv.innerHTML = `<p>${result}</p>`;
                            // Reasignar eventos en caso de contenido nuevo
                            setupDynamicEvents();
                            assignFormSubmitHandler();
                            setupCheckboxHandlers();
                        })
                        .catch(err => {
                            contentDiv.innerHTML =
                                `<div><h1>Error</h1><p>Hubo un problema al procesar el formulario.</p></div>`;
                            console.error(err);
                        });
                });
            });
        };

        // Manejar clics en los botones de "Gestionar Envío"
        const setupGestionarEnvioHandler = () => {
            contentDiv.addEventListener('click', (e) => {
                if (e.target.classList.contains('cargarFormulario')) {
                    const notaId = e.target.getAttribute('data-nota-id');

                    // Cargar el formulario dinámicamente
                    fetch(`cargar_formulario_envio.php?nota_id=${notaId}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Error al cargar el formulario.');
                            return response.text();
                        })
                        .then(html => {
                            contentDiv.innerHTML = html;

                            // Asignar eventos al formulario cargado
                            assignFormSubmitHandler();
                            setupCheckboxHandlers();
                        })
                        .catch(err => {
                            console.error(err);
                            contentDiv.innerHTML = "<p>Error al cargar el formulario.</p>";
                        });
                }
            });
        };

        // Inicializar eventos
        setupDynamicEvents();
        assignFormSubmitHandler();
        setupCheckboxHandlers(); // Iniciar la lógica para checkboxes
        setupGestionarEnvioHandler();
    });
</script>


</body>



</html>