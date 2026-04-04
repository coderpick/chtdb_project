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
        // Enums are difficult to change with Blueprint::change() in many DBs.
        // For MySQL, we use a raw statement.
        DB::statement("ALTER TABLE portfolio_settings MODIFY COLUMN theme ENUM('green', 'blue', 'purple', 'orange', 'dark', 'teal') DEFAULT 'green'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE portfolio_settings MODIFY COLUMN theme ENUM('green', 'blue', 'purple', 'dark', 'teal') DEFAULT 'green'");
    }
};
