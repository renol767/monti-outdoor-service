<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convert content_full to JSON
        $column = 'content_full';
        $table = 'trip_type_sections';

        // Rename generic column to temporary name
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
            // Only convert if old value exists
            $newValue = $oldValue ? json_encode(['id' => $oldValue, 'en' => $oldValue]) : null;
            
            DB::table($table)->where('id', $row->id)->update([
                $column => $newValue
            ]);
        }

        // Drop old column
        Schema::table($table, function (Blueprint $table) use ($column) {
            $table->dropColumn($column . '_old');
        });
    }

    public function down(): void
    {
    }
};
