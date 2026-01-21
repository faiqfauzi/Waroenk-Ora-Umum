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
    Schema::table('order_items', function (Blueprint $table) {
        // rename product_name → name (kalau mau lebih rapi)
        $table->renameColumn('product_name', 'name');

        // hapus table_id jika tidak dipakai
        // $table->dropColumn('table_id');

        // optional: tambahkan menu_id
        // $table->integer('menu_id')->nullable();
    });
}

    public function down()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->renameColumn('name', 'product_name');
        // $table->integer('table_id');
        // $table->dropColumn('menu_id');
    });
}

};
