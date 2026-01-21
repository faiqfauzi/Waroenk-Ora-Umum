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
    Schema::table('menus', function (Blueprint $table) {
        // Menambahkan kolom category_id dengan nilai default null
        $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
    });
}


public function down()
{
    Schema::table('menus', function (Blueprint $table) {
        // Menghapus kolom category_id jika rollback
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}
};
