<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('departure_variants', function (Blueprint $table) {

            if (!Schema::hasColumn('departure_variants', 'discount_type')) {
                $table->string('discount_type')
                    ->nullable()
                    ->default('fixed')
                    ->after('pax_limit');
            }

            if (!Schema::hasColumn('departure_variants', 'discount_value')) {
                $table->decimal('discount_value', 12, 2)
                    ->nullable()
                    ->default(0)
                    ->after('discount_type');
            }

            if (!Schema::hasColumn('departure_variants', 'max_discount')) {
                $table->decimal('max_discount', 12, 2)
                    ->nullable()
                    ->after('discount_value');
            }
        });
    }

    public function down(): void
    {
        Schema::table('departure_variants', function (Blueprint $table) {

            if (Schema::hasColumn('departure_variants', 'discount_type')) {
                $table->dropColumn('discount_type');
            }

            if (Schema::hasColumn('departure_variants', 'discount_value')) {
                $table->dropColumn('discount_value');
            }

            if (Schema::hasColumn('departure_variants', 'max_discount')) {
                $table->dropColumn('max_discount');
            }
        });
    }
};