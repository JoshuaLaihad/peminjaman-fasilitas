@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Dashboard User</h4>
			</div>
			<div class="jumbotron mt-5">
				<h1 class="display-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
				<p class="lead">Ini adalah aplikasi peminjam fasilitas kampus. Anda dapat melakukan peminjaman dan melihat status peminjaman anda di sini.</p>
			</div>
		</div>
	</div>
</div>
@endsection