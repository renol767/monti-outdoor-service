<?php

use App\Models\TripContent;
use App\Models\TripTemplate;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$contents = TripContent::with('tripTemplate')->get();

foreach ($contents as $content) {
    echo "Trip: " . ($content->tripTemplate->title ?? 'Unknown') . "\n";
    echo "Type: {$content->tab_type}\n";
    echo "Content Raw (100 chars): " . substr($content->getAttributes()['content_html'] ?? '', 0, 100) . "...\n";
    echo "EN: " . substr(strip_tags($content->getTranslation('content_html', 'en')), 0, 100) . "...\n";
    echo "ID: " . substr(strip_tags($content->getTranslation('content_html', 'id')), 0, 100) . "...\n";
    echo "----------------\n";
}
