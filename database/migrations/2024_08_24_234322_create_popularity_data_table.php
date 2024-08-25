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
        Schema::create('popularity_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iteration_id');
            $table->string('place_id');
            $table->string('name');
            $table->string('type'); // Added this line
            $table->integer('current_popularity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popularity_data');
    }
};