// public/js/auth.js
function togglePassword(id) {
    const passwordField = document.getElementById(id);
    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input');
    const submitBtn = form.querySelector('button[type="submit"]');

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            let allFilled = true;
            inputs.forEach(input => {
                if (!input.value) {
                    allFilled = false;
                }
            });
            submitBtn.disabled = !allFilled;
        });
    });
});
