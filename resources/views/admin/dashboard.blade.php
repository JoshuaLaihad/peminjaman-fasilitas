@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<!-- Card -->
			<h4 class="page-title">Dashboard Admin</h4>
			<div class="row">
				<div class="col">
					<a href="{{ route('admin.user') }}" class="card card-stats card-round text-decoration-none">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="flaticon-users"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">User</p>
										<h4 class="card-title">{{ $usersCount }}</h4>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col">
					<a href="{{ route('admin.kategori') }}" class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-info bubble-shadow-small">
										<i class="fas fa-layer-group"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Kategori Fasilitas</p>
										<h4 class="card-title">{{ $categoriesCount }}</h4>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<a href="{{ route('admin.fasilitas') }}" class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-success bubble-shadow-small">
										<i class="far fa-check-circle"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Fasilitas</p>
										<h4 class="card-title">{{ $facilitiesInCount }}</h4>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col">
					<a href="{{ route('admin.fasilitaskeluar') }}" class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-secondary bubble-shadow-small">
										<i class="far fa-newspaper"></i> 
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Fasilitas Keluar</p>
										<h4 class="card-title">{{ $facilitiesOutCount }}</h4>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<a href="{{ route('admin.peminjaman') }}" class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="flaticon-interface-6"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Peminjaman</p>
										<h4 class="card-title">{{ $borrowingsCount }}</h4>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col">
					<a href="{{ route('admin.laporan') }}" class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-info bubble-shadow-small">
										<i class="flaticon-interface-6"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Laporan Peminjaman</p>
										<h4 class="card-title">{{ $reportsCount }}</h4>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection