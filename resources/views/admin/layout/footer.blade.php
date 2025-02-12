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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("/notifications")
            .then(response => response.json())
            .then(data => {
                console.log("Data fetched:", data);
                let content = "";
                if (data.length === 0) {
                    content = "<p class='dropdown-item text-center text-muted'>Tidak ada notifikasi</p>";
                } else {
                    data.forEach(item => {
                        content += `
                            <a class="dropdown-item small" href="#">
                                <strong>${item.no_disposisi}</strong> - ${item.deskripsi_status}
                                <br>
                                <span class="text-muted">${item.nama_petugas} - ${item.waktu_trans}</span>
                                <br>
                                <span class="text-muted">${item.uraian}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                        `;
                    });
                }
                document.getElementById("notificationContent").innerHTML = content;
            });
    });
</script>