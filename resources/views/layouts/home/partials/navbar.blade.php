<style>
    .text-navbar {
        color: #20ad96;
        font-size: 13px;
        font-weight: 600;
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top sticky" id="navbar">
    <div class="container-fluid custom-container">
        <a class="navbar-brand logo text-uppercase" href="{{ route('home') }}">
            <img src="{{ asset('home_assets/images/logo-dark.png') }}" class="logo-light" alt="" height="32">
            <!-- <img src="images/logo-light.png" class="logo-dark" alt="" height="28"> -->
        </a>

        {{--<button class="navbar-toggler me-3 order-2 ms-4" type="button" data-bs-toggle="collapse"--}}
        {{--        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-label="Toggle navigation">--}}
        {{--    <i class="mdi mdi-menu"></i>--}}
        {{--</button>--}}

        {{--<div class="collapse navbar-collapse" id="navbarCollapse">--}}
        {{--    <ul class="navbar-nav mx-auto navbar-center">--}}
        {{--        <li class="nav-item">--}}
        {{--            <a href="#home" class="nav-link ">Home</a>--}}
        {{--        </li>--}}
        {{--    </ul>--}}
        {{--    <!--end navbar-nav-->--}}
        {{--</div>--}}
    
        <!--end navabar-collapse-->
        <div class="header-menu list-inline d-flex align-items-center mb-0 order-1">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link text-navbar" href="{{ route('login') }}">LOGIN</a>
                    </li>
                @endif
        
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-navbar" href="{{ route('register') }}">REGISTER</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-navbar" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ strtoupper(Auth::user()->name) }}
                    </a>
            
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-navbar" href="{{ route('dashboard.index') }}">
                            DASHBOARD
                        </a>
                        <a class="dropdown-item text-navbar" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            LOGOUT
                        </a>
                
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </div>
        
    </div>
    <!--end container-->
</nav>