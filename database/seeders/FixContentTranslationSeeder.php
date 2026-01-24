<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TripTypeSection;

class FixContentTranslationSeeder extends Seeder
{
    public function run()
    {
        $translations = [
            'private-trip' => [
                'title' => 'Private Trip',
                'subtitle' => 'Exclusive mountain trip service designed specifically for you and your group.',
                'content_html' => '<p>Private Trip is an exclusive mountain travel service designed specifically for you and your group. Enjoy full flexibility in determining the schedule, destination, and itinerary according to your wishes.</p><h3>Advantages of Private Trip:</h3><ul><li>Flexible schedule according to group wishes</li><li>Professional guide exclusively for your group</li><li>Customizable itinerary</li><li>Maximum privacy and comfort</li></ul>',
                'content_full' => '<h2>Why Choose Private Trip?</h2><p>With Private Trip, all trip details — from schedule, route, consumption, to climbing tempo — are customized to your needs.</p><h3>Facilities You Get:</h3><ul><li>Certified professional guide</li><li>Porter & logistics</li><li>Meals & drinks during the climb</li><li>Tents, mattresses, and equipment</li><li>Documentation (photo & video)</li><li>Simaksi permit & administration</li></ul>',
            ],
            'one-day-trip' => [
                'title' => 'One Day Trip',
                'subtitle' => 'Perfect choice for those who want to enjoy mountain beauty without camping.',
                'content_html' => '<p>One Day Trip is the perfect choice for those of you who want to enjoy the natural beauty of the mountains without having to stay overnight. Efficient, exciting, and refreshing.</p><h3>Advantages:</h3><ul><li>Time efficient (1 day)</li><li>No heavy varied equipment needed</li><li>Suitable for busy weekends</li><li>Refreshing short escape</li></ul>',
                'content_full' => '<h2>Efficient Adventure</h2><p>Experience the thrill of hiking and beautiful scenery in just one day. We depart early in the morning and return in the afternoon/evening.</p><h3>Destinations:</h3><ul><li>Mount Prau (Dieng)</li><li>Mount Papandayan</li><li>Mount Gede (via Putri)</li><li>Andong Peak</li><li>Sikunir Golden Sunrise</li></ul>',
            ],
            'expedition-trip' => [
                'title' => 'Expedition Trip',
                'subtitle' => 'Advanced mountaineering program for those seeking greater challenges.',
                'content_html' => '<p>Expedition Trip is an advanced mountaineering program for those of you looking for more challenges. Designed for difficult routes or mountains with high technical difficulty.</p><h3>Highlights:</h3><ul><li>Challenging routes (Seven Summits)</li><li>Long duration</li><li>Requires physical/mental preparation</li><li>Expert logistical support</li></ul>',
                'content_full' => '<h2>Conquer the Highest Peaks</h2><p>Join our expedition to conquer Indonesia\'s highest peaks. From Carstensz Pyramid to Mount Kerinci.</p><h3>Includes:</h3><ul><li>Professional expedition leader</li><li>High altitude equipment</li><li>Safety management</li><li>Logistics & transport</li><li>Pre-trip training/briefing</li></ul>',
            ],
            'international-trip' => [
                'title' => 'International Trip',
                'subtitle' => 'Taking you to stunning international hiking destinations.',
                'content_html' => '<p>International Trip takes you to stunning international hiking destinations. From the Himalayas to Kilimanjaro, realize your dream of climbing the world\'s mountains.</p><h3>Destinations:</h3><ul><li>Everest Base Camp (Nepal)</li><li>Annapurna Circuit</li><li>Mount Kilimanjaro (Africa)</li><li>Mount Fuji (Japan)</li><li>Mount Kinabalu (Malaysia)</li></ul>',
                'content_full' => '<h2>Explore the World</h2><p>Experience different cultures and landscapes. We handle all logistics including visas, international flights, and local guides.</p><h3>Why Us?</h3><ul><li>Experienced International Leaders</li><li>Reliable Local Partners</li><li>Comprehensive Itinerary</li><li>Safety First Approach</li></ul>',
            ],
            'custom-trip' => [
                'title' => 'Custom Trip',
                'subtitle' => 'Full freedom to design a journey that suits your dreams.',
                'content_html' => '<p>Custom Trip gives you full freedom to design a trip according to your dreams. Our team will help realize your unique itinerary.</p><h3>Possibilities:</h3><ul><li>Combined destinations</li><li>Special honeymoon trips</li><li>Photography trips</li><li>Research/Survey trips</li></ul>',
                'content_full' => '<h2>Your Trip, Your Rules</h2><p>Tell us your dream destination, duration, budget, and special requests. We will craft the perfect proposal for you.</p><h3>How it works:</h3><ul><li>Free Consultation</li><li>Itinerary Drafting</li><li>Budget Estimation</li><li>Execution & Support</li></ul>',
            ],
            // Outdoor
            'cultural-trip' => [
                'title' => 'Cultural Trip',
                'subtitle' => 'Travel that combines adventure with deep local cultural exploration.',
                'content_html' => '<p>Cultural Trip is a tour that combines adventure with local cultural exploration. Get to know the traditions, art, and life of local communities closer.</p><h3>Experience:</h3><ul><li>Stay at traditional villages</li><li>Learn local crafts/dance</li><li>Traditional culinary experience</li><li>Historical sites visit</li></ul>',
                'content_full' => '<h2>Immersive Experience</h2><p>Don\'t just visit, live it. Interact with locals, learn their wisdom, and experience their daily life.</p><h3>Destinations:</h3><ul><li>Wae Rebo Village</li><li>Baduy Dalam</li><li>Tana Toraja</li><li>Bali Aga Villages</li></ul>',
            ],
            'one-day-outdoor-trip' => [
                'title' => 'One Day Trip',
                'subtitle' => 'Enjoy outdoor adventure without needing to stay overnight.',
                'content_html' => '<p>One Day Trip is suitable for those of you who want to enjoy outdoor adventures without needing to stay overnight. Explore nature in a short time.</p><ul><li>Rafting</li><li>River Tubing</li><li>Paragliding</li><li>Offroad Jeep</li></ul>',
                'content_full' => '<h2>Fun \& Adrenaline</h2><p>Perfect for a quick recharge. Activities designed to pump your adrenaline and refresh your mind.</p><h3>Options:</h3><ul><li>Sentul Trekking</li><li>Bogor Rafting</li><li>Bandung Offroad</li><li>Sukabumi Caving</li></ul>',
            ],
            'island-trip' => [
                'title' => 'Island Trip',
                'subtitle' => 'Explore the beautiful islands of Indonesia.',
                'content_html' => '<p>Island Trip invites you to explore the beautiful islands of Indonesia. Enjoy white sandy beaches, crystal clear sea water, and amazing underwater beauty.</p><ul><li>Island Hopping</li><li>Snorkeling & Diving</li><li>Beach Camping</li><li>Sunset Hunting</li></ul>',
                'content_full' => '<h2>Paradise Awaits</h2><p>Discover hidden gems in the Indonesian archipelago. Relax on pristine beaches or explore vibrant coral reefs.</p><h3>Destinations:</h3><ul><li>Labuan Bajo & Komodo</li><li>Derawan Islands</li><li>Belitung</li><li>Nusa Penida</li><li>Raja Ampat</li></ul>',
            ],
            'camping-trip' => [
                'title' => 'Camping Trip',
                'subtitle' => 'Comfortable camping experience with complete facilities.',
                'content_html' => '<p>Camping Trip offers a comfortable camping experience with complete facilities. Enjoy the night under the stars with friends or family.</p><ul><li>Luxury Camping (Glamping)</li><li>Riverside Camping</li><li>Forest Camping</li><li>Bonfire & BBQ</li></ul>',
                'content_full' => '<h2>Back to Nature</h2><p>Disconnect from the city and reconnect with nature. We provide tents, cooking equipment, and everything you need.</p><h3>Locations:</h3><ul><li>Ranca Upas</li><li>Gunung Pancar</li><li>Cikole Lembang</li><li>Situ Gunung</li></ul>',
            ],
            'outdoor-team-building' => [
                'title' => 'Outdoor Team Building',
                'subtitle' => 'Special program for companies to improve teamwork.',
                'content_html' => '<p>Outdoor Team Building is a special program for companies that want to improve teamwork through challenges in nature.</p><ul><li>Leadership Games</li><li>Communication Challenges</li><li>Problem Solving</li><li>Trust Building</li></ul>',
                'content_full' => '<h2>Build Stronger Teams</h2><p>Fun and effective activities designed to strengthen bonds and improve team dynamics.</p><h3>Programs:</h3><ul><li>Amazing Race</li><li>Treasure Hunt</li><li>Survival Challenge</li><li>Rafting & Paintball</li></ul>',
            ],
            'outdoor-custom-trip' => [
                'title' => 'Outdoor Custom Trip',
                'subtitle' => 'Design your dream outdoor trip according to preferences.',
                'content_html' => '<p>Outdoor Custom Trip allows you to design your dream outdoor trip according to preferences. Our team is ready to facilitate.</p><ul><li>Company Outing</li><li>Family Gathering</li><li>Community Trip</li></ul>',
                'content_full' => '<h2>Tailored Adventures</h2><p>Whether it\'s a family picnic or a corporate adventure, we customize every detail to fit your group.</p>',
            ],
            // Indoor
            'city-tour' => [
                'title' => 'City Tour',
                'subtitle' => 'Explore interesting cities with various landmarks and culinary delights.',
                'content_html' => '<p>City Tour invites you to explore interesting cities with various landmarks, culinary delights, and hits tourist spots.</p><ul><li>Heritage Building</li><li>Museum Tour</li><li>Culinary Hopping</li><li>Shopping</li></ul>',
                'content_full' => '<h2>Discover The City</h2><p>Guided tours to the best spots in town. Learn history, taste local food, and take great photos.</p><h3>Cities:</h3><ul><li>Jakarta Historical Tour</li><li>Bandung Heritage</li><li>Yogyakarta Culture</li><li>Semarang Old Town</li></ul>',
            ],
            'company-gathering' => [
                'title' => 'Company Gathering',
                'subtitle' => 'Gathering event organization service for your company.',
                'content_html' => '<p>Company Gathering is a gathering event organization service for your company. We handle everything from venue, rundown, to entertainment.</p><ul><li>Venue Selection</li><li>Event Concept</li><li>Gala Dinner</li><li>Entertainment</li></ul>',
                'content_full' => '<h2>Memorable Events</h2><p>Celebrate your company\'s achievements with a perfectly organized gathering. We create moments that last.</p>',
            ],
            'outing-tour-travel' => [
                'title' => 'Outing, Tour & Travel',
                'subtitle' => 'Complete tour packages for groups, communities, and companies.',
                'content_html' => '<p>Outing, Tour & Travel provides complete tour packages for groups, communities, and companies. Everything is taken care of.</p><ul><li>Bus Transport</li><li>Hotel Accommodation</li><li>Meals & Catering</li><li>Tour Guide</li></ul>',
                'content_full' => '<h2>Hassle-Free Travel</h2><p>Sit back and relax while we handle all the logistics. Enjoy the journey with your group.</p>',
            ],
            'mice-organizer' => [
                'title' => 'MICE Organizer',
                'subtitle' => 'Professional corporate event organizer service.',
                'content_html' => '<p>MICE Organizer (Meeting, Incentive, Convention, Exhibition) is a professional corporate event organizer service. We are experienced in handling large scale events.</p><ul><li>Corporate Meetings</li><li>Scentive Trips</li><li>Conferences</li><li>Exhibitions</li></ul>',
                'content_full' => '<h2>Professional Execution</h2><p>We ensure your corporate event runs smoothly and leaves a professional impression.</p>',
            ],
            'indoor-team-building' => [
                'title' => 'Indoor Team Building',
                'subtitle' => 'Team development programs that can be done indoors.',
                'content_html' => '<p>Indoor Team Building provides team development programs that can be done indoors. Suitable for weather constraints or preference.</p><ul><li>Creative Games</li><li>Interactive Workshops</li><li>Simulation & Role-play</li></ul>',
                'content_full' => '<h2>Grow Comfortably</h2><p>Effective team building doesn\'t always mean getting dirty. Our indoor programs are just as impactful.</p>',
            ],
            'indoor-custom-trip' => [
                'title' => 'Indoor Custom Trip',
                'subtitle' => 'Design indoor events or trips fully according to your needs.',
                'content_html' => '<p>Indoor Custom Trip allows you to design indoor events or trips fully according to your specific or company needs.</p><ul><li>Personalized Program</li><li>Flexible & Adaptive</li><li>Full Consultation</li></ul>',
                'content_full' => '<h2>Your Event, Your Way</h2><p>We help you conceptualize and execute unique indoor events tailored to your objectives.</p>',
            ],
        ];

        foreach ($translations as $slug => $data) {
            $section = TripTypeSection::where('slug', $slug)->first();
            if ($section) {
                // Determine category for context if needed, but text is distinct enough
                
                $section->setTranslation('title', 'en', $data['title']);
                $section->setTranslation('subtitle', 'en', $data['subtitle']);
                $section->setTranslation('content_html', 'en', $data['content_html']);
                $section->setTranslation('content_full', 'en', $data['content_full']);
                $section->save();
            }
        }
    }
}
