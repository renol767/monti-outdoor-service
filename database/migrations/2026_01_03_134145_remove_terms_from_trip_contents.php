<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Removes all per-trip Terms & Conditions content since T&C is now global.
     */
    public function up(): void
    {
        // Delete all trip_contents rows where tab_type = 'terms'
        DB::table('trip_contents')->where('tab_type', 'terms')->delete();
    }

    /**
     * Reverse the migrations.
     * Note: This is a destructive migration, data cannot be recovered.
     */
    public function down(): void
    {
        // Data cannot be restored - this is a one-way migration
    }
};
