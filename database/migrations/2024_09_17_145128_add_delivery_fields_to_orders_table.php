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
            // Adding delivery-related fields
            $table->string('delivery_status')->default('pending'); // pending, shipped, delivered
            $table->string('tracking_number')->nullable(); // Tracking number for shipping
            $table->date('estimated_delivery')->nullable(); // Estimated delivery date
            $table->string('shipping_provider')->nullable(); // Shipping company/provider
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Dropping the columns in case of rollback
            $table->dropColumn('delivery_status');
            $table->dropColumn('tracking_number');
            $table->dropColumn('estimated_delivery');
            $table->dropColumn('shipping_provider');
        });
    }
};
