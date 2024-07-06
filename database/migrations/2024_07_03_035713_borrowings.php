<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fasilitas_id');
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal_dari');
            $table->date('tanggal_sampai'); // Mengganti 'tanggal_mulai' dengan 'tanggal_sampai'
            $table->enum('status', ['diterima', 'ditolak','pending'])->default('pending');
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('fasilitas_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');

    }
};
