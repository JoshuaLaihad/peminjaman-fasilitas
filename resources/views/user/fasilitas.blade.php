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
                                    <h4 class="card-title">Data Fasilitas</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                        data-target="#modalCreate">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
								{{-- Modal Detail --}}
                                @foreach ($facilities as $row)
                                    <div class="modal fade" id="modalDetail{{ $row->id_facility }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h3 class="modal-title">
                                                        <span class="fw-mediumbold">Detail</span>
                                                        <span class="fw-mediumbold">Fasilitas</span>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('admin.fasilitas.update', $row->id_facility) }}"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="id_category">Kategori Fasilitas</label>
                                                            <input type="text" class="form-control" name="id_category"
                                                                value="{{ $row->category ? $row->category->kategori_fasilitas : 'Tidak ada kategori' }}"
                                                                placeholder="Nama Fasilitas..." readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Fasilitas</label>
                                                            <input type="text" class="form-control"
                                                                name="nama_fasilitas" value="{{ $row->nama_fasilitas }}"
                                                                placeholder="Nama Fasilitas..." readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan Fasilitas</label>
                                                            <input type="text" class="form-control"
                                                                name="keterangan_fasilitas"
                                                                value="{{ $row->keterangan_fasilitas }}"
                                                                placeholder="Keterangan Fasilitas..." readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <input type="text" class="form-control" name="status"
                                                                value="{{ $row->status }}" placeholder="Nama Status..."
                                                                readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah</label>
                                                            <input type="text" class="form-control" name="jumlah"
                                                                value="{{ $row->jumlah }}"
                                                                placeholder="jumlah Fasilitas..." readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <input type="date" class="form-control" name="tanggal"
                                                                value="{{ $row->tanggal }}" placeholder="Tanggal..."
                                                                readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Detail Gambar {{ $row->keterangan_fasilitas }}</label>
                                                            <br>
                                                            <img src="{{ asset('uploads/' . $row->nama_gambar) }}"
                                                                style="width: 440px; height: 360px;">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
								{{-- End Modal Detail --}}

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Kategori Fasilitas</th>
                                                <th>Nama Fasilitas</th>
                                                <th>Keterangan Fasilitas</th>
                                                <th>Status</th>
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
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @php $no=1 @endphp
                                            @foreach ($facilities as $row)
                                                @if ($row->category)
                                                    @if (($row->status == 'Tersedia' && $row->jumlah > 0) || $row->status == 'Rusak')
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $row->category->kategori_fasilitas }}</td>
                                                            <td>{{ $row->nama_fasilitas }}</td>
                                                            <td>{{ $row->keterangan_fasilitas }}</td>
                                                            <td>{{ $row->status }}</td>
                                                            <td>
                                                                <a href="#modalDetail{{ $row->id_facility }}"
                                                                    data-toggle="modal" class="btn btn-xs btn-default btn-custom"><i
                                                                        class="fas fa-search"></i>Detail</a>
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
