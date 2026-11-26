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

    /**
     * Halaman manajemen Simulation Leads di Admin Dashboard
     */
    public function index(Request $request): View
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
        $totalLeads = SimulationLead::count();
        $newLeads = SimulationLead::where('status', 'new')->count();

        return view('admin.leads.index', compact('leads', 'totalLeads', 'newLeads', 'domain', 'status', 'search'));
    }

    /**
     * Update status lead (new, contacted, closed)
     */
    public function updateStatus(Request $request, SimulationLead $lead): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]);

        $lead->update(['status' => $validated['status']]);

        return back()->with('success', 'Status prospek berhasil diperbarui.');
    }

    /**
     * Hapus lead
     */
    public function destroy(SimulationLead $lead): RedirectResponse
    {
        $lead->delete();
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
}
