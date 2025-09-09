<script>
    document.addEventListener("DOMContentLoaded", function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        // Handle validation errors
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}", "Error", {
                    timeOut: 5000
                });
            @endforeach
        @endif

        // Handle session success message
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Success", {
                timeOut: 5000
            });
        @endif

        // Handle profile updated status
        @if (session('status') === 'profile-updated')
            toastr.success("{{ __('Profile Updated Successfully!') }}", "Success", {
                timeOut: 5000
            });
        @endif

        // Handle password update errors
        @if ($errors->updatePassword->has('current_password'))
            toastr.error("{{ $errors->updatePassword->first('current_password') }}", "Error", {
                timeOut: 5000
            });
        @endif
        @if ($errors->updatePassword->has('password'))
            toastr.error("{{ $errors->updatePassword->first('password') }}", "Error", {
                timeOut: 5000
            });
        @endif
        @if ($errors->updatePassword->has('password_confirmation'))
            toastr.error("{{ $errors->updatePassword->first('password_confirmation') }}", "Error", {
                timeOut: 5000
            });
        @endif

        // Handle password updated status
        @if (session('status') === 'password-updated')
            toastr.success("{{ __('Password Updated Successfully!') }}", "Success", {
                timeOut: 5000
            });
        @endif

        // Handle session error message
        @if (session('error'))
            toastr.warning("{{ session('error') }}", "Warning", {
                timeOut: 5000
            });
        @endif
    });
</script>
