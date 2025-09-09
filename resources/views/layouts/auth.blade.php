<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ app_favicon() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ app_favicon() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ app_favicon() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS files -->
    @livewireStyles()
    @vite(['resources/css/app.css', 'resources/css/custom.css'])
    @stack('styles')
</head>

<body class="d-flex flex-column">
    <div class="page justify-content-start justify-content-md-center">

        <!-- Content -->
        @yield('content')

    </div>

    <!-- JS files -->
    @livewireScripts()
    @vite(['resources/js/app.js', 'resources/js/custom.js'])
    @include('assets.scripts')
    @include('components.alerts')
    @stack('scripts')
</body>

</html>
