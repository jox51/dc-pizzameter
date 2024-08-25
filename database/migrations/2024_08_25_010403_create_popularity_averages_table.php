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
        Schema::create('popularity_averages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iteration_id');
            $table->float('pizza_average_popularity');
            $table->float('bar_average_popularity');
            $table->float('pizza_bar_ratio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popularity_averages');
    }
};