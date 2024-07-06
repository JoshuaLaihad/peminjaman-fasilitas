<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $fillable = [
        'fasilitas_id',
        'user_id',
        'tanggal_dari',
        'tanggal_sampai',
        'status',
    ];
    
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }



}
