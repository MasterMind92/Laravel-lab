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
        Schema::create('occupants', function (Blueprint $table) {
            $table->id("OccupantID")->unsignedInteger()->autoIncrement();
            $table->string("Nom")->nullable();
            $table->string("Prénom")->nullable();
            $table->date("DateNaissance");
            $table->string("LienClientPrincipal")->nullable();
            $table->string("Etat")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupants');
    }
};
