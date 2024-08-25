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
        Schema::table('popularity_averages', function (Blueprint $table) {
            $table->integer('pizza_count')->after('pizza_bar_ratio');
            $table->integer('bar_count')->after('pizza_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('popularity_averages', function (Blueprint $table) {
            $table->dropColumn(['pizza_count', 'bar_count']);
        });
    }
};