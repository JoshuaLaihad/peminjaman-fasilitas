<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    public $timestamps = false;

    const CREATED_AT = 'created_on';

    protected $fillable = [
        'categories_id',
        'nama_fasilitas',
        'keterangan_fasilitas',
        'status',
        'jumlah',
        'tanggal',
        'nama_file',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }


    
}
