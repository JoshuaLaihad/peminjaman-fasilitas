@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Fasilitas Keluar</h4>
			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Data Fasilitas Keluar Admin</h4>
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
													<label>Keterangan Fasilitas</label>
													<input type="text" class="form-control" name="keterangan_fasilitas" placeholder="Keterangan Fasilitas..." required>
												</div>
												<div class="form-group">
													<label>Status</label>
													<input type="text" class="form-control" name="status" placeholder="Status..." required>
												</div>
												<div class="form-group">
													<label>Jumlah</label>
													<input type="text" class="form-control" name="jumlah" placeholder="jumlah..." required>
												</div>
												<div class="form-group">
													<label>Tanggal</label>
													<input type="date" class="form-control" name="tanggal" placeholder="Tanggal..." required>
												</div>
												<div class="form-group">
													<label for="nama_file">Upload Image</label>
													<input type="file" class="form-control" name="nama_file" id="nama_file" required>
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
													<label>Keterangan Fasilitas</label>
													<input type="text" class="form-control" name="keterangan_fasilitas" value="{{ $d->keterangan_fasilitas }}" placeholder="Keterangan Fasilitas..." required>
												</div>
												<div class="form-group">
													<label>Status</label>
													<input type="text" class="form-control" name="status" value="{{ $d->status }}" placeholder="Nama Status..." required>
												</div>
												<div class="form-group">
													<label>jumlah</label>
													<input type="text" class="form-control" name="jumlah" value="{{ $d->jumlah }}" placeholder="jumlah Fasilitas..." required>
												</div>
												<div class="form-group">
													<label>Tanggal</label>
													<input type="date" class="form-control" name="tanggal" value="{{ $d->tanggal }}" placeholder="Tanggal..." required>
												</div>
												<div class="form-group">
													<label>Upload Gambar</label>
													<input type="file" class="form-control" name="nama_file">
													<br>
													<img src="{{ asset('public/uploads/' . $d->nama_file) }}" width="100px" alt="current image">
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
										<form method="GET" action="{{ route('admin.fasilitaskeluar.destroy', $d->id) }}" enctype="multipart/form-data">
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
											<th>Keterangan Fasilitas</th>
											<th>Status</th>
											<th>Jumlah</th>
											<th>Tanggal</th>
											<th>Gambar</th>
											<th style="width: 10%">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Nomor</th>
											<th>Kategori Fasilitas</th>
											<th>Nama Fasilitas</th>
											<th>Keterangan Fasilitas</th>
											<th>Status</th>
											<th>Jumlah</th>
											<th>Gambar</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										@php $no=1 @endphp
										@foreach ($facilities as $row)
											@if ($row->status == 'Rusak' || $row->status == 'Dipinjam')
											<tr>
												<td>{{$no++}}</td>
												<td>{{$row->category->kategori_fasilitas}}</td>
												<td>{{$row->nama_fasilitas}}</td>
												<td>{{$row->keterangan_fasilitas}}</td>
												<td>{{$row->status}}</td>
												<td>{{$row->jumlah}}</td>
												<td>{{$row->tanggal}}</td>
												<td><img src="{{ asset('public/uploads/' . $row->nama_file) }}" width="100px"></td>
												<td>
													<a href="#modalEdit{{$row->id}}" data-toggle="modal"class="btn btn-xs btn-primary btn-custom"><i class="fa fa-edit"></i>Edit</a>
													<a href="#modalHapus{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-danger btn-custom"><i class="fa fa-trash"></i>Hapus</a>
												</td>
											</tr>
											@endif
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