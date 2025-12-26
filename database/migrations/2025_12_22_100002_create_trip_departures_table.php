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
        Schema::create('trip_departures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_template_id')->constrained('trip_templates')->cascadeOnDelete();
            $table->date('start_date')->index();
            $table->date('end_date');
            $table->integer('capacity');
            $table->integer('booked_count')->default(0);
            $table->string('status', 20)->default('available')->index(); // available, limited, sold_out, closed
            $table->string('discount_type', 10)->nullable(); // fixed, percent
            $table->integer('discount_value')->default(0);
            $table->timestamp('discount_start_at')->nullable();
            $table->timestamp('discount_end_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Composite index for listing query (trip + date + status)
            $table->index(['trip_template_id', 'start_date', 'status'], 'idx_departures_listing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_departures');
    }
};
