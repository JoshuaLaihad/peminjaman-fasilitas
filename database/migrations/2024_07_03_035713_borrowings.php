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
            $table->bigIncrements('id_borrowing');
            $table->unsignedBigInteger('id_facility')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->date('tanggal_dari')->nullable();
            $table->date('tanggal_sampai')->nullable();
            $table->integer('jumlah_dipinjam')->nullable();
            $table->enum('status', ['Selesai', 'Diterima', 'Ditolak', 'Pending'])->default('pending');
            $table->string('nama_surat');
            $table->string('tujuan_peminjaman');
            $table->timestamp('replicated_created_at')->nullable();
        
            // Foreign key constraints
            $table->foreign('id_facility')->references('id_facility')->on('facilities')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
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
