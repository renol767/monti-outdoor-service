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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('trip_template_id')->constrained('trip_templates')->cascadeOnDelete();
            $table->timestamps();

            // Each user can only wishlist a trip once
            $table->unique(['user_id', 'trip_template_id']);
            
            // Indexes for querying
            $table->index('user_id', 'idx_wishlist_user');
            $table->index('trip_template_id', 'idx_wishlist_trip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
