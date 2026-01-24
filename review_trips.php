<?php

use App\Models\TripTemplate;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$trips = TripTemplate::all();

foreach ($trips as $trip) {
    echo "--- Trip: {$trip->getTitleAttribute($trip->getAttributes()['title'])} ---\n";
    // Force get raw attribute to see if it's JSON
    $titleRaw = $trip->getAttributes()['title'];
    echo "Raw Title: $titleRaw\n";
    
    // Check Highlights (EN)
    $highlights = $trip->getTranslation('highlights', 'en');
    echo "Highlights (EN): " . json_encode($highlights) . "\n";

    echo "\n";
}
