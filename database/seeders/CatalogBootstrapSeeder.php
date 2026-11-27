<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Solution;
use Illuminate\Database\Seeder;

class CatalogBootstrapSeeder extends Seeder
{
    /**
     * Seed only clean initial catalog & admin account (no dummy traffic, leads, or contacts).
     */
    public function run(): void
    {
        $this->call([
            DatabaseSeeder::class,
        ]);

        if (Project::count() === 0) {
            $projects = [
                [
                    'title' => 'Automated Stand Panel Assembly & Magnetic Sensor Verification System',
                    'slug' => 'komatsu-stand-panel-assembly-sensor-verification',
                    'client_name' => 'PT Komatsu Indonesia',
                    'category' => 'Automotive',
                    'year' => '2024',
                    'description' => 'Implementasi sistem verifikasi perakitan stand panel heavy equipment berbasis sensor optik dan interlock safety PLC untuk memastikan presisi pemasangan dan eliminasi cacat komponen secara realtime.',
                    'image' => 'projects/komatsu-standpanel-inspection.jpg',
                    'is_featured' => true,
                    'sort_order' => 1,
                ],
                [
                    'title' => 'High-Speed Automotive Component Label & 2D DataMatrix Inspection Cell',
                    'slug' => 'apm-automotive-label-datamatrix-inspection',
                    'client_name' => 'PT APM Armada Autoparts',
                    'category' => 'Automotive',
                    'year' => '2024',
                    'description' => 'Integrasi stasiun inspeksi visi multi-kamera untuk validasi label barcode/QR code, kehadiran komponen, dan akurasi warna pada lini produksi suku cadang otomotif berkecepatan tinggi.',
                    'image' => 'projects/apm-automotive-inspection.jpg',
                    'is_featured' => true,
                    'sort_order' => 2,
                ],
                [
                    'title' => 'High-Speed Bottling Line Vision Inspection for Bottle Seal & Cap Integrity',
                    'slug' => 'akasha-bottling-line-seal-cap-inspection',
                    'client_name' => 'PT Akasha Wira Internasional Tbk',
                    'category' => 'FMCG & Food',
                    'year' => '2024',
                    'description' => 'Sistem inspeksi optik otomatis untuk deteksi kecacatan segel tutup botol dan ketinggian level cairan pada lini pengisian minuman mineral berkapasitas ribuan botol per jam dengan mekanisme reject pneumatik otomatis.',
                    'image' => 'projects/akasha-bottle-inspection.jpg',
                    'is_featured' => true,
                    'sort_order' => 3,
                ],
                [
                    'title' => 'Cold-Pressed Juice Inline Bottle Capper & Label Positioning Inspection',
                    'slug' => 'rejuve-inline-bottle-capper-label-inspection',
                    'client_name' => 'PT Sewu Sentral Primatama (Re.Juve)',
                    'category' => 'FMCG & Food',
                    'year' => '2024',
                    'description' => 'Stasiun inspeksi visual untuk memvalidasi posisi dan kerapatan tutup botol capper serta orientasi label botol jus dingin premium sebelum proses sterilisasi HPP dan pengemasan sekunder.',
                    'image' => 'projects/rejuve-capper-inspection.jpg',
                    'is_featured' => true,
                    'sort_order' => 4,
                ],
                [
                    'title' => 'Pharma Blister Packaging Printing & Security Tape Detection System',
                    'slug' => 'actavis-blister-printing-tape-detection',
                    'client_name' => 'PT Actavis Indonesia (Teva Group)',
                    'category' => 'Pharmaceutical',
                    'year' => '2023',
                    'description' => 'Penerapan Keyence IV vision sensor untuk verifikasi cetak nomor batch, tanggal kadaluarsa (EXP date), serta deteksi pita segel pada kemasan blister farmasi standar CPOB / GMP.',
                    'image' => 'projects/actavis-printing-inspection.jpg',
                    'is_featured' => true,
                    'sort_order' => 5,
                ],
                [
                    'title' => 'Cleanroom Liquid Filling Machine Sensor Integration & Touchscreen HMI',
                    'slug' => 'dankos-cleanroom-filling-machine-sensor-hmi',
                    'client_name' => 'PT Dankos Farma (Kalbe Group)',
                    'category' => 'Pharmaceutical',
                    'year' => '2024',
                    'description' => 'Integrasi sensor optik serat kaca dan sensor level presisi tinggi pada mesin filling ampul/botol steril, dilengkapi panel kendali HMI interaktif dan log alarm kepatuhan regulasi farmasi.',
                    'image' => 'projects/dankos-filling-machine.jpg',
                    'is_featured' => true,
                    'sort_order' => 6,
                ],
                [
                    'title' => 'Cleanroom IPA Exhaust Fan Telemetry & Facility Safety Monitoring',
                    'slug' => 'panasonic-cleanroom-exhaust-fan-telemetry',
                    'client_name' => 'PT Panasonic Manufacturing Indonesia',
                    'category' => 'BMS & Utilities',
                    'year' => '2024',
                    'description' => 'Sistem pemantauan utilitas fasilitas terpusat untuk exhaust fan di ruang bahan kimia IPA dengan instrumentasi sensor aliran udara, interlock gas leak safety, dan notifikasi realtime.',
                    'image' => 'projects/panasonic-exhaust-telemetry.jpg',
                    'is_featured' => true,
                    'sort_order' => 7,
                ],
                [
                    'title' => 'Industrial Smelting Furnace Temperature Telemetry & Sensor Grid',
                    'slug' => 'tms-smelting-furnace-temperature-telemetry',
                    'client_name' => 'PT Tembaga Mulia Semanan Tbk (TMS)',
                    'category' => 'BMS & Utilities',
                    'year' => '2025',
                    'description' => 'Instalasi grid sensor suhu industri dan indikator display digital multi-titik pada tungku peleburan dan pengecoran tembaga untuk pencegahan overheating dan optimalisasi efisiensi termal.',
                    'image' => 'projects/tms-temperature-sensor.jpg',
                    'is_featured' => true,
                    'sort_order' => 8,
                ],
                [
                    'title' => 'Automated Paint Pail Packaging Counting System & Rejection Interlock',
                    'slug' => 'jotun-paint-pail-counting-system-interlock',
                    'client_name' => 'PT Jotun Indonesia',
                    'category' => 'Packaging',
                    'year' => '2024',
                    'description' => 'Sistem otomasi penghitung ember cat otomatis menggunakan smart vision sensor Keyence IV4 dengan interlock konveyor pneumatik untuk mencegah lolosnya produk non-conforming ke palletizer.',
                    'image' => 'projects/jotun-carton-counting.jpg',
                    'is_featured' => true,
                    'sort_order' => 9,
                ],
                [
                    'title' => 'Corrugated Box Lamina Machine Inline Barcode & Quality Inspection',
                    'slug' => 'smkl-corrugated-box-lamina-barcode-inspection',
                    'client_name' => 'PT Satya Mitra Kemas Lestari (SMKL)',
                    'category' => 'Packaging',
                    'year' => '2024',
                    'description' => 'Integrasi industrial barcode imager berkecepatan tinggi pada mesin laminasi karton box untuk verifikasi identitas SKU, mencegah kesalahan cetak kemasan, dan mengotomasi sistem reject sekunder.',
                    'image' => 'projects/smkl-carton-lamina.jpg',
                    'is_featured' => true,
                    'sort_order' => 10,
                ],
            ];

            foreach ($projects as $p) {
                Project::create($p);
            }
        }

        if (Solution::count() === 0) {
            $solutions = [
                [
                    'name' => 'PLC Programming',
                    'slug' => 'plc-progamming',
                    'route_name' => 'plc-progamming',
                    'image' => 'plc_preview.jpg',
                    'description' => 'Specialized PLC automation programming for Mitsubishi, Omron, Siemens, Schneider, and Allen Bradley industrial controllers with fail-safe logic.',
                    'short_description' => 'Mitsubishi, Omron, Siemens, etc.',
                    'icon_svg' => '<rect x="4" y="4" width="16" height="16" rx="2"></rect><rect x="9" y="9" width="6" height="6"></rect>',
                    'show_in_navbar' => true,
                    'sort_order' => 1,
                    'author' => 'PT GAT Engineering',
                    'published_at' => now(),
                ],
                [
                    'name' => 'Inspection & Record Data System',
                    'slug' => 'inspection',
                    'route_name' => 'inspection',
                    'image' => 'inspection_preview.jpg',
                    'description' => 'Machine vision inspection systems for automated quality control, dimensional measurement, optical character recognition (OCR), and defect rejection.',
                    'short_description' => 'High-precision quality assurance',
                    'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 7V5a2 2 0 012-2h2m12 0h2a2 2 0 012 2v2m0 10v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2M7 8v8M10 8v8M14 8v8M17 8v8"></path>',
                    'show_in_navbar' => true,
                    'sort_order' => 2,
                    'author' => 'PT GAT Engineering',
                    'published_at' => now(),
                ],
                [
                    'name' => 'Software & IoT',
                    'slug' => 'software',
                    'route_name' => 'software',
                    'image' => 'software_preview.jpg',
                    'description' => 'Industrial web dashboards, telemetry SCADA, and IoT gateway integration connecting factory floor sensor hardware to cloud analytics.',
                    'short_description' => 'Telemetry & software analytics',
                    'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>',
                    'show_in_navbar' => true,
                    'sort_order' => 3,
                    'author' => 'PT GAT Engineering',
                    'published_at' => now(),
                ],
                [
                    'name' => 'Integrator System',
                    'slug' => 'intergrator',
                    'route_name' => 'intergrator',
                    'image' => 'integrator_preview.jpg',
                    'description' => 'Turnkey line integration connecting disparate conveyors, sensors, check-weighers, and packing machinery into unified SCADA control architectures.',
                    'short_description' => 'Turnkey plant line integration',
                    'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>',
                    'show_in_navbar' => true,
                    'sort_order' => 4,
                    'author' => 'PT GAT Engineering',
                    'published_at' => now(),
                ],
                [
                    'name' => 'Laser Marking',
                    'slug' => 'laser-marking',
                    'route_name' => 'laser-marking',
                    'image' => 'laser_preview.jpg',
                    'description' => 'High-speed fiber and CO2 laser marking systems for direct part marking, QR serialization, and date coding on metal, plastic, and glass substrates.',
                    'short_description' => 'Fiber & CO2 laser serialization',
                    'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>',
                    'show_in_navbar' => true,
                    'sort_order' => 5,
                    'author' => 'PT GAT Engineering',
                    'published_at' => now(),
                ],
                [
                    'name' => 'Strapping Machine',
                    'slug' => 'strapping',
                    'route_name' => 'strapping',
                    'image' => 'strapping_preview.jpg',
                    'description' => 'Heavy-duty automatic and semi-automatic strapping machines, tensioners, and carton bundlers engineered for continuous 24/7 manufacturing plants.',
                    'short_description' => 'Automated carton strapping units',
                    'icon_svg' => '<rect x="3" y="3" width="18" height="18" rx="2"></rect><path stroke-linecap="round" d="M3 9h18M3 15h18M9 3v18M15 3v18"></path>',
                    'show_in_navbar' => true,
                    'sort_order' => 6,
                    'author' => 'PT GAT Engineering',
                    'published_at' => now(),
                ],
            ];

            foreach ($solutions as $s) {
                Solution::create($s);
            }
        }
    }
}
