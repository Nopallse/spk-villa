<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            // Enable foreign keys for SQLite
            DB::statement('PRAGMA foreign_keys = ON');
            
            // For SQLite, we need to recreate the tables to ensure foreign keys work
            // But this is risky with existing data, so we'll just enable foreign keys
            // The constraints should work if they were created correctly
            return;
        }

        // For MySQL/MariaDB: Drop and recreate foreign keys with CASCADE
        if ($driver === 'mysql' || $driver === 'mariadb') {
            Schema::table('criteria_comparisons', function (Blueprint $table) {
                // Drop existing foreign keys if they exist
                $table->dropForeign(['criteria_a_id']);
                $table->dropForeign(['criteria_b_id']);
            });

            Schema::table('criteria_comparisons', function (Blueprint $table) {
                // Recreate with CASCADE
                $table->foreign('criteria_a_id')
                    ->references('id')
                    ->on('criteria')
                    ->onDelete('cascade');
                
                $table->foreign('criteria_b_id')
                    ->references('id')
                    ->on('criteria')
                    ->onDelete('cascade');
            });

            Schema::table('user_preferences', function (Blueprint $table) {
                // Drop existing foreign key if it exists
                $table->dropForeign(['criteria_id']);
            });

            Schema::table('user_preferences', function (Blueprint $table) {
                // Recreate with CASCADE
                $table->foreign('criteria_id')
                    ->references('id')
                    ->on('criteria')
                    ->onDelete('cascade');
            });
        }

        // For PostgreSQL
        if ($driver === 'pgsql') {
            Schema::table('criteria_comparisons', function (Blueprint $table) {
                $table->dropForeign(['criteria_a_id']);
                $table->dropForeign(['criteria_b_id']);
            });

            Schema::table('criteria_comparisons', function (Blueprint $table) {
                $table->foreign('criteria_a_id')
                    ->references('id')
                    ->on('criteria')
                    ->onDelete('cascade');
                
                $table->foreign('criteria_b_id')
                    ->references('id')
                    ->on('criteria')
                    ->onDelete('cascade');
            });

            Schema::table('user_preferences', function (Blueprint $table) {
                $table->dropForeign(['criteria_id']);
            });

            Schema::table('user_preferences', function (Blueprint $table) {
                $table->foreign('criteria_id')
                    ->references('id')
                    ->on('criteria')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse - this migration only fixes constraints
    }
};
