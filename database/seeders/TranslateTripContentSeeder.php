<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TripTemplate;
use App\Models\TripContent;

class TranslateTripContentSeeder extends Seeder
{
    public function run()
    {
        // 1. Labuan Bajo (Island Trip Labuan Bajo 3D2N)
        $this->translateLabuanBajo();

        // 2. Mount Rinjani (Mount Rinjani + Sagara Anak 5D4N)
        $this->translateRinjani();
    }

    private function translateLabuanBajo()
    {
        // Assuming title matching or approximate
        $trip = TripTemplate::where('title', 'like', '%Island Trip Labuan Bajo 3D2N%')->first();
        if (!$trip) return;

        // Overview
        $overview = TripContent::where('trip_template_id', $trip->id)->where('tab_type', 'overview')->first();
        if ($overview) {
            $overview->setTranslation('content_html', 'en', 
                '<p>Labuan Bajo is the gateway to Komodo National Park, an exotic archipelago famous for white sandy beaches, crystal clear waters, and world-class marine life. The <strong>Island Trip 3 Days 2 Nights (3D2N)</strong> program is designed to take you exploring the best islands with a combination of sailing, snorkeling, light trekking, and enjoying iconic sunsets.</p><p>This trip is suitable for travelers who want to experience the Flores sea adventure in a relaxed yet memorable way, with comfortable boat facilities and a professional crew.</p>'
            );
            $overview->save();
        }

        // Itinerary
        $itinerary = TripContent::where('trip_template_id', $trip->id)->where('tab_type', 'itinerary')->first();
        if ($itinerary) {
            $itinerary->setTranslation('content_html', 'en', 
                '<h2><strong>Itinerary</strong></h2>
                <h3><strong>Day 1 – Labuan Bajo – Kelor – Manjarite – Kalong</strong></h3>
                <ul>
                    <li>Airport or hotel pick-up in Labuan Bajo (Start 10:00 - 11:00 AM)</li>
                    <li>Head to harbor and board the boat</li>
                    <li>Visit <strong>Kelor Island</strong>: Trekking for panoramic views</li>
                    <li>Visit <strong>Manjarite</strong>: Snorkeling spot with clear water</li>
                    <li>Sailing to <strong>Kalong Island</strong>: Enjoying sunset and watching bats fly out</li>
                    <li>Dinner and overnight on board</li>
                </ul>
                <h3><strong>Day 2 – Padar – Pink Beach – Komodo – Taka Makassar – Manta Point</strong></h3>
                <ul>
                    <li>Morning trekking at <strong>Padar Island</strong> for iconic sunrise/views</li>
                    <li>Relax and snorkel at <strong>Pink Beach</strong></li>
                    <li>Visit <strong>Komodo Island</strong> to see Komodo dragons (Ranger Guide included)</li>
                    <li>Visit <strong>Taka Makassar</strong>: Sandbar in the middle of the sea</li>
                    <li>Snorkeling at <strong>Manta Point</strong> (finding Manta Rays)</li>
                    <li>Dinner and overnight on board</li>
                </ul>
                <h3><strong>Day 3 – Kanawa – Labuan Bajo</strong></h3>
                <ul>
                    <li>Visit <strong>Kanawa Island</strong>: Snorkeling and relaxing on the beach</li>
                    <li>Return to Labuan Bajo harbor</li>
                    <li>Drop off at Airport or Hotel (End approx. 12:00 - 13:00)</li>
                </ul>'
            );
            $itinerary->save();
        }

        // Include/Exclude
        $inc = TripContent::where('trip_template_id', $trip->id)->where('tab_type', 'include_exclude')->first();
        if ($inc) {
            $inc->setTranslation('content_html', 'en', 
                '<h3><strong>Include</strong></h3>
                <ul>
                    <li>Phinisi / Speedboat during the trip</li>
                    <li>Boat crew & Tour leader</li>
                    <li>Cabin or sleeping area with AC (depending on grade)</li>
                    <li>Meals during the trip (Breakfast, Lunch, Dinner)</li>
                    <li>Snacks, Coffee, Tea & Mineral Water</li>
                    <li>Snorkeling equipment (Mask & Snorkel)</li>
                    <li>Documentation (Drone, Mirrorless/DSLR when available, GoPro)</li>
                    <li>Airport/Hotel Transfer (Pickup & Drop-off)</li>
                </ul>
                <h3><strong>Exclude</strong></h3>
                <ul>
                    <li>Flights to/from Labuan Bajo</li>
                    <li>Komodo National Park Entrance Ticket</li>
                    <li>Hotel in Labuan Bajo (before/after trip)</li>
                    <li>Personal expenses & Tipping</li>
                    <li>Travel Insurance</li>
                </ul>'
            );
            $inc->save();
        }
    }

    private function translateRinjani()
    {
        $trip = TripTemplate::where('title', 'like', '%Mount Rinjani + Sagara Anak 5D4N%')->first();
        if (!$trip) return;

        // Overview
        $overview = TripContent::where('trip_template_id', $trip->id)->where('tab_type', 'overview')->first();
        if ($overview) {
            $overview->setTranslation('content_html', 'en', 
                '<p>Mount Rinjani (3,726 masl) is the second highest volcano in Indonesia and one of the best trekking destinations in Southeast Asia. This 5 Days 4 Nights program offers a complete experience: conquering the Summit, enjoying the beauty of Lake Segara Anak, soaking in natural hot springs, and exploring the savanna.</p><p>We provide full service including porters, tents, mattresses, sleeping bags, and meals during the climb so you can focus on the journey and the scenery.</p>'
            );
            $overview->save();
        }

        // Itinerary
        $itinerary = TripContent::where('trip_template_id', $trip->id)->where('tab_type', 'itinerary')->first();
        if ($itinerary) {
            $itinerary->setTranslation('content_html', 'en', 
                '<h2><strong>Itinerary</strong></h2>
                <h3><strong>Day 1 – Arrival Lombok – Senaru – Basecamp</strong></h3>
                <ul>
                    <li>Pick up at Lombok Airport or hotel</li>
                    <li>Transfer to Senaru/Sembalun Basecamp</li>
                    <li>Check-in at homestay & trekking briefing</li>
                </ul>
                <h3><strong>Day 2 – Sembalun – Plawangan Sembalun</strong></h3>
                <ul>
                    <li>Start trekking from Sembalun Gate</li>
                    <li>Lunch at Pos 2</li>
                    <li>Hike past 7 Hills of Regret (Bukit Penyesalan)</li>
                    <li>Camp at Plawangan Sembalun (Crater Rim)</li>
                    <li>Enjoy sunset and view of Segara Anak Lake</li>
                </ul>
                <h3><strong>Day 3 – Summit Attack – Segara Anak Lake</strong></h3>
                <ul>
                    <li>02:00 AM: Start Summit Attack</li>
                    <li>06:00 AM: Enjoy sunrise at Rinjani Summit (3,726 masl)</li>
                    <li>Descend back to campsite & Lunch</li>
                    <li>Descend to Segara Anak Lake</li>
                    <li>Camp by the lake & Hot Springs</li>
                </ul>
                <h3><strong>Day 4 – Segara Anak – Senaru Crater Rim</strong></h3>
                <ul>
                    <li>Enjoy morning at the lake & hot springs</li>
                    <li>Trek up to Senaru Crater Rim</li>
                    <li>Camp with sunset view over Mount Agung (Bali)</li>
                </ul>
                <h3><strong>Day 5 – Descend to Senaru – Finish</strong></h3>
                <ul>
                    <li>Breakfast with sunrise view</li>
                    <li>Descend through tropical rainforest to Senaru Gate</li>
                    <li>Lunch at Pos 1/Basecamp</li>
                    <li>Transfer to Airport/Mataram/Senggigi/Bangsal Harbor</li>
                </ul>'
            );
            $itinerary->save();
        }

        // Include/Exclude
        $inc = TripContent::where('trip_template_id', $trip->id)->where('tab_type', 'include_exclude')->first();
        if ($inc) {
            $inc->setTranslation('content_html', 'en', 
                '<h3><strong>Include</strong></h3>
                <ul>
                    <li>Official Rinjani National Park Permit</li>
                    <li>Certified Guide & Porter Team</li>
                    <li>Porter carries camping gear & food</li>
                    <li>Camping Equipment (Tent, Mattress, Sleeping Bag, Pillow, Chair)</li>
                    <li>Meals during trek (Breakfast, Lunch, Dinner + Fruits/Snacks)</li>
                    <li>Transport Pick-up & Drop-off (Lombok Area)</li>
                    <li>1 Night Homestay before trek</li>
                    <li>Documentation</li>
                </ul>
                <h3><strong>Exclude</strong></h3>
                <ul>
                    <li>Flights to/from Lombok</li>
                    <li>Personal Porter (for private bag)</li>
                    <li>Tipping Guide & Porter</li>
                    <li>Personal Travel Insurance</li>
                    <li>Extra expenses outside itinerary</li>
                </ul>'
            );
            $inc->save();
        }
    }
}
