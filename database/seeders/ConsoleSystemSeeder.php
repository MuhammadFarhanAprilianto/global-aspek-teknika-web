<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\SimulationLead;
use App\Models\Solution;
use App\Models\VisitorLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConsoleSystemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Projects if empty
        if (Project::count() === 0) {
            $projects = [
                [
                    'title' => "GAT Ensures Nonstop Production at Indonesia's Top Car Parts Maker",
                    'slug' => 'automotive-parts-inspection',
                    'client_name' => 'Astra Components Ind',
                    'category' => 'Automotive',
                    'year' => '2024',
                    'description' => 'Implemented robotic handling cells and telecentric optical cameras for sub-micron transmission gear defect inspection, eliminating scrap escape to final assembly.',
                    'image' => 'turnkey_integration.webp',
                    'is_featured' => true,
                    'sort_order' => 1,
                ],
                [
                    'title' => 'Uninterrupted Critical Systems Telemetry for Eastern Indonesia Hub',
                    'slug' => 'airport-telemetry-scada',
                    'client_name' => 'Angkasa Pura Support',
                    'category' => 'Critical Infrastructure',
                    'year' => '2024',
                    'description' => 'Unified emergency generators, UPS banks, and runway airfield lighting status into a single responsive web-based SCADA dashboard with instant SMS and audio alarm dispatch.',
                    'image' => 'gat_scada_interface_dark.jpg',
                    'is_featured' => true,
                    'sort_order' => 2,
                ],
                [
                    'title' => 'Pharma Vision Inspection & 21 CFR Part 11 Audit Trail',
                    'slug' => 'pharma-bottle-inspection',
                    'client_name' => 'PT Kalbe Farma Tbk',
                    'category' => 'Pharmaceutical',
                    'year' => '2024',
                    'description' => 'High-speed automated blister defect and liquid vial particle inspection line running at 450 bpm with FDA 21 CFR Part 11 compliant tamper-proof audit trails.',
                    'image' => 'inspection_preview.jpg',
                    'is_featured' => true,
                    'sort_order' => 3,
                ],
                [
                    'title' => 'High-Speed Automated Strapping & Palletizing Conveyor',
                    'slug' => 'fmcg-conveyor-strapping',
                    'client_name' => 'PT Indofood CBP Sukses Makmur',
                    'category' => 'Packaging',
                    'year' => '2023',
                    'description' => 'Synchronized 4-lane carton infeed, robotic palletizer, and dual automatic strapping tensioning heads with live throughput telemetry linked to central ERP.',
                    'image' => 'strapping_preview.jpg',
                    'is_featured' => true,
                    'sort_order' => 4,
                ],
            ];

            foreach ($projects as $p) {
                Project::create($p);
            }
        }

        // 2. Seed Solutions if empty or outdated
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

        // 3. Seed Simulation Leads sample if empty
        if (SimulationLead::count() === 0) {
            $leads = [
                [
                    'pic_name' => 'Hendro Wijaya',
                    'company_name' => 'PT Kalbe Farma Tbk (Plant Cikarang)',
                    'email' => 'hendro.w@kalbe.co.id',
                    'phone' => '081289123456',
                    'domain' => 'pharma',
                    'notes' => 'Kebutuhan inspeksi kemasan botol cairan injeksi 50ml dengan rejector otomatis',
                    'simulation_params' => ['target_speed' => 300, 'defect_rate' => 0.02, 'accuracy' => 99.8],
                    'status' => 'new',
                ],
                [
                    'pic_name' => 'Bambang Sutrisno',
                    'company_name' => 'PT Astra Daihatsu Motor',
                    'email' => 'bambang.s@adm.co.id',
                    'phone' => '081399887766',
                    'domain' => 'automotive',
                    'notes' => 'Simulasi cycle time perakitan komponen transmisi otomatis Line 2',
                    'simulation_params' => ['cycle_time' => 18.5, 'station_count' => 6],
                    'status' => 'contacted',
                ],
                [
                    'pic_name' => 'Siti Rahmawati',
                    'company_name' => 'PT Indofood CBP Sukses Makmur',
                    'email' => 'siti.rahma@icbp.indofood.co.id',
                    'phone' => '085711223344',
                    'domain' => 'manufacturing',
                    'notes' => 'Analisis efisiensi OEE konveyor pengemasan mie instan',
                    'simulation_params' => ['oee_target' => 88.5, 'shift' => 3],
                    'status' => 'new',
                ],
            ];

            foreach ($leads as $l) {
                SimulationLead::create($l);
            }
        }

        // 4. Seed Contact Messages if empty
        if (ContactMessage::count() === 0) {
            $msgs = [
                [
                    'name' => 'Agus Budiman',
                    'email' => 'agus.budiman@unilever.com',
                    'phone' => '081122334455',
                    'company' => 'PT Unilever Indonesia Tbk',
                    'service' => 'Sistem Inspeksi & Rekam Data',
                    'message' => 'Mohon dikirimkan katalog teknis dan estimasi biaya peremajaan sistem machine vision pada packaging line pabrik Cikarang.',
                    'status' => 'unread',
                ],
                [
                    'name' => 'Dian Kusuma',
                    'email' => 'dian.k@mayora.co.id',
                    'phone' => '081877665544',
                    'company' => 'PT Mayora Indah Tbk',
                    'service' => 'Strapping Machine',
                    'message' => 'Kami memerlukan 4 unit Automatic Strapping Machine untuk line biskuit dengan kecepatan 45 box/menit.',
                    'status' => 'unread',
                ],
            ];

            foreach ($msgs as $m) {
                ContactMessage::create($m);
            }
        }

        // 5. Seed Visitor Logs if empty
        if (VisitorLog::count() === 0) {
            $pages = [
                '/',
                '/product',
                '/simulator',
                '/simulator/pharma',
                '/solution',
                '/projects',
                '/software',
                '/about',
            ];
            $devices = ['Desktop', 'Desktop', 'Mobile', 'Desktop', 'Mobile', 'Tablet'];
            $browsers = ['Chrome', 'Chrome', 'Edge', 'Safari', 'Firefox'];

            for ($i = 0; $i < 35; $i++) {
                VisitorLog::create([
                    'ip_address' => '180.252.' . rand(1, 254) . '.' . rand(1, 254),
                    'page_url' => 'http://127.0.0.1:8000' . $pages[array_rand($pages)],
                    'route_name' => 'home',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'device' => $devices[array_rand($devices)],
                    'browser' => $browsers[array_rand($browsers)],
                    'platform' => 'Windows',
                    'referer' => 'https://www.google.com/',
                    'created_at' => now()->subHours(rand(1, 72)),
                ]);
            }
        }
    }
}
