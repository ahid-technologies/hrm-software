@extends('layouts.auth')
@section('title', 'Apply Now')
@section('content')
    <div class="container w-md-50 py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                @include('partials.auth-logo') </a>
        </div>
        <form class="card card-md" action="{{ route('students.register') }}" method="POST" autocomplete="off">
            @csrf
            @method('POST')
            <div class="card-body">
                <h2 class="card-title text-center mb-4 font-xl">Admission Application</h2>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="name">Name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" required
                            maxlength="30">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="email">Email : <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" autocomplete="off"
                            required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="date_of_birth">Date Of Birth : <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                            autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="passport_number">Passport Number : <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="passport_number" id="passport_number"
                            autocomplete="off" required maxlength="9">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="country">Nationality: <span class="text-danger">*</span></label>
                        <select name="country" id="country" class="form-select" autocomplete="off" required>
                            <option value="" selected>Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="address">Address : <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="address" id="address" autocomplete="off" required
                            maxlength="100">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="course">Course: <span class="text-danger">*</span></label>
                        <select name="course" id="course" class="form-select" autocomplete="off" required>
                            <option value="" selected>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="batch">Batch: <span class="text-danger">*</span></label>
                        <select name="batch" id="batch" class="form-select" autocomplete="off" required>
                            <option value="" selected>Select Batch</option>
                        </select>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Apply</button>
                </div>
            </div>
        </form>
        @if (Route::has('guest.documents'))
            <div class="text-center text-secondary mt-3">
                Already enrolled? <a href="{{ route('guest.documents') }}" tabindex="-1">Get Documents</a>
            </div>
        @endif

    </div>
@endsection
@push('scripts')
    <script>
        $().ready(function() {
            $('form').ajaxForm({});

            $('#course').on('change', function() {
                var courseId = $(this).val();

                if (courseId) {
                    getBatches(courseId);
                }
            });

            function getBatches(courseId) {
                $.ajax({
                    url: '/get-batches',
                    method: 'GET',
                    data: {
                        course_id: courseId
                    },
                    success: function(response) {
                        var batchSelect = $('#batch');
                        batchSelect.empty(); // Clear existing options

                        if (response.batches && response.batches.length > 0) {
                            // Add the selected batch as the first option
                            batchSelect.append(
                                $('<option>', {
                                    value: "",
                                    text: "Select Batch",
                                    disabled: true
                                })
                            );

                            // Populate new options
                            response.batches.forEach(function(batch) {
                                batchSelect.append(
                                    $('<option>', {
                                        value: batch.id,
                                        text: batch.name
                                    })
                                );
                            });
                        } else {
                            // Add a placeholder if no batches are found
                            batchSelect.append(
                                $('<option>', {
                                    value: '',
                                    text: 'No batches available'
                                })
                            );
                        }
                    },
                    error: function() {
                        toastr.error('Failed to load batches. Please try again.', 'Error');
                    }
                });
            }
        });
    </script>
@endpush
