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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_code', 20)->unique();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('plate', 20)->unique();
            $table->string('brand_model');
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedSmallInteger('capacity_cc')->nullable();
            $table->unsignedInteger('odometer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
