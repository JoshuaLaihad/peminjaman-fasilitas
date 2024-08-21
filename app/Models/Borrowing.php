<?php

namespace App\Models; // Menyatakan namespace dari kelas ini.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory.
use Illuminate\Database\Eloquent\Model; // Menggunakan kelas Model dari Eloquent ORM.

class Borrowing extends Model // Mendefinisikan kelas Borrowing yang merupakan model Eloquent.
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory.

    protected $table = 'borrowings'; // Menentukan nama tabel di database yang diwakili oleh model ini.
    protected $primaryKey = 'id_borrowing'; // Menyesuaikan primary key

    public $timestamps = false; // Menonaktifkan pengelolaan otomatis kolom created_at dan updated_at.

    const CREATED_AT = 'replicated_created_at'; // Menentukan kolom created_on sebagai pengganti created_at.

    protected $fillable = [
        'id_facility', // Menentukan bahwa kolom fasilitas_id dapat diisi secara massal.
        'id_user', // Menentukan bahwa kolom user_id dapat diisi secara massal.
        'tanggal_dari', // Menentukan bahwa kolom tanggal_dari dapat diisi secara massal.
        'tanggal_sampai', // Menentukan bahwa kolom tanggal_sampai dapat diisi secara massal.
        'jumlah_dipinjam', // Menentukan bahwa kolom jumlah_dipinjam dapat diisi secara massal.
        'status', // Menentukan bahwa kolom status dapat diisi secara massal.
        'nama_surat',
        'tujuan_peminjaman',
    ];

    public function facility() // Mendefinisikan relasi many-to-one dengan model Facility.
    {
        return $this->belongsTo(Facility::class, 'id_facility'); // Relasi belongsTo ke model Facility menggunakan foreign key fasilitas_id.
    }

    public function user() // Mendefinisikan relasi many-to-one dengan model User.
    {
        return $this->belongsTo(User::class, 'id_user'); // Relasi belongsTo ke model User menggunakan foreign key user_id.
    }
}
