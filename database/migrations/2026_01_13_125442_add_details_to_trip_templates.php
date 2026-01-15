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
        Schema::table('trip_templates', function (Blueprint $table) {
            $table->string('thumbnail_landscape', 500)->nullable()->after('thumbnail');
            $table->string('trip_itinerary_pdf', 500)->nullable()->after('highlights');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trip_templates', function (Blueprint $table) {
            $table->dropColumn(['thumbnail_landscape', 'trip_itinerary_pdf']);
        });
    }
};
