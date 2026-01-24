<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $table = 'trip_templates';
        $columns = ['title', 'destination', 'highlights', 'trip_facts', 'meta_title', 'meta_description'];
        // Note: difficulty is shared. includes is shared.

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
                
                // Decode if it was previously JSON/Array casted
                $valToSave = $oldValue;
                if (in_array($column, ['highlights', 'trip_facts']) && is_string($oldValue)) {
                     $decoded = json_decode($oldValue, true);
                     if (json_last_error() === JSON_ERROR_NONE) {
                         $valToSave = $decoded;
                     }
                }

                if (!empty($valToSave)) {
                     // Save as {"id": val, "en": val}
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
