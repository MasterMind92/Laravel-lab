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
        Schema::create('services', function (Blueprint $table) {
            $table->id("ServiceID")->autoIncrement();
            $table->string("Code");
            $table->string("Libellé")->nullable();
            $table->string("Catégorie")->nullable();
            $table->integer("PrixUnitaire");
            $table->string("DuréeMoyenne")->nullable();
            $table->string("UnitéFacturation");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
