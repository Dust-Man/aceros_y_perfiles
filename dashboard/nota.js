document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search");
    const resultTable = document.getElementById("resultTable");
    const resultTableBody = resultTable.querySelector("tbody");
    const selectedProductsTableBody = document.getElementById("selectedProducts");
    const paginationContainer = document.getElementById("pagination");

    let currentPage = 1;  // Página inicial
    let totalPages = 1;   // Total de páginas, que se actualizará desde el backend

    // Función para deshabilitar y habilitar la validación del formulario
    const toggleFormValidation = (disable = true) => {
        const form = document.getElementById("notaForm");
        for (let input of form.querySelectorAll("input, select")) {
            if (input !== searchInput) { // Excluir el campo de búsqueda
                input.disabled = disable;
            }
        }
    };

    // Función de búsqueda de productos con paginación
    const buscarProductos = (searchValue, page = 1) => {
        if (!searchValue.trim()) {
            resultTable.style.display = "none";
            resultTableBody.innerHTML = "";
            paginationContainer.innerHTML = ""; // Limpiar la paginación
            return;
        }

        // Deshabilitar la validación antes de hacer la petición
        toggleFormValidation(true);

        fetch(`./buscar.php?search=${encodeURIComponent(searchValue)}&pagina=${page}`)
            .then(response => {
                if (!response.ok) throw new Error("Error en la solicitud");
                return response.json();
            })
            .then(data => {
                const productos = data.productos || [];
                totalPages = data.totalPaginas || 1; // Actualizar el total de páginas
                currentPage = page; // Actualizar la página actual

                // Limpiar la tabla y mostrar productos
                resultTableBody.innerHTML = "";
                if (productos.length > 0) {
                    productos.forEach(producto => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${producto.nombre}</td>
                            <td>${producto.clave}</td>
                            <td>${producto.descripcion || "N/A"}</td>
                            <td>${producto.precio || "N/A"}</td>
                        `;

                        row.addEventListener("click", () => {
                            agregarProductoSeleccionado(producto);
                        });

                        resultTableBody.appendChild(row);
                    });
                    resultTable.style.display = "";
                } else {
                    resultTable.style.display = "none";
                }

                // Actualizar paginación
                actualizarPaginacion();
            })
            .catch(error => {
                console.error("Error al buscar productos:", error);
                resultTable.style.display = "none";
            })
            .finally(() => {
                // Habilitar la validación después de la actualización
                toggleFormValidation(false);
            });
    };

    // Función para mostrar los botones de paginación
    const actualizarPaginacion = () => {
        paginationContainer.innerHTML = ""; // Limpiar paginación existente

        if (totalPages <= 1) return; // No hay paginación si hay solo una página

        // Botón de página anterior
        if (currentPage > 1) {
            const prevButton = document.createElement("button");
            prevButton.textContent = "Anterior";
            prevButton.addEventListener("click", (e) => {
                e.preventDefault(); // Prevenir comportamiento por defecto
                buscarProductos(searchInput.value, currentPage - 1);
            });
            paginationContainer.appendChild(prevButton);
        }

        // Mostrar primeras 3 páginas y última página
        const maxVisiblePages = 3; // Número máximo de páginas visibles al principio
        let startPage = 1;
        let endPage = totalPages;

        // Mostrar páginas 1 a 3 o hasta la página 1 más algunas cercanas a la actual
        if (totalPages > maxVisiblePages) {
            // Si estamos cerca del principio o final, ajustamos las páginas a mostrar
            if (currentPage <= maxVisiblePages) {
                endPage = maxVisiblePages;
            } else if (currentPage >= totalPages - maxVisiblePages + 1) {
                startPage = totalPages - maxVisiblePages + 1;
            } else {
                startPage = currentPage - 1;
                endPage = currentPage + 1;
            }
        }

        // Botones de páginas
        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement("button");
            pageButton.textContent = i;
            if (i === currentPage) {
                pageButton.disabled = true; // Deshabilitar el botón de la página actual
            }
            pageButton.addEventListener("click", (e) => {
                e.preventDefault(); // Prevenir comportamiento por defecto
                buscarProductos(searchInput.value, i);
            });
            paginationContainer.appendChild(pageButton);
        }

        // Mostrar "..." si es necesario
        if (endPage < totalPages - 1) {
            const dots = document.createElement("a");
            dots.textContent = "...";
            paginationContainer.appendChild(dots);
        }

        // Mostrar la última página
        if (endPage < totalPages) {
            const lastPageButton = document.createElement("button");
            lastPageButton.textContent = totalPages;
            lastPageButton.addEventListener("click", (e) => {
                e.preventDefault(); // Prevenir comportamiento por defecto
                buscarProductos(searchInput.value, totalPages);
            });
            paginationContainer.appendChild(lastPageButton);
        }

        // Botón de página siguiente
        if (currentPage < totalPages) {
            const nextButton = document.createElement("button");
            nextButton.textContent = "Siguiente";
            nextButton.addEventListener("click", (e) => {
                e.preventDefault(); // Prevenir comportamiento por defecto
                buscarProductos(searchInput.value, currentPage + 1);
            });
            paginationContainer.appendChild(nextButton);
        }
    };

    // Agregar producto al formulario de seleccionados
    const agregarProductoSeleccionado = (producto) => {
        const { producto_id, clave, nombre, precio } = producto;

        // Evitar duplicados
        const existingRow = document.querySelector(`#selectedProducts tr[data-id="${producto_id}"]`);
        if (existingRow) {
            alert("El producto ya ha sido agregado.");
            return;
        }

        const row = document.createElement("tr");
        row.dataset.producto_id = producto_id;
        row.innerHTML = `
            <td><input type="hidden" name="producto_id[]" value="${producto_id}">${clave}</td>
            <td>${nombre}</td>
            <td><input type="number" name="cantidad[]" value="1" min="1" required></td>
            <td>${precio}</td>
            <td><button type="button" onclick="eliminarProducto(this)">Eliminar</button></td>
        `;

        selectedProductsTableBody.appendChild(row);
    };

    // Eliminar producto del formulario
    window.eliminarProducto = (button) => {
        const row = button.closest("tr");
        row.remove();
    };

    // Evento para búsqueda dinámica
    searchInput.addEventListener("input", () => {
        const searchValue = searchInput.value;
        buscarProductos(searchValue, 1); // Reseteamos la página a 1 al buscar
    });

    // Enviar el formulario con Fetch API
    document.getElementById("submitBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        const formData = new FormData(document.getElementById("notaForm"));

        // Usar fetch para enviar los datos
        fetch('./registrar-nota.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())  // Esperamos una respuesta de texto
        .then(data => {
            alert(data); // Mostrar la respuesta del servidor

            // Reiniciar el formulario
            document.getElementById("notaForm").reset();  // Reinicia todos los campos del formulario

            // Limpiar la tabla de productos seleccionados
            selectedProductsTableBody.innerHTML = ""; // Elimina las filas de productos seleccionados
            resultTable.style.display = "none"; // Oculta la tabla de resultados de búsqueda
            resultTableBody.innerHTML = ""; // Limpiar resultados de búsqueda
        })
        .catch(error => {
            alert("Hubo un error al registrar la nota: " + error);
        });
    });
});
