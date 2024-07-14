<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="/assets/img/profile.jpg" alt="." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    @if (Auth::check())
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                {{ Auth::user()->name }}
                                <span class="user-level">{{ Auth::user()->role }}</span>
                            </span>
                        </a>
                    @endif

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
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
                        @if(auth()->user()->isAdmin())
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
                @if (auth()->user()->role !== 'user')
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
                <li class="nav-item {{ request()->routeIs('admin.fasilitas') || request()->routeIs('admin.fasilitaskeluar') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-pen-square"></i>
                        <p>Data Fasilitas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.fasilitas') }}">
                                    <span class="sub-item">Data Fasilitas</span>
                                </a>
                                <a href="{{ route('admin.fasilitaskeluar') }}">
                                    <span class="sub-item">Data Fasilitas Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item {{ request()->routeIs('admin.peminjaman') || request()->routeIs('user.peminjaman') ? 'active' : '' }}">
                    @if(auth()->check())
                        @if(auth()->user()->isAdmin())
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
                @if (auth()->user()->role !== 'user')
                <li class="nav-item {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                    <a href="{{ route('admin.laporan') }}">
                        <i class="far fa-chart-bar"></i>
                        <p>Data Laporan</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
