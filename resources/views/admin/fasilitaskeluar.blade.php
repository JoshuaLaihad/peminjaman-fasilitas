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
                                    <h4 class="card-title">Data Fasilitas Keluar </h4>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- Modal Detail --}}
                                @foreach ($borrowings as $row)
                                    @if ($row->facility && $row->facility->category && $row->user)
                                        <div class="modal fade" id="modalDetail{{ $row->id_borrowing }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h3 class="modal-title">
                                                            <span class="fw-mediumbold">Detail</span>
                                                            <span class="fw-mediumbold">Fasilitas Keluar</span>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{{ route('admin.laporan.update', $row->id_borrowing) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <h2>Informasi Peminjam</h2>
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Nama
                                                                    Peminjam</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $row->user->name }}" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="no_handphone" class="form-label">Nomor
                                                                    Handphone</label>
                                                                <input type="text" class="form-control" id="no_handphone"
                                                                    name="no_handphone"
                                                                    value="{{ $row->user->no_handphone }}" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="asal" class="form-label">Asal Departemen /
                                                                    Jurusan</label>
                                                                <input type="text" class="form-control" id="asal"
                                                                    name="asal" value="{{ $row->user->asal }}" readonly>
                                                            </div>

                                                            <h2>Informasi Fasilitas Keluar</h2>
                                                            <div class="form-group">
                                                                <label for="category">Kategori Fasilitas</label>
                                                                <input type="text" class="form-control" id="category"
                                                                    name="category_id"
                                                                    value="{{ $row->facility->category->kategori_fasilitas }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="facility">Fasilitas</label>
                                                                <input type="text" class="form-control" id="facility"
                                                                    name="facility_id"
                                                                    value="{{ $row->facility->nama_fasilitas }}" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggal_dari" class="form-label">Tanggal
                                                                    Mulai</label>
                                                                <input type="date" class="form-control" id="tanggal_dari"
                                                                    name="tanggal_dari" value="{{ $row->tanggal_dari }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggal_sampai" class="form-label">Tanggal
                                                                    Sampai</label>
                                                                <input type="date" class="form-control"
                                                                    id="tanggal_sampai" name="tanggal_sampai"
                                                                    value="{{ $row->tanggal_sampai }}" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>jumlah Dipinjam</label>
                                                                <input type="text" class="form-control"
                                                                    name="jumlah_dipinjam"
                                                                    value="{{ $row->jumlah_dipinjam }}" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status" class="form-label">Status</label>
                                                                <input type="text" class="form-control" id="status"
                                                                    name="status"
                                                                    value="{{ $row->status === 'Diterima' ? 'Dipinjam' : $row->facility->status }}"
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
                                    @endif
                                @endforeach
                                {{-- End Modal Detail --}}


                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Kategori Fasilitas</th>
                                                <th>Nama Fasilitas</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Sampai</th>
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
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @php $no=1 @endphp
                                            @foreach ($borrowings as $row)
                                                @if ($row->facility && $row->facility->category && $row->user)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $row->user->name }}</td>
                                                        <td>{{ $row->facility->category->kategori_fasilitas }}</td>
                                                        <td>{{ $row->facility->nama_fasilitas }}</td>
                                                        <td>{{ $row->tanggal_dari }}</td>
                                                        <td>{{ $row->tanggal_sampai }}</td>
                                                        <td>
                                                            <a href="#modalDetail{{ $row->id_borrowing }}"
                                                                data-toggle="modal"class="btn btn-xs btn-default btn-custom"><i
                                                                    class="fas fa-search"></i>Detail</a>
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
