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
        Schema::create('factures', function (Blueprint $table) {
            $table->id("FactureID")->unsignedInteger()->autoIncrement();
            $table->string("NumeroFacture");
            $table->dateTime("DateFacture");
            $table->integer("MontantHT")->default(0);
            $table->integer("MontantTVA")->default(0);
            $table->integer("MontantTTC")->default(0);
            $table->string("StatutPaiement");
            $table->dateTime("DatePaiement");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
