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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id("CommandeID")->unsignedInteger()->autoincrement();
            $table->dateTime("DateCommande");
            $table->dateTime("DateLivraisonPrévue");
            $table->dateTime("DateLivraisonRéelle");
            $table->string("Statut")->default("Non-livré");
            $table->integer("MontantTotal");
            $table->string("Etat");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
