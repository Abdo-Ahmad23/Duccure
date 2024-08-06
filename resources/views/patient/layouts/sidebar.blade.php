<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

    <!-- Profile Sidebar -->
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="/{{Auth::guard('patient')->user()->image}}" alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3>{{Auth::guard('patient')->user()->first_name}} {{Auth::guard('patient')->user()->second_name}}</h3>
                    <div class="patient-details">
                        <h5><i class="fas fa-birthday-cake"></i> {{Auth::guard('patient')->user()->date_of_birth}} </h5>
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{Auth::guard('patient')->user()->state}}, {{Auth::guard('patient')->user()->country}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li>
                        <a href="{{route('dashboardPatient')}}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('patientDoctors')}}">
                            <i class="fas fa-user-md"></i>
                            <span>Doctors</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('patientProfileSettings')}}">
                            <i class="fas fa-user-cog"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('patientChangePassword')}}">
                            <i class="fas fa-lock"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('patientLogout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
    <!-- /Profile Sidebar -->

</div>
