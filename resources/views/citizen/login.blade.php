<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Rental Management System | Citizen Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">
    <script src="{{ asset('admin/js/layout.js') }}"></script>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .form-label{
            color: black;
        }
        .form-control{
            color: black !important;
        }

        .modal-backdrop {
            --vz-backdrop-zindex: 1050;
            --vz-backdrop-bg: #000;
            --vz-backdrop-opacity: 0.5;
            position: unset !important;
            top: 0;
            left: 0;
            z-index: var(--vz-backdrop-zindex);
            width: 100vw;
            height: 100vh;
            background-color: var(--vz-backdrop-bg);
        }
    </style>

</head>

<body>

    <div class="auth-page-wrapper auth-bg-cover py-1 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <div class="auth-page-content overflow-hidden pt-lg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden card-bg-fill border-0 card-border-effect-none" style="background-color: #ececec">
                            <div class="row g-0">
                                <div class="col-lg-7">
                                    <img src="{{ asset('admin/images/(SRA).jpg') }}" alt="" width="100%" height="100%">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100 d-none">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="{{ asset('admin/images/logo-light.png') }}" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white pb-5">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="p-lg-3 p-1">
                                        <div class="text-center">
                                            <img  src="{{ asset('admin/images/Slum-Rehabilitation-Authority-Mumbai (1).png') }}" height="40%" width="40%" alt="">
                                            <h5 class="text-dark text-center pt-3">नागरिक लॉगिन मध्ये आपले स्वागत आहे</h5>
                                        </div>

                                        <div class="mt-2">
                                            <form id="loginForm">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="username" id="username" placeholder="Enter username">
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a id="forgot-password" style="cursor: pointer" class="text-dark">Forgot password?</a>
                                                    </div>
                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password" name="password" >
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember_me">
                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                </div> --}}

                                                <div class="mt-4 text-center">
                                                    <button class="btn btn-primary w-20" type="submit" id="loginForm_submit">Sign In</button>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="mt-4 text-center text-dark">
                                            <p class="mt-0">Don't have an account ? <a href="{{route('citizenRegistration')}}" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
                                        </div>

                                        <!-- Forgot Password Modal -->
                                        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-white text-dark">
                                                        <h5 class="modal-title text-dark" id="forgotPasswordModalLabel">Forgot Password</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body bg-white">
                                                        <form id="forgotPasswordForm">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email Address</label>
                                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">Send Password</button>
                                                                <button type="submit" data-bs-dismiss="modal" aria-label="Close" class="btn btn-primary">Close</button>
                                                            </div>
                                                            <div id="forgotPasswordMessage" class="mt-3"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> RMS. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/plugins.js') }}"></script> --}}
    <script src="{{ asset('admin/js/pages/password-addon.init.js') }}"></script>
</body>

<script>
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        $("#loginForm_submit").prop('disabled', true);
        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('citizenLogin') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                if (!data.error && !data.error2) {
                        window.location.href = '{{ route('dashboard') }}';
                } else {
                    if (data.error2) {
                        swal("Error!", data.error2, "error");
                        $("#loginForm_submit").prop('disabled', false);
                    } else {
                        $("#loginForm_submit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(data.error);
                    }
                }
            },
            error: function(error) {
                $("#loginForm_submit").prop('disabled', false);
                swal("Error occured!", "Something went wrong please try again", "error");
            },
        });

        function resetErrors() {
            var form = document.getElementById('loginForm');
            var data = new FormData(form);
            for (var [key, value] of data) {
                console.log(key, value)
                $('.' + key + '_err').text('');
                $('#' + key).removeClass('is-invalid');
                $('#' + key).addClass('is-valid');
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
                console.log(key);
                $('.' + key + '_err').text(value);
                $('#' + key).addClass('is-invalid');
            });
        }

    });
</script>

<script>
    $(document).ready(function() {
        // Show modal when "Forgot password?" link is clicked
        $('#forgot-password').on('click', function(e) {
            e.preventDefault();
            $('#forgotPasswordModal').modal('show');
        });

        // Handle form submission
        $('#forgotPasswordForm').submit(function(e) {
            e.preventDefault();
            var formdata = new FormData(this);

            $.ajax({
                url: '{{ route('password.email') }}',
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#forgotPasswordMessage').html('<div class="alert alert-success">Password has been sent to your email.</div>');
                    $('#forgotPasswordForm')[0].reset(); // Reset form
                },
                error: function(error) {
                    $('#forgotPasswordMessage').html('<div class="alert alert-danger">Error: ' + error.responseJSON.message + '</div>');
                }
            });
        });
    });
</script>


</html>
