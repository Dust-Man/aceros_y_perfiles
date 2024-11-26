document.addEventListener("DOMContentLoaded", () => {
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
                // Muestra el mensaje de error
                alert(result.message);
            }
                } catch (error) {
            console.error("Error:", error);
            mensajeDiv.innerHTML = "Ha ocurrido un error. Inténtalo nuevamente.";
        }
        form.reset();
    });
});
