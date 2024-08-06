<!DOCTYPE html>
<html lang="en">

<!-- doccure/{{ route('doctor.register') }}  30 Nov 2019 04:12:20 GMT -->

<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">



</head>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">


        <!-- Header -->
        @include('layouts.header')
        <!-- /Header -->

        <!-- Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Register Content -->
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src="{{ asset('assets/img/login-banner.png') }}" class="img-fluid"
                                        alt="Doccure Register">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Patient Register <a href="{{ route('doctor.register') }}">Are you a
                                                Doctor?</a></h3>
                                    </div>

                                    <!-- Register Form -->
                                    <form method="POST" action="{{ route('create_patient') }}">
                                        @csrf

                                        <div class="form-group form-focus">
                                            <input id="first_name" type="text"
                                                class="floating form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ old('first_name') }}" autocomplete="first_name"
                                                autofocus>

                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">Name</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input id="email" type="text"
                                                class="floating form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">Email Address</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input id="password" type="password"
                                                class="floating form-control @error('password') is-invalid @enderror"
                                                name="password" autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">Create Password</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input id="password-confirm" type="password" class="form-control floating"
                                                name="password_confirmation" autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">Check Password</label>
                                        </div>
                                        <div class="text-right">
                                            <a class="forgot-link" href="{{ route('patientLogin') }}">Already have an
                                                account?</a>
                                        </div>
                                        <button class="btn btn-primary btn-block btn-lg login-btn"
                                            type="submit">Signup</button>

                                    </form>
                                    <!-- /Register Form -->

                                </div>
                            </div>
                        </div>
                        <!-- /Register Content -->

                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->



    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

<!-- doccure/{{ route('doctor.register') }}  30 Nov 2019 04:12:20 GMT -->

</html>
