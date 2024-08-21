<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('name', 40);
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('no_handphone', 15);
            $table->string('asal', 50);
            $table->string('chat_id', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

