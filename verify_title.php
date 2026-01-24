<?php

use App\Models\TripTemplate;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$t = TripTemplate::first();
echo "Title Type: " . gettype($t->title) . "\n";
echo "Title Content: " . $t->title . "\n";

echo "Destination Type: " . gettype($t->destination) . "\n";
echo "Destination Content: " . $t->destination . "\n";
