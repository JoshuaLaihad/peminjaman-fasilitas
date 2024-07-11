<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    public $timestamps = false;

    protected $fillable = [
        'fasilitas_id',
        'user_id',
        'tanggal_dari',
        'tanggal_sampai',
        'status',
    ];
    

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'fasilitas_id');
    }

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
