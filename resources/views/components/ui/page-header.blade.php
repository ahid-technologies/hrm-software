@props([
    'title' => '',
    'description' => '',
    'leftCol' => 'col-md-6 col-12', // Default width for title section
    'rightCol' => 'col-md-6 col-12 text-md-end text-start', // Default width for buttons
])

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Title Section -->
                        <div class="{{ $leftCol }} mb-2 mb-md-0">
                            <h1 class="h1 text-primary mb-0 text-capitalize">{{ $title }}</h1>
                            <p class="text-muted small mb-0">{{ $description }}</p>
                        </div>

                        <!-- Buttons / Links Section -->
                        <div class="{{ $rightCol }} d-flex gap-2 justify-content-md-end">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
