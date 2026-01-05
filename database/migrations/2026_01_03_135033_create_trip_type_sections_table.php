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
        Schema::create('trip_type_sections', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50); // 'mountain', 'outdoor', 'indoor'
            $table->string('slug', 100)->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('content_html')->nullable();
            $table->json('images')->nullable(); // Array of image paths
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('category');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_type_sections');
    }
};
