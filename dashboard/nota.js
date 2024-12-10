document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search");
    const resultTable = document.getElementById("resultTable");
    const resultTableBody = resultTable.querySelector("tbody");
    const selectedProductsTableBody = document.getElementById("selectedProducts");

    // Buscar productos
    const buscarProductos = (searchValue) => {
        if (!searchValue.trim()) {
            resultTable.style.display = "none";
            resultTableBody.innerHTML = "";
            return;
        }

        fetch(`./buscar.php?search=${encodeURIComponent(searchValue)}`)
            .then(response => {
                if (!response.ok) throw new Error("Error en la solicitud");
                return response.json();
            })
            .then(data => {
                const productos = data.productos || [];
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
            })
            .catch(error => {
                console.error("Error al buscar productos:", error);
                resultTable.style.display = "none";
            });
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
        buscarProductos(searchValue);
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
