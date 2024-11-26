document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form_new_user");
    form.addEventListener("submit", async (event) => {
        event.preventDefault(); 
        const formData = new FormData(form);

        try {

            const response = await fetch("../insert_usuario.php", {
                method: "POST",
                body: formData,
            });

            
                } catch (error) {
            console.error("Error:", error);
            mensajeDiv.innerHTML = "Ha ocurrido un error. Inténtalo nuevamente.";
        }
        form.reset();
    });
});
