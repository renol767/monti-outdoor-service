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
        Schema::table('trip_type_sections', function (Blueprint $table) {
            $table->longText('content_full')->nullable()->after('content_html');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trip_type_sections', function (Blueprint $table) {
            $table->dropColumn('content_full');
        });
    }
};
