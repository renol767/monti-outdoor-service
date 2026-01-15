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
        Schema::dropIfExists('landing_testimonials');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('landing_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('avatar')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->timestamps();
        });
    }
};
