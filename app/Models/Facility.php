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
    ];

    public function borrowings()
    {
        return $this->belongsTo(Borrowing::class);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    
}
