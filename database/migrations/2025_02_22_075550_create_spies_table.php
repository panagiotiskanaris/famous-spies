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
        Schema::create('spies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('country_of_operation')->nullable();
            $table->date('date_of_birth');
            $table->date('date_of_death')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->timestamps();

            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->unique(['name', 'surname', 'agency_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spies');
    }
};
