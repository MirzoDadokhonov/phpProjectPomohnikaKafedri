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
        //
        Schema::table('scientific_publications', function (Blueprint $table) {
            $table->string('EditionPlace', 50);
            $table->string('Annotation', 1000);
            $table->string('AnnotationEng', 1000);
            $table->string('KeywordList', 200);
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('scientific_publications', function (Blueprint $table) {
            $table->dropColumn('EditionPlace');
            $table->dropColumn('Annotation');
            $table->dropColumn('AnnotationEng');
            $table->dropColumn('KeywordList');
            $table->timestamps();
        });
    }
};
