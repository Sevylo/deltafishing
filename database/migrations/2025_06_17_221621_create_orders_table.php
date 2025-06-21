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
    Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('nama_menu');
    $table->integer('harga');
    $table->integer('jumlah');
    $table->integer('subtotal');
    $table->timestamps();
});

}


public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['jumlah', 'subtotal']);
    });
}


};
