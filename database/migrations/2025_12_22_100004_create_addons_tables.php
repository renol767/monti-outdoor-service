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
        // Master addons table
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Porter Pribadi"
            $table->text('description')->nullable();
            $table->integer('default_price'); // Default price in IDR
            $table->string('unit', 50)->nullable(); // e.g., "per day", "per trip"
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Departure-specific addon assignments
        Schema::create('departure_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_id')->constrained('trip_departures')->cascadeOnDelete();
            $table->foreignId('addon_id')->constrained('addons')->cascadeOnDelete();
            $table->integer('price'); // Override price for this departure
            $table->integer('max_qty')->nullable(); // Max quantity per order
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Each addon can only be assigned once per departure
            $table->unique(['departure_id', 'addon_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_addons');
        Schema::dropIfExists('addons');
    }
};
