<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criteria_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_a_id')->constrained('criteria')->onDelete('cascade');
            $table->foreignId('criteria_b_id')->constrained('criteria')->onDelete('cascade');
            $table->decimal('value', 8, 6); // AHP comparison value (1/9 to 9)
            $table->boolean('is_admin_set')->default(true); // Admin or user comparison
            $table->timestamps();
            
            $table->unique(['criteria_a_id', 'criteria_b_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criteria_comparisons');
    }
};