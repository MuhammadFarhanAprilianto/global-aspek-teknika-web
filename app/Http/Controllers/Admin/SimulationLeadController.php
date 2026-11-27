<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\SimulationLead;
use App\Services\SimpleXlsxExporter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class SimulationLeadController extends Controller
{
    /**
     * Endpoint API publik untuk menyimpan lead yang mengisi form modal di simulator
     */
    public function storePublic(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'pic_name' => 'required|string|max:150',
            'company_name' => 'required|string|max:200',
            'job_title' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:50',
            'domain' => 'nullable|string|max:80',
            'simulation_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
            'simulation_params' => 'nullable|array',
        ], [
            'pic_name.required' => 'Nama lengkap wajib diisi.',
            'company_name.required' => 'Nama PT / Perusahaan wajib diisi.',
            'job_title.required' => 'Jabatan wajib diisi.',
            'email.required' => 'Email aktif wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor kontak / WhatsApp wajib diisi.',
        ]);

        $lead = SimulationLead::create([
            'pic_name' => trim($validated['pic_name']),
            'company_name' => trim($validated['company_name']),
            'job_title' => trim($validated['job_title']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => trim($validated['phone']),
            'domain' => $validated['domain'] ?? 'manufacturing',
            'simulation_date' => $validated['simulation_date'] ?? now()->toDateString(),
            'notes' => $validated['notes'] ?? null,
            'simulation_params' => $validated['simulation_params'] ?? null,
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data tersimpan. Akses simulasi dibuka.',
            'lead_id' => $lead->id,
        ]);
    }

    public static function transformLead(SimulationLead $lead): array
    {
        $domainOptions = [
            'manufacturing' => ['label' => 'Manufacturing & FMCG', 'icon' => 'fa-solid fa-industry', 'color' => 'text-[#3367A5]'],
            'automotive' => ['label' => 'Automotive Assembly', 'icon' => 'fa-solid fa-gears', 'color' => 'text-[#3367A5]'],
            'pharma' => ['label' => 'Pharma & Vision', 'icon' => 'fa-solid fa-microscope', 'color' => 'text-[#3367A5]'],
            'bms' => ['label' => 'BMS & Telemetri', 'icon' => 'fa-solid fa-building-shield', 'color' => 'text-[#3367A5]'],
            'logistics' => ['label' => 'Logistics & Conveyor', 'icon' => 'fa-solid fa-boxes-packing', 'color' => 'text-[#3367A5]'],
            'enpi' => ['label' => 'EnPI Energy SCADA', 'icon' => 'fa-solid fa-bolt', 'color' => 'text-[#3367A5]'],
        ];
        $meta = $domainOptions[$lead->domain] ?? ['label' => ucfirst((string) $lead->domain), 'icon' => 'fa-solid fa-shapes', 'color' => 'text-[#3367A5]'];

        $waClean = preg_replace('/[^0-9]/', '', (string) $lead->phone);
        if (str_starts_with($waClean, '0')) {
            $waClean = '62' . substr($waClean, 1);
        } elseif (str_starts_with($waClean, '8')) {
            $waClean = '62' . $waClean;
        }
        $waMsg = urlencode("Halo Bapak/Ibu {$lead->pic_name} ({$lead->company_name}), kami dari Tim Otomasi PT Global Aspect Technology menindaklanjuti data simulasi mesin {$meta['label']} yang Anda jalankan di website kami.");

        return [
            'id' => $lead->id,
            'pic_name' => $lead->pic_name,
            'job_title' => $lead->job_title,
            'company_name' => $lead->company_name,
            'domain' => $lead->domain,
            'domain_label' => $meta['label'],
            'domain_icon' => $meta['icon'],
            'domain_color' => $meta['color'],
            'email' => $lead->email,
            'phone' => $lead->phone,
            'notes' => $lead->notes ?: '',
            'status' => $lead->status ?: 'new',
            'date_formatted' => ($lead->simulation_date ?? $lead->created_at)->format('d M Y'),
            'time_formatted' => $lead->created_at->format('H:i') . ' WIB',
            'wa_url' => "https://wa.me/{$waClean}?text={$waMsg}",
            'status_url' => route('admin.leads.status', $lead->id),
            'destroy_url' => route('admin.leads.destroy', $lead->id),
        ];
    }

    /**
     * Halaman manajemen Simulation Leads di Admin Dashboard
     */
    public function index(Request $request): View|JsonResponse
    {
        $domain = $request->query('domain', 'all');
        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $query = SimulationLead::query()->latest();

        if ($domain !== 'all') {
            $query->where('domain', $domain);
        }
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('pic_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('job_title', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        $leads = $query->paginate(15)->withQueryString();
        $agg = SimulationLead::selectRaw("
            COUNT(*) as total_leads,
            SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_leads
        ")->first();
        $totalLeads = (int) ($agg->total_leads ?? 0);
        $newLeads = (int) ($agg->new_leads ?? 0);

        $leadsJson = $leads->getCollection()->map(fn (SimulationLead $l) => self::transformLead($l))->values();

        if ($request->expectsJson() || $request->query('format') === 'json') {
            return response()->json([
                'leads' => $leadsJson,
                'stats' => [
                    'total_leads' => $totalLeads,
                    'new_leads' => $newLeads,
                ],
            ]);
        }

        return view('admin.leads.index', compact('leads', 'leadsJson', 'totalLeads', 'newLeads', 'domain', 'status', 'search'));
    }

    /**
     * Update status lead (new, contacted, closed)
     */
    public function updateStatus(Request $request, SimulationLead $lead): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]);

        $oldStatus = $lead->status;
        $lead->update(['status' => $validated['status']]);

        try {
            \App\Models\AdminSecurityLog::record('lead_status_updated', 'info', $request->user(), $request->user()?->email, "Status prospek {$lead->pic_name} ({$lead->company_name}) diubah dari {$oldStatus} ke {$validated['status']}.");
        } catch (\Throwable $e) {
        }

        return back()->with('success', 'Status prospek berhasil diperbarui.');
    }

    /**
     * Hapus lead
     */
    public function destroy(Request $request, SimulationLead $lead): RedirectResponse
    {
        $pic = $lead->pic_name;
        $company = $lead->company_name;
        $lead->delete();

        try {
            \App\Models\AdminSecurityLog::record('lead_deleted', 'warning', $request->user(), $request->user()?->email, "Menghapus data prospek {$pic} ({$company}).");
        } catch (\Throwable $e) {
        }

        return back()->with('success', 'Data prospek simulasi berhasil dihapus.');
    }

    /**
     * Export daftar Simulator Leads ke file Excel (.xlsx) berbentuk tabel rapi sesuai tampilan web
     */
    public function exportCsv(Request $request): Response
    {
        $domain = $request->query('domain', 'all');
        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $query = SimulationLead::query()->latest();

        if ($domain !== 'all') {
            $query->where('domain', $domain);
        }
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('pic_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('job_title', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        $leads = $query->get();
        $filename = 'GAT_Simulator_Leads_' . now()->format('Ymd_His') . '.xlsx';

        $domainLabels = [
            'manufacturing' => 'Manufacturing & FMCG',
            'automotive' => 'Automotive Assembly',
            'pharma' => 'Pharma & Vision',
            'bms' => 'BMS & Telemetri',
            'logistics' => 'Logistics & Conveyor',
            'enpi' => 'EnPI Energy SCADA',
        ];

        $statusLabels = [
            'new' => 'New',
            'contacted' => 'Contacted',
            'closed' => 'Closed / PO',
        ];

        $columns = [
            ['label' => 'NO', 'width' => 6, 'type' => 'number', 'align' => 'center'],
            ['label' => 'TANGGAL SIMULASI', 'width' => 20, 'align' => 'center'],
            ['label' => 'NAMA PIC', 'width' => 22],
            ['label' => 'JABATAN', 'width' => 20],
            ['label' => 'PERUSAHAAN', 'width' => 28],
            ['label' => 'DOMAIN SIMULASI', 'width' => 24, 'align' => 'center'],
            ['label' => 'WHATSAPP / TELEPON', 'width' => 20, 'align' => 'center'],
            ['label' => 'EMAIL', 'width' => 28],
            ['label' => 'CATATAN / KEBUTUHAN', 'width' => 40],
            ['label' => 'STATUS', 'width' => 15, 'align' => 'center'],
        ];

        $rows = [];
        foreach ($leads as $i => $l) {
            $domainKey = strtolower((string) ($l->domain ?: 'manufacturing'));
            $dateText = $l->simulation_date
                ? $l->simulation_date->format('d M Y') . ($l->created_at ? ', ' . $l->created_at->format('H:i') . ' WIB' : '')
                : ($l->created_at ? $l->created_at->format('d M Y, H:i') . ' WIB' : '-');
            $rows[] = [
                $i + 1,
                $dateText,
                $l->pic_name ?: '-',
                $l->job_title ?: '-',
                $l->company_name ?: '-',
                $domainLabels[$domainKey] ?? ucfirst($domainKey),
                (string) ($l->phone ?: '-'),
                $l->email ?: '-',
                preg_replace('/\s+/', ' ', (string) ($l->notes ?: '-')),
                $statusLabels[$l->status] ?? ucfirst((string) $l->status),
            ];
        }

        return SimpleXlsxExporter::download(
            $filename,
            'Simulator Leads',
            'LAPORAN SIMULATOR LEADS — PT GLOBAL ASPECT TECHNOLOGY',
            'Diekspor pada ' . now()->format('d M Y, H:i') . ' WIB  |  Total Data: ' . $leads->count() . ' prospek',
            $columns,
            $rows
        );
    }

    /**
     * Export kalkulasi EIS (Summary, Kapasitas, Biaya) menjadi 1 file Excel (.xlsx) 3 worksheet terstruktur & bergaris tabel
     */
    public function exportEisExcel(Request $request): Response
    {
        $payload = $request->validate([
            'project_name' => 'nullable|string|max:120',
            'location' => 'nullable|string|max:120',
            'devices' => 'nullable|string|max:40',
            'retention_days' => 'nullable|string|max:60',
            'selected_params' => 'nullable|string|max:1000',
            'daily_data' => 'nullable|string|max:60',
            'total_retention' => 'nullable|string|max:60',
            'total_cost' => 'nullable|string|max:60',
            'capacity_rows' => 'nullable|array',
            'capacity_totals' => 'nullable|array',
            'cost_rows' => 'nullable|array',
            'initial_capex' => 'nullable|string|max:60',
            'yearly_opex' => 'nullable|string|max:60',
        ]);

        $projectName = trim((string) ($payload['project_name'] ?? 'EIS_PLANT_1')) ?: 'EIS_PLANT_1';
        $location = trim((string) ($payload['location'] ?? '-')) ?: '-';
        $devices = trim((string) ($payload['devices'] ?? '0')) ?: '0';
        $retentionDays = trim((string) ($payload['retention_days'] ?? '360 hari')) ?: '360 hari';
        $selectedParams = trim((string) ($payload['selected_params'] ?? 'None')) ?: 'None';
        $dailyData = trim((string) ($payload['daily_data'] ?? '0 GB')) ?: '0 GB';
        $totalRetention = trim((string) ($payload['total_retention'] ?? '0 GB')) ?: '0 GB';
        $totalCostText = trim((string) ($payload['total_cost'] ?? 'Rp 0')) ?: 'Rp 0';

        $parseIdr = function (?string $text): ?float {
            $digits = preg_replace('/[^\d]/', '', (string) ($text ?? ''));
            return $digits !== '' ? (float) $digits : null;
        };

        $safeSlug = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $projectName) ?: 'EIS_Plant';
        $filename = 'EIS_Calculation_' . trim($safeSlug, '_') . '.xlsx';
        $subtitle = "PT Global Aspect Technology  |  Proyek: {$projectName}  |  Lokasi: {$location}  |  Diekspor: " . now()->format('d M Y, H:i') . ' WIB';

        // 1. Sheet: Summary
        $summarySheet = [
            'sheetTitle' => 'Summary',
            'reportTitle' => "EIS CALCULATION SUMMARY — {$projectName}",
            'reportSubtitle' => $subtitle,
            'headerStyle' => 'soft_blue',
            'columns' => [
                ['label' => 'Item', 'width' => 34, 'align' => 'left'],
                ['label' => 'Nilai / Keterangan', 'width' => 56, 'align' => 'left'],
            ],
            'rows' => [
                ['Nama Proyek', $projectName],
                ['Lokasi Pabrik / Site', $location],
                ['Jumlah Device / Power Meter', $devices . ' unit'],
                ['Durasi Retensi Penyimpanan', $retentionDays],
                ['Parameter Terpilih', $selectedParams],
                ['Estimasi Data per Hari', $dailyData],
                ['Estimasi Data Total Retention', $totalRetention],
            ],
            'summaryRows' => [
                ['Estimasi Total Biaya (Initial CapEx)', $totalCostText],
                ['Estimasi Yearly OpEx (~10%)', trim((string) ($payload['yearly_opex'] ?? 'Rp 0')) ?: 'Rp 0'],
            ],
        ];

        // 2. Sheet: Kapasitas
        $capRows = [];
        foreach (($payload['capacity_rows'] ?? []) as $r) {
            if (! is_array($r) || count($r) < 7) {
                continue;
            }
            $capRows[] = [
                trim((string) ($r[0] ?? '')),
                trim((string) ($r[1] ?? '')),
                trim((string) ($r[2] ?? '')),
                trim((string) ($r[3] ?? '')),
                trim((string) ($r[4] ?? '')),
                trim((string) ($r[5] ?? '')),
                trim((string) ($r[6] ?? '')),
            ];
        }
        $capTotals = is_array($payload['capacity_totals'] ?? null) ? $payload['capacity_totals'] : [];

        $capacitySheet = [
            'sheetTitle' => 'Kapasitas',
            'reportTitle' => "RINCIAN KAPASITAS STORAGE PER PARAMETER — {$projectName}",
            'reportSubtitle' => $subtitle,
            'headerStyle' => 'soft_blue',
            'columns' => [
                ['label' => 'Parameter', 'width' => 24, 'align' => 'left'],
                ['label' => 'Sampling (detik)', 'width' => 18, 'align' => 'center'],
                ['label' => 'Byte/baris', 'width' => 14, 'align' => 'center'],
                ['label' => 'Per Day (all device)', 'width' => 20, 'align' => 'right'],
                ['label' => 'Per Month (≈30 hari)', 'width' => 20, 'align' => 'right'],
                ['label' => 'Per Year (all device)', 'width' => 20, 'align' => 'right'],
                ['label' => "Total Retention ({$retentionDays})", 'width' => 24, 'align' => 'right'],
            ],
            'rows' => $capRows,
            'summaryRows' => [[
                'TOTAL',
                '',
                '',
                trim((string) ($capTotals[0] ?? $dailyData)),
                trim((string) ($capTotals[1] ?? '-')),
                trim((string) ($capTotals[2] ?? '-')),
                trim((string) ($capTotals[3] ?? $totalRetention)),
            ]],
        ];

        // 3. Sheet: Biaya
        $costRows = [];
        foreach (($payload['cost_rows'] ?? []) as $r) {
            if (! is_array($r) || count($r) < 4) {
                continue;
            }
            $qtyRaw = trim((string) ($r[1] ?? ''));
            $unitRaw = trim((string) ($r[2] ?? ''));
            $subRaw = trim((string) ($r[3] ?? ''));
            $costRows[] = [
                trim((string) ($r[0] ?? '')),
                is_numeric($qtyRaw) ? (0 + $qtyRaw) : $qtyRaw,
                $parseIdr($unitRaw) ?? $unitRaw,
                $parseIdr($subRaw) ?? $subRaw,
            ];
        }

        $capexVal = $parseIdr($payload['initial_capex'] ?? $totalCostText) ?? ($payload['initial_capex'] ?? $totalCostText);
        $opexVal = $parseIdr($payload['yearly_opex'] ?? '0') ?? ($payload['yearly_opex'] ?? 'Rp 0');

        $costSheet = [
            'sheetTitle' => 'Biaya',
            'reportTitle' => "RINCIAN BIAYA CAPEX & OPEX — {$projectName}",
            'reportSubtitle' => $subtitle,
            'headerStyle' => 'soft_blue',
            'columns' => [
                ['label' => 'Komponen', 'width' => 38, 'align' => 'left'],
                ['label' => 'Qty', 'width' => 12, 'type' => 'number', 'align' => 'center'],
                ['label' => 'Unit Price', 'width' => 22, 'type' => 'currency', 'align' => 'right'],
                ['label' => 'Subtotal', 'width' => 24, 'type' => 'currency', 'align' => 'right'],
            ],
            'rows' => $costRows,
            'summaryRows' => [
                ['Initial CapEx', '', '', $capexVal],
                ['Yearly OpEx', '', '', $opexVal],
            ],
        ];

        return SimpleXlsxExporter::downloadMultiSheet($filename, [
            $summarySheet,
            $capacitySheet,
            $costSheet,
        ]);
    }
}
