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
                                    <h4 class="card-title">Laporan Peminjaman</h4>
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

                                {{-- Modal Edit --}}
                                
                                @foreach ($borrowings as $row)
                                    @if ($row->facility && $row->facility->category && $row->user) 
                                        <div class="modal fade" id="modalEdit{{ $row->id_borrowing }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h3 class="modal-title">
                                                            <span class="fw-mediumbold">Edit Data</span>
                                                            <span class="fw-mediumbold">Peminjaman {{ $row->user->name }}</span>
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
                                                                    name="name" value="{{ $row->user->name }}"
                                                                    readonly>
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
                                                                    name="asal" value="{{ $row->user->asal }}"
                                                                    readonly>
                                                            </div>
															<br>
                                                            <h2>Informasi Fasilitas</h2>
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
                                                                <label>Surat Pengajuan Peminjaman
                                                                    {{ $row->keterangan_fasilitas }}</label>
                                                                <br>
                                                                <a href="{{ asset('uploads/' . $row->nama_surat) }}"
                                                                    target="_blank" class="btn btn-info">Lihat Surat</a>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tujuan_peminjaman">Tujuan Peminjaman</label>
                                                                <textarea class="form-control" id="tujuan_peminjaman" name="tujuan_peminjaman" rows="5" readonly>{{ $row->tujuan_peminjaman }}</textarea> <!-- Tambahkan atribut name -->
                                                            </div>
                                                            <div class="form-group">
                                                                <h5>Status</h5>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status"
                                                                        id="statusPending{{ $row->id_borrowing }}"
                                                                        value="Pending"
                                                                        {{ $row->status == 'Pending' ? 'checked' : '' }}
                                                                        required>
                                                                    <label class="form-check-label"
                                                                        for="statusPending{{ $row->id_borrowing }}">Pending</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status"
                                                                        id="statusDitolak{{ $row->id_borrowing }}"
                                                                        value="Ditolak"
                                                                        {{ $row->status == 'Ditolak' ? 'checked' : '' }}
                                                                        required>
                                                                    <label class="form-check-label"
                                                                        for="statusDitolak{{ $row->id_borrowing }}">Ditolak</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status"
                                                                        id="statusDiterima{{ $row->id_borrowing }}"
                                                                        value="Diterima"
                                                                        {{ $row->status == 'Diterima' ? 'checked' : '' }}
                                                                        required>
                                                                    <label class="form-check-label"
                                                                        for="statusDiterima{{ $row->id_borrowing }}">Diterima</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status"
                                                                        id="statusSelesai{{ $row->id_borrowing }}"
                                                                        value="Selesai"
                                                                        {{ $row->status == 'Selesai' ? 'checked' : '' }}
                                                                        required>
                                                                    <label class="form-check-label"
                                                                        for="statusSelesai $row->id_borrowing }}">Sudah Di Kembalikan</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary"><i></i>Simpan
                                                                </button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal"><i></i>Undo</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                {{-- End Modal Edit --}}
                                {{-- Modal Hapus --}}
                                @foreach ($borrowings as $row)
                                    <div class="modal fade" id="modalHapus{{ $row->id_borrowing }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h3 class="modal-title">
                                                        <span class="fw-mediumbold">Hapus</span>
                                                        <span class="fw-mediumbold">Fasilitas</span>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="GET"
                                                    action="{{ route('admin.laporan.destroy', $row->id_borrowing) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <h4 style="text-align: center;">Apakah Anda Ingin Mengapus Data
                                                                Ini?</h4>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="btn btn-danger"><i></i>Hapus</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal"><i></i>Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- End Modal Hapus --}}
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Kategori Fasilitas</th>
                                                <th>Nama Fasilitas</th>
                                                <th>Keterangan Fasilitas</th>
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
                                                <th>Keterangan Fasilitas</th>
                                                <th>Status</th>
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
                                                        <td>{{ $row->facility->keterangan_fasilitas }}</td>
                                                        <td>{{ $row->status }}</td>

                                                        <td>
                                                            <a href="#modalEdit{{ $row->id_borrowing }}"
                                                                data-toggle="modal"class="btn btn-xs btn-primary btn-custom"><i
                                                                    class="fa fa-edit"></i>Edit</a>
                                                            <a href="#modalHapus{{ $row->id_borrowing }}"
                                                                data-toggle="modal"
                                                                class="btn btn-xs btn-danger btn-custom"><i
                                                                    class="fa fa-trash"></i>Hapus</a>
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
