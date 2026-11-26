@extends('components.layouts.admin')

@section('title', 'Detail Pesanan ' . $order->invoice_number)

@section('content')
@php
    $cleanPhone = preg_replace('/[^0-9]/', '', $order->company_phone ?? '');
    if (str_starts_with($cleanPhone, '0')) {
        $cleanPhone = '62' . substr($cleanPhone, 1);
    } elseif (str_starts_with($cleanPhone, '8')) {
        $cleanPhone = '62' . $cleanPhone;
    }
    $waText = urlencode("Halo Bapak/Ibu {$order->pic_name} ({$order->company_name}), kami dari Tim Sales PT Global Aspect Technology menindaklanjuti pesanan Sales Quote #{$order->invoice_number} senilai Rp " . number_format($order->grand_total, 0, ',', '.') . ". Apakah ada dokumen atau hal teknis yang perlu kami bantu proseskan? Terima kasih.");
    $waDirectUrl = !empty($cleanPhone) ? "https://api.whatsapp.com/send?phone={$cleanPhone}&text={$waText}" : '#';

    $statusChoices = [
        'awaiting_po' => ['label' => 'Menunggu PO', 'badge' => 'bg-amber-50 text-amber-800 border-amber-200'],
        'po_submitted' => ['label' => 'PO Terkirim', 'badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200'],
        'confirmed' => ['label' => 'Dikonfirmasi', 'badge' => 'bg-blue-50 text-[#3367A5] border-blue-200'],
        'completed' => ['label' => 'Selesai', 'badge' => 'bg-indigo-50 text-indigo-800 border-indigo-200'],
        'cancelled' => ['label' => 'Dibatalkan', 'badge' => 'bg-rose-50 text-rose-800 border-rose-200'],
    ];
    $currentStatusInfo = $statusChoices[$order->status] ?? ['label' => strtoupper(str_replace('_', ' ', $order->status)), 'badge' => 'bg-slate-100 text-slate-700 border-slate-200'];
@endphp
<div class="space-y-6"
     x-data="{
        statusOpen: false,
        waContactedAt: @js($order->whatsapp_contacted_at ? $order->whatsapp_contacted_at->format('d M Y, H:i') . ' WIB' : null),
        waLogText: @js($order->whatsapp_message_log),
        openWhatsAppWithLog() {
            fetch('{{ route('admin.orders.log-wa', $order->uuid) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(r => r.json()).then(res => {
                if (res.success) {
                    this.waContactedAt = res.timestamp;
                    this.waLogText = res.message;
                }
            }).catch(() => {});
            @if ($waDirectUrl !== '#')
                window.open(@js($waDirectUrl), '_blank', 'noopener,noreferrer');
            @endif
        }
     }">
    <!-- Top Bar -->
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 bg-white p-5 rounded-[24px] border border-[#3367A5]/15 shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.orders.index') }}" class="w-10 h-10 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition shrink-0">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <div class="flex flex-wrap items-center gap-2">
                    <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900">Invoice: {{ $order->invoice_number }}</h2>

                    <!-- Custom Alpine Status Dropdown -->
                    <div class="relative inline-block">
                        <button type="button" @click="statusOpen = !statusOpen"
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold font-['Agrandir',sans-serif] border transition cursor-pointer {{ $currentStatusInfo['badge'] }}">
                            <span>{{ $currentStatusInfo['label'] }}</span>
                            <svg class="w-3 h-3 transition-transform duration-200" :class="{ 'rotate-180': statusOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-cloak x-show="statusOpen" @click.outside="statusOpen = false"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             class="absolute left-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">
                            <form id="orderShowStatusForm" method="POST" action="{{ route('admin.orders.status', $order->uuid) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" id="orderShowStatusInput" value="{{ $order->status }}">
                                @foreach ($statusChoices as $stKey => $stOpt)
                                    <button type="button"
                                            @click="document.getElementById('orderShowStatusInput').value = '{{ $stKey }}'; document.getElementById('orderShowStatusForm').submit()"
                                            class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $order->status === $stKey ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                        <span>{{ $stOpt['label'] }}</span>
                                        @if ($order->status === $stKey)
                                            <i class="fa-solid fa-check text-[#3367A5] text-xs"></i>
                                        @endif
                                    </button>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-slate-400 font-['Questrial',sans-serif] mt-0.5">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <button type="button" @click="openWhatsAppWithLog()"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-xs transition cursor-pointer">
                <i class="fa-brands fa-whatsapp text-sm"></i> Hubungi via WhatsApp
            </button>
            <a href="{{ route('admin.orders.pdf', $order->uuid) }}" target="_blank"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold text-xs font-['Agrandir',sans-serif] border border-purple-200 transition">
                <i class="fa-solid fa-file-pdf"></i> Unduh Sales Quote PDF
            </a>
            @if ($order->po_document_path)
                <a href="{{ route('admin.orders.po-file', $order->uuid) }}" target="_blank"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 font-bold text-xs font-['Agrandir',sans-serif] border border-amber-200 transition">
                    <i class="fa-solid fa-file-lines"></i> Dokumen PO
                </a>
            @endif
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Customer & PO Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-2xs space-y-3.5">
                <h3 class="font-bold text-xs font-['Agrandir',sans-serif] text-slate-800 border-b border-slate-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-building text-[#3367A5]"></i> Profil Perusahaan &amp; PIC
                </h3>
                <div class="text-xs space-y-2">
                    <div>
                        <span class="text-slate-400 block text-[10px]">Perusahaan</span>
                        <span class="font-bold text-slate-800">{{ $order->company_name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">PIC / Kontak</span>
                        <span class="font-semibold text-slate-800">{{ $order->pic_name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Nomor Telepon / WhatsApp</span>
                        <button type="button" @click="openWhatsAppWithLog()"
                           class="font-mono text-emerald-600 hover:text-emerald-700 hover:underline font-semibold inline-flex items-center gap-1 transition cursor-pointer"
                           title="Klik untuk langsung chat WhatsApp ke {{ $order->company_phone }}">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i>
                            <span>{{ $order->company_phone }}</span>
                        </button>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Email</span>
                        <span class="text-slate-700">{{ $order->company_email }}</span>
                    </div>
                    @if ($order->npwp)
                        <div>
                            <span class="text-slate-400 block text-[10px]">NPWP</span>
                            <span class="font-mono text-slate-700">{{ $order->npwp }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="text-slate-400 block text-[10px]">Alamat</span>
                        <span class="text-slate-700 leading-relaxed">{{ $order->company_address ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Riwayat Kontak WhatsApp -->
            <div x-show="waContactedAt" x-cloak class="bg-white rounded-2xl p-5 border border-emerald-200/80 shadow-2xs space-y-2">
                <h3 class="font-bold text-xs font-['Agrandir',sans-serif] text-emerald-800 border-b border-emerald-100 pb-2 flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-emerald-600"></i> Log Interaksi WhatsApp
                </h3>
                <p class="text-[11px] font-semibold text-emerald-700" x-text="'Terakhir dihubungi: ' + waContactedAt"></p>
                <p x-show="waLogText" class="text-xs text-slate-600 leading-relaxed bg-emerald-50/50 p-3 rounded-xl border border-emerald-100" x-text="waLogText"></p>
            </div>

            <!-- Catatan Pesanan -->
            @if ($order->notes)
                <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-2xs space-y-2">
                    <h3 class="font-bold text-xs font-['Agrandir',sans-serif] text-slate-800 border-b border-slate-100 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-note-sticky text-[#3367A5]"></i> Catatan / Instruksi Tambahan
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed italic bg-[#f8fafd] p-3 rounded-xl border border-slate-100">
                        "{{ $order->notes }}"
                    </p>
                </div>
            @endif
        </div>

        <!-- Order Items & Finance -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-2xs space-y-4">
                <h3 class="font-bold text-xs font-['Agrandir',sans-serif] text-slate-800 border-b border-slate-100 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-box-open text-[#3367A5]"></i> Rincian Item Produk &amp; Spesifikasi
                </h3>

                <div class="space-y-3">
                    @foreach ($order->items as $item)
                        <div class="p-3.5 rounded-xl border border-slate-200/90 bg-[#f8fafd] flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                            <div class="space-y-1 flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-xs text-slate-900 font-['Agrandir',sans-serif]">{{ $item->product_name }}</span>
                                    @if ($item->sku)
                                        <span class="px-2 py-0.5 rounded bg-white text-[10px] font-mono border border-slate-200 text-slate-500">{{ $item->sku }}</span>
                                    @endif
                                </div>
                                @php $specs = $item->resolvedSpecifications(); @endphp
                                @if (!empty($specs))
                                    <div class="pt-1.5 space-y-1">
                                        @foreach ($specs as $label => $val)
                                            <div class="text-[11px] text-slate-600 flex items-center gap-2">
                                                <span class="text-slate-400 font-medium">{{ $label }}:</span>
                                                <span class="font-semibold text-slate-800 bg-white px-2 py-0.5 rounded border border-slate-200/80">{{ $val }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="text-right sm:shrink-0 text-xs">
                                <div class="text-slate-400 text-[10px]">{{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}</div>
                                <div class="font-bold text-slate-900 text-sm font-['Agrandir',sans-serif]">Rp {{ number_format($item->line_total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Financial Breakdown -->
                <div class="border-t border-slate-100 pt-3 space-y-1.5 text-xs text-slate-600 max-w-xs ml-auto">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Subtotal:</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">PPN ({{ $order->tax_rate }}%):</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                    </div>
                    @if ($order->pph23_amount > 0)
                        <div class="flex justify-between">
                            <span class="text-slate-400">PPh 23 ({{ $order->pph23_rate }}%):</span>
                            <span class="font-semibold text-rose-600">- Rp {{ number_format($order->pph23_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between border-t border-slate-200 pt-2 text-sm font-bold text-slate-900 font-['Agrandir',sans-serif]">
                        <span>Grand Total:</span>
                        <span class="text-[#3367A5]">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
