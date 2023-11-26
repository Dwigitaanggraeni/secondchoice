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
            $table->decimal('total_belanja', 10, 2)->after('uang_bayar');
            $table->decimal('uang_kembali', 10, 2)->after('total_belanja');
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
            $table->dropColumn('total_belanja');
            $table->dropColumn('uang_kembali');
        });
    }
};
