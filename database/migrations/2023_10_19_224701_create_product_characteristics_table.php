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
        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('value_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('group_attributes')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('attribute_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_characteristics');
    }
};
