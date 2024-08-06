<!DOCTYPE html>
<html lang="en">

<!-- doccure/favourites.html  30 Nov 2019 04:12:16 GMT -->

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

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('layouts.header')
        <!-- /Header -->

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">

                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Doctors</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Doctors</h2>
                    </div>
                </div>
            </div>
        </div>
        @if (session('status')=="Appointment request sent!")
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @elseif (session('status')!="Appointment request sent!" and session('status')!='')
                <div class="alert alert-danger text-center">
                    <p>Appointment request was not sent!</p>
                </div>
                @endif

        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('patient.layouts.sidebar')

                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="row row-grid">
                            @foreach ($doctors as $doctor)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile.html">
                                                <img class="img-fluid" alt="User Image" src="/{{ $doctor->image }}">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile.html">Dr. {{ $doctor->first_name }}
                                                    {{ $doctor->second_name }}</a>
                                                <i class="fas fa-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">{{ $doctor->bio }}</p>

                                            <ul class="available-info">
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i> {{ $doctor->country }}
                                                </li>

                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> {{ $doctor->pricing }} <i
                                                        class="fas fa-info-circle" data-toggle="tooltip"
                                                        title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="row row-sm">
                                                <div class="col-6">
                                                    {{-- <a href="doctor-profile.html" class="btn view-btn">View Profile</a> --}}
                                                    <form id="view-form" action="{{ route('send.doctor.id') }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="doctorId"
                                                            value="{{ $doctor->id }}">
                                                    </form>
                                                    <a href="" class="btn view-btn"
                                                        onclick="event.preventDefault(); document.getElementById('view-form').submit();">
                                                        {{-- <i class="fas fa-sign-out-alt"></i> --}}
                                                        <span>View Profile</span>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    {{-- <a href="booking.html" class="btn book-btn">Book Now</a> --}}
                                                    <form id="book-form" action="{{ route('make.appointment') }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="doctorId"
                                                            value="{{ $doctor->id }}">
                                                    </form>
                                                    <a href="" class="btn view-btn"
                                                        onclick="event.preventDefault(); document.getElementById('book-form').submit();">
                                                        {{-- <i class="fas fa-sign-out-alt"></i> --}}
                                                        <span>Book Now</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach





                        </div>
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

    <!-- Sticky Sidebar JS -->
    <script src="{{ asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>


</html>
