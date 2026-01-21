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
    Schema::create('menus', function (Blueprint $table) {
        $table->id();  // Menambahkan kolom ID
        $table->string('name');  // Kolom untuk nama menu
        $table->integer('price');  // Kolom untuk harga menu
        $table->text('description')->nullable();  // Kolom untuk deskripsi menu (nullable jika tidak ada)
        $table->timestamps();  // Kolom created_at dan updated_at otomatis
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
