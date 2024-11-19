document.addEventListener("DOMContentLoaded", () => {
  const productosContainer = document.getElementById("results");
  const paginacionContainer = document.getElementById("pagination");
  const searchInput = document.getElementById("search-input");
  const searchForm = document.querySelector(".form");

  // Función para obtener productos
  async function fetchProductos(page = 1, search = "") {
    try {
      const response = await fetch(
        `php/productos-sucursal-1/paginacion_1.php?pagina=${page}&search=${search}`
      );

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();

      // Verificar si hay un error en los datos
      if (data.error) {
        console.error("Error:", data.error);
        return;
      }

      renderProductos(data.productos);
      renderPaginacion(data.totalPaginas, page);
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  }

  // Función para renderizar los productos
  function renderProductos(productos) {
    productosContainer.innerHTML = "";

    if (productos.length === 0) {
      productosContainer.innerHTML = "<p>No se encontraron productos.</p>";
      return;
    }

    // Crear tarjetas de productos
    productos.forEach((producto) => {
      const productoCard = `
                <div class="card">
                    <div class="card-image">
                        <img src="${
                          producto.imagen || "placeholder.jpg"
                        }" alt="${producto.nombre}">
                    </div>
                    <div class="category">${producto.categoria}</div>
                    <div class="heading">
                        <h3>${producto.nombre}</h3>
                        <p>${producto.descripcion}</p>
                        <span>Precio: $${producto.precio}</span>
                    </div>
                </div>
            `;
      productosContainer.innerHTML += productoCard;
    });
  }

  // Función para renderizar la paginación
  function renderPaginacion(totalPaginas, paginaActual) {
    paginacionContainer.innerHTML = ""; // Limpiar el contenedor de paginación

    // Enlace a la página anterior
    if (paginaActual > 1) {
      paginacionContainer.innerHTML += `<a href="#" data-page="${
        paginaActual - 1
      }">&laquo; Anterior</a>`;
    }

    // Enlaces para todas las páginas
    for (let i = 1; i <= totalPaginas; i++) {
      const claseActiva = i === paginaActual ? "active" : "";
      paginacionContainer.innerHTML += `<a href="#" class="${claseActiva}" data-page="${i}">${i}</a>`;
    }

    // Enlace a la página siguiente
    if (paginaActual < totalPaginas) {
      paginacionContainer.innerHTML += `<a href="#" data-page="${
        paginaActual + 1
      }">Siguiente &raquo;</a>`;
    }
  }

  // Controlador de eventos para la paginación
  paginacionContainer.addEventListener("click", (event) => {
    event.preventDefault();
    const target = event.target;

    if (target.tagName === "A") {
      const page = target.getAttribute("data-page");
      const searchValue = searchInput ? searchInput.value : "";
      if (page) {
        fetchProductos(parseInt(page), searchValue);
        // Desplazar la página hacia la parte superior de los productos
        productosContainer.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    }
  });
  if (searchInput) {
    searchInput.addEventListener("input", (e) => {
      const searchValue = e.target.value;
      fetchProductos(1, searchValue);
    });
  }

  // Evento para el reset del buscador
  if (searchForm) {
    searchForm.addEventListener("reset", () => {
      setTimeout(() => {
        fetchProductos(1, "");
      }, 0);
    });
  }

  // Cargar la primera página al iniciar
  fetchProductos();
});
