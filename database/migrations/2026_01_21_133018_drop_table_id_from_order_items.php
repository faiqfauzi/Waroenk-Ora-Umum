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
        // Hapus foreign key dulu (nama FK nya otomatis: order_items_table_id_foreign)
        $table->dropForeign(['table_id']);

        // Baru boleh hapus kolomnya
        $table->dropColumn('table_id');
    });
}

public function down()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->unsignedBigInteger('table_id')->nullable();

        $table->foreign('table_id')->references('id')->on('tables');
    });
}

};
