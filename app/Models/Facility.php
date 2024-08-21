<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 

class Facility extends Model 
{
    use HasFactory; 

    protected $table = 'facilities'; 

    protected $primaryKey = 'id_facility';

    public $timestamps = false; 

    const CREATED_AT = 'created_on'; 

    protected $fillable = [
        'id_category', 
        'nama_fasilitas', 
        'keterangan_fasilitas', 
        'status', 
        'jumlah', 
        'tanggal', 
        'nama_gambar', 
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class, 'id_category'); 
    }

    public function borrowings() 
    {
        return $this->hasMany(Borrowing::class, 'id_facility');
    }
}
