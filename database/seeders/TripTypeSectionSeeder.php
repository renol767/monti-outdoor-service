<?php

namespace Database\Seeders;

use App\Models\TripTypeSection;
use Illuminate\Database\Seeder;

class TripTypeSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            // Mountain Trip sections
            [
                'category' => 'mountain',
                'slug' => 'private-trip',
                'title' => 'Private Trip',
                'subtitle' => 'Pengalaman eksklusif bersama grup pribadi Anda',
                'content_html' => '<p>Private Trip adalah layanan perjalanan gunung eksklusif yang dirancang khusus untuk Anda dan grup Anda. Nikmati fleksibilitas penuh dalam menentukan jadwal, destinasi, dan itinerary sesuai keinginan.</p><h3>Keunggulan Private Trip:</h3><ul><li>Jadwal fleksibel sesuai keinginan grup</li><li>Guide profesional khusus untuk grup Anda</li><li>Customizable itinerary</li><li>Privasi dan kenyamanan maksimal</li></ul>',
                'images' => [],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'category' => 'mountain',
                'slug' => 'one-day-trip',
                'title' => 'One Day Trip',
                'subtitle' => 'Petualangan singkat dalam satu hari penuh pengalaman',
                'content_html' => '<p>One Day Trip adalah pilihan sempurna bagi Anda yang ingin menikmati keindahan alam gunung tanpa perlu bermalam. Cocok untuk pemula atau mereka dengan waktu terbatas.</p><h3>Yang Anda Dapatkan:</h3><ul><li>Durasi 1 hari (pagi-sore)</li><li>Destinasi gunung dengan akses mudah</li><li>Guide profesional</li><li>Semua peralatan standar</li><li>Makan siang di gunung</li></ul>',
                'images' => [],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'category' => 'mountain',
                'slug' => 'expedition-trip',
                'title' => 'Expedition Trip',
                'subtitle' => 'Tantangan ekspedisi untuk pendaki berpengalaman',
                'content_html' => '<p>Expedition Trip adalah program pendakian tingkat lanjut untuk Anda yang mencari tantangan lebih. Destinasi meliputi puncak-puncak tertinggi Indonesia dengan durasi lebih panjang.</p><h3>Highlight Expedition:</h3><ul><li>Destinasi puncak tertinggi (Carstensz, Semeru, dll)</li><li>Durasi 3-7 hari</li><li>Tim ekspedisi berpengalaman</li><li>Peralatan lengkap standar ekspedisi</li><li>Sertifikat pendakian</li></ul>',
                'images' => [],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'category' => 'mountain',
                'slug' => 'international-trip',
                'title' => 'International Trip',
                'subtitle' => 'Jelajahi gunung-gunung ikonik di seluruh dunia',
                'content_html' => '<p>International Trip membawa Anda ke destinasi pendakian internasional yang menakjubkan. Dari Himalaya hingga Kilimanjaro, kami siap menemani petualangan Anda.</p><h3>Destinasi Populer:</h3><ul><li>Everest Base Camp, Nepal</li><li>Mount Kilimanjaro, Tanzania</li><li>Mount Fuji, Japan</li><li>Mount Kinabalu, Malaysia</li><li>Mount Rinjani dengan foreign partner</li></ul>',
                'images' => [],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'category' => 'mountain',
                'slug' => 'custom-trip',
                'title' => 'Custom Trip',
                'subtitle' => 'Rancang perjalanan impian Anda sendiri',
                'content_html' => '<p>Custom Trip memberikan kebebasan penuh untuk merancang perjalanan sesuai impian Anda. Tim kami akan membantu mewujudkan ide perjalanan Anda menjadi kenyataan.</p><h3>Apa yang Bisa Dicustom:</h3><ul><li>Destinasi sesuai pilihan</li><li>Durasi fleksibel</li><li>Tingkat kesulitan</li><li>Fasilitas dan akomodasi</li><li>Budget sesuai kemampuan</li></ul>',
                'images' => [],
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            TripTypeSection::updateOrCreate(
                ['slug' => $section['slug']],
                $section
            );
        }
    }
}
