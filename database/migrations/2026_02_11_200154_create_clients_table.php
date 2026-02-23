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
        Schema::create('clients', function (Blueprint $table) {
            $table->id("ClientID")->autoIncrement();
            $table->string("Nom");
            $table->string("Prenom");
            $table->string("Email")->nullable();
            $table->string("Telephone")->nullable();
            $table->string("Adresse")->nullable();
            $table->date("DateNaissance")->nullable();
            $table->string("TypeClient")->nullable();
            $table->string("Statut")->nullable();
            $table->string("PointsFidelite")->default("0");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
