// JavaScript for Password Visibility Toggle
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

function toggleConfirmPasswordVisibility() {
    var confirmPasswordInput = document.getElementById("password_confirmation");
    if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
    } else {
        confirmPasswordInput.type = "password";
    }
}

// Attach event listeners to buttons after the DOM has loaded
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("show_password").addEventListener("click", togglePasswordVisibility);
    document.getElementById("show_confirmation").addEventListener("click", toggleConfirmPasswordVisibility);
});
