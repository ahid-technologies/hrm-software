@extends('layouts.auth')
@section('title', 'Get Documents')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                @include('partials.auth-logo') </a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Get Documents for Enrollment</h2>
                <form action="{{ route('guest.documents.download') }}" method="POST" autocomplete="off" validate>
                    @csrf
                    <div class="mb-3" id="passport-number-input">
                        <label class="form-label">Passport Number</label>
                        <input type="text" class="form-control" name="passport_number" id="passport_number"
                            autocomplete="off" required maxlength="9" placeholder="Enter your 9 character passport number">
                    </div>
                    <div class="mb-3" id="enrollment-select" style="display: none;">
                        <label class="form-label" for="enrollment_id">Enrollments: <span
                                class="text-danger">*</span></label>
                        <select name="enrollment_id" id="enrollment_id" class="form-select">
                            <option value="" selected disabled>Select Enrollment</option>
                        </select>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100" id="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $().ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();

                $('#submit-btn').prop("disabled", true).text("Processing...");

                var form = $(this);
                var passportNumber = $('#passport_number').val();
                var enrollmentId = $('#enrollment_id').val();
                var actionUrl = $(this).attr('action');

                // Submit passport number for validation and enrollment retrieval
                if (passportNumber && !enrollmentId) {
                    $.ajax({
                        type: 'POST',
                        url: actionUrl,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            passport_number: passportNumber
                        },
                        success: function(response) {
                            // Populate enrollments select box
                            $('#enrollment_id').html('');
                            $.each(response.enrollments, function(key, value) {
                                $('#enrollment_id').append('<option value="' + value
                                    .id +
                                    '">' + value.name + '</option>');
                            });
                            // Show enrollment select box
                            $('#enrollment_id').parent().show();
                            // Hide passport number input
                            $('#passport_number').prop('disabled', true);
                        },
                        error: function(xhr) {
                            showErrors(xhr);
                        },
                        complete: function() {
                            $('#submit-btn').prop("disabled", false).text("Submit");
                        }
                    });
                }
                // Submit enrollment ID to retrieve documents
                else if (enrollmentId) {
                    $.ajax({
                        type: 'POST',
                        url: actionUrl,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            enrollment_id: enrollmentId,
                            passport_number: passportNumber
                        },
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(response) {
                            // Create a Blob from the PDF response
                            const blob = new Blob([response], {
                                type: 'application/pdf'
                            });

                            // Generate a URL for the Blob
                            const url = window.URL.createObjectURL(blob);

                            // Open the PDF in a new tab or prompt download
                            const link = document.createElement('a');
                            link.href = url;
                            link.download = 'grafton-academy-document.pdf';
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);

                            // Download documents
                            form[0].reset();

                            // Reset dynamically populated dropdowns
                            $('#passport_number').prop('disabled', false);

                            $('#enrollment_id').html(
                                    '<option value="">Select Enrollment</option>').parent()
                                .hide();
                        },
                        error: function(xhr) {
                            showErrors(xhr);
                        },
                        complete: function() {
                            $('#submit-btn').prop("disabled", false).text("Submit");
                        }
                    });
                }
            });

            function showErrors(xhr) {
                let errorMessage = "";

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(
                        xhr.responseJSON.errors,
                        function(key, value) {
                            errorMessage += value + "\n";
                        }
                    );
                } else if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                } else if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {
                    errorMessage = xhr.responseJSON.message;
                } else {
                    errorMessage =
                        "An error occurred. Please try again.";
                }

                toastr.error(errorMessage, "Error");
            }
        });
    </script>
@endpush
