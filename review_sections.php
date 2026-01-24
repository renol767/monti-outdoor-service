<?php

use App\Models\TripTypeSection;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sections = TripTypeSection::all();

foreach ($sections as $section) {
    echo "--- Slug: {$section->slug} ---\n";
    echo "ID Title: " . $section->getTranslation('title', 'id') . "\n";
    echo "EN Title: " . $section->getTranslation('title', 'en') . "\n";
    echo "ID Content: " . substr(strip_tags($section->getTranslation('content_html', 'id')), 0, 100) . "...\n";
    echo "EN Content Key: " . substr(strip_tags($section->getTranslation('content_html', 'en')), 0, 100) . "...\n";
    echo "\n";
}
