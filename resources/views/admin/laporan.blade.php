@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Peminjaman</h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							{{-- Modal Edit --}}
							@foreach ($borrowings as $d)
							<div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h3 class="modal-title">
												<span class="fw-mediumbold">Edit</span>
												<span class="fw-mediumbold">User</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{ route('admin.laporan.update', $d->id) }}" enctype="multipart/form-data">
											@csrf
											@method('PUT')
											<div class="modal-body">
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
												
												<h2>Informasi Aset</h2>
													<div class="form-group">
														<label for="category">Select Category</label>
														<input type="text" class="form-control" id="category" name="category_id" value="{{ $d->facility->category->kategori_fasilitas }}" readonly>
													</div>
													<div class="form-group">
														<label for="facility">Select Facility</label>
														<input type="text" class="form-control" id="facility" name="facility_id" value="{{ $d->facility->nama_fasilitas }}" readonly>
													</div>
													<div class="form-group">
														<label for="tanggal_dari" class="form-label">Tanggal Mulai</label>
														<input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" value="{{ $d->tanggal_dari }}" readonly>
													</div>
													<div class="form-group">
														<label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
														<input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" value="{{ $d->tanggal_sampai }}" readonly>
													</div>
													<div class="form-group">
													<h5>Role</h5>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="status" id="statusPending{{ $d->id }}" value="pending" {{ $d->status == 'pending' ? 'checked' : '' }} required>
														<label class="form-check-label" for="statusPending{{ $d->id }}">Pending</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="status" id="statusDitolak{{ $d->id }}" value="ditolak" {{ $d->status == 'ditolak' ? 'checked' : '' }} required>
														<label class="form-check-label" for="statusDitolak{{ $d->id }}">Ditolak</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="status" id="statusDiterima{{ $d->id }}" value="diterima" {{ $d->status == 'diterima' ? 'checked' : '' }} required>
														<label class="form-check-label" for="statusDiterima{{ $d->id }}">Diterima</label>
													</div>
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
							@endforeach
							{{-- End Modal Edit --}}
							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Kategori Fasilitas</th>
											<th>Nama Fasilitas</th>
											<th>Tanggal Mulai</th>
											<th>Tanggal Sampai</th>
											<th>Status</th>
											<th style="width: 10%">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Kategori Fasilitas</th>
											<th>Nama Fasilitas</th>
											<th>Tanggal Mulai</th>
											<th>Tanggal Sampai</th>
											<th>Status</th>
											<th style="width: 10%">Action</th>
										</tr>
									</tfoot>
									<tbody>
										@php $no=1 @endphp
										@foreach ($borrowings as $row)
										<tr>
											<td>{{$no++}}</td>
											<td>{{ Auth::user()->name }}</td>
											<td>{{$row->facility->category->kategori_fasilitas}}</td>
											<td>{{$row->facility->nama_fasilitas}}</td>
											<td>{{$row->tanggal_dari}}</td>
											<td>{{$row->tanggal_sampai}}</td>
											<td>{{$row->status}}</td>
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
@endsection