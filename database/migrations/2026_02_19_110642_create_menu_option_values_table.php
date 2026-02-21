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
    Schema::create('menu_option_values', function (Blueprint $table) {
        $table->id();
        $table->foreignId('menu_option_id')
              ->constrained()
              ->onDelete('cascade');
        $table->string('label'); // contoh: Pedas, Telur
        $table->integer('additional_price')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_option_values');
    }
};
