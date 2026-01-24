<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TripTemplate;

class FixDoubleEncodedTripsSeeder extends Seeder
{
    public function run()
    {
        $trips = TripTemplate::all();
        $fields = ['title', 'destination', 'meta_title', 'meta_description'];

        foreach ($trips as $trip) {
            $updated = false;
            foreach ($fields as $field) {
                // We use getAttributes to get the raw JSON from DB (because of Accessors/Casts)
                // Actually, since we added Accessors that might handle decoding, let's be careful.
                // Best to use raw query or bypass accessors if possible, but getAttributes() returns raw array of model.
                
                $raw = $trip->getAttributes()[$field] ?? null;
                
                if (!$raw) continue;

                // Attempt to decode outer JSON
                // It should be {"en": "...", "id": "..."}
                $decoded = json_decode($raw, true);

                // If valid JSON object
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $newTrans = [];
                    foreach (['en', 'id'] as $locale) {
                        $val = $decoded[$locale] ?? null;
                        if (is_string($val)) {
                            // Check if this string is ITSELF a JSON
                            $innerDecoded = json_decode($val, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($innerDecoded)) {
                                // Double encoded!
                                // Extract the string for the current locale from the inner JSON
                                // e.g. val was '{"en": "Mount Rinjani", "id": "Gunung Rinjani"}'
                                // We want $innerDecoded[$locale]
                                $newTrans[$locale] = $innerDecoded[$locale] ?? $innerDecoded['en'] ?? $innerDecoded['id'] ?? $val; 
                            } else {
                                // Not double encoded, keep as is
                                $newTrans[$locale] = $val;
                            }
                        } else {
                             $newTrans[$locale] = $val;
                        }
                    }
                    
                    // If we found changes or just reconstructed clean array
                    // Check if it's different from original decoded
                    if ($newTrans !== $decoded) {
                        $trip->setTranslation($field, 'en', $newTrans['en']);
                        $trip->setTranslation($field, 'id', $newTrans['id']);
                        $updated = true;
                    }
                }
            }
            
            if ($updated) {
                 $trip->save();
                 echo "Fixed Trip {$trip->id}\n";
            }
        }
    }
}
