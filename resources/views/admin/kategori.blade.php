@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Data Kategori Fasilitas</h4>
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
												<span class="fw-mediumbold">Tambah Data</span> 
												<span class="fw-mediumbold">Kategori Fasilitas</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{ route('admin.kategori.store') }}" enctype="multipart/form-data">
											@csrf
											<div class="modal-body">
												<div class="form-group">
													<label>Kategori Fasilitas</label>
													<input type="text" class="form-control" name="kategori_fasilitas" placeholder="Nama Kategori Fasilitas..." required>
												</div>                                      
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary"><i></i>Simpan</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i></i>Undo</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							{{-- End Modal Tambah --}}
							
							{{-- Modal Edit --}}
							@foreach ($categories as $row)
							<div class="modal fade" id="modalEdit{{ $row->id_category }}" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h3 class="modal-title">
												<span class="fw-mediumbold">Edit Data</span>
												<span class="fw-mediumbold">Kategori Fasilitas {{ $row->kategori_fasilitas }}</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{ route('admin.kategori.update', $row->id_category) }}" enctype="multipart/form-data">
											@csrf
											@method('PUT')
											<div class="modal-body">
												<div class="form-group">
													<label>Kategori Fasilitas</label>
													<input type="text" class="form-control" name="kategori_fasilitas" id="kategori_fasilitas" value="{{ $row->kategori_fasilitas }}" placeholder="" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary"><i></i>Simpan</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i></i>Undo</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							@endforeach
							{{-- End Modal Edit --}}

							{{-- Modal Hapus --}}
							@foreach ($categories as $row)
							<div class="modal fade" id="modalHapus{{ $row->id_category }}" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h3 class="modal-title">
												<span class="fw-mediumbold">Hapus Data</span>
												<span class="fw-mediumbold">Kategori Fasilitas {{ $row->kategori_fasilitas }}</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="GET" action="{{ route('admin.kategori.destroy', $row->id_category) }}" enctype="multipart/form-data">
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
							{{-- End Modal Hapus --}}

							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Kategori Fasilitas</th>
											<th style="width: 10%">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Kategori Fasilitas</th>
											<th style="width: 10%">Action</th>
										</tr>
									</tfoot>
									<tbody>
										@php $no=1 @endphp
										@foreach ($categories as $row)
										   <tr>
										   <td>{{$no++}}</td>
										   <td>{{$row->kategori_fasilitas}}</td>
										  <td>
											<a href="#modalEdit{{$row->id_category}}" data-toggle="modal"class="btn btn-xs btn-primary btn-custom"><i class="fa fa-edit"></i>Edit</a>
											<a href="#modalHapus{{$row->id_category}}" data-toggle="modal" class="btn btn-xs btn-danger btn-custom"><i class="fa fa-trash"></i>Hapus</a>
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
@endsection