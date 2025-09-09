<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                @include('partials.auth-logo', ['width' => 200]) </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ app_favicon() }})"></span>
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
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <x-ui.nav-item icon="ti ti-home" route="{{ route('dashboard') }}" title="Dashboard" />

                <x-ui.nav-item icon="ti ti-users" route="{{ route('staff.index') }}" title="Staff Management" />

                <x-ui.nav-item icon="ti ti-clock" route="{{ route('attendance.index') }}" title="Staff Attendance" />

                <x-ui.nav-item icon="ti ti-file-text" route="{{ route('documents.index') }}" title="Docs. Management" />

                <x-ui.nav-item icon="ti ti-file-check" route="{{ route('work-checks.index') }}" title="Work Checks" />

                <x-ui.nav-item icon="ti ti-bell" route="{{ route('notifications.index') }}" title="Notifications" />

                <x-ui.nav-item icon="ti ti-settings" route="{{ route('settings.index') }}" title="Settings" />
            </ul>

            {{-- Company Info - Desktop Only --}}
            <div class="d-none d-lg-block mt-auto mb-3">
                <div class="card border-0">
                    <div class="card-body p-3">
                        <div class="text-center">
                            <div class="h6 text-white mb-2">
                                <i class="ti ti-code text-primary me-1"></i>
                                Developed by
                            </div>
                            <div class="fw-bold mb-2">Ahid Technologies</div>
                            <div class="small text-muted mb-1">
                                <i class="ti ti-mail text-secondary me-1"></i>
                                <a href="mailto:info@ahidtechnologies.com" class="text-decoration-none text-muted">
                                    info@ahidtechnologies.com
                                </a>
                            </div>
                            <div class="small text-muted">
                                <i class="ti ti-phone text-secondary me-1"></i>
                                <a href="tel:+923437753509" class="text-decoration-none text-muted me-2">
                                    +92 343 7753509
                                </a>
                                <a href="https://wa.me/+923437753509" target="_blank"
                                    class="text-decoration-none text-success" title="WhatsApp">
                                    <i class="ti ti-brand-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
