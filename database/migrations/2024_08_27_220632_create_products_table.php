<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description (optional)
            $table->decimal('price', 10, 2); // Product price with 2 decimal places
            $table->integer('quantity'); // Product quantity in stock
            $table->string('image')->nullable(); // URL or path to the product image (optional)
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key to categories table
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
