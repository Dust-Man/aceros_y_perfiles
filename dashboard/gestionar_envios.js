// Manejar clics en los botones de "Gestionar Envío" y cargar el formulario dinámico
const setupGestionarEnvioHandler = () => {
  const contentDiv = document.querySelector('.content');

  if (!contentDiv) {
      console.error("Error: El contenedor principal '.content' no está definido.");
      return;
  }

  // Usar delegación de eventos para evitar duplicados
  contentDiv.addEventListener('click', (e) => {
      try {
          // Buscar el botón más cercano con la clase 'cargarFormulario'
          const button = e.target.closest('.cargarFormulario');
          if (!button) return; // Si no es un botón válido, salir

          const notaId = button.getAttribute('data-nota-id');
          if (!notaId) {
              console.error("Error: El botón no tiene un 'data-nota-id' válido.");
              contentDiv.innerHTML = "<p>Error: No se encontró un ID de nota válido.</p>";
              return;
          }

          console.log(`Nota ID detectada: ${notaId}`);
          contentDiv.innerHTML = "<p>Cargando formulario...</p>";

          fetch(`./cargar_formulario_envio.php?nota_id=${notaId}`)
              .then(response => {
                  if (!response.ok) {
                      const errorMsg = `Error ${response.status}: ${response.statusText}`;
                      console.error(errorMsg);
                      throw new Error(errorMsg);
                  }
                  return response.text();
              })
              .then(html => {
                  if (!html.trim()) {
                      throw new Error("El formulario recibido está vacío.");
                  }

                  // Insertar el contenido del formulario y agregar un enlace para regresar
                  contentDiv.innerHTML = `
                      <div class="formulario-container">
                          <a href="./generar-envio.php" class="btn-regresar">⬅ Regresar</a>
                          ${html}
                      </div>`;

                  console.log("Formulario cargado exitosamente.");
              })
              .catch(err => {
                  console.error("Error al cargar el formulario:", err.message);
                  contentDiv.innerHTML = "<p>Error al cargar el formulario. Por favor, inténtalo nuevamente.</p>";
              });
      } catch (err) {
          console.error("Error inesperado:", err.message);
          contentDiv.innerHTML = "<p>Error inesperado al gestionar el formulario. Revisa la consola para más detalles.</p>";
      }
  });
};

// Inicializar el controlador principal
document.addEventListener('DOMContentLoaded', () => {
  setupGestionarEnvioHandler();
});
