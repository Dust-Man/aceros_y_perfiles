document.addEventListener('DOMContentLoaded', () => {
    const formEnvio = document.getElementById('formEnvio');
  
    if (!formEnvio) {
      console.error("Error: No se encontró el formulario con id 'formEnvio'");
      return;
    }
  
    formEnvio.addEventListener('submit', async (e) => {
      e.preventDefault(); // Evita que el formulario se envíe de la manera tradicional
  
      try {
        const formData = new FormData(formEnvio);
  
        console.log("Enviando datos del formulario...");
        const response = await fetch('./insertar_envio.php', {
          method: 'POST',
          body: formData,
        });
  
        if (!response.ok) {
          throw new Error(`Error: ${response.status} ${response.statusText}`);
        }
  
        const result = await response.json(); // Asume que el servidor responde con JSON
        console.log("Respuesta del servidor:", result);
  
        if (result.success) {
          alert('Formulario enviado exitosamente');
        } else {
          alert('Error al enviar el formulario: ' + result.message);
        }
      } catch (error) {
        console.error("Error al enviar el formulario:", error);
        alert('Ocurrió un error inesperado. Intenta nuevamente.');
      }
    });
  });
  