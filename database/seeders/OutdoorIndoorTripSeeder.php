<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TripTypeSection;

class OutdoorIndoorTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Outdoor Activity Trip sections
        $outdoorSections = [
            [
                'category' => 'outdoor',
                'slug' => 'cultural-trip',
                'title' => 'Cultural Trip',
                'subtitle' => 'Jelajahi kekayaan budaya dan tradisi lokal',
                'content_html' => '<p>Cultural Trip adalah perjalanan wisata yang menggabungkan petualangan dengan eksplorasi budaya lokal. Nikmati pengalaman autentik menyaksikan tradisi, kuliner, dan keramahtamahan masyarakat setempat.</p><ul><li>Kunjungan ke desa-desa tradisional</li><li>Workshop kerajinan lokal</li><li>Kuliner tradisional</li></ul>',
                'content_full' => '<h2>Cultural Trip - Jelajahi Kekayaan Budaya Indonesia</h2><p>Cultural Trip adalah paket perjalanan wisata yang dirancang khusus untuk Anda yang ingin mengenal lebih dalam kekayaan budaya Indonesia. Kami mengajak Anda menjelajahi desa-desa tradisional, menyaksikan upacara adat, mempelajari kerajinan lokal, dan menikmati kuliner otentik.</p><h3>Apa yang termasuk?</h3><ul><li>Kunjungan ke desa-desa tradisional</li><li>Workshop kerajinan tangan (batik, ukir, anyam)</li><li>Pertunjukan seni tradisional</li><li>Kuliner lokal autentik</li><li>Guide lokal yang berpengalaman</li></ul><h3>Destinasi Populer</h3><p>Kami menawarkan Cultural Trip ke berbagai destinasi seperti Yogyakarta, Bali, Toraja, Lombok, dan masih banyak lagi.</p>',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'category' => 'outdoor',
                'slug' => 'one-day-outdoor-trip',
                'title' => 'One Day Trip',
                'subtitle' => 'Petualangan seru dalam satu hari penuh',
                'content_html' => '<p>One Day Trip cocok untuk Anda yang ingin menikmati petualangan outdoor tanpa perlu menginap. Eksplorasi alam yang seru dan menyegarkan dalam waktu singkat.</p><ul><li>Durasi 1 hari penuh</li><li>Berbagai pilihan aktivitas</li><li>Cocok untuk pemula</li></ul>',
                'content_full' => '<h2>One Day Trip - Petualangan Sehari Penuh Keseruan</h2><p>Tidak punya banyak waktu libur? One Day Trip adalah solusinya! Kami menyediakan paket perjalanan outdoor yang dapat diselesaikan dalam satu hari, mulai dari pagi hingga sore hari.</p><h3>Pilihan Aktivitas</h3><ul><li>Hiking ke air terjun tersembunyi</li><li>River tubing dan rafting</li><li>Caving (susur goa)</li><li>Sunset trekking</li><li>Snorkeling dan island hopping</li></ul><h3>Keuntungan One Day Trip</h3><p>Hemat waktu, hemat biaya, namun tetap mendapatkan pengalaman petualangan yang berkesan. Semua peralatan dan snack sudah termasuk dalam paket.</p>',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'category' => 'outdoor',
                'slug' => 'island-trip',
                'title' => 'Island Trip',
                'subtitle' => 'Eksplorasi keindahan pulau-pulau eksotis',
                'content_html' => '<p>Island Trip mengajak Anda menjelajahi pulau-pulau indah di Indonesia. Nikmati pantai berpasir putih, terumbu karang yang menakjubkan, dan kehidupan laut yang beragam.</p><ul><li>Island hopping</li><li>Snorkeling dan diving</li><li>Beach camping</li></ul>',
                'content_full' => '<h2>Island Trip - Jelajahi Surga Kepulauan Indonesia</h2><p>Indonesia memiliki lebih dari 17.000 pulau dengan keindahan yang luar biasa. Island Trip kami mengajak Anda mengeksplorasi pulau-pulau terbaik dengan berbagai aktivitas seru.</p><h3>Aktivitas Island Trip</h3><ul><li>Island hopping ke pulau-pulau eksotis</li><li>Snorkeling di terumbu karang</li><li>Diving untuk melihat biota laut</li><li>Beach camping di pantai terpencil</li><li>Sunset cruise</li></ul><h3>Destinasi Island Trip</h3><p>Raja Ampat, Labuan Bajo, Kepulauan Seribu, Karimunjawa, Derawan, dan masih banyak lagi pulau menakjubkan menanti Anda!</p>',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'category' => 'outdoor',
                'slug' => 'camping-trip',
                'title' => 'Camping',
                'subtitle' => 'Berkemah di alam terbuka dengan fasilitas lengkap',
                'content_html' => '<p>Camping Trip menawarkan pengalaman berkemah yang nyaman dengan fasilitas lengkap. Nikmati malam di bawah bintang dengan aman dan nyaman bersama tim profesional kami.</p><ul><li>Tenda dan sleeping bag premium</li><li>BBQ dinner</li><li>Aktivitas bonfire</li></ul>',
                'content_full' => '<h2>Camping Trip - Bermalam di Bawah Bintang</h2><p>Rasakan pengalaman berkemah yang berbeda dengan Camping Trip kami. Kami menyediakan semua peralatan camping berkualitas dan mendampingi Anda sepanjang perjalanan.</p><h3>Fasilitas Camping</h3><ul><li>Tenda dome premium waterproof</li><li>Sleeping bag dan matras</li><li>Peralatan masak outdoor</li><li>Lampu dan fire starter</li><li>P3K lengkap</li></ul><h3>Aktivitas Camping</h3><ul><li>BBQ dinner bersama</li><li>Bonfire dan storytelling</li><li>Stargazing</li><li>Morning hiking</li><li>Sunrise photography</li></ul>',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'category' => 'outdoor',
                'slug' => 'outdoor-team-building',
                'title' => 'Outdoor Team Building',
                'subtitle' => 'Perkuat kekompakan tim dengan aktivitas outdoor',
                'content_html' => '<p>Outdoor Team Building adalah program khusus untuk perusahaan yang ingin meningkatkan kerjasama tim melalui aktivitas outdoor yang menantang dan menyenangkan.</p><ul><li>Games dan challenges</li><li>Leadership training</li><li>Problem solving activities</li></ul>',
                'content_full' => '<h2>Outdoor Team Building - Bangun Tim yang Solid</h2><p>Program Outdoor Team Building kami dirancang untuk membangun kekompakan, kepercayaan, dan komunikasi dalam tim Anda. Melalui berbagai aktivitas outdoor yang menantang, tim Anda akan belajar bekerja sama dengan lebih efektif.</p><h3>Program Team Building</h3><ul><li>Trust building activities</li><li>Problem solving challenges</li><li>Leadership games</li><li>Communication exercises</li><li>Strategic planning simulation</li></ul><h3>Manfaat untuk Perusahaan</h3><p>Meningkatkan moral tim, memperkuat hubungan antar karyawan, mengembangkan kemampuan leadership, dan menciptakan kenangan bersama yang tak terlupakan.</p>',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'category' => 'outdoor',
                'slug' => 'outdoor-custom-trip',
                'title' => 'Outdoor Custom Trip',
                'subtitle' => 'Rancang perjalanan outdoor sesuai keinginan Anda',
                'content_html' => '<p>Outdoor Custom Trip memungkinkan Anda merancang perjalanan outdoor impian sesuai preferensi. Tim kami siap membantu merencanakan setiap detail perjalanan Anda.</p><ul><li>Fleksibel sesuai kebutuhan</li><li>Konsultasi gratis</li><li>Paket personalized</li></ul>',
                'content_full' => '<h2>Outdoor Custom Trip - Petualangan Sesuai Impian Anda</h2><p>Setiap orang punya impian petualangan yang berbeda. Dengan Outdoor Custom Trip, Anda bisa merancang perjalanan outdoor yang benar-benar sesuai keinginan Anda.</p><h3>Apa yang bisa dikustomisasi?</h3><ul><li>Destinasi dan rute perjalanan</li><li>Durasi trip</li><li>Jenis aktivitas outdoor</li><li>Tingkat kesulitan</li><li>Akomodasi dan transportasi</li><li>Jumlah peserta</li></ul><h3>Proses Pemesanan</h3><ol><li>Konsultasi kebutuhan dan preferensi Anda</li><li>Kami buatkan proposal perjalanan</li><li>Revisi hingga sesuai keinginan</li><li>Konfirmasi dan pembayaran</li><li>Perjalanan impian dimulai!</li></ol>',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        // Indoor Activity Trip sections
        $indoorSections = [
            [
                'category' => 'indoor',
                'slug' => 'city-tour',
                'title' => 'City Tour',
                'subtitle' => 'Jelajahi pesona kota-kota menarik di Indonesia',
                'content_html' => '<p>City Tour mengajak Anda menjelajahi kota-kota menarik dengan berbagai landmark, kuliner, dan tempat wisata populer. Cocok untuk liburan santai bersama keluarga.</p><ul><li>Landmark dan museum</li><li>Kuliner lokal</li><li>Shopping spots</li></ul>',
                'content_full' => '<h2>City Tour - Eksplorasi Pesona Kota</h2><p>City Tour kami menawarkan pengalaman menjelajahi kota-kota menarik di Indonesia dengan cara yang menyenangkan dan informatif. Kami akan mengajak Anda ke tempat-tempat ikonik dan hidden gems yang mungkin tidak Anda ketahui.</p><h3>Yang Termasuk dalam City Tour</h3><ul><li>Kunjungan ke landmark dan monument bersejarah</li><li>Museum dan galeri seni</li><li>Kuliner lokal terbaik</li><li>Pasar tradisional dan mall</li><li>Street photography spots</li></ul><h3>Kota Destinasi</h3><p>Jakarta, Bandung, Yogyakarta, Surabaya, Malang, Semarang, dan kota-kota menarik lainnya.</p>',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'category' => 'indoor',
                'slug' => 'company-gathering',
                'title' => 'Company Gathering',
                'subtitle' => 'Acara gathering perusahaan yang berkesan',
                'content_html' => '<p>Company Gathering adalah layanan penyelenggaraan acara gathering untuk perusahaan Anda. Kami handle semua dari venue hingga entertainment.</p><ul><li>Venue premium</li><li>Catering dan F&B</li><li>Entertainment dan MC</li></ul>',
                'content_full' => '<h2>Company Gathering - Rayakan Kebersamaan Tim</h2><p>Biarkan kami mengurus semua detail gathering perusahaan Anda sehingga Anda dan tim bisa fokus menikmati acara. Dari perencanaan hingga eksekusi, kami handle semuanya.</p><h3>Layanan Gathering</h3><ul><li>Pencarian dan booking venue</li><li>Catering dan minuman</li><li>Dekorasi sesuai tema</li><li>Entertainment dan band</li><li>MC profesional</li><li>Dokumentasi foto dan video</li><li>Door prize dan games</li></ul><h3>Jenis Gathering</h3><p>Annual gathering, year-end party, anniversary celebration, award night, family day, dan berbagai jenis gathering lainnya.</p>',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'category' => 'indoor',
                'slug' => 'outing-tour-travel',
                'title' => 'Outing, Tour & Travel',
                'subtitle' => 'Paket wisata lengkap untuk grup dan perusahaan',
                'content_html' => '<p>Outing, Tour & Travel menyediakan paket wisata lengkap untuk grup, komunitas, dan perusahaan. Semua sudah termasuk transportasi, akomodasi, dan guide.</p><ul><li>Paket all-inclusive</li><li>Transportasi nyaman</li><li>Akomodasi pilihan</li></ul>',
                'content_full' => '<h2>Outing, Tour & Travel - Perjalanan Wisata Tanpa Ribet</h2><p>Kami menyediakan paket wisata lengkap yang cocok untuk rombongan, baik dari perusahaan, komunitas, sekolah, maupun keluarga besar. Semua kebutuhan perjalanan sudah kami urus.</p><h3>Yang Termasuk dalam Paket</h3><ul><li>Transportasi bus/elf AC</li><li>Supir berpengalaman</li><li>Akomodasi hotel berbintang</li><li>Meals sesuai itinerary</li><li>Tiket masuk objek wisata</li><li>Tour guide/leader</li><li>Asuransi perjalanan</li></ul><h3>Destinasi Populer</h3><p>Bali, Yogyakarta, Bandung, Malang, Lombok, dan destinasi wisata favorit lainnya.</p>',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'category' => 'indoor',
                'slug' => 'mice-organizer',
                'title' => 'MICE Organizer',
                'subtitle' => 'Meeting, Incentive, Conference, Exhibition profesional',
                'content_html' => '<p>MICE Organizer adalah layanan penyelenggaraan event korporat profesional. Kami berpengalaman menangani berbagai skala event dari lokal hingga internasional.</p><ul><li>Event planning</li><li>Venue management</li><li>Production dan technical</li></ul>',
                'content_full' => '<h2>MICE Organizer - Solusi Event Korporat Profesional</h2><p>MICE (Meeting, Incentive, Conference, Exhibition) adalah layanan kami untuk penyelenggaraan event korporat skala besar. Dengan pengalaman bertahun-tahun, kami siap menjadi partner Anda.</p><h3>Layanan MICE</h3><ul><li>Meeting dan workshop</li><li>Incentive trip untuk top performers</li><li>Conference dan seminar</li><li>Exhibition dan pameran</li><li>Product launching</li><li>Gala dinner</li></ul><h3>Mengapa Memilih Kami?</h3><p>Tim profesional, vendor network yang luas, project management yang terstruktur, dan komitmen untuk menghasilkan event yang sukses sesuai objektif Anda.</p>',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'category' => 'indoor',
                'slug' => 'indoor-team-building',
                'title' => 'Indoor Team Building',
                'subtitle' => 'Program team building indoor yang kreatif dan efektif',
                'content_html' => '<p>Indoor Team Building menyediakan program pengembangan tim yang dapat dilakukan di dalam ruangan. Cocok untuk kondisi cuaca tidak mendukung atau preferensi indoor.</p><ul><li>Creative games</li><li>Workshop interaktif</li><li>Simulasi dan role-play</li></ul>',
                'content_full' => '<h2>Indoor Team Building - Kembangkan Tim di Ruang Nyaman</h2><p>Tidak selalu tim building harus di outdoor. Program Indoor Team Building kami dirancang untuk memberikan pengalaman sama efektifnya dalam ruangan yang nyaman dan terkontrol.</p><h3>Program Indoor Team Building</h3><ul><li>Creative problem solving games</li><li>Escape room challenge</li><li>Cooking class bersama</li><li>Art and craft workshop</li><li>Murder mystery games</li><li>Quiz dan trivia competition</li></ul><h3>Keuntungan Indoor Team Building</h3><p>Tidak tergantung cuaca, lebih nyaman untuk peserta dengan keterbatasan fisik, lebih fleksibel waktunya, dan bisa dilakukan di office atau venue pilihan.</p>',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'category' => 'indoor',
                'slug' => 'indoor-custom-trip',
                'title' => 'Indoor Custom Trip',
                'subtitle' => 'Rancang acara atau perjalanan indoor sesuai keinginan',
                'content_html' => '<p>Indoor Custom Trip memungkinkan Anda merancang acara atau perjalanan indoor yang sepenuhnya sesuai kebutuhan spesifik Anda atau perusahaan.</p><ul><li>Personalized program</li><li>Fleksibel dan adaptif</li><li>Konsultasi penuh</li></ul>',
                'content_full' => '<h2>Indoor Custom Trip - Solusi Sesuai Kebutuhan Anda</h2><p>Setiap perusahaan dan organisasi memiliki kebutuhan yang unik. Indoor Custom Trip kami memungkinkan Anda untuk mendapatkan layanan yang benar-benar sesuai dengan kebutuhan spesifik Anda.</p><h3>Yang Bisa Dikustomisasi</h3><ul><li>Jenis event atau aktivitas</li><li>Lokasi dan venue</li><li>Durasi program</li><li>Jumlah peserta</li><li>Budget yang tersedia</li><li>Objectives yang ingin dicapai</li></ul><h3>Cara Pemesanan</h3><ol><li>Hubungi kami untuk konsultasi awal</li><li>Diskusikan kebutuhan dan preference Anda</li><li>Kami siapkan proposal custom</li><li>Revisi hingga sesuai</li><li>Konfirmasi dan eksekusi</li></ol>',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        // Insert outdoor sections
        foreach ($outdoorSections as $section) {
            TripTypeSection::updateOrCreate(
                ['slug' => $section['slug']],
                $section
            );
        }

        // Insert indoor sections
        foreach ($indoorSections as $section) {
            TripTypeSection::updateOrCreate(
                ['slug' => $section['slug']],
                $section
            );
        }

        $this->command->info('Outdoor and Indoor Trip sections seeded successfully!');
    }
}
