<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">{{ $content->com_name }}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> 
    <!-- Navbar Clock-->
    <p class="text-white dashboard-date mb-0"><i class="far fa-clock"></i> {{ date('l, j F Y,') }} <span id="timer"></span></p>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if (isset(Auth::user()->image))
                    <img class="profile-img" src="{{ asset(Auth::user()->image) }}" alt=""> 
                @else
                    <img class="profile-img" src="{{ asset('images/profile.png') }}" alt=""> 
                @endif
                <span class="common-text">{{ Auth::user()->name }}</span></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile',) }}"><i class="fa fa-user"></i> Profile</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="{{route('password.change')}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-unlock"></i> Password </a></li>
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>