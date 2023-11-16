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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->text('dignities')->nullable();
            $table->text('disadvantages')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('real_buy')->default(true);
            $table->float('rating', 2, 1);
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->boolean('publish')->default(true);
            $table->timestamps();


            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('product_id');

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
