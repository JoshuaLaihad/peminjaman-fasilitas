@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Fasilitas Keluar User</h4>
			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="card">
						<div class="card-body">

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
												<td><img src="{{ asset('uploads/' . $row->nama_file) }}" width="100px"></td>
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