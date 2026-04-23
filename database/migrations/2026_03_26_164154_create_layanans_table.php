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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->integer('harga_per_kg');
            $table->enum('kategori', ['pakaian', 'selimut', 'sprei']);
            $table->text('deskripsi');
            $table->date('tanggal_tersedia');
            $table->string('gambar');
            $table->string('dokumen');
            $table->boolean('is_admin')->default(false);
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
