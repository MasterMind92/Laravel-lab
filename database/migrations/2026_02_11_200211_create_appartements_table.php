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
        Schema::create('appartements', function (Blueprint $table) {
            $table->id("AppartementID")->unsignedInteger()->autoIncrement();
            $table->string("Code");
            $table->string("Type")->nullable();
            $table->string("Surface")->nullable();
            $table->string("Etage")->nullable();
            $table->tinyText("Images")->comment("concatener les liens des images separer par des points virgules")->nullable();
            $table->string("Gmaps")->comment("cette colonne contient le lien google maps de l'appartement")->nullable();
            $table->string("Adresse")->comment("cette colonne contient l'adresse de l'appartement")->nullable();
            $table->tinyInteger("CapaciteMax")->default("1");
            $table->string("Etat")->comment("1.Disponible; 2.Occupe; 3.Maintenance;")->nullable();
            $table->dateTime("DernierNettoyage")->useCurrent();
            $table->dateTime("DateDerniereRenovation");
            $table->string("Observations")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Appartements');
    }
};
