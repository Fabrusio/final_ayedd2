const loginForm = document.getElementById("login-form");
const backToLoginLink = document.getElementById("back-to-login-link");
const note = document.getElementById("password-note");

backToLoginLink.addEventListener('click', function (event) {
    event.preventDefault();
    forgotPasswordForm.style.display = 'none';
    note.style.display = 'block';
    loginForm.style.display = 'block';
});