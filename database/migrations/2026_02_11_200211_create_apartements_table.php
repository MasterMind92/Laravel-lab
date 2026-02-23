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
        Schema::create('apartements', function (Blueprint $table) {
            $table->id("AppartementID")->unsignedInteger()->autoIncrement();
            $table->string("Code");
            $table->string("Type")->nullable();
            $table->string("Surface")->nullable();
            $table->string("Etage")->nullable();
            $table->tinyInteger("CapaciteMax")->default("1");
            $table->string("Etat")->nullable();
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
        Schema::dropIfExists('apartements');
    }
};
