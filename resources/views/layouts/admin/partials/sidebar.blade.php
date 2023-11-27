<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    
    <div data-simplebar class="h-100">
        
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                
                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="mdi mdi-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="javascript:(0)" class="has-arrow waves-effect">
                        <i class="mdi mdi-cat"></i>
                        <span>Kucing</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" style="">
                        <li><a href="{{ route('dashboard.cat.create') }}">Tambah Kucing</a></li>
                        <li><a href="{{ route('dashboard.cat.index') }}">List Kucing</a></li>
                        @if(Auth::user()->role === 'admin')
                            <li><a href="{{ route('dashboard.cat-type.index') }}">Jenis Kucing</a></li>
                        @endif
                    </ul>
                </li>
                
                <li class="menu-title">Alat</li>
                <li>
                    <a href="{{ route('logout') }}" class="waves-effect"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            
            </ul>
        
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
