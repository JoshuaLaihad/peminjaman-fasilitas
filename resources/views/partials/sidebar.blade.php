<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    @if (Auth::check())
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <i class="fas fa-layer-group"></i>
                            <span>
                                {{ Auth::user()->name }}
                                <span class="user-level">{{ Auth::user()->role }}</span>
                            </span>
                        </a>
                    @endif
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}">
                                <i class="fas fa-home"></i>Dashboard
                            </a>
                        @endif
                    @endif
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-item {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                        <a href="{{ route('admin.user') }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
                        <a href="{{ route('admin.kategori') }}">
                            <i class="fas fa-pen-square"></i>
                            <p>Data Kategori</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ request()->routeIs('admin.fasilitas') || request()->routeIs('user.fasilitas') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.fasilitas') }}">
                                <i class="far fa-check-circle"></i> Data Fasilitas
                            </a>
                        @else
                            <a href="{{ route('user.fasilitas') }}">
                                <i class="far fa-check-circle"></i> Data Fasilitas
                            </a>
                        @endif
                    @endif
                </li>
                <li class="nav-item {{ request()->routeIs('admin.fasilitaskeluar') || request()->routeIs('user.fasilitaskeluar') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.fasilitaskeluar') }}">
                                <i class="far fa-newspaper"></i> Data Fasilitas Keluar
                            </a>
                        @else
                            <a href="{{ route('user.fasilitaskeluar') }}">
                                <i class="far fa-newspaper"></i> Data Fasilitas Keluar
                            </a>
                        @endif
                    @endif
                </li>
                <li class="nav-item {{ request()->routeIs('admin.peminjaman') || request()->routeIs('user.peminjaman') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.peminjaman') }}">
                                <i class="fas fa-pen-square"></i> Peminjaman
                            </a>
                        @else
                            <a href="{{ route('user.peminjaman') }}">
                                <i class="fas fa-pen-square"></i> Peminjaman
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
