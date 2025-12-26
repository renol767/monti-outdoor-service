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
        Schema::create('departure_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_id')->constrained('trip_departures')->cascadeOnDelete();
            $table->string('name'); // e.g., "Meeting Point Jakarta"
            $table->text('description')->nullable();
            $table->integer('base_price'); // Price in IDR (integer)
            $table->integer('quota')->nullable(); // Per-variant quota (optional)
            $table->integer('booked_count')->default(0);
            $table->string('discount_type', 10)->nullable(); // fixed, percent
            $table->integer('discount_value')->default(0);
            $table->timestamp('discount_start_at')->nullable();
            $table->timestamp('discount_end_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Index for price calculation
            $table->index(['departure_id', 'base_price', 'is_active'], 'idx_variants_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_variants');
    }
};
