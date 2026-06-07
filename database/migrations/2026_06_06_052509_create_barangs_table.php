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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 150);
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->nullOnDelete();
            $table->string('satuan', 50); //pcs, pack,box, kg, dll
            $table->integer('jumlah_stok')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->decimal('harga_jual', 15, 2)->default(0);
            $table->decimal('harga_beli', 15, 2)->default(0);
            $table->string('berat_ukuran', 100)->nullable(); // contohnya seperti 500gram
            $table->string('lokasi_simpan', 100)->nullable(); // contohnya seperti Rak A-3
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel barangs
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
