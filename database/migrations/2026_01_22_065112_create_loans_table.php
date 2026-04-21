<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('jenis_identitas');
            $table->foreignId('barang_id')->constrained('items');
            $table->integer('lama_pinjam');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali_realitas')->nullable(); // Tanggal saat owner klik kembali/masalah
            $table->integer('denda')->default(0); // Untuk denda telat (10rb/hari) atau denda rusak/hilang
            $table->enum('status', ['dipinjam', 'kembali', 'rusak', 'hilang'])->default('dipinjam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
