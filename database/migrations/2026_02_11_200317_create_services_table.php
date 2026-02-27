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
        Schema::create('services', function (Blueprint $table) {
            $table->id("ServiceID")->unsignedInteger()->autoIncrement();
            $table->string("Code");
            $table->string("Libelle")->nullable();
            $table->string("Categorie")->nullable();
            $table->integer("PrixUnitaire");
            $table->string("DureeMoyenne")->nullable();
            $table->string("UniteFacturation");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
