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
            $table->id("ArticleID")->autoIncrement();
            $table->string("Référence");
            $table->string("Libellé");
            $table->string("Catégorie");
            $table->string("QuantitéStock");
            $table->string("SeuilMin");
            $table->string("Localisation");
            $table->string("Etat");
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
