<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl d-flex justify-content-end">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-start">
            <div class="d-none d-md-flex me-2">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-moon font-xl"></i>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-sun font-xl"></i>
                </a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm rounded-circle"
                        style="background-image: url({{ asset('icons/favicon-32x32.png') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div class="h4 m-0">{{ Auth::user()->name }}</div>
                        <div class="small text-secondary">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                    <div class="dropdown-divider m-0"></div>
                    <button type="submit" form="logoutForm" class="dropdown-item text-danger font-bold">Logout</a>
                </div>
                <form action="{{ route('logout') }}" method="post" id="logoutForm">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
