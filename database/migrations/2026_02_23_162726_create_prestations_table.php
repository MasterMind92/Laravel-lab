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
        Schema::create('prestations', function (Blueprint $table) {
            $table->id("PrestationID")->unsignedInteger()->autoincrement();
            $table->dateTime("DateDemande")->useCurrent();
            $table->date("DateRéalisation")->nullable();
            $table->time("HeureDébut")->nullable();
            $table->time("HeureFin")->nullable();
            $table->string("Statut")->nullable();
            $table->string("Satisfaction")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestations');
    }
};
