// Validaciones de los inputs y envío de formulario
document
  .getElementById("form_new_user")
  .addEventListener("submit", async function (event) {
    event.preventDefault(); // Evitar envío por defecto

    const usernameField = document.getElementById("usuario");
    const passwordField = document.getElementById("password");

    const usernameError = document.getElementById("usernameError");
    const passwordError = document.getElementById("passwordError");

    const username = usernameField.value.trim();
    const password = passwordField.value;

    const regexSimbolos = /[!@#$%^&*(),.?":{}|<>]/;

    let isValid = true;

    // Validación de usuario
    if (!username) {
      usernameError.style.display = "block";
      usernameField.classList.add("input-error");
      isValid = false;
    } else {
      usernameError.style.display = "none";
      usernameField.classList.remove("input-error");
    }

    // Validación de contraseña
    if (
      password.length < 8 ||
      password.length > 15 ||
      !regexSimbolos.test(password)
    ) {
      passwordError.style.display = "block";
      passwordField.classList.add("input-error");
      passwordField.value = ""; // Limpiar el campo en caso de error
      isValid = false;
    } else {
      passwordError.style.display = "none";
      passwordField.classList.remove("input-error");
    }

    // Si es válido,
    if (isValid) {
      const formData = new FormData(this);

      try {
        const response = await fetch("./insert_usuario.php", {
          method: "POST",
          body: formData,
        });

        if (!response.ok) {
          throw new Error("Error en la respuesta del servidor.");
        }

        alert_bien();
        const result = await response.text();

        document.getElementById("close").addEventListener("click", function () {
          document.getElementById("form_new_user").reset();
        });

        
      } catch (error) {
        console.error("Error:", error);
        alert("Ha ocurrido un error. Inténtalo nuevamente.");
      }
    }
  });
function alert_bien() {
  document.getElementById("success").style.display = "flex";
}

function cerrarAlerta() {
  document.getElementById('success').style.display = "none";
  document.getElementById("form_new_user").reset();


}
document.getElementById('close').addEventListener('click', cerrarAlerta);