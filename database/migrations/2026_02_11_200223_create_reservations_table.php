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
            $table->id("ReservationID")->autoIncrement();
            $table->string("Numero");
            $table->dateTime("DateArrivee");
            $table->dateTime("DateDepart");
            $table->tinyInteger("NbAdultes");
            $table->tinyInteger("NbEnfants");
            $table->string("Statut");
            $table->string("Source");
            $table->tinyInteger("Notes");
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
