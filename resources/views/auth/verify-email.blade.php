@extends('layouts.auth')
@section('title', 'Verify Email')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                @include('partials.auth-logo') </a>
        </div>
        <form class="card card-md" action="{{ route('verification.send') }}" method="POST" autocomplete="off">
            @csrf

            <div class="card-body">
                <h2 class="card-title text-center mb-4">Verify Email</h2>
                <p class="text-secondary mb-4">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-small text-success">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Resend Email</button>
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
