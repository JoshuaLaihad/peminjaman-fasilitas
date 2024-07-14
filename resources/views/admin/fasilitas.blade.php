@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Fasilitas</h4>
			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Data Fasilitas</h4>
								<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
									<i class="fa fa-plus"></i>
									Tambah Data
								</button>
							</div>
						</div>
						<div class="card-body">
							<!-- Modal Tambah-->
							<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h3 class="modal-title">
												<span class="fw-mediumbold">Tambah</span> 
												<span class="fw-mediumbold">Nama Fasilitas</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{ route('admin.fasilitas.store') }}" enctype="multipart/form-data">
											@csrf
											<div class="modal-body">
												<div class="form-group">
													@if ($categories->count() > 0)
														<label for="category">Select Category</label>
														<select name="categories_id" id="category" class="form-control">
															@foreach($categories as $category)
																<option value="{{ $category->id }}">{{ $category->kategori_fasilitas }}</option>
															@endforeach
														</select>
													@else
														<p>No categories available.</p>
													@endif
												</div>
												<div class="form-group">
													<label>Nama Fasilitas</label>
													<input type="text" class="form-control" name="nama_fasilitas" placeholder="Nama Fasilitas..." required>
												</div>
												<div class="form-group">
													<label>Merk</label>
													<input type="text" class="form-control" name="merk" placeholder="Nama Merk..." required>
												</div>
												<div class="form-group">
													<label>Model</label>
													<input type="text" class="form-control" name="model" placeholder="Nama Model..." required>
												</div>
												<div class="form-group">
													<label>Stok</label>
													<input type="number" class="form-control" name="stok" placeholder="Jumlah Stok..." required>
												</div>
												<div class="form-group">
													<label>Status</label>
													<input type="text" class="form-control" name="status" placeholder="Nama Status..." required>
												</div>
												<div class="form-group">
													<label>Tanggal</label>
													<input type="date" class="form-control" name="tanggal" placeholder="Tanggal..." required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary"><i></i>Save Changes</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i></i>Undo</button>
											</div>
										</form>	
									</div>
								</div>
							</div>
							{{-- End Modal Tambah --}}

							{{-- Modal Edit --}}
							@foreach ($facilities as $d)
							<div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h3 class="modal-title">
												<span class="fw-mediumbold">Edit</span>
												<span class="fw-mediumbold">Facility</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{ route('admin.fasilitas.update', $d->id) }}" enctype="multipart/form-data">
											@csrf
											@method('PUT')
											<div class="modal-body">
												<div class="form-group">
													@if ($categories->count() > 0)
														<label for="category">Select Category</label>
														<select name="categories_id" id="category" class="form-control">
															@foreach($categories as $category)
																<option value="{{ $category->id }}">{{ $category->kategori_fasilitas }}</option>
															@endforeach
														</select>
													@else
														<p>No categories available.</p>
													@endif
												</div>
												<div class="form-group">
													<label>Nama Fasilitas</label>
													<input type="text" class="form-control" name="nama_fasilitas" value="{{ $d->nama_fasilitas }}" placeholder="Nama Fasilitas..." required>
												</div>
												<div class="form-group">
													<label>Merk</label>
													<input type="text" class="form-control" name="merk" value="{{ $d->merk }}" placeholder="Nama Merk..." required>
												</div>
												<div class="form-group">
													<label>Model</label>
													<input type="text" class="form-control" name="model" value="{{ $d->model }}" placeholder="Nama Model..." required>
												</div>
												<div class="form-group">
													<label>Stok</label>
													<input type="number" class="form-control" name="stok" value="{{ $d->stok }}" placeholder="Jumlah Stok..." required>
												</div>
												<div class="form-group">
													<label>Status</label>
													<input type="text" class="form-control" name="status" value="{{ $d->status }}" placeholder="Nama Status..." required>
												</div>
												<div class="form-group">
													<label>Tanggal</label>
													<input type="date" class="form-control" name="tanggal" value="{{ $d->tanggal }}" placeholder="Tanggal..." required>
												</div>
											</div>
											
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">Save Changes</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							@endforeach
							{{-- End Modal Edit --}}
					
							{{-- Modal Hapus --}}
							@foreach ($facilities as $d)
							<div class="modal fade" id="modalHapus{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h3 class="modal-title">
												<span class="fw-mediumbold">Hapus</span>
												<span class="fw-mediumbold">Fasilitas</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="GET" action="{{ route('admin.fasilitas.destroy', $d->id) }}" enctype="multipart/form-data">
											@csrf
											@method('DELETE')
											<div class="modal-body">
												<div class="form-group">
													<h4 style="text-align: center;">Apakah Anda Ingin Mengapus Data Ini?</h4>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-danger"><i></i>Hapus</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal"><i></i>Close</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							@endforeach
							{{-- End Modal Edit --}}

							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Nomor</th>
											<th>Kategori Fasilitas</th>
											<th>Nama Fasilitas</th>
											<th>Merk</th>
											<th>Model</th>
											<th>Stok</th>
											<th>Status</th>
											<th>Tanggal</th>
											<th style="width: 10%">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Nomor</th>
											<th>Kategori Fasilitas</th>
											<th>Nama Fasilitas</th>
											<th>Merk</th>
											<th>Model</th>
											<th>Stok</th>
											<th>Status</th>
											<th>Tanggal</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										@php $no=1 @endphp
										@foreach ($facilities as $row)
										   <tr>
										   <td>{{$no++}}</td>
										   <td>{{$row->category->kategori_fasilitas}}</td>
										   <td>{{$row->nama_fasilitas}}</td>
										   <td>{{$row->merk}}</td>
										   <td>{{$row->model}}</td>
										   <td>{{$row->stok}}</td>
										   <td>{{$row->status}}</td>
										   <td>{{$row->tanggal}}</td>
										  <td>
											<a href="#modalEdit{{$row->id}}" data-toggle="modal"class="btn btn-xs btn-primary btn-custom"><i class="fa fa-edit"></i>Edit</a>
											<a href="#modalHapus{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-danger btn-custom"><i class="fa fa-trash"></i>Hapus</a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
    $('#category').change(function() {
        var category_id = $(this).val(); // Ambil nilai ID kategori fasilitas yang dipilih
        $.ajax({
            url: '/get-facilities/' + category_id, // URL endpoint untuk mengambil fasilitas berdasarkan kategori
            type: 'GET',
            success: function(data) {
                $('#facility').empty(); // Kosongkan pilihan fasilitas sebelumnya
                $.each(data, function(key, value) {
                    $('#facility').append('<option value="' + value.id + '">' + value.nama_fasilitas + '</option>'); // Tambahkan pilihan fasilitas baru sesuai dengan kategori yang dipilih
                });
            }
        });
    });
});

</script>
@endsection