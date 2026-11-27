<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ContactMessage;
use App\Services\SimpleXlsxExporter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ContactAdminController extends Controller
{
    public static function transformMessage(ContactMessage $msg): array
    {
        $waClean = preg_replace('/[^0-9]/', '', $msg->phone ?? '');
        if (str_starts_with($waClean, '0')) {
            $waClean = '62' . substr($waClean, 1);
        } elseif (str_starts_with($waClean, '8')) {
            $waClean = '62' . $waClean;
        }
        $companyLabel = $msg->company ? " ({$msg->company})" : '';
        $serviceLabel = $msg->service ?: 'layanan otomasi industri';
        $waText = urlencode("Halo Bapak/Ibu {$msg->name}{$companyLabel}, terima kasih telah menghubungi PT Global Aspect Technology mengenai {$serviceLabel}. Tim teknis kami siap membantu kebutuhan Anda. Apakah ada informasi tambahan yang bisa kami diskusikan?");
        $waUrl = !empty($waClean) ? "https://api.whatsapp.com/send?phone={$waClean}&text={$waText}" : '';

        return [
            'id' => $msg->id,
            'name' => $msg->name,
            'company' => $msg->company ?: 'Individu / Perusahaan',
            'email' => $msg->email,
            'phone' => $msg->phone ?: '',
            'service' => $msg->service ?: 'General Inquiry',
            'message' => $msg->message,
            'status' => $msg->status ?: 'unread',
            'date_formatted' => $msg->created_at->format('d M Y'),
            'time_formatted' => $msg->created_at->format('H:i') . ' WIB',
            'created_at_formatted' => $msg->created_at->format('d M Y, H:i') . ' WIB',
            'wa_url' => $waUrl,
            'mailto_url' => !empty($msg->email) ? 'mailto:' . $msg->email . '?subject=' . rawurlencode('Re: ' . ($msg->service ?: 'Pertanyaan Website PT Global Aspect Technology')) : '',
            'status_url' => route('admin.contacts.status', $msg->id),
            'destroy_url' => route('admin.contacts.destroy', $msg->id),
        ];
    }

    public function index(Request $request): View|JsonResponse
    {
        $status = $request->query('status', 'all');
        $search = trim($request->query('search', ''));

        $query = ContactMessage::latest();

        if ($status !== 'all' && in_array($status, ['unread', 'read', 'contacted'], true)) {
            $query->where('status', $status);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('service', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(15)->withQueryString();
        $agg = ContactMessage::selectRaw("
            COUNT(*) as total_messages,
            SUM(CASE WHEN status = 'unread' THEN 1 ELSE 0 END) as unread_messages,
            SUM(CASE WHEN status = 'contacted' THEN 1 ELSE 0 END) as contacted_messages
        ")->first();
        $totalMessages = (int) ($agg->total_messages ?? 0);
        $unreadMessages = (int) ($agg->unread_messages ?? 0);
        $contactedMessages = (int) ($agg->contacted_messages ?? 0);

        $messagesList = $messages->getCollection()->map(fn (ContactMessage $m) => self::transformMessage($m))->values();

        if ($request->expectsJson() || $request->query('format') === 'json') {
            return response()->json([
                'messages' => $messagesList,
                'stats' => [
                    'total_messages' => $totalMessages,
                    'unread_messages' => $unreadMessages,
                    'contacted_messages' => $contactedMessages,
                ],
            ]);
        }

        return view('admin.contacts.index', compact(
            'messages',
            'messagesList',
            'totalMessages',
            'unreadMessages',
            'contactedMessages',
            'status',
            'search'
        ));
    }

    public function updateStatus(Request $request, ContactMessage $contact): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,contacted',
        ]);

        $contact->update(['status' => $validated['status']]);

        $labels = [
            'unread' => 'Baru',
            'read' => 'Dibaca',
            'contacted' => 'Dihubungi',
        ];

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status' => $contact->status,
                'label' => $labels[$contact->status] ?? $contact->status,
            ]);
        }

        return back()->with('success', 'Status pesan dari "' . $contact->name . '" diperbarui menjadi ' . ($labels[$contact->status] ?? $contact->status) . '.');
    }

    public function markAsRead(Request $request, ContactMessage $contact): RedirectResponse|JsonResponse
    {
        $contact->update(['status' => 'read']);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'status' => 'read']);
        }

        return back()->with('success', 'Pesan dari "' . $contact->name . '" ditandai telah dibaca.');
    }

    public function markAsContacted(Request $request, ContactMessage $contact): RedirectResponse|JsonResponse
    {
        $contact->update(['status' => 'contacted']);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'status' => 'contacted']);
        }

        return back()->with('success', 'Status pengirim "' . $contact->name . '" diperbarui menjadi Dihubungi.');
    }

    public function markAllRead(): RedirectResponse
    {
        $updated = ContactMessage::where('status', 'unread')->update(['status' => 'read']);

        return back()->with('success', $updated > 0 ? "{$updated} pesan belum dibaca telah ditandai dibaca." : 'Semua pesan sudah dibaca.');
    }

    public function destroy(Request $request, ContactMessage $contact): RedirectResponse
    {
        $name = $contact->name;
        $email = $contact->email;
        $contact->delete();

        try {
            \App\Models\AdminSecurityLog::record('contact_deleted', 'warning', $request->user(), $request->user()?->email, "Menghapus pesan kontak dari {$name} ({$email}).");
        } catch (\Throwable $e) {
        }

        return back()->with('success', 'Pesan dari "' . $name . '" berhasil dihapus.');
    }

    /**
     * Export daftar Contact Inquiries ke file Excel (.xlsx) berbentuk tabel rapi sesuai tampilan web
     */
    public function exportCsv(Request $request): Response
    {
        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $query = ContactMessage::latest();

        if ($status !== 'all' && in_array($status, ['unread', 'read', 'contacted'], true)) {
            $query->where('status', $status);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('service', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->get();
        $filename = 'GAT_Contact_Inquiries_' . now()->format('Ymd_His') . '.xlsx';

        $statusLabels = [
            'unread' => 'Baru',
            'read' => 'Dibaca',
            'contacted' => 'Dihubungi',
        ];

        $columns = [
            ['label' => 'NO', 'width' => 6, 'type' => 'number', 'align' => 'center'],
            ['label' => 'TANGGAL', 'width' => 20, 'align' => 'center'],
            ['label' => 'NAMA PENGIRIM', 'width' => 22],
            ['label' => 'PERUSAHAAN', 'width' => 26],
            ['label' => 'EMAIL', 'width' => 28],
            ['label' => 'WHATSAPP / TELEPON', 'width' => 19, 'align' => 'center'],
            ['label' => 'TOPIK LAYANAN', 'width' => 24, 'align' => 'center'],
            ['label' => 'ISI PESAN', 'width' => 46],
            ['label' => 'STATUS', 'width' => 14, 'align' => 'center'],
        ];

        $rows = [];
        foreach ($messages as $i => $m) {
            $rows[] = [
                $i + 1,
                $m->created_at ? $m->created_at->format('d M Y, H:i') . ' WIB' : '-',
                $m->name ?: '-',
                $m->company ?: '-',
                $m->email ?: '-',
                (string) ($m->phone ?: '-'),
                $m->service ?: 'General Inquiry',
                preg_replace('/\s+/', ' ', (string) ($m->message ?: '-')),
                $statusLabels[$m->status] ?? ucfirst((string) $m->status),
            ];
        }

        return SimpleXlsxExporter::download(
            $filename,
            'Contact Inquiries',
            'LAPORAN PESAN MASUK (CONTACT US) — PT GLOBAL ASPECT TECHNOLOGY',
            'Diekspor pada ' . now()->format('d M Y, H:i') . ' WIB  |  Total Pesan: ' . $messages->count() . ' pesan',
            $columns,
            $rows
        );
    }
}
