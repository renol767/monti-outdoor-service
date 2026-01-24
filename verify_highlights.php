<?php

use App\Models\TripTemplate;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$t = TripTemplate::first();
echo "Highlights Type: " . gettype($t->highlights) . "\n";
echo "Content: " . json_encode($t->highlights) . "\n";
echo "First Element: " . ($t->highlights[0] ?? 'NONE') . "\n";

// Emulate Blade loop
foreach (array_slice($t->highlights ?? [], 0, 3) as $h) {
    if (is_array($h)) {
        echo "FAIL: Element is array\n";
    } else {
        echo "OK: Element is string ($h)\n";
    }
}
