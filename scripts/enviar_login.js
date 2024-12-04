document.addEventListener("DOMContentLoaded", () => {
    const texto_error=document.getElementById("error");
    const passwordField = document.getElementById("password");
    const form = document.getElementById("login");
    form.addEventListener("submit", async (event) => {
        event.preventDefault(); 
        const formData = new FormData(form);

        try {
            const response = await fetch("../post_login.php", {
                method: "POST",
                body: formData,
            });
            const result = await response.json();

            if (result.status === 'success') {
                // Redirige a la página indicada
                window.location.href = result.redirect;
            } else {
                texto_error.style.display="block";

            }
                } catch (error) {
          //  console.error("Error:", error);
            texto_error.style.display="block";
            passwordField.value="";

        }
        form.reset();
    });
});

// Funciones para mostrar y ocultar loader
function mostrarLoader() {
    document.getElementById("loader").style.display = "flex";
    document.querySelector(".button-submit").disabled = true;
  }
  
  function ocultarLoader() {
    document.getElementById("loader").style.display = "none";
    document.querySelector(".button-submit").disabled = false;
  }
  