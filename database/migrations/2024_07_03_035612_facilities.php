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
        Schema::create('facilities', function (Blueprint $table) {
            $table->bigIncrements('id_facility');
            $table->unsignedBigInteger('id_category');
            $table->string('nama_fasilitas', 40);
            $table->string('keterangan_fasilitas', 40)->nullable();
            $table->enum('status', ['Tersedia', 'Dipinjam', 'Rusak'])->default('Tersedia');
            $table->integer('jumlah')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nama_gambar');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
