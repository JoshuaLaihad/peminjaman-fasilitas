<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 

class Category extends Model 
{
    use HasFactory; 

    protected $table = 'categories'; 
    protected $primaryKey = 'id_category';

    public $timestamps = false;

    protected $fillable = [
        'kategori_fasilitas',
    ];

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'id_category', 'id_category'); 
    }
}
