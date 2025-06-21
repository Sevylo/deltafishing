<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->string('nama_pemesan');
    $table->string('nomor_meja');
    $table->date('tanggal_booking');
    $table->time('jam_booking');
    $table->timestamps();
});
 
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('booking_items');
    }
};
