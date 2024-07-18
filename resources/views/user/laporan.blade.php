@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Laporan Peminjaman User</h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
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
											<th>Jumlah Dipinjam</th>
											<th>Status</th>
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
											<th>Jumlah Dipinjam</th>
											<th>Status</th>
										</tr>
									</tfoot>
									<tbody>
										@php $no=1 @endphp
										@foreach ($borrowings as $row)
											@if ($row->facility && $row->facility->category && $row->user)
												<tr>
													<td>{{$no++}}</td>
													<td>{{$row->user->name}}</td>
													<td>{{$row->facility->category->kategori_fasilitas}}</td>
													<td>{{$row->facility->nama_fasilitas}}</td>
													<td>{{$row->tanggal_dari}}</td>
													<td>{{$row->tanggal_sampai}}</td>
													<td>{{$row->jumlah_dipinjam}}</td>
													<td>{{$row->status}}</td>
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