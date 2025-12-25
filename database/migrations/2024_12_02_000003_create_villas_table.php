<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 0); // Price in IDR
            $table->string('location');
            $table->text('address')->nullable();
            $table->integer('capacity');
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->decimal('cleanliness_score', 2, 1)->default(0);
            $table->decimal('facilities_score', 2, 1)->default(0);
            $table->json('facilities')->nullable(); // Array of facilities
            $table->json('images')->nullable(); // Array of image URLs
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};