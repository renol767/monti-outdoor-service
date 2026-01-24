<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Hero Slides
        $this->convertColumns('hero_slides', ['title', 'subtitle', 'badge_text']);

        // 2. Landing Features
        $this->convertColumns('landing_features', ['title', 'description']);

        // 3. Landing Services
        $this->convertColumns('landing_services', ['title', 'description']);

        // 4. Trip Templates
        $this->convertColumns('trip_templates', ['title', 'destination', 'meta_title', 'meta_description', 'difficulty']);
        // special handling for existing JSON columns: includes, highlights, trip_facts
        $this->convertJsonColumns('trip_templates', ['includes', 'highlights', 'trip_facts']);

        // 5. Trip Type Sections
        $this->convertColumns('trip_type_sections', ['title', 'subtitle', 'content_html']);

        // 6. Landing Settings (Only value column, but conditionally based on type? No, value is text, we'll convert all to match pattern)
        // Actually, landing_settings is Key-Value. Converting value to JSON globally might break things like 'image' paths.
        // We will skip landing_settings for now as it risks breaking config values. 
        // Can be handled manually or in a separate specific migration if needed.
    }

    protected function convertColumns(string $table, array $columns)
    {
        foreach ($columns as $column) {
            // Rename generic column to temporary name
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->renameColumn($column, $column . '_old');
            });

            // Create new JSON column
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->json($column)->nullable(); // Make nullable temporarily
            });

            // Migrate data
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $oldValue = $row->{$column . '_old'};
                $newValue = json_encode(['id' => $oldValue, 'en' => $oldValue]); // Duplicate to EN for now or leave empty
                
                DB::table($table)->where('id', $row->id)->update([
                    $column => $newValue
                ]);
            }

            // Drop old column
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->dropColumn($column . '_old');
            });
        }
    }

    protected function convertJsonColumns(string $table, array $columns)
    {
        // For columns that are ALREADY JSON (like includes = ["A", "B"])
        // We want to transform them to {"id": ["A", "B"], "en": ["A", "B"]}
        
        foreach ($columns as $column) {
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $oldValueJson = $row->$column;
                
                if (empty($oldValueJson)) {
                    continue; // Skip nulls
                }

                $oldValue = json_decode($oldValueJson, true);
                
                // Safety check: is it already in new format? (Has 'id' key?)
                if (is_array($oldValue) && array_key_exists('id', $oldValue)) {
                    continue;
                }

                $newValue = json_encode(['id' => $oldValue, 'en' => $oldValue]); 
                
                DB::table($table)->where('id', $row->id)->update([
                    $column => $newValue
                ]);
            }
        }
    }

    public function down(): void
    {
        // Revert is complex and lossy if we added translations. 
        // For development safety, we can attempt to extract 'id' back to the column.
        
        // Simulating revert for Hero Slides as example
        // $this->revertColumns('hero_slides', ['title', 'subtitle', 'badge_text']);
        // ... implementing full down() is skipped for this specific one-way upgrade task unless requested.
    }
};
