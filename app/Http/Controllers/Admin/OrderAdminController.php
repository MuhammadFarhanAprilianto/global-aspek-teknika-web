<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Services\FonnteWhatsAppService;
use App\Services\SimpleXlsxExporter;
use Barryvdh\DomPDF\Facade\Pdf;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderAdminController extends Controller
{
    public static function transformOrder(Order $o): array
    {
        return [
            'id' => $o->id,
            'uuid' => $o->uuid,
            'invoice_number' => $o->invoice_number,
            'status' => $o->status,
            'status_label' => strtoupper(str_replace('_', ' ', $o->status)),
            'created_at_formatted' => $o->created_at->format('d M Y, H:i') . ' WIB',
            'pic_name' => $o->pic_name,
            'company_name' => $o->company_name,
            'company_email' => $o->company_email,
            'company_phone' => $o->company_phone,
            'company_address' => $o->company_address ?: '-',
            'npwp' => $o->npwp ?: '-',
            'notes' => $o->notes ?: '',
            'subtotal_formatted' => 'Rp ' . number_format($o->subtotal, 0, ',', '.'),
            'tax_rate' => $o->tax_rate,
            'tax_amount_formatted' => 'Rp ' . number_format($o->tax_amount, 0, ',', '.'),
            'pph23_rate' => $o->pph23_rate,
            'pph23_amount_formatted' => 'Rp ' . number_format($o->pph23_amount, 0, ',', '.'),
            'grand_total_formatted' => 'Rp ' . number_format($o->grand_total, 0, ',', '.'),
            'po_number' => $o->po_number,
            'has_po_file' => !empty($o->po_document_path),
            'po_file_url' => !empty($o->po_document_path) ? route('admin.orders.po-file', $o->uuid) : null,
            'quote_pdf_url' => route('admin.orders.pdf', $o->uuid),
            'whatsapp_contacted_at' => $o->whatsapp_contacted_at ? $o->whatsapp_contacted_at->format('d M Y, H:i') . ' WIB' : null,
            'whatsapp_contacted_diff' => $o->whatsapp_contacted_at ? $o->whatsapp_contacted_at->diffForHumans() : null,
            'whatsapp_message_log' => $o->whatsapp_message_log,
            'items' => $o->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_name' => $item->product_name,
                    'sku' => $item->sku,
                    'quantity' => $item->quantity,
                    'unit_price_formatted' => 'Rp ' . number_format($item->unit_price, 0, ',', '.'),
                    'line_total_formatted' => 'Rp ' . number_format($item->line_total, 0, ',', '.'),
                    'specifications' => $item->resolvedSpecifications(),
                ];
            })->values()->all(),
        ];
    }

    public function index(Request $request): View|JsonResponse
    {
        $status = $request->query('status', 'all');
        $search = trim($request->query('search', ''));

        $query = Order::with('items.product')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('pic_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('company_email', 'like', "%{$search}%")
                  ->orWhere('company_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();
        $agg = Order::selectRaw("
            COUNT(*) as total_orders,
            COALESCE(SUM(grand_total), 0) as total_revenue,
            SUM(CASE WHEN status = 'awaiting_po' THEN 1 ELSE 0 END) as awaiting_po_count,
            SUM(CASE WHEN status = 'po_submitted' THEN 1 ELSE 0 END) as po_submitted_count,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_count,
            SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_count
        ")->first();

        $totalOrders = (int) ($agg->total_orders ?? 0);
        $totalRevenue = (float) ($agg->total_revenue ?? 0);
        $awaitingPoCount = (int) ($agg->awaiting_po_count ?? 0);
        $poSubmittedCount = (int) ($agg->po_submitted_count ?? 0);
        $completedCount = (int) ($agg->completed_count ?? 0);
        $cancelledCount = (int) ($agg->cancelled_count ?? 0);

        $ordersJson = $orders->getCollection()->map(fn (Order $o) => self::transformOrder($o))->values();

        if ($request->expectsJson() || $request->query('format') === 'json') {
            return response()->json([
                'orders' => $ordersJson,
                'stats' => [
                    'total_orders' => $totalOrders,
                    'awaiting_po' => $awaitingPoCount,
                    'po_submitted' => $poSubmittedCount,
                    'completed' => $completedCount,
                    'cancelled' => $cancelledCount,
                    'total_revenue_formatted' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
                ],
            ]);
        }

        return view('admin.orders.index', compact(
            'orders',
            'ordersJson',
            'totalOrders',
            'totalRevenue',
            'awaitingPoCount',
            'poSubmittedCount',
            'completedCount',
            'cancelledCount',
            'status',
            'search'
        ));
    }

    public function show(Order $order): View
    {
        $order->load(['items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:awaiting_po,po_submitted,confirmed,completed,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan ' . $order->invoice_number . ' berhasil diperbarui.');
    }

    public function downloadQuotePdf(Order $order, FonnteWhatsAppService $whatsappService): Response
    {
        $order->load(['items.product:id,sku,name,specifications']);

        $shortHash = strtoupper(substr($order->verification_hash, 0, 16));
        $verifyUrl = route('checkout.verify', [
            'uuid' => $order->uuid,
            'hash' => strtolower($shortHash),
        ]);
        $qrCodeDataUri = (new QRCode)->render($verifyUrl);

        $pdf = Pdf::loadView('pdf.sales-quote', [
            'order' => $order,
            'logoBase64' => $whatsappService->resolveCompanyLogoBase64(),
            'qrCodeDataUri' => $qrCodeDataUri,
            'shortHash' => $shortHash,
        ])->setPaper('a4', 'portrait');

        $safeFilename = 'Sales_Quote_' . Str::slug($order->company_name ?: 'B2B', '_') . '_' . str_replace('/', '-', $order->invoice_number) . '.pdf';

        return $pdf->stream($safeFilename);
    }

    public function downloadPoDocument(Order $order): Response
    {
        if (! $order->po_document_path) {
            abort(404, 'Lampiran dokumen PO tidak ditemukan atau belum diunggah.');
        }

        return app(\App\Services\SupabaseStorageService::class)->downloadResponse(
            $order->po_document_path,
            basename($order->po_document_path),
            'local'
        );
    }

    public function logWhatsApp(Order $order): JsonResponse
    {
        $order->update([
            'whatsapp_contacted_at' => now(),
            'whatsapp_message_log' => 'Admin menghubungi via WhatsApp pada ' . now()->format('d M Y, H:i') . ' WIB',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Interaksi WhatsApp berhasil dicatat.',
            'timestamp' => now()->format('d M Y, H:i') . ' WIB',
        ]);
    }

    public function destroy(Order $order): RedirectResponse
    {
        $invoice = $order->invoice_number;
        $order->items()->delete();
        $order->delete();

        return back()->with('success', 'Pesanan ' . $invoice . ' berhasil dihapus.');
    }

    /**
     * Export daftar Orders & RFQ ke file Excel (.xlsx) berbentuk tabel rapi sesuai tampilan web
     */
    public function exportCsv(Request $request): Response
    {
        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $query = Order::with('items')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('pic_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('company_email', 'like', "%{$search}%")
                  ->orWhere('company_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->get();
        $filename = 'GAT_Orders_RFQ_' . now()->format('Ymd_His') . '.xlsx';

        $statusLabels = [
            'awaiting_po' => 'Menunggu PO',
            'po_submitted' => 'PO Terkirim',
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $columns = [
            ['label' => 'NO', 'width' => 6, 'type' => 'number', 'align' => 'center'],
            ['label' => 'NO. INVOICE', 'width' => 16, 'align' => 'center'],
            ['label' => 'TANGGAL', 'width' => 20, 'align' => 'center'],
            ['label' => 'PERUSAHAAN', 'width' => 28],
            ['label' => 'NAMA PIC', 'width' => 20],
            ['label' => 'WHATSAPP / TELEPON', 'width' => 19, 'align' => 'center'],
            ['label' => 'EMAIL', 'width' => 26],
            ['label' => 'DAFTAR PRODUK', 'width' => 36],
            ['label' => 'SUBTOTAL', 'width' => 18, 'type' => 'currency'],
            ['label' => 'PPN (11%)', 'width' => 16, 'type' => 'currency'],
            ['label' => 'PPH 23 (2%)', 'width' => 16, 'type' => 'currency'],
            ['label' => 'GRAND TOTAL', 'width' => 20, 'type' => 'currency'],
            ['label' => 'STATUS PESANAN', 'width' => 18, 'align' => 'center'],
            ['label' => 'LOG WHATSAPP', 'width' => 28],
        ];

        $rows = [];
        $sumSub = 0.0;
        $sumTax = 0.0;
        $sumPph = 0.0;
        $sumGrand = 0.0;

        foreach ($orders as $i => $o) {
            $itemsText = $o->items->map(fn ($it) => "{$it->product_name} ({$it->quantity} SET)")->implode('; ');
            $waInfo = $o->whatsapp_contacted_at
                ? 'Dihubungi ' . $o->whatsapp_contacted_at->format('d M Y, H:i') . ' WIB'
                : 'Belum dihubungi';

            $sub = (float) $o->subtotal;
            $tax = (float) $o->tax_amount;
            $pph = (float) $o->pph23_amount;
            $grand = (float) $o->grand_total;

            $sumSub += $sub;
            $sumTax += $tax;
            $sumPph += $pph;
            $sumGrand += $grand;

            $rows[] = [
                $i + 1,
                $o->invoice_number ?: ('ORD-' . $o->id),
                $o->created_at ? $o->created_at->format('d M Y, H:i') . ' WIB' : '-',
                $o->company_name ?: '-',
                $o->pic_name ?: '-',
                (string) ($o->company_phone ?: '-'),
                $o->company_email ?: '-',
                $itemsText ?: '-',
                $sub,
                $tax,
                $pph,
                $grand,
                $statusLabels[$o->status] ?? ucfirst((string) $o->status),
                $waInfo,
            ];
        }

        $summaryRow = $orders->isNotEmpty()
            ? ['', 'TOTAL', '', $orders->count() . ' Pengajuan', '', '', '', '', $sumSub, $sumTax, $sumPph, $sumGrand, '', '']
            : null;

        return SimpleXlsxExporter::download(
            $filename,
            'Orders & RFQ',
            'LAPORAN PESANAN & SALES QUOTE (RFQ) — PT GLOBAL ASPECT TECHNOLOGY',
            'Diekspor pada ' . now()->format('d M Y, H:i') . ' WIB  |  Total Pengajuan: ' . $orders->count() . ' pesanan',
            $columns,
            $rows,
            $summaryRow
        );
    }
}
