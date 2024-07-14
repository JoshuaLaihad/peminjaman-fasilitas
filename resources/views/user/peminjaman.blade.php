@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Daftar Peminjaman Aset</h4>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Peminjaman Aset</div>
				</div>
				<div class="card-body">
					<!-- Form Peminjaman -->
					<form action="{{ route('user.peminjaman.store') }}" method="POST">
						@csrf
						<!-- Informasi Peminjam -->
						<h2>Informasi Peminjam</h2>
						<div class="form-group">
							<label for="name" class="form-label">Nama Peminjam</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
						</div> 
						<div class="form-group">
							<label for="no_handphone" class="form-label"></label>
							<input type="text" class="form-control" id="no_handphone" name="no_handphone" value="{{ Auth::user()->no_handphone }}" readonly>
						</div> 
						<div class="form-group">
							<label for="asal_instansi" class="form-label"></label>
							<input type="text" class="form-control" id="asal_instansi" name="asal_instansi" value="{{ Auth::user()->asal_instansi }}" readonly>
						</div> 
						<hr> <!-- Garis Pembatas -->
					
						<!-- Informasi Aset -->
						<h2>Informasi Aset</h2>
						<div class="form-group">
							<label for="category">Select Category</label>
							<select name="category_id" id="category" class="form-control">
								<option value="" disabled selected>Select Category</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->kategori_fasilitas }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="facility">Select Facility</label>
							<select name="facility_id" id="facility" class="form-control" disabled>
								<option value="" disabled selected>Select Facility</option>
							</select>
						</div>
						<div class="form-group">
							<label for="merk">Select Merk</label>
							<select name="merk" id="merk" class="form-control" disabled>
								<option value="" disabled selected>Select Merk</option>
							</select>
						</div>
						<div class="form-group">
							<label for="model">Model</label>
							<input type="text" class="form-control" id="model" name="model" disabled>
						</div>
						<div class="form-group">
							<label for="stok">Stok</label>
							<input type="number" class="form-control" id="stok" name="stok" disabled>
						</div>
						<div class="form-group">
							<label for="tanggal_dari">Tanggal Mulai</label>
							<input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" required>
						</div>
						<div class="form-group">
							<label for="tanggal_sampai">Tanggal Sampai</label>
							<input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" required>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i></i>Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection