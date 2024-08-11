<?php

namespace App\Models; // Menyatakan namespace dari kelas ini.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory.
use Illuminate\Database\Eloquent\Model; // Menggunakan kelas Model dari Eloquent ORM.

class Category extends Model // Mendefinisikan kelas Category yang merupakan model Eloquent.
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory.

    protected $table = 'categories'; // Menentukan nama tabel di database yang diwakili oleh model ini.

    public $timestamps = false; // Menonaktifkan pengelolaan otomatis kolom created_at dan updated_at.

    protected $fillable = [
        'kategori_fasilitas', // Menentukan bahwa kolom kategori_fasilitas dapat diisi secara massal.
    ];

    public function facilities() // Mendefinisikan relasi one-to-many dengan model Facility.
    {
        return $this->hasMany(Facility::class, 'categories_id', 'id'); // Relasi hasMany ke model Facility menggunakan foreign key categories_id.
    }
}
