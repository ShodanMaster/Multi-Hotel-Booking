@extends('app.layout')
@section('main')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white text-center bg-success fs-4">
            <span id="form-title">Hotel Register</span>
        </div>

        <form action="{{route('hotel.hotelregister')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" required>
                </div>
                <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" id="signup-email" placeholder="Email" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="password" id="signup-password" placeholder="Password" required>
                            <!-- Toggle show password -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="show-regitser-password" />
                                <label class="form-check-label" for="show-regitser-password">Show Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="password_confirmation" id="signup-password-confirmation" placeholder="Confirmation Password" required>
                        </div>
                    </div>
                </div>

                <!-- Link to Login form -->
                <div class="form-group text-center mb-3">
                    <p>Already have an account? <a href="{{route('login')}}" id="show-login-form">Login</a></p>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary">Register</button>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            // Toggle password visibility for signup form (password)
            $('#show-regitser-password').change(function() {
                var registerPasswordField = $('#signup-password');
                if ($(this).prop('checked')) {
                    registerPasswordField.attr('type', 'text');
                } else {
                    registerPasswordField.attr('type', 'password');
                }
            });

            $(document).on('submit', '#register-form', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{route('hotel.hotelregister')}}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);

                        if (response.status == 200) {
                            // Flash success message using SweetAlert2
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });

                            setTimeout(function() {
                                window.location.href = response.url;
                            }, 2000);
                        } else {
                            // Flash error message using SweetAlert2
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Flash error if request fails and show the specific error message

                        // If validation errors are returned from Laravel
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            let errorMessage = 'Validation errors occurred:';

                            // Loop through the validation errors and show them in a single message
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                errorMessage += `\n${messages.join(', ')}`;
                            });

                            // Show the validation errors in SweetAlert2
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Errors!',
                                text: errorMessage,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // If some other error occurs (e.g., server error)
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong. Please try again.',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });

            });

        });
    </script>
@endsection
