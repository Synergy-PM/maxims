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
        Schema::table('packages', function (Blueprint $table) {
            $table->text('price_disclaimer')->nullable();
            $table->string('jeddah_taxi_fare')->nullable();
            $table->string('madinah_taxi_fare')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['price_disclaimer', 'jeddah_taxi_fare', 'madinah_taxi_fare']);
        });
    }
};
