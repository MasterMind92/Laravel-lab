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
        Schema::create('sejours', function (Blueprint $table) {
            $table->id("SejourID")->unsignedInteger()->autoIncrement();
            $table->dateTime("DateCheckIn");
            $table->time("HeureCheckIn");
            $table->date("DateCheckOut");
            $table->time("HeureCheckOut");
            $table->tinyInteger("NbOccupantsReels")->default(1);
            $table->boolean("CleRemise")->default(0);
            $table->boolean("CautionVersee")->default(0);
            $table->integer("MontantCaution");
            $table->boolean("CautionRemboursee")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejours');
    }
};
