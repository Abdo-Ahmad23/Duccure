<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

    <!-- Profile Sidebar -->
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="/{{ Auth::guard('doctor')->user()->image }}" alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3>Dr. {{ Auth::guard('doctor')->user()->first_name }} {{Auth::guard('doctor')->user()->second_name}}</h3>

                    <div class="patient-details">
                        <h5 class="mb-0">{{ Auth::guard('doctor')->user()->bio }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li>
                        <a href="{{ route('doctor.dashboard') }}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('doctor.appointments') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Appointments</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('doctor.profile.setting') }}">
                            <i class="fas fa-user-cog"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>

                    <li>
                        <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a href=""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
