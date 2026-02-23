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
        Schema::create('employes', function (Blueprint $table) {
            $table->id("EmployéID")->unsignedInteger()->autoIncrement();
            $table->string("Matricule");
            $table->string("Nom");
            $table->string("Prénom");
            $table->string("Poste")->nullable();
            $table->string("Email")->nullable();
            $table->string("Téléphone")->nullable();
            $table->dateTime("DateEmbauche")->nullable();
            $table->string("Statut")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
