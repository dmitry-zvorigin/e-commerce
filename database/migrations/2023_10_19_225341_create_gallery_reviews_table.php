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
        Schema::create('gallery_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reviews_id');
            $table->string('image');
            $table->string('thumbnail');
            $table->timestamps();

            $table->foreign('reviews_id')->references('id')->on('reviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_reviews');
    }
};
