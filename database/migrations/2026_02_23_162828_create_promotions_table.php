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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id("PromotionID")->unsignedInteger()->autoIncrement();
            $table->string("Code");
            $table->string("Description")->nullable();
            $table->string("TypeRemise");
            $table->string("ValeurRemise");
            $table->date("DateDébut")->nullable();
            $table->date("DateFin")->nullable();
            $table->string("ConditionsApplication");
            $table->string("Etat")->default("A");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
