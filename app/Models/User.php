<?php

namespace App\Models; // Menyatakan namespace dari kelas ini.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory.
use Illuminate\Foundation\Auth\User as Authenticatable; // Menggunakan kelas Authenticatable dari Eloquent untuk dukungan autentikasi.
use Illuminate\Notifications\Notifiable; // Menggunakan trait Notifiable untuk mendukung pengiriman notifikasi.
use Laravel\Sanctum\HasApiTokens; // Menggunakan trait HasApiTokens untuk mendukung API token dengan Sanctum.

class User extends Authenticatable // Mendefinisikan kelas User yang merupakan model Eloquent dan dapat diautentikasi.
{
    use HasApiTokens, HasFactory, Notifiable; // Menggunakan trait HasApiTokens, HasFactory, dan Notifiable.

    public function isAdmin() // Mendefinisikan fungsi untuk memeriksa apakah user adalah admin.
    {
        return $this->role === 'admin'; // Mengembalikan true jika field role adalah 'admin'.
    }

    protected $fillable = [
        'name', // Menentukan bahwa kolom name dapat diisi secara massal.
        'username', // Menentukan bahwa kolom username dapat diisi secara massal.
        'password', // Menentukan bahwa kolom password dapat diisi secara massal.
        'role', // Menentukan bahwa kolom role dapat diisi secara massal.
        'no_handphone', // Menentukan bahwa kolom no_handphone dapat diisi secara massal.
        'asal_departemen', // Menentukan bahwa kolom asal_departemen dapat diisi secara massal.
        'chat_id', // Menentukan bahwa kolom chat_id dapat diisi secara massal.
    ];

    protected $hidden = [
        'password', // Menyembunyikan kolom password saat serialisasi.
        'remember_token', // Menyembunyikan kolom remember_token saat serialisasi.
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Mengonversi kolom email_verified_at menjadi datetime.
        'password' => 'hashed', // Mengonversi kolom password menjadi hashed.
    ];

    public function borrowings() // Mendefinisikan relasi one-to-many dengan model Borrowing.
    {
        return $this->hasMany(Borrowing::class); // Relasi hasMany ke model Borrowing.
    }
}
