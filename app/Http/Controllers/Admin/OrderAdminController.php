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
    public function index(Request $request): View
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
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('grand_total');
        $awaitingPoCount = Order::where('status', 'awaiting_po')->count();
        $poSubmittedCount = Order::where('status', 'po_submitted')->count();
        $completedCount = Order::where('status', 'completed')->count();
        $cancelledCount = Order::where('status', 'cancelled')->count();

        return view('admin.orders.index', compact(
            'orders', 
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
        if (! $order->po_document_path || ! Storage::disk('local')->exists($order->po_document_path)) {
            abort(404, 'Lampiran dokumen PO tidak ditemukan atau belum diunggah.');
        }

        return Storage::disk('local')->response($order->po_document_path, basename($order->po_document_path));
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
