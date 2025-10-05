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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('id_card_number')->unique();
            $table->string('phone_number');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->unsignedInteger('years_of_experience');
            $table->string('education_level');
            $table->string('reference_number')->unique();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('etablissement');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};