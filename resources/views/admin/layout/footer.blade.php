<script>
        const menuToggle = document.getElementById('menu-toggle');
        const sideMenu = document.getElementById('side-menu');

        sideMenu.style.left = '-250px';

        menuToggle.addEventListener('click', () => {
            if (sideMenu.style.left === '0px') {
                sideMenu.style.left = '-250px';
            } else {
                sideMenu.style.left = '0';
            }
        });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
 
    <script>
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
</script>

   

    