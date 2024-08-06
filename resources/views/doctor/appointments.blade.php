<!DOCTYPE html>
<html lang="en">

<!-- doccure/appointments.html  30 Nov 2019 04:12:09 GMT -->

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
                                <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Appointments</h2>
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
                        <h2 class="text-center my-3">Accepted Appoinments</h2>
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
                                                    {{ $appointment->patient->country }}</h5>
                                                <h5><i class="fas fa-envelope"></i> {{ $appointment->patient->email }}
                                                </h5>
                                                <h5 class="mb-0"><i class="fas fa-phone"></i>
                                                    {{ $appointment->patient->mobile }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="appointment-action">
                                        <form id="accept-form" action="{{ route('accept.form') }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="appointmentId" value="{{ $appointment->id }}">
                                        </form>
                                        <a href="" class="btn btn-sm bg-success-light"
                                        onclick="event.preventDefault(); document.getElementById('accept-form').submit();">
                                            <i class="fas fa-check"></i> Accept
                                        </a>



                                        {{-- <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                            <i class="fas fa-times"></i> Cancel
                                        </a> --}}
                                        <form id="cancel-form" action="{{ route('cancel.form') }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="appointmentId" value="{{ $appointment->id }}">
                                        </form>
                                        <a href="" class="btn btn-sm bg-danger-light"
                                        onclick="event.preventDefault(); document.getElementById('cancel-form').submit();">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                    </div>

                                </div>
                            @endforeach

                            @if ($appointments->isEmpty())
                                <div>
                                    <h1 class="btn btn-sm bg-danger-light w-100 mt-2">No Appointments</h1>
                                </div>
                            @endif








                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->


    </div>
    <!-- /Main Wrapper -->

    <!-- Appointment Details Modal -->
    <div class="modal fade custom-modal" id="appt_details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="info-details">
                        <li>
                            <div class="details-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="title">#APT0001</span>
                                        <span class="text">21 Oct 2019 10:00 AM</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-right">
                                            <button type="button" class="btn bg-success-light btn-sm"
                                                id="topup_status">Completed</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="title">Status:</span>
                            <span class="text">Completed</span>
                        </li>
                        <li>
                            <span class="title">Confirm Date:</span>
                            <span class="text">29 Jun 2019</span>
                        </li>
                        <li>
                            <span class="title">Paid Amount</span>
                            <span class="text">$450</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Appointment Details Modal -->

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

<!-- doccure/appointments.html  30 Nov 2019 04:12:09 GMT -->

</html>
