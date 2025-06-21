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
    Schema::create('bayars', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('alamat');
        $table->string('nohp', 20);
        $table->integer('jumlah');
        $table->date('tanggal');
        $table->string('nama_barang');
        $table->integer('harga_satuan'); // Added this line
        $table->integer('jumlah_pancing')->nullable();
        $table->integer('jumlah_pakan')->nullable();
        $table->integer('total_harga');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayars');
    }
};
