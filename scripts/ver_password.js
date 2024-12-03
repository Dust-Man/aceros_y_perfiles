
const passwordInput = document.getElementById('password');
const togglePasswordIcon = document.getElementById('seepassword');


togglePasswordIcon.addEventListener('click', () => {

    const inputType = passwordInput.getAttribute('type');

    if (inputType === 'password') {
        passwordInput.setAttribute('type', 'text');
    } else {
        passwordInput.setAttribute('type', 'password');
    }
});
