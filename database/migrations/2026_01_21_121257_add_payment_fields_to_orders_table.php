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
    Schema::table('orders', function (Blueprint $table) {
        $table->string('method')->default('kasir'); // qris / kasir
        $table->integer('subtotal')->default(0);
        $table->integer('tax')->default(0);
        $table->text('notes')->nullable();
        $table->string('proof')->nullable(); // path bukti upload
    });
}

    public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['method', 'subtotal', 'tax', 'notes', 'proof']);
    });
}
};
