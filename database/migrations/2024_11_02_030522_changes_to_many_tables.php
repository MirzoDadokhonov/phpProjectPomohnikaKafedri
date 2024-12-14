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

        Schema::table('authors', function (Blueprint $table) {
            //
            $table->string('FullName', 100);
            $table->string('Email', 100);
            $table->string('ORCID', 20);
            $table->string('Role', 20);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
     
        Schema::table('authors', function (Blueprint $table) {
            //
            $table->dropColumn('FullName');
            $table->dropColumn('Email');
            $table->dropColumn('ORCID');
            $table->dropColumn('Role');
        });
    }
};
