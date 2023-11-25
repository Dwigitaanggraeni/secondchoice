<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_transactions', function (Blueprint $table) {
            $table->string('nomor_unik');
            $table->string('nama_pelanggan');
            $table->decimal('uang_bayar', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->string('cashier_name');

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_transactions', function (Blueprint $table) {
             // Drop the foreign key constraint first
             $table->dropForeign(['user_id']);

             // Then drop the columns
             $table->dropColumn(['nomor_unik', 'nama_pelanggan', 'uang_bayar', 'user_id', 'cashier_name']);
         });
     }
};
