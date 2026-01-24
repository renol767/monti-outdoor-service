<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convert functionality for JSON columns (features) in landing_services
        $rows = DB::table('landing_services')->get();
        foreach ($rows as $row) {
            $oldValueJson = $row->features;
            
            if (empty($oldValueJson)) {
                continue;
            }

            $oldValue = json_decode($oldValueJson, true);
            
            // Safety: check if already has 'id' key
            if (is_array($oldValue) && array_key_exists('id', $oldValue)) {
                continue;
            }

            $newValue = json_encode(['id' => $oldValue, 'en' => $oldValue]); 
            
            DB::table('landing_services')->where('id', $row->id)->update([
                'features' => $newValue
            ]);
        }
    }

    public function down(): void
    {
        // Irreversible easily
    }
};
