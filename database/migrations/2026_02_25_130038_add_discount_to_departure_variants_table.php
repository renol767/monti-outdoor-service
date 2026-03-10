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
        Schema::table('departure_variants', function (Blueprint $table) {
            // Options: fixed, percentage
            $table->string('discount_type')->nullable()->after('pax_limit')->default('fixed');
            $table->decimal('discount_value', 12, 2)->nullable()->after('discount_type')->default(0);
            
            // To limit max discount amount if type is percentage
            $table->decimal('max_discount', 12, 2)->nullable()->after('discount_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departure_variants', function (Blueprint $table) {
            $table->dropColumn(['discount_type', 'discount_value', 'max_discount']);
        });
    }
};
