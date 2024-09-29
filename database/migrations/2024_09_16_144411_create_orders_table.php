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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable for guest users
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');
            $table->string('phone');
            $table->string('payment_method'); // E.g., 'credit_card', 'paypal'
            $table->decimal('total', 10, 2); // Total price for the order
            $table->string('status')->default('pending'); // Status: pending, paid, shipped, etc.
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
