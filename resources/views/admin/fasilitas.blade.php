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

                                <!-- Modal Tambah-->
                                <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h3 class="modal-title">
                                                    <span class="fw-mediumbold">Tambah Data</span>
                                                    <span class="fw-mediumbold">Nama Fasilitas</span>
                                                </h3>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.fasilitas.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        @if ($categories->count() > 0)
                                                            <label for="id_category">Kategori Fasilitas</label>
                                                            <select name="id_category" id="id_category"
                                                                class="form-control">
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id_category }}">
                                                                        {{ $category->kategori_fasilitas }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <p>Tidak ada kategori yang tersedia.</p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Fasilitas</label>
                                                        <input type="text" class="form-control" name="nama_fasilitas"
                                                            placeholder="Nama Fasilitas..." required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Keterangan Fasilitas</label>
                                                        <input type="text" class="form-control"
                                                            name="keterangan_fasilitas"
                                                            placeholder="Keterangan Fasilitas..." required>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Status</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusTersedia" value="Tersedia" required>
                                                            <label class="form-check-label"
                                                                for="statusTersedia">Tersedia</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="statusRusak" value="Rusak" required>
                                                            <label class="form-check-label" for="statusRusak">Rusak</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>jumlah</label>
                                                        <input type="number" class="form-control" name="jumlah"
                                                            placeholder="jumlah..." required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal</label>
                                                        <input type="date" class="form-control" name="tanggal"
                                                            placeholder="Tanggal..." required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_gambar">Upload Image</label>
                                                        <input type="file" class="form-control" name="nama_gambar"
                                                            id="nama_gambar" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"><i></i>Simpan</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal"><i></i>Undo</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Tambah --}}

                                {{-- Modal Edit --}}
                                @foreach ($facilities as $row)
                                    <div class="modal fade" id="modalEdit{{ $row->id_facility }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h3 class="modal-title">
                                                        <span class="fw-mediumbold">Edit Data</span>
                                                        <span class="fw-mediumbold">Fasilitas
                                                            {{ $row->nama_fasilitas }}</span>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('admin.fasilitas.update', $row->id_facility) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            @if ($categories->count() > 0)
                                                                <label for="id_category">Kategori Fasilitas</label>
                                                                <select name="id_category" id="id_category"
                                                                    class="form-control">
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id_category }}"
                                                                            @if ($row->id_category == $category->id_category) selected @endif>
                                                                            {{ $category->kategori_fasilitas }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <p>No categories available.</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Fasilitas</label>
                                                            <input type="text" class="form-control"
                                                                name="nama_fasilitas" value="{{ $row->nama_fasilitas }}"
                                                                placeholder="Nama Fasilitas..." required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan Fasilitas</label>
                                                            <input type="text" class="form-control"
                                                                name="keterangan_fasilitas"
                                                                value="{{ $row->keterangan_fasilitas }}"
                                                                placeholder="Keterangan Fasilitas..." required>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>Status</h5>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="status"
                                                                    id="statusTersedia{{ $row->id_facility }}"
                                                                    value="Tersedia"
                                                                    {{ $row->status == 'Tersedia' ? 'checked' : '' }}
                                                                    required>
                                                                <label class="form-check-label"
                                                                    for="statusTersedia{{ $row->id_facility }}">Tersedia</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="status"
                                                                    id="statusRusak{{ $row->id_facility }}"
                                                                    value="Rusak"
                                                                    {{ $row->status == 'Rusak' ? 'checked' : '' }}
                                                                    required>
                                                                <label class="form-check-label"
                                                                    for="statusRusak{{ $row->id_facility }}">Rusak</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah</label>
                                                            <input type="number" class="form-control" name="jumlah"
                                                                value="{{ $row->jumlah }}"
                                                                placeholder="jumlah Fasilitas..." required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <input type="date" class="form-control" name="tanggal"
                                                                value="{{ $row->tanggal }}" placeholder="Tanggal..."
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Edit Gambar</label>
                                                            <input type="file" class="form-control"
                                                                name="nama_gambar">
                                                            <br>
                                                            <img src="{{ asset('uploads/' . $row->nama_gambar) }}"
                                                                style="width: 125px; height: 75px;">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- End Modal Edit --}}

                                {{-- Modal Hapus --}}
                                @foreach ($facilities as $row)
                                    <div class="modal fade" id="modalHapus{{ $row->id_facility }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h3 class="modal-title">
                                                        <span class="fw-mediumbold">Hapus Data</span>
                                                        <span class="fw-mediumbold">Fasilitas
                                                            {{ $row->nama_fasilitas }}</span>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="GET"
                                                    action="{{ route('admin.fasilitas.destroy', $row->id_facility) }}"
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
                                                    @if ($row->status == 'Tersedia' || $row->status == 'Rusak')
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $row->category->kategori_fasilitas }}</td>
                                                            <td>{{ $row->nama_fasilitas }}</td>
                                                            <td>{{ $row->keterangan_fasilitas }}</td>
                                                            <td>{{ $row->status }}</td>
                                                            <td>
                                                                <a href="#modalDetail{{ $row->id_facility }}"
                                                                    data-toggle="modal"class="btn btn-xs btn-default btn-custom"><i
                                                                        class="fas fa-search"></i>Detail</a>
                                                                <a href="#modalEdit{{ $row->id_facility }}"
                                                                    data-toggle="modal"class="btn btn-xs btn-primary btn-custom"><i
                                                                        class="fa fa-edit"></i>Edit</a>
                                                                <a href="#modalHapus{{ $row->id_facility }}"
                                                                    data-toggle="modal"
                                                                    class="btn btn-xs btn-danger btn-custom"><i
                                                                        class="fa fa-trash"></i>Hapus</a>
                                                            </td>
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
