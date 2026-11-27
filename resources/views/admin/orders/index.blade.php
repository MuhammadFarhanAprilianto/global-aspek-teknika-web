@extends('components.layouts.admin')

@section('title', 'Pesanan & Log WhatsApp B2B')

@section('content')
    @php
        $orderStatusOptions = [
            'all' => ['label' => 'Semua Status', 'dot' => 'bg-slate-400'],
            'awaiting_po' => ['label' => 'Menunggu PO / Kontak', 'dot' => 'bg-amber-500'],
            'po_submitted' => ['label' => 'PO Masuk / Terkonfirmasi', 'dot' => 'bg-emerald-500'],
            'completed' => ['label' => 'Selesai / Terkirim', 'dot' => 'bg-[#3367A5]'],
            'cancelled' => ['label' => 'Dibatalkan', 'dot' => 'bg-rose-500'],
        ];
        $activeOrderStatus = $orderStatusOptions[$status] ?? $orderStatusOptions['all'];
        $isOrderFiltered = $status !== 'all' || !empty($search);
        $ordersJson = $ordersJson ?? $orders->getCollection()->map(fn ($o) => \App\Http\Controllers\Admin\OrderAdminController::transformOrder($o))->values();
    @endphp

    <div class="space-y-6" x-data="{
        detailModalOpen: false,
        selectedOrder: null,
        ordersData: {{ json_encode($ordersJson) }},
        stats: {
            total_orders: {{ (int) $totalOrders }},
            awaiting_po: {{ (int) $awaitingPoCount }},
            po_submitted: {{ (int) $poSubmittedCount }},
            total_revenue_formatted: 'Rp {{ number_format($totalRevenue, 0, ',', '.') }}'
        },
        ordersPollTimer: null,
        getOrder(orderId) {
            return this.ordersData.find(o => o.id === orderId) || null;
        },
        openDetail(orderId) {
            this.selectedOrder = this.getOrder(orderId);
            if (this.selectedOrder) {
                this.detailModalOpen = true;
            }
        },
        syncOrders() {
            const url = new URL(window.location.href);
            url.searchParams.set('format', 'json');
            fetch(url.toString(), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                cache: 'no-store'
            }).then(r => {
                if (r.status === 401) {
                    window.location.href = '{{ route('login') }}';
                    return null;
                }
                return r.ok ? r.json() : null;
            }).then(data => {
                if (!data) return;
                if (Array.isArray(data.orders)) {
                    this.ordersData = data.orders;
                    if (this.selectedOrder) {
                        const updated = this.getOrder(this.selectedOrder.id);
                        if (updated) this.selectedOrder = updated;
                    }
                }
                if (data.stats) {
                    this.stats = data.stats;
                }
            }).catch(() => {});
        },
        init() {
            this.ordersPollTimer = setInterval(() => {
                if (!document.hidden) this.syncOrders();
            }, 6000);
            try {
                if (typeof BroadcastChannel !== 'undefined') {
                    const ch = new BroadcastChannel('gat_cms_sync');
                    ch.onmessage = (ev) => {
                        if (ev?.data?.type === 'public_submission') {
                            this.syncOrders();
                        }
                    };
                }
            } catch (e) {}
        },
        getWhatsAppUrl(order) {
            if (!order || !order.company_phone) return '#';
            let phone = String(order.company_phone).replace(/[^0-9]/g, '');
            if (phone.startsWith('0')) phone = '62' + phone.slice(1);
            else if (phone.startsWith('8')) phone = '62' + phone;

            const company = order.company_name || '';
            const pic = order.pic_name || '';
            const inv = order.invoice_number || '';
            const total = order.grand_total_formatted || '';
            const msg = encodeURIComponent(`Halo Bapak/Ibu ${pic} (${company}), kami dari Tim Sales PT Global Aspect Technology menindaklanjuti pesanan Sales Quote #${inv} senilai ${total}. Apakah ada dokumen atau hal teknis yang perlu kami bantu proseskan? Terima kasih.`);

            return `https://api.whatsapp.com/send?phone=${phone}&text=${msg}`;
        },
        logWhatsAppInteraction(order) {
            if (!order || !order.uuid) return;
            fetch(`{{ url('admin/orders') }}/${order.uuid}/log-wa`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(r => r.json()).then(res => {
                if (res.success) {
                    const target = (order.id ? this.getOrder(order.id) : null) || order;
                    target.whatsapp_contacted_at = res.timestamp;
                    target.whatsapp_contacted_diff = 'Baru saja';
                    target.whatsapp_message_log = res.message;
                    if (this.selectedOrder && this.selectedOrder.id === target.id) {
                        this.selectedOrder = { ...target };
                    }
                    this.syncOrders();
                }
            }).catch(e => console.log(e));
        },
        openWhatsApp(order) {
            this.logWhatsAppInteraction(order);
            const url = this.getWhatsAppUrl(order);
            if (url && url !== '#') {
                window.open(url, '_blank');
            }
        }
    }">

        <!-- Top Action & Stat Bar -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4.5 rounded-[24px] border border-[#3367A5]/15 shadow-sm min-h-[76px]">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-lg shrink-0 shadow-2xs">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none flex items-center">
                    Pesanan &amp; Log WhatsApp Pelanggan B2B
                </h2>
            </div>

            <!-- Stat Counters -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <div class="h-11 px-3.5 rounded-2xl bg-[#f8fafd] border border-slate-200/80 inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[90px]">
                    <span class="text-[10px] text-slate-400 block font-semibold font-['Questrial',sans-serif] leading-tight">Total Pengajuan</span>
                    <span class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight mt-0.5" x-text="stats.total_orders">{{ $totalOrders }}</span>
                </div>
                <div class="h-11 px-3.5 rounded-2xl bg-amber-50 border border-amber-100 inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[90px]">
                    <span class="text-[10px] text-amber-700 block font-semibold font-['Questrial',sans-serif] leading-tight">Menunggu PO</span>
                    <span class="text-sm font-bold font-['Agrandir',sans-serif] text-amber-800 leading-tight mt-0.5" x-text="stats.awaiting_po">{{ $awaitingPoCount }}</span>
                </div>
                <div class="h-11 px-3.5 rounded-2xl bg-emerald-50 border border-emerald-100 inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[90px]">
                    <span class="text-[10px] text-emerald-700 block font-semibold font-['Questrial',sans-serif] leading-tight">PO Terkonfirmasi</span>
                    <span class="text-sm font-bold font-['Agrandir',sans-serif] text-emerald-800 leading-tight mt-0.5" x-text="stats.po_submitted">{{ $poSubmittedCount }}</span>
                </div>
                <div class="h-11 px-3.5 rounded-2xl bg-blue-50 border border-blue-100 inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[110px]">
                    <span class="text-[10px] text-[#3367A5] block font-semibold font-['Questrial',sans-serif] leading-tight">Total Transaksi</span>
                    <span class="text-sm font-bold font-['Agrandir',sans-serif] text-[#3367A5] leading-tight mt-0.5" x-text="stats.total_revenue_formatted">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 text-xs">
            <form id="ordersFilterForm" method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <input type="hidden" name="status" id="filterOrderStatusInput" value="{{ $status }}">

                <!-- Search Input -->
                <div class="relative w-full sm:w-auto">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari invoice, PT, PIC..."
                           class="pl-8 pr-8 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-700 outline-none focus:border-[#3367A5] w-full sm:w-64 text-xs font-['Questrial',sans-serif] transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400"></i>
                    @if (!empty($search))
                        <button type="button" onclick="document.querySelector('input[name=search]').value=''; document.getElementById('ordersFilterForm').submit()" 
                                class="absolute right-2.5 top-2 text-slate-400 hover:text-slate-600 cursor-pointer" title="Hapus pencarian">
                            <i class="fa-solid fa-xmark text-xs"></i>
                        </button>
                    @endif
                </div>

                <!-- Custom Dropdown: Status Pesanan -->
                <div class="relative" x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                            class="inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer min-w-[190px] {{ $status !== 'all' ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                        <div class="flex items-center gap-2 truncate">
                            <span class="w-2 h-2 rounded-full {{ $activeOrderStatus['dot'] }} shrink-0"></span>
                            <span class="truncate">{{ $activeOrderStatus['label'] }}</span>
                        </div>
                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-cloak x-show="open" @click.outside="open = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                        class="absolute left-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">

                        <div class="py-1">
                            @foreach ($orderStatusOptions as $key => $opt)
                                <button type="button"
                                    @click="document.getElementById('filterOrderStatusInput').value = '{{ $key }}'; document.getElementById('ordersFilterForm').submit()"
                                    class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $status === $key ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2 h-2 rounded-full {{ $opt['dot'] }} shrink-0"></span>
                                        <span class="font-['Questrial',sans-serif] {{ $status === $key ? 'font-bold text-[#3367A5]' : '' }}">{{ $opt['label'] }}</span>
                                    </div>
                                    @if ($status === $key)
                                        <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Reset Filter Button -->
                @if ($isOrderFiltered)
                    <a href="{{ route('admin.orders.index') }}"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-['Agrandir',sans-serif] text-xs font-semibold border border-rose-200/70 transition shadow-2xs"
                        title="Reset semua filter">
                        <i class="fa-solid fa-rotate-left text-[11px]"></i>
                        <span>Reset Filter</span>
                    </a>
                @endif
            </form>

            <!-- Export Excel Button (respects active filters) -->
            <a href="{{ route('admin.orders.export', request()->only(['status', 'search'])) }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-200/90 hover:border-emerald-600 font-['Agrandir',sans-serif] text-xs font-bold transition shadow-2xs shrink-0"
               title="Unduh rekap Orders & RFQ dalam format Excel (.xlsx) bertabel rapi">
                <i class="fa-solid fa-file-excel text-xs"></i>
                <span>Export Excel</span>
            </a>
        </div>

        <!-- Orders Table Card -->
        <div class="bg-white rounded-[24px] border border-[#3367A5]/15 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1050px] text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-[#f8fafd] border-b border-slate-100 text-slate-500 font-['Agrandir',sans-serif] text-[11px] uppercase tracking-wider">
                            <th class="py-4 px-4 font-bold whitespace-nowrap w-[170px]">No. Invoice &amp; Waktu</th>
                            <th class="py-4 px-4 font-bold whitespace-nowrap min-w-[220px]">Perusahaan &amp; PIC</th>
                            <th class="py-4 px-4 font-bold whitespace-nowrap w-[170px]">Item &amp; Total Nilai</th>
                            <th class="py-4 px-4 font-bold whitespace-nowrap w-[170px]">Status Pesanan</th>
                            <th class="py-4 px-4 font-bold whitespace-nowrap min-w-[200px]">Log WhatsApp</th>
                            <th class="py-4 px-4 font-bold whitespace-nowrap text-right w-[180px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($orders as $order)
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $order->company_phone ?? '');
                                if (str_starts_with($cleanPhone, '0')) {
                                    $cleanPhone = '62' . substr($cleanPhone, 1);
                                } elseif (str_starts_with($cleanPhone, '8')) {
                                    $cleanPhone = '62' . $cleanPhone;
                                }
                                $waText = urlencode("Halo Bapak/Ibu {$order->pic_name} ({$order->company_name}), kami dari Tim Sales PT Global Aspect Technology menindaklanjuti pesanan Sales Quote #{$order->invoice_number} senilai Rp " . number_format($order->grand_total, 0, ',', '.') . ". Apakah ada dokumen atau hal teknis yang perlu kami bantu proseskan? Terima kasih.");
                                $waDirectUrl = !empty($cleanPhone) ? "https://api.whatsapp.com/send?phone={$cleanPhone}&text={$waText}" : '#';
                                $orderItemJs = $ordersJson->firstWhere('id', $order->id);
                            @endphp
                            <tr class="hover:bg-[#f8fafd]/80 transition duration-150">
                                <!-- No. Invoice & Waktu -->
                                <td class="py-4 px-4 whitespace-nowrap align-middle">
                                    <button type="button" @click="openDetail({{ $order->id }})" 
                                            class="font-bold text-[#3367A5] hover:underline font-mono text-xs flex items-center gap-1.5 cursor-pointer text-left"
                                            title="Klik untuk melihat detail lengkap">
                                        <i class="fa-solid fa-receipt text-[#3367A5]/70 text-[11px]"></i>
                                        <span>{{ $order->invoice_number }}</span>
                                    </button>
                                    <div class="text-[11px] text-slate-400 font-['Questrial',sans-serif] flex items-center gap-1.5 mt-0.5">
                                        <i class="fa-regular fa-clock text-[10px] text-slate-300"></i>
                                        <span>{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                                    </div>
                                </td>

                                <!-- Perusahaan & PIC -->
                                <td class="py-4 px-4 align-middle">
                                    <div class="font-bold text-slate-900 font-['Agrandir',sans-serif] text-xs whitespace-nowrap">
                                        {{ $order->company_name }}
                                    </div>
                                    <div class="text-[11px] text-slate-500 font-['Questrial',sans-serif] flex items-center gap-1.5 mt-0.5 whitespace-nowrap">
                                        <span class="text-[#3367A5] font-semibold">PIC: {{ $order->pic_name }}</span>
                                        <span class="text-slate-300">•</span>
                                        <a href="{{ $waDirectUrl }}" target="_blank" rel="noopener noreferrer"
                                           @click="logWhatsAppInteraction({{ json_encode($orderItemJs ?? ['uuid' => $order->uuid]) }})"
                                           class="font-mono text-slate-500 hover:text-emerald-600 hover:underline inline-flex items-center gap-1 transition"
                                           title="Langsung chat WhatsApp ke {{ $order->company_phone }}">
                                            <i class="fa-brands fa-whatsapp text-emerald-500 text-xs"></i>
                                            <span>{{ $order->company_phone }}</span>
                                        </a>
                                    </div>
                                </td>

                                <!-- Item & Total Nilai -->
                                <td class="py-4 px-4 whitespace-nowrap align-middle">
                                    <div class="font-bold font-['Agrandir',sans-serif] text-slate-900 text-xs">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </div>
                                    <button type="button" @click="openDetail({{ $order->id }})"
                                            class="text-[11px] text-[#3367A5] hover:underline font-['Questrial',sans-serif] flex items-center gap-1 mt-0.5 cursor-pointer">
                                        <i class="fa-solid fa-box text-[10px]"></i>
                                        <span>{{ $order->items ? $order->items->count() : 0 }} Item Produk</span>
                                    </button>
                                </td>

                                <!-- Status Pesanan (Fixed Viewport Portal - Never Clipped Inside Table) -->
                                <td class="py-4 px-4 whitespace-nowrap align-middle"
                                    x-data="{
                                        statusOpen: false,
                                        openUp: false,
                                        menuTop: 0,
                                        menuBottom: 0,
                                        menuLeft: 0,
                                        get rowOrder() { return getOrder({{ $order->id }}) || { status: '{{ $order->status }}' }; },
                                        toggleMenu() {
                                            if (this.statusOpen) {
                                                this.statusOpen = false;
                                                return;
                                            }
                                            const rect = this.$refs.orderStatusBtn.getBoundingClientRect();
                                            const spaceBelow = window.innerHeight - rect.bottom;
                                            this.openUp = spaceBelow < 220 && rect.top > 220;
                                            this.menuTop = rect.bottom + 6;
                                            this.menuBottom = window.innerHeight - rect.top + 6;
                                            this.menuLeft = Math.max(8, Math.min(window.innerWidth - 216, rect.left));
                                            this.statusOpen = true;
                                        }
                                    }"
                                    @scroll.window="statusOpen = false"
                                    @resize.window="statusOpen = false">
                                    <div class="relative inline-block text-left">
                                        <button type="button" x-ref="orderStatusBtn"
                                            @click.stop="toggleMenu()"
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold font-['Agrandir',sans-serif] border transition cursor-pointer shadow-2xs hover:scale-[1.02] active:scale-95"
                                            :class="rowOrder.status === 'po_submitted' ? 'bg-emerald-50 text-emerald-800 border-emerald-200 hover:bg-emerald-100/80 hover:border-emerald-300' : (rowOrder.status === 'awaiting_po' ? 'bg-[#fffbeb] text-[#b45309] border-[#fde68a] hover:bg-[#fef3c7] hover:border-[#fcd34d]' : (rowOrder.status === 'completed' ? 'bg-blue-50 text-[#3367A5] border-blue-200 hover:bg-blue-100/80' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'))">
                                            <span class="w-2 h-2 rounded-full shrink-0"
                                                  :class="rowOrder.status === 'po_submitted' ? 'bg-emerald-500' : (rowOrder.status === 'awaiting_po' ? 'bg-amber-500' : (rowOrder.status === 'completed' ? 'bg-[#3367A5]' : 'bg-slate-400'))"></span>
                                            <span x-text="rowOrder.status === 'po_submitted' ? 'PO Submitted' : (rowOrder.status === 'awaiting_po' ? 'Awaiting PO' : (rowOrder.status === 'completed' ? 'Completed' : 'Cancelled'))">{{ $order->status === 'po_submitted' ? 'PO Submitted' : ($order->status === 'awaiting_po' ? 'Awaiting PO' : ($order->status === 'completed' ? 'Completed' : 'Cancelled')) }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200"
                                                :class="[rowOrder.status === 'po_submitted' ? 'text-emerald-700' : (rowOrder.status === 'awaiting_po' ? 'text-[#b45309]' : 'text-[#3367A5]'), { 'rotate-180': statusOpen }]"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <template x-teleport="body">
                                            <div x-cloak x-show="statusOpen"
                                                @click.outside="if (!$refs.orderStatusBtn?.contains($event.target)) statusOpen = false"
                                                x-transition:enter="transition ease-out duration-150"
                                                x-transition:enter-start="opacity-0 scale-95"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-100"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-95"
                                                :style="openUp ? `position: fixed; left: ${menuLeft}px; bottom: ${menuBottom}px;` : `position: fixed; left: ${menuLeft}px; top: ${menuTop}px;`"
                                                class="w-52 bg-white rounded-2xl shadow-2xl border border-slate-200/90 py-1.5 z-[9990] text-slate-700 font-['Questrial',sans-serif] overflow-hidden">

                                                <form id="orderStatusForm_{{ $order->id }}" method="POST" action="{{ route('admin.orders.status', $order->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" id="orderStatusInput_{{ $order->id }}" value="{{ $order->status }}">

                                                    <!-- Option Awaiting PO -->
                                                    <button type="button"
                                                        @click="document.getElementById('orderStatusInput_{{ $order->id }}').value = 'awaiting_po'; document.getElementById('orderStatusForm_{{ $order->id }}').submit()"
                                                        class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-amber-50/70 transition cursor-pointer {{ $order->status === 'awaiting_po' ? 'bg-amber-50/90 text-amber-900 font-bold' : 'text-slate-700' }}">
                                                        <div class="flex items-center gap-2.5">
                                                            <span class="w-2 h-2 rounded-full bg-amber-500 shrink-0"></span>
                                                            <div>
                                                                <span class="font-['Agrandir',sans-serif] font-bold block leading-none">Awaiting PO</span>
                                                                <span class="text-[10px] text-slate-400 font-['Questrial',sans-serif] block mt-0.5">Menunggu Kontak / PO</span>
                                                            </div>
                                                        </div>
                                                        @if ($order->status === 'awaiting_po')
                                                            <i class="fa-solid fa-check text-amber-600 text-xs"></i>
                                                        @endif
                                                    </button>

                                                    <!-- Option PO Submitted -->
                                                    <button type="button"
                                                        @click="document.getElementById('orderStatusInput_{{ $order->id }}').value = 'po_submitted'; document.getElementById('orderStatusForm_{{ $order->id }}').submit()"
                                                        class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-emerald-50/70 transition cursor-pointer {{ $order->status === 'po_submitted' ? 'bg-emerald-50/90 text-emerald-800 font-bold' : 'text-slate-700' }}">
                                                        <div class="flex items-center gap-2.5">
                                                            <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                                                            <div>
                                                                <span class="font-['Agrandir',sans-serif] font-bold block leading-none">PO Submitted</span>
                                                                <span class="text-[10px] text-slate-400 font-['Questrial',sans-serif] block mt-0.5">PO Masuk / Terkonfirmasi</span>
                                                            </div>
                                                        </div>
                                                        @if ($order->status === 'po_submitted')
                                                            <i class="fa-solid fa-check text-emerald-600 text-xs"></i>
                                                        @endif
                                                    </button>

                                                    <!-- Option Completed -->
                                                    <button type="button"
                                                        @click="document.getElementById('orderStatusInput_{{ $order->id }}').value = 'completed'; document.getElementById('orderStatusForm_{{ $order->id }}').submit()"
                                                        class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $order->status === 'completed' ? 'bg-blue-50/90 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                                        <div class="flex items-center gap-2.5">
                                                            <span class="w-2 h-2 rounded-full bg-[#3367A5] shrink-0"></span>
                                                            <div>
                                                                <span class="font-['Agrandir',sans-serif] font-bold block leading-none">Completed</span>
                                                                <span class="text-[10px] text-slate-400 font-['Questrial',sans-serif] block mt-0.5">Pesanan Selesai / Terkirim</span>
                                                            </div>
                                                        </div>
                                                        @if ($order->status === 'completed')
                                                            <i class="fa-solid fa-check text-[#3367A5] text-xs"></i>
                                                        @endif
                                                    </button>

                                                    <!-- Option Cancelled -->
                                                    <button type="button"
                                                        @click="document.getElementById('orderStatusInput_{{ $order->id }}').value = 'cancelled'; document.getElementById('orderStatusForm_{{ $order->id }}').submit()"
                                                        class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-rose-50/70 transition cursor-pointer {{ $order->status === 'cancelled' ? 'bg-rose-50 text-rose-700 font-bold' : 'text-slate-700' }}">
                                                        <div class="flex items-center gap-2.5">
                                                            <span class="w-2 h-2 rounded-full bg-rose-500 shrink-0"></span>
                                                            <div>
                                                                <span class="font-['Agrandir',sans-serif] font-bold block leading-none">Cancelled</span>
                                                                <span class="text-[10px] text-slate-400 font-['Questrial',sans-serif] block mt-0.5">Dibatalkan</span>
                                                            </div>
                                                        </div>
                                                        @if ($order->status === 'cancelled')
                                                            <i class="fa-solid fa-check text-rose-600 text-xs"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>
                                        </template>
                                    </div>
                                </td>

                                <!-- Log Interaksi WhatsApp (Reaktif Real-Time) -->
                                <td class="py-4 px-4 align-middle max-w-xs"
                                    x-data="{ get rowOrder() { return getOrder({{ $order->id }}) || { whatsapp_contacted_at: @json($order->whatsapp_contacted_at ? $order->whatsapp_contacted_at->format('d M Y, H:i') . ' WIB' : null), whatsapp_contacted_diff: @json($order->whatsapp_contacted_at ? $order->whatsapp_contacted_at->diffForHumans() : null), whatsapp_message_log: @json($order->whatsapp_message_log) }; } }">
                                    <template x-if="rowOrder.whatsapp_contacted_at">
                                        <div>
                                            <div class="flex items-center gap-1.5 text-emerald-700 font-bold text-[11px]">
                                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                                <span x-text="'Dihubungi ' + (rowOrder.whatsapp_contacted_diff || rowOrder.whatsapp_contacted_at)"></span>
                                            </div>
                                            <p class="text-[10px] text-slate-500 truncate mt-0.5 font-['Questrial',sans-serif]"
                                               :title="rowOrder.whatsapp_message_log || ''"
                                               x-text="rowOrder.whatsapp_message_log || ''"></p>
                                        </div>
                                    </template>
                                    <template x-if="!rowOrder.whatsapp_contacted_at">
                                        <span class="inline-flex items-center gap-1 text-[10px] text-slate-400 italic font-['Questrial',sans-serif]">
                                            <i class="fa-regular fa-clock text-[9px]"></i> Belum mengklik tombol WA
                                        </span>
                                    </template>
                                </td>

                                <!-- Aksi (Clean, Functional, All Work!) -->
                                <td class="py-4 px-4 whitespace-nowrap text-right align-middle">
                                    <div class="inline-flex items-center gap-1.5">
                                        <!-- Detail Button -->
                                        <button type="button" @click="openDetail({{ $order->id }})"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-[#3367A5] font-bold text-[11px] font-['Agrandir',sans-serif] transition shadow-2xs cursor-pointer"
                                                title="Lihat Detail Pesanan">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                            <span>Detail</span>
                                        </button>

                                        <!-- Chat WhatsApp Button -->
                                        <a href="{{ $waDirectUrl }}" target="_blank" rel="noopener noreferrer"
                                           @click="logWhatsAppInteraction({{ json_encode($orderItemJs ?? ['uuid' => $order->uuid]) }})"
                                           class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] font-['Agrandir',sans-serif] transition shadow-2xs hover:shadow-xs cursor-pointer"
                                           title="Langsung chat WhatsApp ke {{ $order->company_phone }} &amp; Catat Log">
                                            <i class="fa-brands fa-whatsapp text-xs"></i>
                                            <span>Chat WA</span>
                                        </a>

                                        <!-- Download Sales Quote PDF -->
                                        <a href="{{ route('admin.orders.pdf', $order->uuid) }}" target="_blank"
                                           class="p-1.5 text-purple-600 hover:text-purple-800 rounded-xl hover:bg-purple-50 transition border border-transparent hover:border-purple-200 cursor-pointer"
                                           title="Unduh Surat Penawaran Resmi (Sales Quote PDF)">
                                            <i class="fa-solid fa-file-pdf text-xs"></i>
                                        </a>

                                        <!-- Download PO File if customer uploaded -->
                                        @if ($order->po_document_path)
                                            <a href="{{ route('admin.orders.po-file', $order->uuid) }}" target="_blank"
                                               class="p-1.5 text-amber-600 hover:text-amber-800 rounded-xl hover:bg-amber-50 transition border border-transparent hover:border-amber-200 cursor-pointer"
                                               title="Unduh Dokumen PO Pelanggan ({{ $order->po_number ?: 'PO File' }})">
                                                <i class="fa-solid fa-file-lines text-xs"></i>
                                            </a>
                                        @endif

                                        <!-- Delete Order -->
                                        <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}"
                                              class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip pesanan {{ $order->invoice_number }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-1.5 text-slate-400 hover:text-rose-600 rounded-xl hover:bg-rose-50 transition border border-transparent hover:border-rose-100 cursor-pointer"
                                                    title="Hapus Pesanan">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 font-['Questrial',sans-serif]">
                                    <i class="fa-solid fa-inbox text-3xl mb-2 text-slate-300 block"></i>
                                    Belum ada pengajuan pesanan B2B yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination only when pages exist -->
            @if ($orders->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

        <!-- ============================================================== -->
        <!-- MODAL: DETAIL PESANAN & ITEM QUOTATION B2B                     -->
        <!-- ============================================================== -->
        <template x-teleport="body">
            <div x-cloak x-show="detailModalOpen" 
                 class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center p-3 sm:p-4 md:p-6 bg-slate-900/60 backdrop-blur-xs overflow-hidden"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                
                <div class="bg-white rounded-[28px] max-w-3xl w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[90vh] overflow-hidden my-auto"
                     @click.outside="detailModalOpen = false"
                     x-show="selectedOrder">
                
                    <!-- Pinned Header -->
                    <div class="px-6 sm:px-7 pt-5 pb-3.5 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-lg">
                                <i class="fa-solid fa-file-invoice"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-bold font-['Agrandir',sans-serif] text-slate-900">
                                        Invoice: <span class="font-mono text-[#3367A5]" x-text="selectedOrder?.invoice_number"></span>
                                    </h3>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold font-['Agrandir',sans-serif]"
                                          :class="selectedOrder?.status === 'po_submitted' ? 'bg-emerald-100 text-emerald-800' : (selectedOrder?.status === 'awaiting_po' ? 'bg-amber-100 text-amber-800' : (selectedOrder?.status === 'completed' ? 'bg-blue-100 text-[#3367A5]' : 'bg-rose-100 text-rose-800'))"
                                          x-text="selectedOrder?.status_label">
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-400 font-['Questrial',sans-serif]" x-text="'Dibuat pada ' + selectedOrder?.created_at_formatted"></p>
                            </div>
                        </div>
                        <button type="button" @click="detailModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>

                    <!-- Smooth Scrollable Body -->
                    <div class="flex-1 overflow-y-auto px-6 sm:px-7 py-5 space-y-5 text-xs overscroll-contain"
                         style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                        
                        <!-- Top Two Columns: Company Data & Financial Breakdown -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Customer & PIC Profile -->
                            <div class="bg-[#f8fafd] rounded-2xl p-4 border border-slate-200/80 space-y-2.5">
                                <div class="font-bold text-xs font-['Agrandir',sans-serif] text-slate-800 border-b border-slate-200/70 pb-1.5 flex items-center gap-2">
                                    <i class="fa-solid fa-building text-[#3367A5]"></i> Profil Perusahaan &amp; PIC
                                </div>
                                <div class="space-y-1.5 text-xs font-['Questrial',sans-serif]">
                                    <div>
                                        <span class="text-slate-400 text-[10px] block">Perusahaan:</span>
                                        <span class="font-bold text-slate-900" x-text="selectedOrder?.company_name"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 pt-1">
                                        <div>
                                            <span class="text-slate-400 text-[10px] block">PIC:</span>
                                            <span class="font-semibold text-slate-800" x-text="selectedOrder?.pic_name"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-400 text-[10px] block">WhatsApp:</span>
                                            <a :href="getWhatsAppUrl(selectedOrder)" target="_blank" rel="noopener noreferrer"
                                               @click="logWhatsAppInteraction(selectedOrder)"
                                               class="font-mono text-emerald-600 hover:text-emerald-700 hover:underline font-semibold inline-flex items-center gap-1 transition"
                                               title="Klik untuk langsung chat WhatsApp ke nomor pelanggan">
                                                <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i>
                                                <span x-text="selectedOrder?.company_phone"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 pt-1">
                                        <div>
                                            <span class="text-slate-400 text-[10px] block">Email:</span>
                                            <span class="text-slate-700 truncate block" x-text="selectedOrder?.company_email"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-400 text-[10px] block">NPWP:</span>
                                            <span class="font-mono text-slate-700" x-text="selectedOrder?.npwp || '-'"></span>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <span class="text-slate-400 text-[10px] block">Alamat:</span>
                                        <span class="text-slate-700 leading-relaxed block" x-text="selectedOrder?.company_address || '-'"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment & Status Summary -->
                            <div class="bg-[#f8fafd] rounded-2xl p-4 border border-slate-200/80 space-y-2.5 flex flex-col justify-between">
                                <div>
                                    <div class="font-bold text-xs font-['Agrandir',sans-serif] text-slate-800 border-b border-slate-200/70 pb-1.5 flex items-center justify-between">
                                        <span class="flex items-center gap-2"><i class="fa-solid fa-wallet text-[#3367A5]"></i> Ringkasan Nilai Quotation</span>
                                        <span class="text-[10px] text-slate-400 font-normal">B2B Formal</span>
                                    </div>

                                    <div class="space-y-1.5 pt-2 text-xs font-['Questrial',sans-serif]">
                                        <div class="flex justify-between">
                                            <span class="text-slate-400">Subtotal:</span>
                                            <span class="font-semibold text-slate-800" x-text="selectedOrder?.subtotal_formatted"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-400" x-text="'PPN (' + (selectedOrder?.tax_rate || 11) + '%):'"></span>
                                            <span class="font-semibold text-slate-800" x-text="selectedOrder?.tax_amount_formatted"></span>
                                        </div>
                                        <template x-if="selectedOrder?.pph23_rate > 0">
                                            <div class="flex justify-between text-rose-600">
                                                <span x-text="'PPh 23 (' + selectedOrder?.pph23_rate + '%):'"></span>
                                                <span class="font-semibold" x-text="'- ' + selectedOrder?.pph23_amount_formatted"></span>
                                            </div>
                                        </template>
                                        <div class="flex justify-between border-t border-slate-200/80 pt-2 text-sm font-bold font-['Agrandir',sans-serif]">
                                            <span class="text-slate-900">Grand Total:</span>
                                            <span class="text-[#3367A5]" x-text="selectedOrder?.grand_total_formatted"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- PO Document Attachment Status -->
                                <div class="pt-2 border-t border-slate-200/80">
                                    <div class="flex items-center justify-between text-[11px]">
                                        <span class="text-slate-500 font-medium">Dokumen PO Pelanggan:</span>
                                        <template x-if="selectedOrder?.has_po_file">
                                            <a :href="selectedOrder?.po_file_url" target="_blank"
                                               class="inline-flex items-center gap-1.5 text-emerald-700 font-bold hover:underline bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                                <i class="fa-solid fa-file-arrow-down text-xs"></i> Unduh File PO
                                            </a>
                                        </template>
                                        <template x-if="!selectedOrder?.has_po_file">
                                            <span class="text-slate-400 italic">Belum diunggah</span>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes if any -->
                        <template x-if="selectedOrder?.notes">
                            <div class="p-3.5 rounded-2xl bg-amber-50/60 border border-amber-200/70 text-xs">
                                <span class="font-bold text-amber-900 block font-['Agrandir',sans-serif] mb-0.5">Catatan Khusus Klien:</span>
                                <p class="text-amber-800 italic leading-relaxed" x-text="selectedOrder?.notes"></p>
                            </div>
                        </template>

                        <!-- Items & Specifications List -->
                        <div class="space-y-2.5">
                            <div class="font-bold text-xs font-['Agrandir',sans-serif] text-slate-800 flex items-center justify-between border-b border-slate-200/80 pb-2">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-layer-group text-[#3367A5]"></i> Item Produk &amp; Konfigurasi Spesifikasi
                                </span>
                                <span class="text-[10px] text-slate-400 font-normal" x-text="(selectedOrder?.items?.length || 0) + ' Item'"></span>
                            </div>

                            <div class="space-y-3">
                                <template x-for="item in selectedOrder?.items" :key="item.id">
                                    <div class="p-3.5 rounded-2xl border border-slate-200 bg-[#f8fafd] flex flex-col sm:flex-row sm:items-start justify-between gap-3 shadow-2xs">
                                        <div class="space-y-1.5 flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-xs text-slate-900 font-['Agrandir',sans-serif]" x-text="item.product_name"></span>
                                                <template x-if="item.sku">
                                                    <span class="px-2 py-0.5 rounded bg-white text-[10px] font-mono border border-slate-200 text-slate-600" x-text="item.sku"></span>
                                                </template>
                                            </div>

                                            <!-- Specifications Tags -->
                                            <div class="space-y-1 pt-1" x-show="Object.keys(item.specifications || {}).length > 0">
                                                <template x-for="(val, key) in item.specifications" :key="key">
                                                    <div class="text-[11px] text-slate-600 flex items-center gap-2">
                                                        <span class="text-slate-400" x-text="key + ':'"></span>
                                                        <span class="font-semibold text-slate-800 bg-white px-2 py-0.5 rounded border border-slate-200/80" x-text="val"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <div class="text-right sm:shrink-0 text-xs">
                                            <div class="text-slate-400 text-[10px]" x-text="item.quantity + ' pcs x ' + item.unit_price_formatted"></div>
                                            <div class="font-bold text-slate-900 text-sm font-['Agrandir',sans-serif] mt-0.5" x-text="item.line_total_formatted"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                    <!-- Pinned Footer: Solid Action Buttons -->
                    <div class="px-6 sm:px-7 py-3.5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 shrink-0 bg-white">
                        <div class="flex items-center gap-2">
                            <!-- Download PDF Quote -->
                            <a :href="selectedOrder?.quote_pdf_url" target="_blank"
                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold text-xs font-['Agrandir',sans-serif] border border-purple-200 transition">
                                <i class="fa-solid fa-file-pdf"></i> Unduh Sales Quote PDF
                            </a>

                            <!-- Download PO File if available -->
                            <template x-if="selectedOrder?.has_po_file">
                                <a :href="selectedOrder?.po_file_url" target="_blank"
                                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 font-bold text-xs font-['Agrandir',sans-serif] border border-amber-200 transition">
                                    <i class="fa-solid fa-file-lines"></i> Dokumen PO
                                </a>
                            </template>
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- Chat WA Button -->
                            <a :href="getWhatsAppUrl(selectedOrder)" target="_blank" rel="noopener noreferrer"
                               @click="logWhatsAppInteraction(selectedOrder)"
                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-md shadow-emerald-600/20 transition cursor-pointer active:scale-95"
                               title="Buka WhatsApp langsung ke nomor pelanggan">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Hubungi via WhatsApp</span>
                            </a>

                            <!-- Close Button -->
                            <button type="button" @click="detailModalOpen = false" 
                                    class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endsection
