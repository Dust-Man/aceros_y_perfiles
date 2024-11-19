document.addEventListener("DOMContentLoaded", () => {
  const productosContainer = document.getElementById("results");
  const paginacionContainer = document.getElementById("pagination");
  const searchInput = document.getElementById("search-input");
  const searchForm = document.querySelector(".form");

  // Función para obtener productos
  async function fetchProductos(page = 1, search = "") {
    try {
      const response = await fetch(
        `php/paginacion.php?pagina=${page}&search=${search}`
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

    if (paginaActual > 1) {
      paginacionContainer.innerHTML += `<a href="#" data-page="${
        paginaActual - 1
      }">&laquo; Anterior</a>`;
    }

    for (let i = 1; i <= totalPaginas; i++) {
      const claseActiva = i === paginaActual ? "active" : "";
      paginacionContainer.innerHTML += `<a href="#" class="${claseActiva}" data-page="${i}">${i}</a>`;
    }

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
        // Desplazar la vista al inicio de la página
        window.scrollTo({
          top: 0,
          behavior: "smooth", // Agrega una transición suave
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

    // Evento para manejar el envío del formulario
    searchForm.addEventListener("submit", (event) => {
      event.preventDefault();
      const searchValue = searchInput.value;
      fetchProductos(1, searchValue);
    });
  }

  // Cargar la primera página al iniciar
  fetchProductos();
});
