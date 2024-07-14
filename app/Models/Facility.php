<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    public $timestamps = false;

    protected $fillable = [
        'categories_id',
        'nama_fasilitas',
        'merk',
        'model',
        'stok',
        'status',
        'tanggal',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    // Relasi dengan peminjaman
    // public function borrowings()
    // {
    //     return $this->hasMany(Borrowing::class);
    // }

    
}
