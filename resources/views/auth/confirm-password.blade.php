@extends('layouts.auth')
@section('title', 'Confirm Password')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                @include('partials.auth-logo') </a>
        </div>
        <form class="card card-md" action="{{ route('password.confirm') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Confirm password</h2>
                <p class="text-secondary mb-4">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
                <div class="mb-3">
                    <label class="form-label">Password: <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter password" name="email">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                            <path d="M3 7l9 6l9 -6" />
                        </svg>
                        {{ __('Confirm') }}
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="link-style">Logout Instead</button>
            </form>
        </div>
    </div>
@endsection
