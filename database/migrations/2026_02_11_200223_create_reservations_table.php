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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id("ReservationID")->unsignedInteger()->autoIncrement();
            $table->string("Numero");
            $table->dateTime("DateArrivee")->useCurrent();
            $table->dateTime("DateDepart")->useCurrent();
            $table->tinyInteger("NbAdultes")->default(0);
            $table->tinyInteger("NbEnfants")->default(0);
            $table->string("Statut");
            $table->foreign('fkClient')->references('ClientID')->on('client');
            $table->foreign('fkAppart')->references('AppartementID')->on('appartements');
            $table->string("Source")->nullable();
            $table->tinyInteger("Notes")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
