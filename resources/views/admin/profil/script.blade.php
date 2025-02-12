<script>
    function extractAndStoreId() {
        const url = window.location.href;
        const parts = url.split('/');
        const id = parts[parts.length - 1];

        if (!isNaN(id)) {
            localStorage.setItem('profileId', id);

            // Set the hidden input value
            document.getElementById('storedProfileId').value = id;

            const newUrl = url.substring(0, url.lastIndexOf('/'));
            window.history.replaceState(null, document.title, newUrl);
        } else {
            console.error("Invalid ID found in the URL");
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        extractAndStoreId(); // Extract and store on initial load

        // Retrieve from localStorage if it exists (for refreshes)
        const storedId = localStorage.getItem('profileId');
        if (storedId) {
            document.getElementById('storedProfileId').value = storedId;
            console.log("Retrieved Profile ID from localStorage:", storedId);
        }
    });
</script>

<script>
    function validatePassword() {
        const passwordInput = document.getElementById("password");
        const passwordError = document.getElementById("passwordError");

        if (passwordInput.value.length >= 8) {
            passwordError.style.display = "block";
        } else {
            passwordError.style.display = "none";
        }
    }

    function updatePassword() {
        const profileId = document.getElementById("storedProfileId").value;
        const newPassword = document.getElementById("password").value;

        if (newPassword.length > 8) {
            alert("⚠ Password maksimal 8 karakter!");
            return;
        }

        fetch("{{ route('update.profile') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    profile_id: profileId,
                    password: newPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                showAlert(data.message, "success");
                document.getElementById("password").value = ""; // Reset password input
            })
            .catch(error => {
                showAlert("Terjadi kesalahan. Coba lagi!", "danger");
                console.error("Error:", error);
            });
    }

    function showAlert(message, type) {
        const alertDiv = document.getElementById("alertMessage");
        alertDiv.innerHTML = message;
        alertDiv.className = `alert alert-${type} mt-3`;
        alertDiv.classList.remove("d-none");

        // Hilangkan pesan setelah 3 detik
        setTimeout(() => {
            alertDiv.classList.add("d-none");
        }, 3000);
    }
</script>