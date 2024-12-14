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
        Schema::table('publications', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sphere_id')->constrained()->onDelete('cascade');
        });

        Schema::table('scientific_publications', function (Blueprint $table) {
            $table->foreignId('publication_id')->constrained()->onDelete('cascade');
        });

        Schema::table('methodical_publications', function (Blueprint $table) {
            $table->foreignId('publication_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
