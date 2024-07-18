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
            $table->unsignedBigInteger('fasilitas_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('tanggal_dari')->nullable();
            $table->date('tanggal_sampai')->nullable(); // Mengganti 'tanggal_mulai' dengan 'tanggal_sampai'
            $table->integer('jumlah_dipinjam')->nullable();
            $table->enum('status', ['selesai', 'diterima', 'ditolak','pending'])->default('pending')->nullable();
            $table->timestamp('replicated_created_at')->nullable();
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
