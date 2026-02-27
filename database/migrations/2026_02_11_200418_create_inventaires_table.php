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
        Schema::create('inventaires', function (Blueprint $table) {
            $table->id("ArticleID")->unsignedInteger()->autoIncrement();
            $table->string("Reference")->nullable();
            $table->string("Libelle")->nullable();
            $table->string("Categorie")->nullable();
            $table->integer("QuantiteStock")->default(0);
            $table->string("SeuilMin")->default(0);
            $table->string("Localisation")->nullable();
            $table->string("Etat")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaires');
    }
};
