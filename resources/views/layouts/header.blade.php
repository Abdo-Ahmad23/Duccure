<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <a href="{{ route('home') }}" class="navbar-brand logo">
                <img src="{{asset('assets/img/logo.png')}}" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{ route('home') }}" class="menu-logo">
                    <img src="{{asset('assets/img/logo.png')}}" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                <li class="active">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="login-link">
                    <a href="{{route('patientLogin')}}">Login / Signup</a>
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            <li class="nav-item contact-item">
                <div class="header-contact-img">
                    <i class="far fa-hospital"></i>
                </div>
                <div class="header-contact-detail">
                    <p class="contact-header">Contact</p>
                    <p class="contact-info-header"> +1 315 369 5943</p>
                </div>
            </li>
            <li class="nav-item">
                @if(Auth::guard('patient')->check() or Auth::guard('doctor')->check())
                @if(Auth::guard('patient')->check())
                <li><a href="{{ route('dashboardPatient') }}">Profile</a></li>
                @elseif (Auth::guard('doctor')->check())
                <li><a href="{{ route('doctor.dashboard') }}">Profile</a></li>
                @endif
                @if ((Auth::guard('patient')->check()))
                <li>
                    <form id="logout-form" action="{{ route('patientLogout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
                @elseif ((Auth::guard('doctor')->check()))
                <li>
                    <form id="logout-form2" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();">Logout</a>
                </li>
                @endif
            @else
                <li><a href="{{ route('patientLogin') }}">Login</a></li>
                <li><a href="{{ route('patientRegister') }}">Register</a></li>
            @endif
            </li>
        </ul>
    </nav>
</header>
