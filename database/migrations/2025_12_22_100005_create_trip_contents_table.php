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
        Schema::create('trip_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_template_id')->constrained('trip_templates')->cascadeOnDelete();
            $table->string('tab_type', 50); // overview, include_exclude, itinerary, terms
            $table->jsonb('content_delta'); // Quill Delta JSON
            $table->text('content_html')->nullable(); // Cached HTML (optional)
            $table->integer('version')->default(1); // For revision tracking
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // Unique constraint for trip + tab + version
            $table->unique(['trip_template_id', 'tab_type', 'version'], 'idx_contents_version');
            
            // Index for fetching content
            $table->index(['trip_template_id', 'tab_type'], 'idx_contents_trip_tab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_contents');
    }
};
