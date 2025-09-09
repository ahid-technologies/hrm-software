@extends('layouts.admin')
@section('title', 'Profile')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">

            <!-- start page title -->
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Title Section -->
                            <div class="col-md-6 col-12">
                                <h1 class="h2 text-primary mb-0">{{ __('modules.profile') }}</h1>
                                <p class="text-muted small mb-0">{{ __('modules.profile.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <div class="row gy-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="post">
                                @csrf
                                @method('patch')

                                <h4 class="card-title">Profile Information</h4>
                                <p class="card-title-desc">Update your account's profile information and email address.
                                </p>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name: <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text"
                                            value="{{ old('name', $user->name) }}" id="name"
                                            placeholder="Enter your name">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email: <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" type="email"
                                            value="{{ old('email', $user->email) }}" id="email"
                                            placeholder="Enter you email address">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row gx-0 justify-content-end mb-3">
                                    <button type="submit" class="btn btn-md btn-primary rounded w-auto">Update</button>
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('password.update') }}" method="post">
                                @csrf
                                @method('put')

                                <h4 class="card-title">Update Password</h4>
                                <p class="card-title-desc">Ensure your account is using a long, random password to stay
                                    secure.
                                </p>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="current-password" class="col-sm-2 col-form-label">Current Password: <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="current_password"
                                            autocomplete="current-password" id="current-password"
                                            placeholder="Enter your current password">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="password" class="col-sm-2 col-form-label">Password: <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password" id="password"
                                            autocomplete="new-password" placeholder="Enter your new password">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm
                                        Password: <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password_confirmation"
                                            autocomplete="new-password" id="password_confirmation"
                                            placeholder="Confirm your new password">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row gx-0 justify-content-end mb-3">
                                    <button type="submit" class="btn btn-md btn-primary rounded w-auto">Update</button>
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
