function checkPasswordLength() {
    let passwordInput = document.getElementById("pass_login");
    let warning = document.getElementById("passwordWarning");

    if (passwordInput.value.length > 8) {
        warning.style.display = "inline";
        passwordInput.value = passwordInput.value.substring(0, 8); // Memotong teks agar tidak lebih dari 8 karakter
    } else {
        warning.style.display = "none";
    }
}

function togglePassword() {
    let passwordInput = document.getElementById("pass_login");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
