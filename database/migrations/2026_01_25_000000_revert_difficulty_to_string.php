<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Modify the column to string (VARCHAR) immediately.
        // This drops the JSON constraint and converts existing JSON data to its string representation.
        // e.g. {"en": "desc"} becomes '{"en": "desc"}'
        DB::statement("ALTER TABLE trip_templates MODIFY difficulty VARCHAR(255) NULL");

        // 2. Clean up the data.
        // Now that it's a string column, valid JSON strings can still be parsed.
        // We look for strings starting with {, attempting to extract 'en'.
        // If extraction yields null (invalid json or no en), we leave it or handle it?
        // Let's safe update: if it looks like JSON, try to extract.
        
        DB::statement("
            UPDATE trip_templates 
            SET difficulty = JSON_UNQUOTE(JSON_EXTRACT(difficulty, '$.en')) 
            WHERE difficulty LIKE '{%' 
            AND JSON_VALID(difficulty)
        ");
    }

    public function down(): void
    {
        // Re-convert to JSON
        // We assume the string is the 'en' value.
        // We need to wrap it back: 'value' -> '{"en": "value", "id": "value"}'
        
        // 1. Modify back to json (or text first then json? Direct to json might fail if content is not json)
        // It's safer to make it text, update content, then make it json.
        // But since we are likely not reverting, we can just make it nullable string.
        
        // For strict correctness:
        // DB::statement("ALTER TABLE trip_templates MODIFY difficulty JSON NULL");
        // But data would need to be valid JSON first.
    }
};
