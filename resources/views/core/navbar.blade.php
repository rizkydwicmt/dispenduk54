@section('sidebar-header')
    <img src="http://103.254.169.147/templates/assets/client/img/logo_new.jpg" alt="" srcset="">
@endsection

@section('sidebar-menu')

    <ul class="menu">
        
        <li class='sidebar-title'>Main Menu</li>

        <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }} ">
        <a href="{{ url('/') }}" class='sidebar-link'>
                <i data-feather="home" width="20"></i> 
                <span>Dashboard</span>
            </a>
        </li>

        <li class="
            sidebar-item  has-sub 
            {{ Request::is('dafduk_wni/kk') ? 'active' : '' }} 
            {{ Request::is('dafduk_wni/biodata') ? 'active' : '' }}
            {{ Request::is('dafduk_wni/pindah') ? 'active' : '' }}
            {{ Request::is('dafduk_wni/datang') ? 'active' : '' }}
        ">
            <a href="#" class='sidebar-link'>
                <i data-feather="layers" width="20"></i> 
                <span>Daftar Penduduk WNI</span>
            </a>
            
            <ul class="
                submenu 
                {{ Request::is('dafduk_wni/kk') ? 'active' : '' }} 
                {{ Request::is('dafduk_wni/biodata') ? 'active' : '' }}
                {{ Request::is('dafduk_wni/pindah') ? 'active' : '' }}
                {{ Request::is('dafduk_wni/datang') ? 'active' : '' }}
            ">
                <li style="
                    {{ 
                        Request::is('dafduk_wni/kk') ? 'color: #8be5c0;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('dafduk_wni/kk') }}">Kartu Keluarga</a>
                </li>
                <li style="
                    {{ 
                        Request::is('dafduk_wni/biodata') ? 'color: #8be5c0;border-right: solid;' : '' 
                    }} 
                ">
                    <a href="{{ url('dafduk_wni/biodata') }}">Biodata</a>
                </li>
                <li style="
                        {{ 
                            Request::is('dafduk_wni/pindah') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('dafduk_wni/pindah') }}">Pindah</a>
                </li>
                <li style="
                        {{ 
                            Request::is('dafduk_wni/datang') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('dafduk_wni/datang') }}">Datang</a>
                </li>
            </ul>
        </li>

        <li class="
            sidebar-item  has-sub 
            {{ Request::is('dafduk_oa/kk') ? 'active' : '' }} 
            {{ Request::is('dafduk_oa/biodata') ? 'active' : '' }}
            {{ Request::is('dafduk_oa/pindah') ? 'active' : '' }}
            {{ Request::is('dafduk_oa/datang') ? 'active' : '' }}
        ">
            <a href="#" class='sidebar-link'>
                <i data-feather="layers" width="20"></i> 
                <span>Daftar Penduduk OA</span>
            </a>
            
            <ul class="
                submenu 
                {{ Request::is('dafduk_oa/kk') ? 'active' : '' }} 
                {{ Request::is('dafduk_oa/biodata') ? 'active' : '' }}
                {{ Request::is('dafduk_oa/pindah') ? 'active' : '' }}
                {{ Request::is('dafduk_oa/datang') ? 'active' : '' }}
            ">
                <li style="
                        {{ 
                            Request::is('dafduk_oa/kk') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('dafduk_oa/kk') }}">Kartu Keluarga</a>
                </li>
                <li style="
                        {{ 
                            Request::is('dafduk_oa/biodata') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('dafduk_oa/biodata') }}">Biodata</a>
                </li>
            </ul>
        </li>

        <li class="
            sidebar-item  has-sub 
            {{ Request::is('pencatatan_sipil/kelahiran') ? 'active' : '' }} 
            {{ Request::is('pencatatan_sipil/kematian') ? 'active' : '' }}
            {{ Request::is('pencatatan_sipil/perkawinan') ? 'active' : '' }}
            {{ Request::is('pencatatan_sipil/perceraian') ? 'active' : '' }}
        ">
            <a href="#" class='sidebar-link'>
                <i data-feather="layers" width="20"></i> 
                <span>Pencatatan Sipil</span>
            </a>
            
            <ul class="
                submenu 
                {{ Request::is('pencatatan_sipil/kelahiran') ? 'active' : '' }} 
                {{ Request::is('pencatatan_sipil/kematian') ? 'active' : '' }}
                {{ Request::is('pencatatan_sipil/perkawinan') ? 'active' : '' }}
                {{ Request::is('pencatatan_sipil/perceraian') ? 'active' : '' }}
            ">
                <li style="
                        {{ 
                            Request::is('pencatatan_sipil/kelahiran') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('pencatatan_sipil/kelahiran') }}">Kelahiran WNI</a>
                </li>
                <li style="
                        {{ 
                            Request::is('pencatatan_sipil/kematian') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('pencatatan_sipil/kematian') }}">Kematian</a>
                </li>
                <li style="
                        {{ 
                            Request::is('pencatatan_sipil/perkawinan') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('pencatatan_sipil/perkawinan') }}">Perkawinan</a>
                </li>
                <li style="
                        {{ 
                            Request::is('pencatatan_sipil/perceraian') ? 'color: #8be5c0;border-right: solid;' : '' 
                        }} 
                    ">
                        <a href="{{ url('pencatatan_sipil/perceraian') }}">Perceraian</a>
                </li>
            </ul>
        </li>

@endsection

@section('navbar')

    <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
        <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar mr-1">
                            <img src="{{ asset('/assets/images/avatar/avatar-s-1.png') }}" alt="" srcset="">
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">Hi, {{Session::get('username')}}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-toggle="modal" href="#edit_profile"><i data-feather="settings" width="20"></i> Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/akses_admin/logout') }}"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

@endsection