<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('solutions', 'page_content')) {
            Schema::table('solutions', function (Blueprint $table) {
                $table->json('page_content')->nullable()->after('description');
            });
        }

        $seedPages = [
            'plc-progamming' => [
                'hero_subtitle' => 'Mission-Critical Logic Architecture, Motion Control & System Retrofitting',
                'stats' => [
                    ['value' => '150+', 'label' => 'Industrial Lines Deployed'],
                    ['value' => '99.9%', 'label' => 'Logic Uptime & Safety SLA'],
                    ['value' => '24/7', 'label' => 'Emergency On-site Support'],
                ],
                'tags' => ['Mitsubishi', 'Siemens', 'Omron', 'Keyence', 'Allen Bradley'],
                'deliverables_subtitle' => 'Comprehensive PLC lifecycle engineering customized to your exact production demands.',
                'deliverables' => [
                    [
                        'title' => 'New Program Development',
                        'description' => 'Designing ground-up automation logic, clean structured text, and modular ladder architectures tailored to custom manufacturing machinery.',
                        'highlights' => [
                            'Mitsubishi, Omron, Siemens, Keyence',
                            'Fail-safe Interlocks & Emergency Logic',
                            'Custom Operator HMI Touchscreen Panels',
                        ],
                    ],
                    [
                        'title' => 'Modification & Servo Motion',
                        'description' => 'Upgrading and enhancing existing operating lines, adding multi-axis servo positioning, barcode tracking, and throughput acceleration.',
                        'highlights' => [
                            'Multi-Axis Servo & Stepper Integration',
                            'Cycle Time Optimization & De-bottlenecking',
                            'High-Speed Sensor & Scanner Triggers',
                        ],
                    ],
                    [
                        'title' => 'Troubleshooting & Retrofit',
                        'description' => 'Rapid diagnostic fault finding and legacy hardware migrations to eliminate unplanned factory downtime and extend machinery lifespan.',
                        'highlights' => [
                            'Rapid Root-Cause Fault Identification',
                            'Legacy-to-Modern PLC Migrations',
                            'Real-Time Diagnostic Alarm Logging',
                        ],
                    ],
                ],
                'process_subtitle' => 'A proven engineering framework that minimizes production disruption and guarantees rock-solid execution.',
                'process_steps' => [
                    ['title' => 'Audit & Architecture', 'description' => 'Analyzing machinery I/O schematics, mechanical timing requirements, and safety protocols to create a comprehensive logic blueprint.'],
                    ['title' => 'Programming & HMI', 'description' => 'Writing modular ladder logic, structured text algorithms, and designing clean intuitive HMI touchscreen operator dashboards.'],
                    ['title' => 'Simulation & FAT', 'description' => 'Executing off-line virtual simulations and strict Factory Acceptance Testing (FAT) to validate edge cases before line shutdown.'],
                    ['title' => 'Commissioning & Handover', 'description' => 'Live on-site line commissioning, parameter fine-tuning, operator training, and complete documentation sign-off.'],
                ],
                'faqs' => [
                    ['question' => 'Which PLC controller brands do you support?', 'answer' => 'We specialize in all major industrial brands including Mitsubishi (GX Works 2/3), Keyence (KV Studio), Omron (Sysmac Studio / CX-Programmer), Siemens (TIA Portal S7-1200/1500), Allen Bradley (Studio 5000), and Panasonic.'],
                    ['question' => 'Can you modify or reverse-engineer an existing running PLC without documentation?', 'answer' => 'Yes. Our senior automation engineers can upload running logic from the controller, map physical I/O registers, reconstruct comments and rung documentation, and safely implement your requested additions without risking plant operations.'],
                    ['question' => 'Do you provide on-site emergency troubleshooting in industrial zones?', 'answer' => 'Yes. We provide priority on-site troubleshooting across Jakarta, Cikarang, Karawang, Bekasi, Surabaya, and industrial estates nationwide to rapidly diagnose faults, restore line uptime, and implement permanent fixes.'],
                ],
                'cta_title' => 'Ready to Build Your Next High-Performance Automation?',
                'cta_description' => "Let's discuss your machinery specs, cycle time goals, and automation logic. Contact our engineering team for a comprehensive technical consultation.",
                'cta_button_text' => 'Get A Quote / Consultation',
            ],
            'inspection' => [
                'hero_subtitle' => 'Ultra High-Speed Machine Vision & Real-Time Serialization Auditing',
                'stats' => [
                    ['value' => '800 pcs/min', 'label' => 'Ultra High-Speed Sorting'],
                    ['value' => '0.01 mm', 'label' => 'Optical Defect Accuracy'],
                    ['value' => '100%', 'label' => 'Full Traceability Compliance'],
                ],
                'tags' => ['Cognex', 'Keyence Vision', 'Python OpenCV', 'High-Speed Trigger'],
                'deliverables_subtitle' => 'Advanced optical inspection and database serialization tailored for pharmaceutical, FMCG, and automotive lines.',
                'deliverables' => [
                    [
                        'title' => 'High-Speed Vision Camera',
                        'description' => 'Industrial camera systems checking surface flaws, label alignment, OCR character legibility, and packaging integrity at speeds up to 800 pcs/minute.',
                        'highlights' => [
                            '800+ pcs/min Real-Time Processing',
                            'Sub-millimeter Dimensional Measurements',
                            '1D/2D Barcode & DataMatrix Grading',
                        ],
                    ],
                    [
                        'title' => 'Serialization Management',
                        'description' => 'Complete product code generation and tracking software ensuring regulatory compliance, anti-counterfeiting security, and parent-child packaging aggregation.',
                        'highlights' => [
                            'Unique Item & Bundle Code Hierarchy',
                            'Anti-Counterfeiting Verification Database',
                            'Automated BPOM & GS1 Standard Export',
                        ],
                    ],
                    [
                        'title' => 'Automated Rejector Gateway',
                        'description' => 'High-speed pneumatic air blowers, flipper arms, and servo pushers that divert non-conforming items instantly into secure reject bins without slowing line speed.',
                        'highlights' => [
                            'Zero Line Stoppage Rejection',
                            'Reject Verification Sensor Feedback',
                            'Audit-Ready Defect Image Archival',
                        ],
                    ],
                ],
                'process_subtitle' => 'Ensuring zero false-positive rejections and seamless integration with existing conveyors.',
                'process_steps' => [
                    ['title' => 'Optical Feasibility', 'description' => 'Laboratory testing of product samples under multiple lighting angles and high-frequency strobes to guarantee defect visibility.'],
                    ['title' => 'Vision Algorithm', 'description' => 'Configuring AI defect classification models, OCR text templates, and barcode grading thresholds.'],
                    ['title' => 'Line FAT & Ejector Sync', 'description' => 'Synchronizing camera triggers with conveyor encoders and testing high-speed pneumatic reject mechanisms.'],
                    ['title' => 'Validation & Handover', 'description' => 'Live production trial validation, statistical defect reporting setup, and operator training certification.'],
                ],
                'faqs' => [
                    ['question' => 'Can the inspection system handle multiple product SKUs without re-tuning?', 'answer' => 'Yes. The system includes recipe management where operators simply select the product SKU from the touchscreen to automatically switch inspection parameters, lighting presets, and tolerance rules in seconds.'],
                    ['question' => 'How does the system ensure non-compliant products are rejected reliably?', 'answer' => 'High-speed pneumatic air nozzles or mechanical diverters fire within milliseconds of defect detection. Downstream optical sensors confirm that the defective unit has successfully dropped into the locked reject bin.'],
                    ['question' => 'Can inspection data and images be exported to ERP/MES systems?', 'answer' => 'Yes. All inspection timestamps, serial codes, defect categories, and high-resolution flaw images are stored in a local SQL database and can be synced via REST API, MQTT, or OPC-UA to your enterprise ERP.'],
                ],
                'cta_title' => 'Ready to Implement Zero-Defect Optical Inspection?',
                'cta_description' => "Send us your product samples for a free optical feasibility test. We'll verify detection accuracy and provide a custom system design.",
                'cta_button_text' => 'Get A Quote / Consultation',
            ],
            'software' => [
                'hero_subtitle' => 'Enterprise IoT Telemetry, SCADA & OEE Software Analytics',
                'stats' => [
                    ['value' => '<100ms', 'label' => 'Telemetry Refresh Latency'],
                    ['value' => '30%+', 'label' => 'Average OEE Improvement'],
                    ['value' => '100%', 'label' => 'Secure On-Prem or Cloud'],
                ],
                'tags' => ['IoT Gateway', 'SCADA', 'MQTT / Modbus', 'Web Dashboard', 'OEE'],
                'deliverables_subtitle' => 'Enterprise IoT software infrastructure transforming raw sensor data into actionable production insights.',
                'deliverables' => [
                    [
                        'title' => 'Real-Time SCADA & IoT Telemetry',
                        'description' => 'Continuous sub-second monitoring of cycle times, motor currents, hydraulic pressure, pneumatic lines, and temperatures across the plant floor.',
                        'highlights' => [
                            'Multi-Line Plant Floor Visual Synoptic',
                            'Sub-second OPC-UA / MQTT Data Ingestion',
                            'Custom Sensor Threshold Warnings',
                        ],
                    ],
                    [
                        'title' => 'Automated OEE Analytics',
                        'description' => 'Automated Overall Equipment Effectiveness calculations capturing Availability, Performance rate, and Quality yield without manual spreadsheet errors.',
                        'highlights' => [
                            'Automatic Micro-Stoppage Reason Logging',
                            'Shift & Batch Benchmark Comparisons',
                            'Executive PDF & Excel Report Automation',
                        ],
                    ],
                    [
                        'title' => 'Predictive Maintenance & Vision AI',
                        'description' => 'Condition monitoring tracking vibration harmonic shifts, thermal spikes, and edge Vision AI algorithms to notify maintenance teams before catastrophic motor or bearing failures.',
                        'highlights' => [
                            'Instant WhatsApp / Email Alarm Triggers',
                            'Bearing & Motor Health Index Scoring',
                            'Historical MTBF / MTTR Diagnostic Metrics',
                        ],
                    ],
                ],
                'process_subtitle' => 'Non-invasive software and sensor integration designed to work seamlessly with both modern and legacy equipment.',
                'process_steps' => [
                    ['title' => 'System & PLC Survey', 'description' => 'Mapping target machine registers, network topology, and sensor locations without interrupting production.'],
                    ['title' => 'Edge Gateway & Setup', 'description' => 'Installing industrial IoT gateways, edge data buffers, and secure encrypted communication bridges.'],
                    ['title' => 'Dashboard & OEE Tuning', 'description' => 'Customizing dashboard widgets, shift schedules, downtime categorizations, and notification rules.'],
                    ['title' => 'Floor Display & Go-Live', 'description' => 'Deploying large Andon TV screens on factory floors, mobile app access for managers, and staff training.'],
                ],
                'faqs' => [
                    ['question' => 'Can this software monitor legacy machines without built-in network ports?', 'answer' => 'Yes. We utilize non-invasive external IoT sensors (current clamps, optical cycle counters, and vibration nodes) connected to compact edge gateways that bridge legacy machines directly into the dashboard.'],
                    ['question' => 'Is plant telemetry data stored locally on-premise or in the cloud?', 'answer' => 'We support both fully air-gapped on-premises local servers and private cloud hosting. Your company retains 100% ownership and control over all telemetry records.'],
                    ['question' => 'How do supervisors receive alerts during machine stoppage?', 'answer' => 'The system sends automated push alerts via WhatsApp, Email, Telegram, or SMS. In addition, factory floor Andon boards flash red with specific machine stoppage codes immediately.'],
                ],
                'cta_title' => 'Ready to Connect Your Factory Floor with Smart Software?',
                'cta_description' => 'Schedule a live demo to see how our IoT telemetry dashboards and OEE software analytics optimize plant uptime and eliminate hidden bottlenecks.',
                'cta_button_text' => 'Get A Quote / Consultation',
            ],
            'intergrator' => [
                'hero_subtitle' => 'End-to-End Industrial Robotics, Material Flow & Smart Line Integration',
                'stats' => [
                    ['value' => '200+', 'label' => 'Integrated Workcells'],
                    ['value' => '40%', 'label' => 'Throughput Acceleration'],
                    ['value' => '100%', 'label' => 'Turnkey Engineering'],
                ],
                'tags' => ['SCADA', 'OPC-UA', 'Robotics', 'PLC Integration', 'EtherCAT'],
                'deliverables_subtitle' => 'Bespoke industrial integration optimizing material flow, ergonomics, and machine cycle efficiency.',
                'deliverables' => [
                    [
                        'title' => 'Robotic Workcells',
                        'description' => 'Deploying 6-axis articulated robots, SCARA, Delta, and collaborative cobots for high-speed pick-and-place, assembly, and automated packing.',
                        'highlights' => [
                            'FANUC, Yaskawa, ABB & Universal Robots',
                            'Custom End-of-Arm Tooling (EOAT) Grippers',
                            'Optical Safety Light Curtains & Interlocks',
                        ],
                    ],
                    [
                        'title' => 'Material Handling Conveyors',
                        'description' => 'Custom modular conveyor systems, sorting tables, spiral elevators, and palletizing transport lines engineered for zero jamming.',
                        'highlights' => [
                            'Motorized Roller, Belt & Slat Conveyors',
                            'Rotary Indexers & 90-Degree Diverters',
                            'Automatic Pallet Infeed & Outfeed Lines',
                        ],
                    ],
                    [
                        'title' => 'MES & ERP Floor Interfacing',
                        'description' => 'Bridging shop floor machines with SAP, Oracle, and custom Manufacturing Execution Systems for automated work-order dispatch and inventory tracking.',
                        'highlights' => [
                            'Automated Job Order Synchronization',
                            'Barcode & RFID Material Verification',
                            'Real-time WIP (Work-in-Progress) Auditing',
                        ],
                    ],
                ],
                'process_subtitle' => 'Turnkey mechanical, electrical, and software delivery for complex manufacturing systems.',
                'process_steps' => [
                    ['title' => '3D CAD & Cycle Study', 'description' => '3D digital twin layout modeling, robot reachability studies, and precise throughput cycle time simulations.'],
                    ['title' => 'Fabrication & Control Panel', 'description' => 'CNC machining of custom grippers, structural welding, electrical panel wiring, and safety cage assembly.'],
                    ['title' => 'PLC & Robot Sync', 'description' => 'Interlocking robot controller kinematics with master PLC signals, sensors, and safety protocols.'],
                    ['title' => 'Turnkey Installation', 'description' => 'On-site plant deployment, continuous endurance trial runs, safety certification, and full operator training.'],
                ],
                'faqs' => [
                    ['question' => 'Do you handle mechanical fabrication in addition to electrical automation?', 'answer' => 'Yes. We provide complete turnkey systems including mechanical frame design, CNC fabricated grippers, pneumatic routing, electrical control panel building, and software programming under one roof.'],
                    ['question' => 'Can collaborative robots (Cobots) work safely next to human operators?', 'answer' => 'Yes. We engineer ISO-compliant collaborative workstations equipped with integrated force-torque limiting sensors, optical area scanners, and automatic speed reduction zones.'],
                    ['question' => 'What warranty and after-sales support do you provide?', 'answer' => 'Every integrated line comes with a comprehensive 1-year turnkey warranty, spare parts inventory recommendations, and rapid on-site emergency SLA support.'],
                ],
                'cta_title' => 'Ready to Automate Your Manufacturing Workcells?',
                'cta_description' => 'Our robotics and system integration experts are ready to study your line layout and propose an optimal automated solution.',
                'cta_button_text' => 'Get A Quote / Consultation',
            ],
            'laser-marking' => [
                'hero_subtitle' => 'Precision Industrial Tracing, Fiber Laser Marking & High-Speed CIJ Printing',
                'stats' => [
                    ['value' => '1200+', 'label' => 'Characters / Second Speed'],
                    ['value' => '50+', 'label' => 'Material Substrates Tested'],
                    ['value' => '100%', 'label' => 'Zero-Smudge Traceability'],
                ],
                'tags' => ['Fiber Laser', 'CIJ Printer', 'DataMatrix', 'Barcode 128'],
                'deliverables_subtitle' => 'Turnkey laser and inkjet coding systems designed for continuous 24/7 industrial production.',
                'deliverables' => [
                    [
                        'title' => 'Fiber, CO2 & UV Laser',
                        'description' => 'Permanent, sharp contrast laser engraving on automotive parts, electronic PCBs, plastics, ceramics, and pharmaceutical vials.',
                        'highlights' => [
                            'Fiber Laser (20W-100W) for Metals & Alloys',
                            'Cold UV Laser for Heat-Sensitive Plastics',
                            'High-Density 2D DataMatrix & Vector Logos',
                        ],
                    ],
                    [
                        'title' => 'Continuous Inkjet (CIJ)',
                        'description' => 'Fast-drying non-contact coding printing expiration dates, lot numbers, and barcodes on curved bottles, cans, pouches, and cables.',
                        'highlights' => [
                            'Multi-line High-Speed Alphanumeric Coding',
                            'Fast-Drying Food Grade & UV Inks',
                            'Automatic Printhead Flushing & Nozzle Seal',
                        ],
                    ],
                    [
                        'title' => 'Automated Traverse & Vision',
                        'description' => 'Motorized multi-axis traversing slides for wide web packaging and inline OCR verification cameras ensuring 100% legibility.',
                        'highlights' => [
                            'Motorized Multi-Lane Traversing Heads',
                            'Instant Post-Print OCR Legibility Audit',
                            'Interlocked Class 1 Laser Safety Enclosures',
                        ],
                    ],
                ],
                'process_subtitle' => 'Material testing, encoder synchronization, and line-speed validation for sharp contrast marks.',
                'process_steps' => [
                    ['title' => 'Substrate Sample Testing', 'description' => 'Laboratory testing on your actual materials to determine the exact laser wavelength, lens focus, or ink adhesion.'],
                    ['title' => 'Mounting & Encoder Sync', 'description' => 'Fabricating rigid adjustable brackets and wiring high-resolution rotary encoders for dynamic conveyor synchronization.'],
                    ['title' => 'PLC & Serialization Link', 'description' => 'Connecting printer controllers with master PLC triggers and dynamic database serialization feeds.'],
                    ['title' => 'Commissioning & Training', 'description' => 'Full-speed production run validation, optical legibility sign-off, and operator maintenance training.'],
                ],
                'faqs' => [
                    ['question' => 'How do I know whether Fiber Laser or UV Laser is right for my product?', 'answer' => "Fiber lasers are the industry standard for metals and robust opaque plastics. UV 'cold lasers' operate at a 355nm wavelength that produces photochemical marks on delicate plastics, glass, and medical tubing without creating heat-affected zones or micro-fractures."],
                    ['question' => 'Can the system print dynamic date codes and serial numbers without stopping?', 'answer' => 'Yes. The marking software automatically increments unit serial numbers, batch lot IDs, real-time timestamps, and dynamic 2D DataMatrix codes on-the-fly at line speeds up to 1200 chars/sec.'],
                    ['question' => 'How do you protect line operators from laser radiation?', 'answer' => 'All laser marking installations include certified Class 1 safety enclosures with certified optical shielding windows and dual-channel safety interlocks that immediately shut down the beam if a guard door is opened.'],
                ],
                'cta_title' => 'Ready to Upgrade Your Industrial Coding & Marking?',
                'cta_description' => "Send us your packaging samples for sample marking evaluations. We'll verify print contrast, adhesion, and speed performance.",
                'cta_button_text' => 'Get A Quote / Consultation',
            ],
            'strapping' => [
                'hero_subtitle' => 'High-Speed End-of-Line Packaging, Arch Strappers & Heavy Pallet Bundling',
                'stats' => [
                    ['value' => '60+', 'label' => 'Straps / Minute Speed'],
                    ['value' => '0.2 sec', 'label' => 'Instant Thermal Sealing'],
                    ['value' => '100%', 'label' => 'Tension Consistency'],
                ],
                'tags' => ['PP/PET Strapping', 'Sealing Head', 'Conveyor Sensor', 'Pallet Loader'],
                'deliverables_subtitle' => 'Reliable strapping solutions from compact tabletop units to fully automated conveyor arch lines.',
                'deliverables' => [
                    [
                        'title' => 'Fully Automatic In-Line Arch',
                        'description' => 'High-speed arch strapping machines with powered conveyor rollers for operator-free end-of-line packaging and carton bundling.',
                        'highlights' => [
                            '60+ Straps/Min Cycle Capability',
                            'Automatic Strap Feeding & Misfeed Re-ejection',
                            'Interlocked Upstream & Downstream Sensors',
                        ],
                    ],
                    [
                        'title' => 'Semi-Automatic Strappers',
                        'description' => 'Compact, versatile tabletop strapping units with quick-heating heater blades for varied package sizes and fast manual operation.',
                        'highlights' => [
                            'Instant Heat-Seal Mechanism (0.2s)',
                            'Low Maintenance Direct-Drive Motors',
                            'Foot Pedal & Touch Trigger Modes',
                        ],
                    ],
                    [
                        'title' => 'Heavy Pallet & Bundle',
                        'description' => 'Automated vertical and horizontal strapping for heavy palletized loads, ceramics, steel pipes, and lumber using high-tension PET strap.',
                        'highlights' => [
                            'Heavy-Duty PP & PET Strap Support',
                            'Friction Weld Sealing Technology',
                            'Turntable & Automatic Top Press Bar',
                        ],
                    ],
                ],
                'process_subtitle' => 'Custom arch dimensioning, conveyor interlocks, and endurance testing.',
                'process_steps' => [
                    ['title' => 'Package Geometry Audit', 'description' => 'Evaluating package dimensions, weight, strap tension parameters, and line speed requirements.'],
                    ['title' => 'Arch & Roller Sizing', 'description' => 'Specifying custom arch dimensions, conveyor roller pitch, centering guides, and pneumatic press bars.'],
                    ['title' => 'PLC Conveyor FAT', 'description' => 'Synchronizing strapper cycle signals with upstream carton sealers and downstream palletizers.'],
                    ['title' => 'Installation & Handover', 'description' => 'On-site integration, strap coil changeover training, and preventive maintenance sign-off.'],
                ],
                'faqs' => [
                    ['question' => 'Which strap materials and widths can be used?', 'answer' => 'Our machines support standard Polypropylene (PP) straps (5mm to 15mm) for standard cartons and high-tensile Polyester (PET) straps (9mm to 19mm) for heavy industrial pallets and lumber bundles.'],
                    ['question' => 'How does the machine prevent strap jams during high-speed operation?', 'answer' => 'Automatic loop ejectors discharge any misfed strap automatically without requiring manual clearing, while the auto re-feed system immediately threads the strap into the arch for the next cycle.'],
                    ['question' => 'Can the strapping unit interface with case sealers and robotic palletizers?', 'answer' => 'Yes. The integrated PLC logic coordinates smoothly with carton erectors, tape sealers, weighing scales, and palletizing robots via standard digital I/O or Industrial Ethernet.'],
                ],
                'cta_title' => 'Ready to Speed Up Your End-of-Line Packaging?',
                'cta_description' => 'Contact our packaging automation engineers for custom arch sizing and high-speed strapping machine recommendations.',
                'cta_button_text' => 'Get A Quote / Consultation',
            ],
        ];

        foreach ($seedPages as $slug => $content) {
            DB::table('solutions')
                ->where('slug', $slug)
                ->whereNull('page_content')
                ->update(['page_content' => json_encode($content)]);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('solutions', 'page_content')) {
            Schema::table('solutions', function (Blueprint $table) {
                $table->dropColumn('page_content');
            });
        }
    }
};
