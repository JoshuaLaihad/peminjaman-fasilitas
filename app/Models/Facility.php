<?php

namespace App\Models; // Menyatakan namespace dari kelas ini.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory.
use Illuminate\Database\Eloquent\Model; // Menggunakan kelas Model dari Eloquent ORM.

class Facility extends Model // Mendefinisikan kelas Facility yang merupakan model Eloquent.
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory.

    protected $table = 'facilities'; // Menentukan nama tabel di database yang diwakili oleh model ini.

    public $timestamps = false; // Menonaktifkan pengelolaan otomatis kolom created_at dan updated_at.

    const CREATED_AT = 'created_on'; // Menentukan kolom created_on sebagai pengganti created_at.

    protected $fillable = [
        'categories_id', // Menentukan bahwa kolom categories_id dapat diisi secara massal.
        'nama_fasilitas', // Menentukan bahwa kolom nama_fasilitas dapat diisi secara massal.
        'keterangan_fasilitas', // Menentukan bahwa kolom keterangan_fasilitas dapat diisi secara massal.
        'status', // Menentukan bahwa kolom status dapat diisi secara massal.
        'jumlah', // Menentukan bahwa kolom jumlah dapat diisi secara massal.
        'tanggal', // Menentukan bahwa kolom tanggal dapat diisi secara massal.
        'nama_file', // Menentukan bahwa kolom nama_file dapat diisi secara massal.
    ];

    public function category() // Mendefinisikan relasi many-to-one dengan model Category.
    {
        return $this->belongsTo(Category::class, 'categories_id'); // Relasi belongsTo ke model Category menggunakan foreign key categories_id.
    }

    public function borrowings() // Mendefinisikan relasi one-to-many dengan model Borrowing.
    {
        return $this->hasMany(Borrowing::class, 'fasilitas_id'); // Relasi hasMany ke model Borrowing menggunakan foreign key fasilitas_id.
    }
}
