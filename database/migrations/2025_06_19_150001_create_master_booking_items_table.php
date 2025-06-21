<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('menu_name');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('booking_items');
    }
};
