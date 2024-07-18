@extends('partials.main')
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Fasilitas User</h4>
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
											<th>Tanggal</th>
											<th>Gambar</th>
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
											<th>Tanggal</th>
											<th>Gambar</th>
										</tr>
									</tfoot>
									<tbody>
										@php $no=1 @endphp
										@foreach ($facilities as $row)
										   @if ($row->category)
											@if ($row->status == 'Tersedia')
												<tr>
													<td>{{$no++}}</td>
													<td>{{$row->category->kategori_fasilitas}}</td>
													<td>{{$row->nama_fasilitas}}</td>
													<td>{{$row->keterangan_fasilitas}}</td>
													<td>{{$row->status}}</td>
													<td>{{$row->jumlah}}</td>
													<td>{{$row->tanggal}}</td>
													<td><img src="{{ asset('uploads/' . $row->nama_file) }}" width="100px"></td>
												</tr>  
											@endif
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