@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data User</h4>
			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Data User</h4>
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
												<span class="fw-mediumbold">User</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
											@csrf
											<div class="modal-body">
												<div class="form-group">
													<label>Nama</label>
													<input type="text" class="form-control" name="name" placeholder="Nama User..." required>
												</div>
												<div class="form-group">
													<label>Username</label>
													<input type="text" class="form-control" name="username" placeholder="Username..." required>
												</div>
												<div class="form-group">
													<label>No Handphone</label>
													<input type="number" class="form-control" name="no_handphone" placeholder="No Handphone..." required>
												</div>
												<div class="form-group">
													<label>Asal Instansi</label>
													<input type="text" class="form-control" name="asal_instansi" placeholder="Asal Instansi..." required>
												</div>
												<div class="form-group">
													<label>Password</label>
													<input type="password" class="form-control" name="password" placeholder="Password..." required>
												</div>
												<div class="form-group">
													<h5>Role</h5>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="role" id="roleUser" value="user" required>
														<label class="form-check-label" for="roleUser">User</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="role" id="roleAdmin" value="admin" required>
														<label class="form-check-label" for="roleAdmin">Admin</label>
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
							{{-- End Modal Tambah --}}

							{{-- Modal Edit --}}
							@foreach ($users as $d)
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
										<form method="POST" action="{{ route('admin.user.update', $d->id) }}" enctype="multipart/form-data">
											@csrf
											@method('PUT')
											<div class="modal-body">
												<div class="form-group">
													<label>Nama User</label>
													<input type="text" class="form-control" name="name" value="{{ $d->name }}" placeholder="" required>
												</div>
												<div class="form-group">
													<label>Username</label>
													<input type="text" class="form-control" name="username" value="{{ $d->username }}" placeholder="" required>
												</div>
												<div class="form-group">
													<label>No Handphone</label>
													<input type="number" class="form-control" name="no_handphone" value="{{ $d->no_handphone }}" placeholder="" required>
												</div>
												<div class="form-group">
													<label>Asal Instansi</label>
													<input type="text" class="form-control" name="asal_instansi" value="{{ $d->asal_instansi }}" placeholder="" required>
												</div>
												<div class="form-group">
													<label>Password</label>
													<input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
												</div>
												<div class="form-group">
													<h5>Role</h5>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="role" id="roleUser{{ $d->id }}" value="user" {{ $d->role == 'user' ? 'checked' : '' }} required>
														<label class="form-check-label" for="roleUser{{ $d->id }}">User</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="role" id="roleAdmin{{ $d->id }}" value="admin" {{ $d->role == 'admin' ? 'checked' : '' }} required>
														<label class="form-check-label" for="roleAdmin{{ $d->id }}">Admin</label>
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
							
							{{-- Modal Hapus --}}
							@foreach ($users as $d)
							<div class="modal fade" id="modalHapus{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h3 class="modal-title">
												<span class="fw-mediumbold">Hapus</span>
												<span class="fw-mediumbold">User</span>
											</h3>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="GET" action="{{ route('admin.user.destroy', $d->id) }}" enctype="multipart/form-data">
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
											<th>No</th>
											<th>Nama</th>
											<th>Username</th>
											<th>Nomor Handphone</th>
											<th>Asal Instansi</th>
											<th>Role</th>
											<th style="width: 10%">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Username</th>
											<th>Nomor Handphone</th>
											<th>Asal Instansi</th>
											<th>Role</th>
											<th style="width: 10%">Action</th>
										</tr>
									</tfoot>
									<tbody>
										@php $no=1 @endphp
										@foreach ($users as $row)
										   <tr>
										   <td>{{$no++}}</td>
										   <td>{{$row->name}}</td>
										   <td>{{$row->username}}</td>
										   <td>{{$row->no_handphone}}</td>
										   <td>{{$row->asal_instansi}}</td>
										   <td>{{$row->role}}</td>
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