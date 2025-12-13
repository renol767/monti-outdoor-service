<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('landing_settings')->truncate();

        $settings = [
            // Hero
            ['key' => 'hero_title', 'value' => 'Discover the Unseen Beauty of Indonesia', 'type' => 'text'],
            ['key' => 'hero_subtitle', 'value' => 'Expert-guided mountain expeditions and outdoor adventures tailored for every explorer.', 'type' => 'text'],
            ['key' => 'hero_badge', 'value' => 'Your Adventure Starts Here', 'type' => 'text'],
            ['key' => 'hero_bg_image', 'value' => 'images/Annapurna Basecamp.jpg', 'type' => 'image'],

            // Why Choose Us
            ['key' => 'why_choose_title', 'value' => 'Why Choose Monti', 'type' => 'text'],
            ['key' => 'why_choose_description', 'value' => 'We combine expertise, passion, and respect for nature to deliver unforgettable outdoor experiences', 'type' => 'text'],

            // Trips
            ['key' => 'trips_title', 'value' => 'Popular Trips & Packages', 'type' => 'text'],
            ['key' => 'trips_description', 'value' => 'Carefully curated adventures for every type of explorer. From mountain summits to island paradises.', 'type' => 'text'],

            // Services
            ['key' => 'services_title', 'value' => 'Our Services', 'type' => 'text'],
            ['key' => 'services_description', 'value' => 'Comprehensive outdoor and indoor adventure solutions tailored to your needs', 'type' => 'text'],

            // Gallery
            ['key' => 'gallery_title', 'value' => 'Adventure Gallery', 'type' => 'text'],
            ['key' => 'gallery_description', 'value' => 'Moments captured from our journeys. Join us and create your own unforgettable memories.', 'type' => 'text'],

            // Testimonials
            ['key' => 'testimonials_title', 'value' => 'What Adventurers Say', 'type' => 'text'],
            ['key' => 'testimonials_description', 'value' => 'Real experiences from our community of explorers', 'type' => 'text'],

            // About
            ['key' => 'about_title', 'value' => 'About Monti Outdoor Service', 'type' => 'text'],
            ['key' => 'about_text', 'value' => '<p>At Monti Outdoor Service, we believe that nature has the power to transform. Founded by a team of passionate mountaineers and outdoor enthusiasts, our mission is to make the beauty of Indonesia\'s wilderness accessible to everyone, safely and responsibly.</p><p>With years of experience navigating the archipelago\'s diverse terrains, we specialize in organizing trips that are not just holidays, but life-affirming experiences. From the misty peaks of Java to the pristine beaches of East Indonesia, we are your trusted partners in adventure.</p>', 'type' => 'textarea'],
            ['key' => 'about_image', 'value' => 'images/Surya Kencana 2.jpg', 'type' => 'image'],

            // CTA
            ['key' => 'cta_title', 'value' => 'Need a Custom Package?', 'type' => 'text'],
            ['key' => 'cta_description', 'value' => 'Every adventure is unique. Let us craft a personalized itinerary that matches your vision, budget, and schedule.', 'type' => 'text'],

            // Contact
            ['key' => 'contact_email', 'value' => 'hello@montioutdoor.com', 'type' => 'text'],
            ['key' => 'contact_phone', 'value' => '+62 812 3456 7890', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => 'Jakarta, Indonesia', 'type' => 'text'],

            // GLOBAL SETTINGS (Branding & Social)
            ['key' => 'global_logo', 'value' => 'images/logo/Untitled-4.png', 'type' => 'image'],
            ['key' => 'global_footer_logo', 'value' => '', 'type' => 'image'], // Empty by default
            ['key' => 'global_footer_text', 'value' => 'Your trusted partner for outdoor adventures and mountain expeditions across Indonesia.', 'type' => 'textarea'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com', 'type' => 'text'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com', 'type' => 'text'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com', 'type' => 'text'],
        ];

        DB::table('landing_settings')->insert($settings);
    }
}
