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
        Schema::create('tarifs', function (Blueprint $table) {
            $table->id("TarifID")->unsignedInteger()->autoIncrement();
            $table->string("TypeAppartement")->nullable();
            $table->date("PeriodeDebut");
            $table->date("PeriodeFin");
            $table->integer("PrixJournalier")->default(0);
            $table->integer("PrixHebdomadaire")->default(0);
            $table->integer("PrixMensuel")->default(0);
            $table->string("Conditions");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifs');
    }
};
