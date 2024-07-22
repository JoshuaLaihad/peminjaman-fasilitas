@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Daftar Peminjaman Fasilitas Admin</h4>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Peminjaman Fasiltias </div>
					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
					@if(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
					@endif
				</div>
				<div class="card-body">
					<!-- Form Peminjaman -->
					<form action="{{ route('admin.peminjaman.store') }}" method="POST">
						@csrf
						<!-- Informasi Peminjam -->
						<h2>Informasi Peminjam</h2>
						<div class="form-group">
							<label for="name" class="form-label">Nama Peminjam</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
						</div> 
						<div class="form-group">
							<label for="no_handphone" class="form-label">Nomor Handphone</label>
							<input type="text" class="form-control" id="no_handphone" name="no_handphone" value="{{ Auth::user()->no_handphone }}" readonly>
						</div> 
						<div class="form-group">
							<label for="asal_departemen" class="form-label">Asal Departemen / Jurusan</label>
							<input type="text" class="form-control" id="asal_departemen" name="asal_departemen" value="{{ Auth::user()->asal_departemen }}" readonly>
						</div> 
						<hr> <!-- Garis Pembatas -->
					
						<!-- Informasi Aset -->
						<h2>Informasi Fasiltias</h2>
						<div class="form-group">
							<label for="category">Kategori Fasilitas</label>
							<select name="category_id" id="category" class="form-control">
								<option value="" disabled selected>Pilih Kategori Fasilitas</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->kategori_fasilitas }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="facility">Fasilitas</label>
							<select name="facility_id" id="facility" class="form-control" disabled>
								<option value="" disabled selected>Pilih Fasilitas</option>
							</select>
						</div>
						<div class="form-group">
							<label for="keterangan_fasilitas">Keterangan Fasilitas</label>
							<input type="text" class="form-control" id="keterangan_fasilitas" name="keterangan_fasilitas" placeholder="">
						</div>
						<div class="form-group">
							<label for="tanggal_dari">Tanggal Mulai</label>
							<input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" required>
						</div>
						<div class="form-group">
							<label for="tanggal_sampai">Tanggal Sampai</label>
							<input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" required>
						</div>
						<div class="form-group">
							<label for="status">Status Peminjaman</label>
							<input type="text" class="form-control" id="status" name="status" value="Pending" readonly>
						
                            {{-- <select class="form-control" id="status" name="status">
								<option value="Pending" selected>Pending</option>
                            </select> --}}
                        </div>
						<div class="form-group">
							<label for="jumlah_dipinjam">Jumlah Dipinjam</label>
							<input type="text" class="form-control" id="jumlah_dipinjam" name="jumlah_dipinjam" required>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i></i>Ajukan Peminjaman</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection