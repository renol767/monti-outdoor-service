<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convert columns in trip_contents
        $table = 'trip_contents';
        $columns = ['content_html', 'content_delta'];

        foreach ($columns as $column) {
            // Rename
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->renameColumn($column, $column . '_old');
            });

            // Create new JSON column
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->json($column)->nullable();
            });

            // Migrate data
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $oldValue = $row->{$column . '_old'};
                // For delta (json), decode first
                if ($column === 'content_delta' && $oldValue) {
                    $json = json_decode($oldValue); // it was likely stringified json or json column?
                    // if origin column was text/longtext, it's string. If json, it's string (from get()).
                    // Actually, if it was json column, laravel returns string or object? DB facade returns string usually for json.
                    // Let's assume input needs to be structured: {"id": OLD, "en": OLD}
                    // Wait, if existing data is "Overview text", then new data is {"id": "Overview text", "en": "Overview text"}
                    
                    // Note: content_delta determines the Quill instructions.
                }
                
                $valToSave = $oldValue;
                if ($column === 'content_delta' && is_string($oldValue)) {
                    $valToSave = json_decode($oldValue);
                }

                if (!empty($valToSave)) {
                     $newValue = json_encode(['id' => $valToSave, 'en' => $valToSave]);
                     DB::table($table)->where('id', $row->id)->update([
                         $column => $newValue
                     ]);
                }
            }

            // Drop old
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->dropColumn($column . '_old');
            });
        }
    }

    public function down(): void
    {
    }
};
