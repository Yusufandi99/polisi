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