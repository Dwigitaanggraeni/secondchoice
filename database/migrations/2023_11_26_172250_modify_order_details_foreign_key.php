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
        Schema::table('tbl_order_details', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']); // Drop the existing foreign key

            $table->foreign('transaction_id')
                ->references('id')->on('tbl_transactions')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->unique('custom_foreign_key_name'); // Specify a custom name for the foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_order_details', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            
            // Add the foreign key back without specifying a custom name
            $table->foreign('transaction_id')
                ->references('id')->on('tbl_transactions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
};
