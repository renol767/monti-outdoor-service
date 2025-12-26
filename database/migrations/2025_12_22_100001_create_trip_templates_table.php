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
        Schema::create('trip_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('destination')->nullable();
            $table->string('category', 50)->nullable()->index();
            $table->integer('duration_days');
            $table->integer('duration_nights');
            $table->string('difficulty', 20)->nullable(); // easy, moderate, hard, extreme
            $table->string('thumbnail', 500)->nullable();
            $table->decimal('rating_avg', 2, 1)->default(0);
            $table->integer('rating_count')->default(0);
            $table->string('status', 20)->default('draft')->index(); // draft, published, archived
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            // Index for listing query
            $table->index(['status', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_templates');
    }
};
