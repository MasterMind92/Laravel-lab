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
        Schema::create('ligne_factures', function (Blueprint $table) {
            $table->id("LigneID")->unsignedInteger()->autoincrement();
            $table->string("Description");
            $table->tinyInteger("Quantite")->default(0);
            $table->integer("PrixUnitaire")->default(0);
            $table->integer("TVA")->default(0);
            $table->string("TotalLigne")->nullable();
            $table->string("TypeLigne")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_factures');
    }
};
