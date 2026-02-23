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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id("FournisseurID")->unsignedInteger()->autoIncrement();
            $table->string("Nom");
            $table->string("Type")->nullable();
            $table->string("Contact")->nullable();
            $table->string("Téléphone");
            $table->string("Email")->nullable();
            $table->string("Adresse")->nullable();
            $table->string("etat")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
