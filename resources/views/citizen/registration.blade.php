<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/galaxy/auth-signup-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jan 2024 09:25:39 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Citizen Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">
    <!--datatable css-->
    <script src="{{ asset('admin/js/layout.js') }}"></script>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .col-form-label{
            color: black;
        }

        input, select, textarea{
        color: black !important;
    }

    .auth-page-wrapper .auth-page-content {
            padding-bottom: 0px !important;
            position: relative;
            z-index: 2;
            width: 100%;
        }
        
    </style>

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-1 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0 card-bg-fill border-0 card-border-effect-none">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-5">
                                    <img src="{{ asset('admin/images/(SRA).jpg') }}" alt="" width="100%" height="100%">
                                </div>

                                <div class="col-lg-7 bg-white">
                                    <div class="p-lg-4 p-2">
                                        <div class="text-center">
                                            <img  src="{{ asset('admin/images/Group 1 copy 2.png') }}" height="50%" width="50%" alt="">
                                            <h5 class="text-dark text-center pt-3" style="font-weight: bold">नोंदणीमध्ये आपले स्वागत आहे</h5>
                                        </div>

                                        <div class="mt-4">
                                            <form id="registartionForm">
                                                @csrf

                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="citizen_first_name">Citizen First Name (नागरिकाचे पहिले नाव)<span class="text-danger">*</span></label>
                                                        <input class="form-control" id="citizen_first_name" name="citizen_first_name" type="text" placeholder="Enter Citizen First Name" required>
                                                        <span class="text-danger is-invalid citizen_first_name_err"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="citizen_middle_name">Citizen Middle Name (नागरिकाचे मधले नाव)<span class="text-danger">*</span></label>
                                                        <input class="form-control" id="citizen_middle_name" name="citizen_middle_name" type="text" placeholder="Enter Citizen Middle Name" required>
                                                        <span class="text-danger is-invalid citizen_middle_name_err"></span>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="citizen_last_name">Citizen Last Name (नागरिकाचे आडनाव)<span class="text-danger">*</span></label>
                                                        <input class="form-control" id="citizen_last_name" name="citizen_last_name" type="text" placeholder="Enter Citizen Last Name" required>
                                                        <span class="text-danger is-invalid citizen_last_name_err"></span>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="mobile">Citizen Mobile No (नागरिकाचा मोबाईल नंबर)<span class="text-danger">*</span></label>
                                                        <input class="form-control" id="mobile" name="mobile" type="number" placeholder="Enter Citizen Mobile Number" required>
                                                        <span class="text-danger is-invalid mobile_err"></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="email">Citizen Email (नागरिकाचा ईमेल)<span class="text-danger">*</span></label>
                                                        <input class="form-control" id="email" name="email" type="email" placeholder="Enter Citizen Email" required>
                                                        <span class="text-danger is-invalid email_err"></span>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="address">Citizen Address (नागरिकाचा पत्ता)<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="address" id="address" cols="30" rows="3" required></textarea>
                                                        <span class="text-danger is-invalid address_err"></span>
                                                    </div>
                        
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="password">Password (पासवर्ड)<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                                                            <span class="input-group-text" id="togglePassword">
                                                                <i class="fa fa-eye"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="confirm_password">Confirm Password (पासवर्डची पुष्टी करा)<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                                                            <span class="input-group-text" id="togglePasswordnew">
                                                                <i class="fa fa-eye"></i>
                                                            </span>
                                                        </div>
                                                    </div>
    
                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-20" type="submit" id="loginForm_submit">Sign Up</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="mt-3 text-center text-dark">
                                            <p class="mb-0">Already have an account ? <a href="{{route('citizenLoginPage')}}" class="fw-semibold text-primary text-decoration-underline"> Signin</a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer d-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> Crafted with <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/plugins.js') }}"></script> --}}
    <script src="{{ asset('admin/js/pages/password-addon.init.js') }}"></script>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');
    
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>

<script>
    // Toggle password visibility
    document.getElementById('togglePasswordnew').addEventListener('click', function () {
        const passwordField = document.getElementById('confirm_password');
        const icon = this.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

    <script>
        $("#registartionForm").submit(function(e) {
            e.preventDefault();
            $("#loginForm_submit").prop('disabled', true);
            var formdata = new FormData(this);
            $.ajax({
                url: '{{ route('storeCitizenRegistration') }}',
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (!data.error && !data.error2) {
                            swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('citizenLoginPage') }}';
                            });
                            // window.location.href = '{{ route('citizenLoginPage') }}';
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
    
    
</body>

</html>