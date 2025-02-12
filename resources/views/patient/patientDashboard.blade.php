<!DOCTYPE html>
<html lang="en">

<!-- doccure/patient-dashboard.html  30 Nov 2019 04:12:16 GMT -->

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

                    <!-- Profile Sidebar -->
                    @include('patient.layouts.sidebar')

                    <!-- / Profile Sidebar -->

                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body pt-0">

                                <!-- Tab Menu -->
                                <nav class="user-tabs mb-4">
                                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#pat_appointments"
                                                data-toggle="tab">Appointments</a>
                                        </li>

                                    </ul>
                                </nav>
                                <!-- /Tab Menu -->

                                <!-- Tab Content -->
                                <div class="tab-content pt-0">

                                    <!-- Appointment Tab -->
                                    <div id="pat_appointments" class="tab-pane fade show active">
                                        <div class="card card-table mb-0">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Doctor</th>
                                                                <th>Booking Date</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            @isset($appointments)
                                                            @foreach ($appointments as $appointment)
                                                            <tr>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="doctor-profile.html"
                                                                            class="avatar avatar-sm mr-2">
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="/{{ $appointment->doctor->image }}"
                                                                                alt="User Image">
                                                                        </a>
                                                                        <a href="doctor-profile.html">Dr.
                                                                            {{ $appointment->doctor->first_name }}
                                                                            <span>Dental</span></a>
                                                                    </h2>
                                                                </td>

                                                                <td>{{ $appointment->created_at->diffForHumans() }}
                                                                </td>
                                                                <td>$250</td>

                                                                <td>
                                                                    @if ($appointment->status == 'pending')
                                                                        <span
                                                                        class="btn btn-sm bg-warning-light">{{ $appointment->status }}</span>
                                                                    @elseif ($appointment->status == 'accepted')
                                                                        <span
                                                                        class="btn btn-sm bg-success-light">{{ $appointment->status }}</span>
                                                                    @elseif ($appointment->status == 'rejected')
                                                                        <span
                                                                        class="btn btn-sm bg-danger-light">{{ $appointment->status }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="table-action">
                                                                        <form id="cancel-form"
                                                                            action="{{ route('cancel.appointment') }}"
                                                                            method="POST" style="display: none;">
                                                                            @csrf
                                                                            <input type="hidden" name="appointmentId"
                                                                                value="{{ $appointment->id }}">
                                                                        </form>
                                                                        <a href=""
                                                                            class="btn btn-sm bg-danger-light"
                                                                            onclick="event.preventDefault(); document.getElementById('cancel-form').submit();">
                                                                            <i class="far fa-trash-alt"></i> Cancel
                                                                            {{-- <span>Book Now</span> --}}
                                                                        </a>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                            @endisset




                                                        </tbody>
                                                    </table>
                                                    @if($appointments->isEmpty())
                                                    <div>
                                                        <h1 class="btn btn-sm bg-danger-light w-100 mt-2">No Appointments</h1>
                                                    </div>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Appointment Tab -->


                                </div>
                                <!-- Tab Content -->

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

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

<!-- doccure/patient-dashboard.html  30 Nov 2019 04:12:16 GMT -->

</html>
