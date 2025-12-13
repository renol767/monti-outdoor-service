<?php

use App\Models\LandingGallery;

try {
    LandingGallery::create([
        'image' => 'images/test.jpg',
        'caption' => 'Test',
        'order' => 1
    ]);
    echo "Success Gallery";
} catch (\Exception $e) {
    echo $e->getMessage();
}
