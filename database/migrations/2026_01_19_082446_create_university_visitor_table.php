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
    Schema::create('university_visitor', function (Blueprint $table) {
        $table->id();
        $table->foreignId('university_id')->constrained()->cascadeOnDelete();
        $table->foreignId('visitor_id')->constrained()->cascadeOnDelete();
        $table->timestamps();

        // 👇 TAMBAHKAN BARIS INI
        // Supaya satu user cuma bisa nge-like 1x per kampus
        $table->unique(['university_id', 'visitor_id']); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_visitor');
    }
};
