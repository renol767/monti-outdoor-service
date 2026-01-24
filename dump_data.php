<?php

use App\Models\LandingService;
use App\Models\LandingFeature;
use App\Models\TripTypeSection;
use App\Models\TripTemplate;
use App\Models\TripContent;

echo "--- Services ---\n";
echo LandingService::all()->toJson(JSON_PRETTY_PRINT) . "\n";

echo "--- Features ---\n";
echo LandingFeature::all()->toJson(JSON_PRETTY_PRINT) . "\n";

echo "--- Trip Sections ---\n";
echo TripTypeSection::all()->toJson(JSON_PRETTY_PRINT) . "\n";

echo "--- Trip Templates ---\n";
// Only fetching relevant fields to keep concise
$trips = TripTemplate::all()->map(function($t) {
    return [
        'id' => $t->id,
        'title' => $t->title, // currently array
        'destination' => $t->destination, // currently array
        'highlights' => $t->highlights, // currently array
        'trip_facts' => $t->trip_facts,
    ];
});
echo $trips->toJson(JSON_PRETTY_PRINT) . "\n";

echo "--- Trip Contents ---\n";
// Content might be large (HTML), let's limit length or just take ID
$contents = TripContent::all()->map(function($c) {
    $html = $c->content_html; // array
    return [
        'id' => $c->id,
        'trip_template_id' => $c->trip_template_id,
        'tab_type' => $c->tab_type,
        // We assume 'id' key holds the value we want to translate
        'content_source' => isset($html['id']) ? substr(strip_tags($html['id']), 0, 500) : 'EMPTY', 
         // Just taking a snippet to understand what to translate?
         // No, if I want to translate, I need the FULL content. 
         // But full content can be huge. 
         // Maybe the user only cares about Titles/Descriptions/Highlights for now?
         // "isi datanya" -> maybe dummy data or real translation? "ngetranslate" implies real.
         // Let's try to get full content for Services/Features/Sections (small). 
         // For TripContent (Itinerary), it might be too big for context window if there are many trips.
    ];
});
// echo $contents->toJson(JSON_PRETTY_PRINT) . "\n"; 
// Skip TripContent for now, stick to metadata first.
