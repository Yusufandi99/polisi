<header>
    <div class="menu-toggle" id="menu-toggle">&#9776;</div>
    <div class="icons">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="gearDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-gear"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gearDropdown">
                <a class="dropdown-item" href="#">Gear Option 1</a>
                <a class="dropdown-item" href="#">Gear Option 2</a>
            </div>
        </div>

        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="bellDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bellDropdown">
                <a class="dropdown-item" href="#">Bell Option 1</a>
                <a class="dropdown-item" href="#">Bell Option 2</a>
            </div>
        </div>

        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="personDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="personDropdown">
                <a class="dropdown-item" href="#">Person Option 1</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
            </div>
        </div>
    </div>
</header>