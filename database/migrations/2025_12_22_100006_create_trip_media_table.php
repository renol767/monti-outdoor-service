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
        Schema::create('trip_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_template_id')->constrained('trip_templates')->cascadeOnDelete();
            $table->string('media_type', 20); // gallery, tracking_map, thumbnail
            $table->string('file_path', 500);
            $table->string('alt_text')->nullable();
            $table->boolean('is_cover')->default(false); // For gallery cover
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Index for fetching media by type
            $table->index(['trip_template_id', 'media_type'], 'idx_media_trip_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_media');
    }
};
