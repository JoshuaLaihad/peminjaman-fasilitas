<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        @if (Auth::check())
                        <span>
                            {{ Auth::user()->name }}
                            @if (Auth::user()->role == 'admin')
                            <span class="user-level">Administrator</span>
                            @elseif (Auth::user()->role == 'user')
                            <span class="user-level">User</span>
                            @endif
                            <span class="caret"></span>
                        </span>  
                        @endif
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('logout') }}">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        @endif
                    @endif
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Fitur</h4>
                </li>
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-item {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                        <a href="{{ route('admin.user') }}">
                            <i class="flaticon-users"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
                        <a href="{{ route('admin.kategori') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Data Kategori</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ request()->routeIs('admin.fasilitas') || request()->routeIs('user.fasilitas') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.fasilitas') }}">
                                <i class="far fa-check-circle"></i>
                                <p>Data Fasilitas</p>
                            </a>
                        @else
                            <a href="{{ route('user.fasilitas') }}">
                                <i class="far fa-check-circle"></i> 
                                <p>Data Fasilitas</p>
                            </a>
                        @endif
                    @endif
                </li>
                <li class="nav-item {{ request()->routeIs('admin.fasilitaskeluar') || request()->routeIs('user.fasilitaskeluar') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.fasilitaskeluar') }}">
                                <i class="far fa-newspaper"></i> 
                                <p>Data Fasilitas Keluar</p>
                            </a>
                        @else
                            <a href="{{ route('user.fasilitaskeluar') }}">
                                <i class="far fa-newspaper"></i> 
                                <p>Data Fasilitas Keluar</p>
                            </a>
                        @endif
                    @endif
                </li>
                <li class="nav-item {{ request()->routeIs('admin.peminjaman') || request()->routeIs('user.peminjaman') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.peminjaman') }}">
                                <i class="flaticon-interface-6"></i>
                                <p>Peminjaman</p>
                            </a>
                        @else
                            <a href="{{ route('user.peminjaman') }}">
                                <i class="flaticon-interface-6"></i>
                                <p>Peminjaman</p>
                            </a>
                        @endif
                    @endif
                </li>
                <li class="nav-item {{ request()->routeIs('admin.laporan') || request()->routeIs('user.laporan') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.laporan') }}">
                                <i class="far fa-chart-bar"></i>
                                <p>Data Laporan</p>
                            </a>
                        @else
                            <a href="{{ route('user.laporan') }}">
                                <i class="far fa-chart-bar"></i>
                                <p>Data Laporan</p>
                            </a>
                        @endif
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
