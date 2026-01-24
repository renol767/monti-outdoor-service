<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;
use App\Models\LandingSetting;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing hero data from landing_settings if exists
        $existingHero = LandingSetting::whereIn('key', [
            'hero_badge', 'hero_title', 'hero_subtitle', 'hero_bg_image'
        ])->pluck('value', 'key');

        // Create slide #1 with existing data or defaults
        HeroSlide::create([
            'order' => 1,
            'badge_text' => $existingHero['hero_badge'] ?? 'Your Adventure Starts Here',
            'title' => $existingHero['hero_title'] ?? 'Explore Nature. Discover Adventure.',
            'subtitle' => $existingHero['hero_subtitle'] ?? 'Mountain Trips · Outdoor Adventures · Team Building · Custom Tours',
            'background_image' => $existingHero['hero_bg_image'] ?? 'images/Annapurna Basecamp.jpg',
            'is_active' => true,
        ]);

        // Create slide #2
        HeroSlide::create([
            'order' => 2,
            'badge_text' => 'Conquer the Peaks',
            'title' => 'Mountain Expeditions Await',
            'subtitle' => 'Experience breathtaking views and unforgettable moments on Indonesia\'s highest peaks',
            'background_image' => 'images/Annapurna Basecamp.jpg', // Placeholder - admin will update
            'is_active' => false,
        ]);

        // Create slide #3
        HeroSlide::create([
            'order' => 3,
            'badge_text' => 'Island Paradise',
            'title' => 'Explore Tropical Islands',
            'subtitle' => 'Discover pristine beaches, crystal clear waters, and vibrant marine life',
            'background_image' => 'images/Annapurna Basecamp.jpg', // Placeholder - admin will update
            'is_active' => false,
        ]);

        // Create slide #4
        HeroSlide::create([
            'order' => 4,
            'badge_text' => 'Team Building Excellence',
            'title' => 'Build Stronger Teams',
            'subtitle' => 'Professional outdoor activities designed to enhance teamwork and collaboration',
            'background_image' => 'images/Annapurna Basecamp.jpg', // Placeholder - admin will update
            'is_active' => false,
        ]);

        // Create slide #5
        HeroSlide::create([
            'order' => 5,
            'badge_text' => 'Custom Adventures',
            'title' => 'Your Journey, Your Way',
            'subtitle' => 'Tailor-made itineraries crafted to match your vision, budget, and schedule',
            'background_image' => 'images/Annapurna Basecamp.jpg', // Placeholder - admin will update
            'is_active' => false,
        ]);

        // Optional: Clean up old hero settings from landing_settings
        // Uncomment if you want to remove old keys after migration
        // LandingSetting::whereIn('key', [
        //     'hero_badge', 'hero_title', 'hero_subtitle', 'hero_bg_image'
        // ])->delete();
    }
}
