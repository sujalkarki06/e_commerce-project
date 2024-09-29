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
            // Adding transaction_id field
            $table->string('transaction_id')->nullable(); // Transaction ID for payments
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Dropping the transaction_id column in case of rollback
            $table->dropColumn('transaction_id');
        });
    }
};
