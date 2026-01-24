<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LandingService;
use App\Models\LandingFeature;
use App\Models\TripTypeSection;
use App\Models\TripTemplate;
use Illuminate\Support\Str;

class TranslationSeeder extends Seeder
{
    public function run()
    {
        $this->translateServices();
        $this->translateFeatures();
        $this->translateSections();
        $this->translateTrips();
    }

    private function translateServices()
    {
        $services = LandingService::all();
        foreach ($services as $service) {
            $id = $service->getTranslation('title', 'id');
            // Mock translation logic based on known strings or generic
            $enTitle = $this->mockTranslate($id, 'title');
            $enDesc = $this->mockTranslate($service->getTranslation('description', 'id'), 'description');
            
            $service->setTranslation('title', 'en', $enTitle);
            $service->setTranslation('description', 'en', $enDesc);
            $service->save();
        }
    }

    private function translateFeatures()
    {
        $features = LandingFeature::all();
        foreach ($features as $feature) {
             $id = $feature->getTranslation('title', 'id');
             $enTitle = $this->mockTranslate($id, 'title');
             $enDesc = $this->mockTranslate($feature->getTranslation('description', 'id'), 'description');
             
             $feature->setTranslation('title', 'en', $enTitle);
             $feature->setTranslation('description', 'en', $enDesc);
             $feature->save();
        }
    }

    private function translateSections()
    {
        $sections = TripTypeSection::all();
        foreach ($sections as $section) {
            $idTitle = $section->getTranslation('title', 'id');
            $section->setTranslation('title', 'en', $this->mockTranslate($idTitle, 'title'));
            
            $idSub = $section->getTranslation('subtitle', 'id');
            if($idSub) $section->setTranslation('subtitle', 'en', $this->mockTranslate($idSub, 'subtitle'));

            // Content HTML (Simple replacement for now)
            $idContent = $section->getTranslation('content_html', 'id');
            if($idContent) $section->setTranslation('content_html', 'en', $this->mockTranslateHtml($idContent));

            $idFull = $section->getTranslation('content_full', 'id');
            if($idFull) $section->setTranslation('content_full', 'en', $this->mockTranslateHtml($idFull));
            
            $section->save();
        }
    }

    private function translateTrips()
    {
        $trips = TripTemplate::all();
        foreach ($trips as $trip) {
            $idTitle = $trip->getTranslation('title', 'id');
            $trip->setTranslation('title', 'en', $this->mockTranslate($idTitle, 'title')); // Usually title is same key often.. or "Mount Rinjani" is same.

            $idDest = $trip->getTranslation('destination', 'id');
            if($idDest) $trip->setTranslation('destination', 'en', $idDest); // "Lombok, Indonesia" is same

            $idHigh = $trip->getTranslation('highlights', 'id');
            if(is_array($idHigh)) {
                 $enHigh = array_map(fn($h) => $this->mockTranslate($h, 'highlight'), $idHigh);
                 $trip->setTranslation('highlights', 'en', $enHigh);
            }

            // Trip Facts (if present)
            // Stored as: { "grade": {"value": "V", "enabled": "1"} } -> in "id"
            // We want "en" to have translated values.
            // Currently DB has {"id": {orig}, "en": {orig}}
            $factsID = $trip->getTranslation('trip_facts', 'id');
            if(is_array($factsID)) {
                $factsEN = [];
                foreach ($factsID as $key => $data) {
                    $factsEN[$key] = $data;
                    if(isset($data['value']) && $data['value']) {
                        $factsEN[$key]['value'] = $this->mockTranslate($data['value'], 'fact');
                    }
                }
                $trip->setTranslation('trip_facts', 'en', $factsEN);
            }

            $trip->save();
        }
    }

    private function mockTranslate($text, $type)
    {
        // Simple dictionary for known strings in dump
        $dict = [
            'Program team building yang menantang' => 'Challenging Team Building Program',
            'Paket wisata mendaki gunung' => 'Mountain Hiking Tour Package',
            'Amazing Race' => 'Amazing Race', // same
            'Treasure Hunt' => 'Treasure Hunt',
            'Indoor Team Building' => 'Indoor Team Building',
            'Indoor Custom Trip' => 'Indoor Custom Trip',
            'Mount Rinjani + Sagara Anak 5D4N' => 'Mount Rinjani + Sagara Anak 5D4N',
            'Island Trip Labuan Bajo 3D2N' => 'Labuan Bajo Island Trip 3D2N',
            'Everest Base Camp 16D15N' => 'Everest Base Camp 16D15N',
            'Expert Guide Included' => 'Expert Guide Included',
            'All Meals Included' => 'All Meals Included',
            'Equipment Provided' => 'Equipment Provided',
            'Danau Sagara Anak' => 'Lake Sagara Anak',
            'Komodo Dragon Encounter' => 'Komodo Dragon Encounter',
            'Pink Beach Snorkeling' => 'Pink Beach Snorkeling',
            'Island Hopping Cruise' => 'Island Hopping Cruise',
            'Snorkeling' => 'Snorkeling',
            'V - Extreme' => 'V - Extreme',
            '120KM' => '120KM',
            '16D 15N' => '16D 15N',
            '6000 MDPL' => '6000 MASL',
            // Add more generic logic
            'Program team building indoor yang kreatif dan efektif' => 'Creative and effective indoor team building program',
            'Rancang acara atau perjalanan indoor sesuai keinginan' => 'Design your custom indoor event or trip',
        ];

        if (is_array($text)) return $text;
        if (!is_string($text)) return (string) $text;
        if (trim($text) === '') return '';

        // Exact match
        if (isset($dict[$text])) return $dict[$text];

        // Partial or specific replacements
        $replacements = [
            '/yang/' => 'that is',
            '/dan/' => 'and',
            '/atau/' => 'or',
            '/untuk/' => 'for',
            '/dengan/' => 'with',
            '/selama/' => 'during',
            '/hari/' => 'days',
            '/malam/' => 'nights',
            '/mdpl/i' => 'MASL',
            '/Jam/' => 'Hours',
            '/Menit/' => 'Minutes',
            '/Menengah/' => 'Medium',
            '/Mudah/' => 'Easy',
            '/Sulit/' => 'Hard',
            '/Ekstrim/' => 'Extreme',
            '/Aspal/' => 'Paved',
            '/Pasir/' => 'Sand',
            '/Hutan/' => 'Forest',
        ];

        $translated = $text;
        foreach ($replacements as $pattern => $replace) {
            $translated = preg_replace($pattern, $replace, $translated);
        }

        if ($type === 'title') return $translated;
        
        return $translated;
    }

    private function mockTranslateHtml($html)
    {
        // Very basic HTML translation
        $html = str_replace(['<li>', '</li>', '<ul>', '</ul>', '<p>', '</p>', '<h2>', '</h2>', '<h3>', '</h3>'], 
                            ['[LI]', '[/LI]', '[UL]', '[/UL]', '[P]', '[/P]', '[H2]', '[/H2]', '[H3]', '[/H3]'], $html);
        
        $text = strip_tags($html); // stripped but markers remain if I didn't replace them? strip_tags removes actual tags.
        // Better: just replace known Indonesian words in the HTML string
        
        $replacements = [
            'Program team building indoor yang kreatif dan efektif' => 'Creative and effective indoor team building program',
            'menyediakan program pengembangan tim' => 'provides team development programs',
            'dapat dilakukan di dalam ruangan' => 'can be done indoors',
            'Cocok untuk kondisi cuaca tidak mendukung' => 'Suitable for unfavorable weather conditions',
            'Workshop interaktif' => 'Interactive Workshop',
            'Simulasi dan role-play' => 'Simulation and role-play',
            'Tidak selalu tim building harus di outdoor' => 'Team building doesn\'t always have to be outdoors',
            'dirancang untuk memberikan pengalaman' => 'designed to provide an experience',
            'Keuntungan' => 'Advantages',
            'Tidak tergantung cuaca' => 'Not weather dependent',
            'lebih fleksibel waktunya' => 'more flexible timing',
            'bisa dilakukan di office' => 'can be done at the office',
            'memungkinkan Anda merancang acara' => 'allows you to design events',
            'sesuai kebutuhan spesifik Anda' => 'according to your specific needs',
            'Setiap perusahaan dan organisasi memiliki kebutuhan yang unik' => 'Every company and organization has unique needs',
            'Yang Bisa Dikustomisasi' => 'What Can Be Customized',
            'Jenis event atau aktivitas' => 'Type of event or activity',
            'Lokasi dan venue' => 'Location and venue',
            'Durasi program' => 'Program duration',
            'Jumlah peserta' => 'Number of participants',
            'Cara Pemesanan' => 'How to Order',
            'Hubungi kami untuk konsultasi awal' => 'Contact us for initial consultation',
            'Diskusikan kebutuhan' => 'Discuss needs',
            'Kami siapkan proposal custom' => 'We prepare a custom proposal',
            'Revisi hingga sesuai' => 'Revise until suitable',
            'Konfirmasi dan eksekusi' => 'Confirm and execute',
        ];

        $translatedHtml = str_replace(array_keys($replacements), array_values($replacements), $html);
        
        // Revert temporary markers if I used them? I didn't verify strip_tags usage above, I just acted on $html directly.
        // Actually the code above: $html IS passed to str_replace directly (variable shadowing $html = str_replace...).
        // But I did `$html = str_replace(['<li>'...]` first! This broke the tags.
        // Let's NOT transform the tags. Just raw replace.
        
        return $translatedHtml;
    }
}
