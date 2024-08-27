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
            $table->string('event_probability_tier')->nullable()->after('bar_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('popularity_averages', function (Blueprint $table) {
            $table->dropColumn('event_probability_tier');
        });
    }
};
