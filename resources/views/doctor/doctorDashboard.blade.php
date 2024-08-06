<!DOCTYPE html>
<html lang="en">

<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:03 GMT -->

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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

  <![endif]-->

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
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    @include('doctor.layouts.sidebar')

                    <div class="col-md-7 col-lg-8 col-xl-9">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card dash-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6">
                                                <div class="dash-widget dct-border-rht">
                                                    <div class="circle-bar circle-bar1">
                                                        <div class="circle-graph1" data-percent="75">
                                                            <img src="{{ asset('assets/img/icon-01.png') }}"
                                                                class="img-fluid" alt="patient">
                                                        </div>
                                                    </div>
                                                    <div class="dash-widget-info">
                                                        <h6>Total Patient</h6>
                                                        <h3>{{$patientCount}}</h3>
                                                        <p class="text-muted">Till Today</p>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-12 col-lg-6">
                                                <div class="dash-widget">
                                                    <div class="circle-bar circle-bar3">
                                                        <div class="circle-graph3" data-percent="50">
                                                            <img src="{{ asset('assets/img/icon-03.png') }}"
                                                                class="img-fluid" alt="Patient">
                                                        </div>
                                                    </div>
                                                    <div class="dash-widget-info">
                                                        <h6>Appoinments</h6>
                                                        <h3>{{$appointmentCount}}</h3>
                                                        <p class="text-muted">06, Apr 2019</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4">Patient Appoinment</h4>
                                <div class="appointments">

                                    <!-- Appointment List -->

                                    @foreach ($appointments as $appointment)
                                        <div class="appointment-list">
                                            <div class="profile-info-widget">
                                                <a href="patient-profile.html" class="booking-doc-img">
                                                    <img src="/{{ $appointment->patient->image }}" alt="User Image">
                                                </a>
                                                <div class="profile-det-info">
                                                    <h3><a href="patient-profile.html">{{ $appointment->patient->first_name }}
                                                            {{ $appointment->patient->second_name }}</a></h3>
                                                    <div class="patient-details">
                                                        <h5><i class="far fa-clock"></i>
                                                            {{ $appointment->created_at->diffForHumans() }}</h5>
                                                        <h5><i class="fas fa-map-marker-alt"></i>
                                                            {{ $appointment->patient->country }}
                                                        </h5>
                                                        <h5><i class="fas fa-envelope"></i>
                                                            {{ $appointment->patient->email }}</h5>
                                                        <h5 class="mb-0"><i class="fas fa-phone"></i>
                                                            {{ $appointment->patient->mobile }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="appointment-action">


                                                <form id="accept-form" action="{{ route('accept.form') }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="appointmentId"
                                                        value="{{ $appointment->id }}">
                                                </form>
                                                <form id="cancel-form" action="{{ route('cancel.form') }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="appointmentId"
                                                        value="{{ $appointment->id }}">
                                                </form>
                                                @if ($appointment->status=='pending')
                                                <a href="" class="btn btn-sm bg-success-light"
                                                    onclick="event.preventDefault(); document.getElementById('accept-form').submit();">
                                                    <i class="fas fa-check"></i> Accept
                                                </a>
                                                <a href="" class="btn btn-sm bg-danger-light"
                                                 onclick="event.preventDefault(); document.getElementById('cancel-form').submit();">

                                                    <i class="fas fa-times"></i> Cancel
                                                </a>
                                                @elseif ($appointment->status=='accepted')
                                                <a href="" class="btn btn-sm bg-danger-light"
                                                 onclick="event.preventDefault(); document.getElementById('cancel-form').submit();">

                                                    <i class="fas fa-times"></i> Cancel
                                                </a>
                                                @else
                                                <a href="" class="btn btn-sm bg-success-light"
                                                    onclick="event.preventDefault(); document.getElementById('accept-form').submit();">
                                                    <i class="fas fa-check"></i> Accept
                                                </a>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                    @if($appointments->isEmpty())
                                                    <div>
                                                        <h1 class="btn btn-sm bg-danger-light w-100 mt-2">No Appointments</h1>
                                                    </div>
                                                @endif

                                </div>
                            </div>
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

    <!-- Circle Progress JS -->
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:09 GMT -->

</html>
