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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id("InterventionID")->unsignedInteger()->autoIncrement();
            $table->dateTime("DateDemande")->nullable();
            $table->dateTime("DateIntervention")->nullable();
            $table->string("Type")->nullable();
            $table->string("Description")->nullable();
            $table->string("Priorite")->nullable();
            $table->integer("CoutMateriel")->nullable();
            $table->integer("CoutMainOeuvre")->nullable();
            $table->string("Statut")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
