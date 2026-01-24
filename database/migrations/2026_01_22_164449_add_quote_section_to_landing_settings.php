<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert quote section settings
        DB::table('landing_settings')->insert([
            [
                'key' => 'quote_text',
                'value' => 'Successful operations depend on meticulous preparation. With the right training, planning & mindset, no summit is out of reach.',
                'type' => 'textarea',
                'label' => 'Quote Text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'quote_author',
                'value' => 'Nimsdai Purja MBE',
                'type' => 'text',
                'label' => 'Quote Author',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'quote_author_title',
                'value' => 'High altitude expedition leader',
                'type' => 'text',
                'label' => 'Quote Author Title',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'quote_background_image',
                'value' => 'images/quote-bg.jpg',
                'type' => 'image',
                'label' => 'Quote Background Image (16:9)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('landing_settings')->whereIn('key', [
            'quote_text',
            'quote_author',
            'quote_author_title',
            'quote_background_image',
        ])->delete();
    }
};
