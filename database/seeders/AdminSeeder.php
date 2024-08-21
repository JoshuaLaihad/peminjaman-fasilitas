<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('adminpassword'), // Ganti dengan password yang Anda inginkan
            'role' => 'admin',
            'no_handphone' => '080000000000',
            'asal' => 'Admin Office',
            'chat_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
