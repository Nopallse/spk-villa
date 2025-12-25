<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('criteria_id')->constrained('criteria')->onDelete('cascade');
            $table->foreignId('villa_id')->nullable()->constrained('villas')->onDelete('cascade');
            $table->integer('preference_value'); // 1-5 Likert scale
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'criteria_id', 'villa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};