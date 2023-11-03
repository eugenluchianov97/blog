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
            $table->id();
            $table->string('name');
            $table->string('name_ro');
            $table->string('name_en');
            $table->text('description')->nullable();
            $table->text('description_ro')->nullable();
            $table->text('description_en')->nullable();
            $table->float('price')->default(0.00);
            $table->float('discount_price')->nullable();
            $table->boolean('recommended')->default(false);
            $table->timestamps();
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
