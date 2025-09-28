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
        Schema::create('educatrices', function (Blueprint $table) {
            $table->id();
            $table->string('nom_fr');
            $table->string('nom_ar')->nullable();
            $table->string('prenom_fr');
            $table->string('prenom_ar')->nullable();
            $table->string('cin')->unique();
            $table->string('etablissement');
            $table->string('niveau_scolaire');
            $table->integer('annees_experience');
            $table->string('email')->unique()->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Pour permettre la suppression logique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educatrices');
    }
};