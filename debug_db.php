<?php

use App\Models\LandingTestimonial;

try {
    LandingTestimonial::create([
        'name' => 'Test',
        'role' => 'Tester',
        'avatar' => 'avatar.jpg',
        'content' => 'Test Content',
        'rating' => 5
    ]);
    echo "Success";
} catch (\Exception $e) {
    echo $e->getMessage();
}
