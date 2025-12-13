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
        // 1. General Settings (Hero, About, Contact info, etc.)
        Schema::create('landing_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, number
            $table->string('label')->nullable(); // For Admin UI
            $table->timestamps();
        });

        // 2. Features (Why Choose Monti)
        Schema::create('landing_features', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('icon')->nullable(); // SVG code or image path
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 3. Trips (Popular Trips)
        Schema::create('landing_trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable(); // For detail page URL
            $table->text('description');
            $table->string('price'); // e.g. "From IDR 2,500,000"
            $table->string('duration'); // e.g. "3-7 Days"
            $table->string('difficulty'); // e.g. "Intermediate - Advanced"
            $table->string('category'); // e.g. "Mountain Trip" or "Outdoor Activity"
            $table->string('image');
            $table->boolean('is_popular')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 4. Services (Our Services)
        Schema::create('landing_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('icon')->nullable();
            $table->string('icon_bg_class')->nullable(); // e.g. bg-orange, bg-green
            $table->json('features')->nullable(); // List of features
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 5. Gallery
        Schema::create('landing_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 6. Testimonials
        Schema::create('landing_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('avatar')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_testimonials');
        Schema::dropIfExists('landing_galleries');
        Schema::dropIfExists('landing_services');
        Schema::dropIfExists('landing_trips');
        Schema::dropIfExists('landing_features');
        Schema::dropIfExists('landing_settings');
    }
};
