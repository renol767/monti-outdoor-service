<?php

use App\Models\TripTemplate;
use Illuminate\Support\Facades\DB;

$trips = TripTemplate::all();

foreach ($trips as $trip) {
    // Get RAW attribute to check if it's JSON
    $rawIncludes = $trip->getAttributes()['includes'] ?? null;
    $includes = $trip->includes; // Casted value

    echo "Trip {$trip->id} Raw: " . $rawIncludes . "\n";
    
    // Check if it looks like localized JSON (has 'en' or 'id' key)
    // Since 'includes' is cast to array, $includes might be ['en' => [...], 'id' => [...]]
    
    if (is_array($includes) && (isset($includes['en']) || isset($includes['id']))) {
        echo " - Detected localized structure. Fixing...\n";
        
        $fixed = $includes['id'] ?? $includes['en'] ?? [];
        
        // We need to bypass Mutators if any, but array cast is standard.
        // We can just set the attribute and save.
        $trip->includes = $fixed;
        $trip->save();
        
        echo " - Fixed: " . json_encode($fixed) . "\n";
    } else {
        echo " - OK (not localized)\n";
    }
}
