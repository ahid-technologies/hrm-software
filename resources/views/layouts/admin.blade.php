<!DOCTYPE html>
<html lang="en" data-bs-theme-primary="indigo" data-bs-theme-radius="1.5">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', $title ?? '') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ app_favicon() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ app_favicon() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ app_favicon() }}">

    <!-- Livewire files -->
    @livewireStyles()

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/custom.css'])
    @stack('styles')

</head>

<body class="layout-fluid">

    <div class="page">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Navbar -->
        @include('components.header')

        <!-- Content -->
        <div class="page-wrapper">
            @yield('content')

            {{ $slot ?? '' }}

            <!-- Footer -->
            @include('components.footer')
        </div>

    </div>

    <!-- JS files -->
    @livewireScripts()
    @vite(['resources/js/app.js', 'resources/js/custom.js'])
    @include('assets.scripts')
    @include('components.alerts')
    @stack('scripts')

</body>

</html>
