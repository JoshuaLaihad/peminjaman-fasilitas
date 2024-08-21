@extends('partials.main')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Peminjaman Fasilitas</div>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mt-4">
                            <p>Sebelum Melakukan Pengisian Form Peminjaman, klik <a href="https://t.me/ApfpBot"
                                    target="_blank">di sini </a>agar bot dapat mengenali chat id anda dan klik tombol atau
                                ketikkan <strong>/start</strong> pada bot, ketika sudah selesai silahkan lanjutkan pengisian
                                form.</p>
                        </div>
                        <!-- Form Peminjaman -->
                        <form action="{{ route('admin.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Informasi Aset -->
                            <h2>Informasi Fasilitas</h2>
                            <div class="form-group">
                                <label for="id_category">Kategori Fasilitas</label>
                                <select name="id_category" id="id_category" class="form-control">
                                    <option value="" disabled selected>Pilih Kategori Fasilitas</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id_category }}">{{ $category->kategori_fasilitas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_facility">Fasilitas</label>
                                <select name="id_facility" id="id_facility" class="form-control" disabled>
                                    <option value="" disabled selected>Pilih Fasilitas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan_fasilitas">Keterangan Fasilitas</label>
                                <select name="keterangan_fasilitas" id="keterangan_fasilitas" class="form-control" disabled>
                                    <option value="" disabled selected>Pilih Keterangan Fasilitas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_dari">Tanggal Mulai Peminjaman</label>
                                <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sampai">Tanggal Selesai Peminjaman</label>
                                <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Peminjaman</label>
                                <input type="text" class="form-control" id="status" name="status" value="Pending"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_dipinjam">Jumlah Dipinjam</label>
                                <input type="text" class="form-control" id="jumlah_dipinjam" name="jumlah_dipinjam"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="nama_surat">Upload Surat Peminjaman</label>
                                <input type="file" class="form-control-file" id="nama_surat" name="nama_surat"> <!-- Tambahkan atribut name -->
                            </div>
                            <div class="form-group">
                                <label for="tujuan_peminjaman">Tujuan Peminjaman</label>
                                <textarea class="form-control" id="tujuan_peminjaman" name="tujuan_peminjaman" rows="5"></textarea> <!-- Tambahkan atribut name -->
                            </div>                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i></i>Ajukan Peminjaman</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
