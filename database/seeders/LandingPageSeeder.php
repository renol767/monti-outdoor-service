<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingSetting;
use App\Models\LandingFeature;
use App\Models\LandingTrip;
use App\Models\LandingService;
use App\Models\LandingGallery;
use App\Models\LandingTestimonial;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate tables to prevent duplicates
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        LandingSetting::truncate();
        LandingFeature::truncate();
        LandingTrip::truncate();
        LandingService::truncate();
        LandingGallery::truncate();
        LandingTestimonial::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Settings
        $settings = [
            ['key' => 'hero_badge', 'value' => 'Your Adventure Starts Here', 'type' => 'text', 'label' => 'Hero Badge Text'],
            ['key' => 'hero_title', 'value' => 'Explore Nature. Discover Adventure.', 'type' => 'text', 'label' => 'Hero Title'],
            ['key' => 'hero_subtitle', 'value' => 'Mountain Trips · Outdoor Adventures · Team Building · Custom Tours', 'type' => 'text', 'label' => 'Hero Subtitle'],
            ['key' => 'hero_bg_image', 'value' => 'images/Annapurna Basecamp.jpg', 'type' => 'image', 'label' => 'Hero Background Image'],
            
            ['key' => 'why_choose_title', 'value' => 'Why Choose Monti', 'type' => 'text', 'label' => 'Why Choose Us Title'],
            ['key' => 'why_choose_description', 'value' => 'We combine expertise, passion, and respect for nature to deliver unforgettable outdoor experiences', 'type' => 'textarea', 'label' => 'Why Choose Us Description'],
            
            ['key' => 'trips_title', 'value' => 'Popular Trips & Packages', 'type' => 'text', 'label' => 'Trips Section Title'],
            ['key' => 'trips_description', 'value' => 'Carefully curated adventures for every type of explorer. From mountain summits to island paradises.', 'type' => 'textarea', 'label' => 'Trips Section Description'],
            
            ['key' => 'services_title', 'value' => 'Our Services', 'type' => 'text', 'label' => 'Services Section Title'],
            ['key' => 'services_description', 'value' => 'Comprehensive outdoor and indoor adventure solutions tailored to your needs', 'type' => 'textarea', 'label' => 'Services Section Description'],
            
            ['key' => 'gallery_title', 'value' => 'Adventure Gallery', 'type' => 'text', 'label' => 'Gallery Section Title'],
            ['key' => 'gallery_description', 'value' => 'Moments captured from our journeys. Join us and create your own unforgettable memories.', 'type' => 'textarea', 'label' => 'Gallery Section Description'],
            
            ['key' => 'testimonials_title', 'value' => 'What Adventurers Say', 'type' => 'text', 'label' => 'Testimonials Section Title'],
            ['key' => 'testimonials_description', 'value' => 'Real experiences from our community of explorers', 'type' => 'textarea', 'label' => 'Testimonials Section Description'],
            
            ['key' => 'about_title', 'value' => 'About Monti Outdoor Service', 'type' => 'text', 'label' => 'About Section Title'],
            ['key' => 'about_image', 'value' => 'images/Surya Kencana 2.jpg', 'type' => 'image', 'label' => 'About Section Image'],
            ['key' => 'about_text', 'value' => '<p class="about-text">Born from a passion for the outdoors and a deep respect for nature, <strong>Monti Outdoor Service</strong> was founded to share Indonesia\'s stunning landscapes with adventurers from all walks of life.</p><p class="about-text">We believe that the best adventures happen when you\'re supported by experienced guides who prioritize your safety, comfort, and connection to the environment. Our team consists of certified mountain guides, outdoor educators, and local experts who know every trail, every peak, and every hidden gem.</p><p class="about-text">Whether you\'re conquering your first summit, exploring remote islands, or building team cohesion in nature, we\'re here to make your journey meaningful, safe, and unforgettable.</p>', 'type' => 'textarea', 'label' => 'About Us Text (HTML Allowed)'],
            
            ['key' => 'cta_title', 'value' => 'Need a Custom Package?', 'type' => 'text', 'label' => 'CTA Title'],
            ['key' => 'cta_description', 'value' => 'Every adventure is unique. Let us craft a personalized itinerary that matches your vision, budget, and schedule.', 'type' => 'textarea', 'label' => 'CTA Description'],
            
            ['key' => 'contact_email', 'value' => 'hello@montioutdoor.com', 'type' => 'text', 'label' => 'Contact Email'],
            ['key' => 'contact_phone', 'value' => '+62 812-3456-7890', 'type' => 'text', 'label' => 'Contact Phone'],
            ['key' => 'contact_address', 'value' => 'Jl. Adventure No. 1, Bogor, Indonesia', 'type' => 'textarea', 'label' => 'Contact Address'],

            // Terms & Conditions
            ['key' => 'terms_conditions_content', 'value' => '<h2>Syarat dan Ketentuan Monti Outdoor Service</h2>

<h3>1. Pendaftaran dan Pembayaran</h3>
<ul>
<li>Pendaftaran trip dianggap sah setelah melakukan pembayaran DP minimal 50%</li>
<li>Pelunasan maksimal H-7 sebelum keberangkatan</li>
<li>Pembayaran dapat dilakukan via transfer bank atau e-wallet</li>
</ul>

<h3>2. Pembatalan</h3>
<ul>
<li>Pembatalan H-14: Pengembalian 75% dari total pembayaran</li>
<li>Pembatalan H-7: Pengembalian 50% dari total pembayaran</li>
<li>Pembatalan H-3: Tidak ada pengembalian</li>
<li>Reschedule dapat dilakukan maksimal 1x dengan biaya administrasi</li>
</ul>

<h3>3. Perlengkapan Peserta</h3>
<ul>
<li>Peserta wajib membawa perlengkapan pribadi sesuai checklist yang diberikan</li>
<li>Perlengkapan teknis disediakan oleh Monti (tenda, matras, peralatan masak grup)</li>
<li>Peserta bertanggung jawab atas barang bawaan masing-masing</li>
</ul>

<h3>4. Kesehatan dan Keselamatan</h3>
<ul>
<li>Peserta wajib dalam kondisi sehat jasmani dan rohani</li>
<li>Mohon informasikan kondisi kesehatan khusus sebelum keberangkatan</li>
<li>Peserta wajib mengikuti instruksi guide demi keselamatan bersama</li>
<li>Keputusan guide untuk membatalkan atau mengubah rute bersifat final demi keselamatan</li>
</ul>

<h3>5. Force Majeure</h3>
<p>Dalam kondisi force majeure (bencana alam, cuaca ekstrem, kebijakan pemerintah), Monti berhak membatalkan atau menunda trip dengan opsi:</p>
<ul>
<li>Reschedule ke tanggal yang tersedia</li>
<li>Pengembalian dana setelah dikurangi biaya operasional yang sudah dikeluarkan</li>
</ul>

<h3>6. Asuransi</h3>
<p>Semua peserta dicakup dalam asuransi perjalanan dasar. Untuk perlindungan tambahan, peserta dianjurkan menggunakan asuransi pribadi.</p>

<h3>7. Dokumentasi</h3>
<p>Dengan mengikuti trip, peserta menyetujui penggunaan foto/video untuk keperluan promosi Monti Outdoor Service.</p>

<p><strong>Dengan mendaftar, peserta dianggap telah membaca dan menyetujui seluruh syarat dan ketentuan di atas.</strong></p>', 'type' => 'textarea', 'label' => 'Terms & Conditions Content (HTML)'],
        ];

        foreach ($settings as $setting) {
            LandingSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 2. Features
        $features = [
            [
                'title' => 'Professional Guides & Safety First',
                'description' => 'Experienced, certified guides ensuring your safety throughout every adventure',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                'order' => 1
            ],
            [
                'title' => 'Full-Support & Gear Provided',
                'description' => 'All necessary equipment and logistics handled for your convenience',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>',
                'order' => 2
            ],
            [
                'title' => 'Custom & Flexible Packages',
                'description' => 'Tailored itineraries to match your adventure style and preferences',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 10 10H12V2z"/><path d="M22 12A10 10 0 1 1 12 2"/></svg>',
                'order' => 3
            ],
            [
                'title' => 'Affordable & Transparent Pricing',
                'description' => 'No hidden fees — clear, competitive pricing for quality service',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
                'order' => 4
            ],
            [
                'title' => 'Small Groups / Personalized Experience',
                'description' => 'Intimate group sizes for a more meaningful and connected journey',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
                'order' => 5
            ],
            [
                'title' => 'Eco-Friendly & Respectful',
                'description' => 'Committed to Leave No Trace principles and supporting local communities',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 0 1 7.38 16.75L12 22l-7.38-3.25A10 10 0 0 1 12 2z"/><path d="M12 8v8"/><path d="M8 12h8"/></svg>',
                'order' => 6
            ],
        ];

        foreach ($features as $feature) {
            LandingFeature::create($feature);
        }

        // 3. Trips
        $trips = [
            [
                'title' => 'Summit Expedition',
                'category' => 'Mountain Trip',
                'image' => 'images/IMG-20241112-WA0001.jpg',
                'description' => 'Conquer majestic peaks with experienced guides. Multi-day expeditions to Indonesia\'s highest summits.',
                'price' => 'From IDR 2,500,000',
                'duration' => '3-7 Days',
                'difficulty' => 'Intermediate - Advanced',
                'is_popular' => true,
                'slug' => 'summit-expedition',
                'order' => 1
            ],
            [
                'title' => 'Island Exploration',
                'category' => 'Outdoor Activity',
                'image' => 'images/Pulau 1.jpg',
                'description' => 'Discover hidden beaches, snorkeling paradise, and pristine island ecosystems.',
                'price' => 'From IDR 1,800,000',
                'duration' => '2-4 Days',
                'difficulty' => 'Beginner - Intermediate',
                'is_popular' => true,
                'slug' => 'island-exploration',
                'order' => 2
            ],
            [
                'title' => 'Wilderness Camping',
                'category' => 'Outdoor Activity',
                'image' => 'images/Dining Tent at Surya Kencana.jpg',
                'description' => 'Sleep under the stars in pristine nature. All gear provided, campfire stories included.',
                'price' => 'From IDR 850,000',
                'duration' => '1-3 Days',
                'difficulty' => 'Beginner - Intermediate',
                'is_popular' => false,
                'slug' => 'wilderness-camping',
                'order' => 3
            ],
            [
                'title' => 'Team Building Adventure',
                'category' => 'Outdoor Activity',
                'image' => 'images/Outdoor Team Building.JPG',
                'description' => 'Strengthen your team through outdoor challenges, collaboration activities, and nature immersion.',
                'price' => 'From IDR 1,200,000',
                'duration' => '1-2 Days',
                'difficulty' => 'All Levels',
                'is_popular' => false,
                'slug' => 'team-building',
                'order' => 4
            ],
            [
                'title' => 'Open Trip Adventure',
                'category' => 'Mountain Trip',
                'image' => 'images/Prau 2.jpg',
                'description' => 'Join fellow adventurers on scheduled group treks. Perfect for solo travelers and new friends.',
                'price' => 'From IDR 950,000',
                'duration' => '2-3 Days',
                'difficulty' => 'Beginner - Intermediate',
                'is_popular' => true,
                'slug' => 'open-trip',
                'order' => 5
            ],
            [
                'title' => 'Cultural City Tour',
                'category' => 'Indoor Activity',
                'image' => 'images/Baduy.jpeg',
                'description' => 'Explore cultural heritage, local cuisine, and historic landmarks with expert local guides.',
                'price' => 'From IDR 650,000',
                'duration' => '1 Day',
                'difficulty' => 'All Levels',
                'is_popular' => false,
                'slug' => 'cultural-tour',
                'order' => 6
            ],
        ];

        foreach ($trips as $trip) {
            LandingTrip::create($trip);
        }

        // 4. Services
        $services = [
            [
                'title' => 'Mountain Trip',
                'description' => 'Professional mountain expeditions and summit climbs with certified guides',
                'icon_bg_class' => 'bg-orange', // Will need to handle SVG in view based on type or just store SVG
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/></svg>',
                'features' => [
                    'Summit expeditions & multi-day treks',
                    'Certified mountain guides',
                    'Complete mountaineering gear',
                    'Safety & emergency protocols'
                ],
                'order' => 1
            ],
            [
                'title' => 'Outdoor Activity Trip',
                'description' => 'Diverse outdoor adventures including camping, island trips, and nature exploration',
                'icon_bg_class' => 'bg-green',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>',
                'features' => [
                    'Island exploration & beach camping',
                    'Wilderness camping experiences',
                    'Nature photography tours',
                    'Water sports & snorkeling'
                ],
                'order' => 2
            ],
            [
                'title' => 'Indoor Activity Trip',
                'description' => 'Cultural experiences, team building workshops, and educational programs',
                'icon_bg_class' => 'bg-blue',
                'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>',
                'features' => [
                    'Cultural heritage city tours',
                    'Team building workshops',
                    'Outdoor skills training',
                    'Environmental education programs'
                ],
                'order' => 3
            ],
        ];

        foreach ($services as $service) {
            LandingService::create($service);
        }

        // 5. Gallery
        $gallery = [
            ['image' => 'images/Puncak Rinjani.jpg', 'caption' => 'Mountain summit', 'order' => 1],
            ['image' => 'images/Annapurna Basecamp.jpg', 'caption' => 'Mountain landscape', 'order' => 2],
            ['image' => 'images/IMG-20250711-WA0004.jpg', 'caption' => 'Mountain peak', 'order' => 3],
            ['image' => 'images/Campsite Surya Kencana Gn. Gede 3.jpg', 'caption' => 'Camping tent', 'order' => 4],
            ['image' => 'images/Binaiya.jpg', 'caption' => 'Forest trail', 'order' => 5],
            ['image' => 'images/Campsite Surya Kencana Gn. Gede 1.jpg', 'caption' => 'Mountain camping', 'order' => 6],
            ['image' => 'images/Prau 4.jpg', 'caption' => 'Sunset view', 'order' => 7],
            ['image' => 'images/Everest Base Camp Trek.jpg', 'caption' => 'Mountain path', 'order' => 8],
            ['image' => 'images/Merbabu.JPG', 'caption' => 'Mountain vista', 'order' => 9],
        ];
        
        foreach ($gallery as $img) {
            LandingGallery::create($img);
        }

        // 6. Testimonials
        $testimonials = [
            [
                'name' => 'Ahmad Rizki',
                'role' => 'Solo Traveler',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100',
                'content' => 'Incredible experience! The guides were professional and the mountain views were breathtaking. Monti made my first summit climb safe and unforgettable.',
                'rating' => 5
            ],
            [
                'name' => 'Siti Nurhaliza',
                'role' => 'Adventure Enthusiast',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100',
                'content' => 'The island exploration package exceeded all expectations. Crystal clear waters, hidden beaches, and a team that truly cares about the environment. Highly recommended!',
                'rating' => 5
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Corporate Team Lead',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100',
                'content' => 'Perfect team building experience! Our team bonded through challenges and enjoyed nature together. Monti\'s facilitators were engaging and professional.',
                'rating' => 5
            ]
        ];

        foreach ($testimonials as $testimonial) {
            LandingTestimonial::create($testimonial);
        }
    }
}
