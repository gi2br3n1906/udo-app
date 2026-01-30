<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE sponsors MODIFY COLUMN type ENUM('Mega Platinum', 'Platinum', 'Gold', 'Silver', 'Bronze', 'Media Partner') NOT NULL DEFAULT 'Silver'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE sponsors MODIFY COLUMN type ENUM('Platinum', 'Gold', 'Silver', 'Bronze', 'Media Partner') NOT NULL DEFAULT 'Silver'");
    }
};
