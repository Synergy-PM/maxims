<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->string('year')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('package_number')->nullable();
            $table->string('category_zone')->nullable();
            $table->string('nearby')->nullable();

            $table->string('name');
            $table->string('code')->nullable();
            $table->integer('days')->nullable();
            $table->string('travel_route')->nullable();
            $table->string('color')->nullable()->default('#000000');

            $table->string('maktab');
            $table->string('maktab_number');

            $table->enum('medina_arrival', ['before_hajj', 'after_hajj'])->default('before_hajj');
            $table->enum('hajj_duration', ['short', 'long'])->default('short');

            $table->string('image')->nullable();

            // Package Category - Rate of Exchange
            $table->decimal('pkr_roe', 12, 2)->default(0);
            $table->decimal('usd_roe', 12, 2)->default(0);
            $table->decimal('gbp_roe', 12, 2)->default(0);
            $table->decimal('euro_roe', 12, 2)->default(0);
            $table->decimal('aed_roe', 12, 2)->default(0);

            $table->string('room_type')->nullable();
            $table->string('azizia_room_type')->nullable();

            $table->string('makkah_type')->nullable();
            $table->string('medinah_type')->nullable();
            $table->string('azizia_type')->nullable();
            $table->string('mina_type')->nullable();

            // Prices per currency
            foreach (['pkr', 'sar', 'usd', 'eur', 'gbp', 'aed'] as $currency) {
                $table->decimal("adult_{$currency}", 12, 2)->default(0);
                $table->decimal("child_{$currency}", 12, 2)->default(0);
                $table->decimal("infant_{$currency}", 12, 2)->default(0);
            }

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};