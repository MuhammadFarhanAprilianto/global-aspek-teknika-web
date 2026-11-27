@extends('components.layouts.admin')

@section('title', 'Pesan Masuk Contact Us')

@section('content')
@php
    $statusOptions = [
        'all' => ['label' => 'Semua Status', 'dot' => 'bg-blue-400'],
        'unread' => ['label' => 'Baru', 'dot' => 'bg-rose-500'],
        'read' => ['label' => 'Dibaca', 'dot' => 'bg-slate-400'],
        'contacted' => ['label' => 'Dihubungi', 'dot' => 'bg-emerald-500'],
    ];
    $activeStatus = $statusOptions[$status] ?? $statusOptions['all'];
    $isContactFiltered = ($status !== 'all' && !empty($status)) || !empty($search);
    $messagesList = $messagesList ?? $messages->getCollection()->map(fn ($m) => \App\Http\Controllers\Admin\ContactAdminController::transformMessage($m))->values();
@endphp

<div class="space-y-6" x-data="{
    detailModalOpen: false,
    selectedMsg: null,
    messagesList: @js($messagesList),
    stats: {
        total_messages: {{ (int) $totalMessages }},
        unread_messages: {{ (int) $unreadMessages }},
        contacted_messages: {{ (int) $contactedMessages }}
    },
    isFirstPage: {{ $messages->currentPage() === 1 ? 'true' : 'false' }},
    contactsPollTimer: null,
    statusMenuMsg: null,
    statusMenuTop: 0,
    statusMenuBottom: 0,
    statusMenuLeft: 0,
    statusMenuUp: false,
    statusTriggerEl: null,
    openStatusMenu(msg, btnEl) {
        if (this.statusMenuMsg && this.statusMenuMsg.id === msg.id) {
            this.statusMenuMsg = null;
            return;
        }
        const rect = btnEl.getBoundingClientRect();
        const spaceBelow = window.innerHeight - rect.bottom;
        this.statusMenuUp = spaceBelow < 165 && rect.top > 165;
        this.statusMenuTop = rect.bottom + 6;
        this.statusMenuBottom = window.innerHeight - rect.top + 6;
        this.statusMenuLeft = Math.max(8, Math.min(window.innerWidth - 172, rect.left));
        this.statusTriggerEl = btnEl;
        this.statusMenuMsg = msg;
    },
    openDetail(id) {
        this.selectedMsg = this.messagesList.find(m => m.id === id) || null;
        if (this.selectedMsg) {
            this.detailModalOpen = true;
        }
    },
    syncMessages() {
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
            if (Array.isArray(data.messages)) {
                if (this.isFirstPage) {
                    this.messagesList = data.messages;
                } else {
                    const byId = Object.fromEntries(data.messages.map(m => [m.id, m]));
                    this.messagesList = this.messagesList.map(m => byId[m.id] || m);
                }
                if (this.selectedMsg) {
                    const updated = this.messagesList.find(m => m.id === this.selectedMsg.id);
                    if (updated) this.selectedMsg = updated;
                }
                if (this.statusMenuMsg) {
                    const updatedMenu = this.messagesList.find(m => m.id === this.statusMenuMsg.id);
                    if (updatedMenu) this.statusMenuMsg = updatedMenu;
                }
            }
            if (data.stats) this.stats = data.stats;
        }).catch(() => {});
    },
    init() {
        this.contactsPollTimer = setInterval(() => {
            if (!document.hidden) this.syncMessages();
        }, 8000);
        try {
            if (typeof BroadcastChannel !== 'undefined') {
                const ch = new BroadcastChannel('gat_cms_sync');
                ch.onmessage = (ev) => {
                    if (ev?.data?.type === 'public_submission') {
                        this.syncMessages();
                    }
                };
            }
        } catch (e) {}
    },
    markContactedAsync(id) {
        fetch(`{{ url('admin/contacts') }}/${id}/contacted`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        }).then(r => r.json()).then(res => {
            if (res.success) {
                const target = this.messagesList.find(m => m.id === id);
                if (target) target.status = 'contacted';
                if (this.selectedMsg && this.selectedMsg.id === id) {
                    this.selectedMsg.status = 'contacted';
                }
                this.syncMessages();
            }
        }).catch(() => {});
    },
    getStatusLabel(st) {
        if (st === 'unread') return 'Baru';
        if (st === 'contacted') return 'Dihubungi';
        return 'Dibaca';
    }
}">

    <!-- Flash Notifications -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition
             class="flex items-center justify-between p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold shadow-2xs">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" @click="show = false" class="text-emerald-500 hover:text-emerald-700 cursor-pointer p-1">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if (isset($errors) && $errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition
             class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs shadow-2xs">
            <div class="flex items-center justify-between mb-1.5 font-bold">
                <div class="flex items-center gap-2 text-rose-700">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Terdapat kesalahan pada input data:</span>
                </div>
                <button type="button" @click="show = false" class="text-rose-500 hover:text-rose-700 cursor-pointer p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-rose-600 pl-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top Action & Stat Bar (Standardized Centered Layout + Clickable Stat Filters) -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4.5 rounded-[24px] border border-[#3367A5]/15 shadow-sm min-h-[76px]">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-lg shrink-0 shadow-2xs">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none flex items-center">
                Kotak Masuk Formulir Kontak
            </h2>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 shrink-0">
            <a href="{{ route('admin.contacts.index') }}"
               class="h-11 px-4 rounded-2xl bg-[#f8fafd] hover:bg-slate-100 border {{ $status === 'all' && empty($search) ? 'border-[#3367A5]/40 ring-2 ring-[#3367A5]/10' : 'border-slate-200/80' }} inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[92px] transition"
               title="Tampilkan semua pesan">
                <span class="text-[10px] text-slate-400 font-semibold font-['Questrial',sans-serif] leading-tight block">Total Pesan</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight block mt-0.5" x-text="stats.total_messages">{{ $totalMessages }}</span>
            </a>
            <a href="{{ route('admin.contacts.index', ['status' => 'unread']) }}"
               class="h-11 px-4 rounded-2xl bg-rose-50 hover:bg-rose-100/80 border {{ $status === 'unread' ? 'border-rose-400 ring-2 ring-rose-500/15' : 'border-rose-200/80' }} inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[92px] transition"
               title="Filter pesan belum dibaca">
                <span class="text-[10px] text-rose-600 font-semibold font-['Questrial',sans-serif] leading-tight block">Belum Dibaca</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-rose-600 leading-tight block mt-0.5" x-text="stats.unread_messages">{{ $unreadMessages }}</span>
            </a>
            <a href="{{ route('admin.contacts.index', ['status' => 'contacted']) }}"
               class="hidden md:inline-flex h-11 px-4 rounded-2xl bg-emerald-50 hover:bg-emerald-100/80 border {{ $status === 'contacted' ? 'border-emerald-400 ring-2 ring-emerald-500/15' : 'border-emerald-200/80' }} flex-col items-center justify-center text-center shadow-2xs min-w-[92px] transition"
               title="Filter pesan yang sudah dihubungi">
                <span class="text-[10px] text-emerald-700 font-semibold font-['Questrial',sans-serif] leading-tight block">Dihubungi</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-emerald-700 leading-tight block mt-0.5" x-text="stats.contacted_messages">{{ $contactedMessages }}</span>
            </a>

            @if ($unreadMessages > 0)
                <form method="POST" action="{{ route('admin.contacts.mark-all-read') }}" class="inline-flex m-0 p-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="h-11 px-4 inline-flex items-center justify-center gap-1.5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95 leading-none"
                            title="Tandai semua pesan baru menjadi Dibaca">
                        <i class="fa-solid fa-check-double text-xs"></i>
                        <span class="hidden sm:inline">Tandai Semua Dibaca</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 text-xs">
        <form id="contactsFilterForm" method="GET" action="{{ route('admin.contacts.index') }}" class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
            <input type="hidden" name="status" id="filterContactStatusInput" value="{{ $status }}">

            <!-- Search Input -->
            <div class="relative w-full sm:w-auto">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, PT, email, HP, topik..."
                       class="pl-8 pr-8 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-700 outline-none focus:border-[#3367A5] w-full sm:w-64 text-xs font-['Questrial',sans-serif] transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400"></i>
                @if (!empty($search))
                    <button type="button" onclick="document.querySelector('#contactsFilterForm input[name=search]').value=''; document.getElementById('contactsFilterForm').submit()"
                            class="absolute right-2.5 top-2 text-slate-400 hover:text-slate-600 cursor-pointer" title="Hapus pencarian">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                @endif
            </div>

            <!-- Custom Dropdown: Status Pesan -->
            <div class="relative" x-data="{ openSt: false }">
                <button type="button" @click="openSt = !openSt"
                    class="inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer min-w-[160px] {{ ($status !== 'all' && !empty($status)) ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                    <div class="flex items-center gap-2 truncate">
                        <span class="w-2 h-2 rounded-full {{ $activeStatus['dot'] }} shrink-0"></span>
                        <span class="truncate">{{ $activeStatus['label'] }}</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200"
                        :class="{ 'rotate-180': openSt }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-cloak x-show="openSt" @click.outside="openSt = false"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                    class="absolute left-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">

                    <div class="py-1">
                        @foreach ($statusOptions as $key => $opt)
                            <button type="button"
                                @click="document.getElementById('filterContactStatusInput').value = '{{ $key }}'; document.getElementById('contactsFilterForm').submit()"
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

            <button type="submit"
                    class="px-4 py-2 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold font-['Agrandir',sans-serif] transition shadow-xs cursor-pointer active:scale-95">
                Terapkan
            </button>

            @if ($isContactFiltered)
                <a href="{{ route('admin.contacts.index') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-rose-600 hover:bg-rose-50 font-semibold transition">
                    <i class="fa-solid fa-rotate-left text-[11px]"></i>
                    <span>Reset</span>
                </a>
            @endif
        </form>

        <!-- Export Excel Button (respects active filters) -->
        <a href="{{ route('admin.contacts.export', request()->only(['status', 'search'])) }}"
           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-200/90 hover:border-emerald-600 font-['Agrandir',sans-serif] text-xs font-bold transition shadow-2xs shrink-0"
           title="Unduh rekap Contact Inquiries dalam format Excel (.xlsx) bertabel rapi">
            <i class="fa-solid fa-file-excel text-xs"></i>
            <span>Export Excel</span>
        </a>
    </div>

    <!-- Messages Table Card -->
    <div class="bg-white rounded-[24px] border border-[#3367A5]/15 shadow-sm overflow-hidden">
        <div class="overflow-x-auto admin-table-scroll">
            <table class="w-full min-w-[780px] text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-[#f8fafd] border-b border-slate-100 text-[10.5px] uppercase tracking-wider text-slate-500 font-['Agrandir',sans-serif]">
                        <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Waktu</th>
                        <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Pengirim &amp; Perusahaan</th>
                        <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Layanan / Topik</th>
                        <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Isi Pesan</th>
                        <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Status</th>
                        <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700"
                       @scroll.window="statusMenuMsg = null"
                       @resize.window="statusMenuMsg = null">
                    <template x-for="msg in messagesList" :key="msg.id">
                        <tr class="hover:bg-[#f8fafd]/80 transition duration-150"
                            :class="msg.status === 'unread' ? 'bg-blue-50/15' : ''">
                            <!-- Waktu -->
                            <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap align-middle">
                                <div class="font-bold text-slate-800 font-['Agrandir',sans-serif] text-xs" x-text="msg.date_formatted"></div>
                                <div class="text-[11px] text-slate-400 font-['Questrial',sans-serif] flex items-center gap-1 mt-0.5">
                                    <i class="fa-regular fa-clock text-[10px] text-slate-300"></i>
                                    <span x-text="msg.time_formatted"></span>
                                </div>
                            </td>

                            <!-- Pengirim & Perusahaan -->
                            <td class="py-3.5 px-2.5 xl:px-3.5 align-middle max-w-[210px]">
                                <button type="button" @click="openDetail(msg.id)"
                                        class="font-bold text-slate-900 hover:text-[#3367A5] font-['Agrandir',sans-serif] text-xs text-left cursor-pointer transition truncate block max-w-full"
                                        x-text="msg.name"></button>
                                <div class="text-[11px] text-[#3367A5] font-semibold mt-0.5 truncate" x-text="msg.company"></div>
                                <div class="flex flex-wrap items-center gap-x-2 gap-y-0.5 mt-1 text-[11px] font-['Questrial',sans-serif]">
                                    <template x-if="msg.email">
                                        <a :href="msg.mailto_url"
                                           class="text-slate-400 hover:text-[#3367A5] hover:underline inline-flex items-center gap-1 transition truncate max-w-[160px]"
                                           :title="'Kirim email ke ' + msg.email">
                                            <i class="fa-regular fa-envelope text-[10px] shrink-0"></i>
                                            <span class="font-mono text-[10px] truncate" x-text="msg.email"></span>
                                        </a>
                                    </template>
                                    <template x-if="msg.wa_url">
                                        <a :href="msg.wa_url" target="_blank" rel="noopener noreferrer"
                                           @click="markContactedAsync(msg.id)"
                                           class="text-slate-500 hover:text-emerald-600 hover:underline inline-flex items-center gap-1 transition"
                                           :title="'Chat WhatsApp langsung ke ' + msg.phone">
                                            <i class="fa-brands fa-whatsapp text-emerald-500 text-xs"></i>
                                            <span class="font-mono text-[10px]" x-text="msg.phone"></span>
                                        </a>
                                    </template>
                                </div>
                            </td>

                            <!-- Layanan / Topik -->
                            <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap align-middle">
                                <span class="h-6 px-2.5 inline-flex items-center justify-center rounded-lg text-[10px] font-bold font-['Agrandir',sans-serif] bg-slate-100 text-slate-700 leading-none"
                                      x-text="msg.service"></span>
                            </td>

                            <!-- Isi Pesan -->
                            <td class="py-3.5 px-2.5 xl:px-3.5 max-w-[190px] align-middle">
                                <button type="button" @click="openDetail(msg.id)"
                                        class="text-left text-[11px] text-slate-600 hover:text-slate-900 leading-relaxed line-clamp-2 cursor-pointer transition"
                                        title="Klik untuk membaca pesan selengkapnya"
                                        x-text="msg.message"></button>
                            </td>

                            <!-- Status Pill -->
                            <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap align-middle">
                                <button type="button"
                                    @click.stop="openStatusMenu(msg, $el)"
                                    class="h-7 px-3 inline-flex items-center justify-center gap-1.5 rounded-lg text-[11px] font-bold font-['Agrandir',sans-serif] border transition cursor-pointer shadow-2xs active:scale-95 leading-none"
                                    :class="msg.status === 'unread' ? 'bg-rose-50 text-rose-700 border-rose-200 hover:bg-rose-100' : (msg.status === 'contacted' ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-slate-100 text-slate-700 border-slate-200 hover:bg-slate-200/70')">
                                    <span x-text="getStatusLabel(msg.status)"></span>
                                    <svg class="w-3 h-3 transition-transform duration-200" :class="{ 'rotate-180': statusMenuMsg && statusMenuMsg.id === msg.id }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </td>

                            <!-- Aksi -->
                            <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap text-right align-middle">
                                <div class="inline-flex items-center gap-1">
                                    <button type="button" @click="openDetail(msg.id)"
                                            class="h-8 px-2.5 inline-flex items-center justify-center gap-1 rounded-xl bg-blue-50 hover:bg-blue-100 text-[#3367A5] font-bold text-[11px] font-['Agrandir',sans-serif] transition cursor-pointer leading-none"
                                            title="Baca detail pesan lengkap">
                                        <i class="fa-solid fa-eye text-[11px]"></i>
                                        <span>Detail</span>
                                    </button>

                                    <template x-if="msg.wa_url">
                                        <a :href="msg.wa_url" target="_blank" rel="noopener noreferrer"
                                           @click="markContactedAsync(msg.id)"
                                           class="h-8 px-2.5 inline-flex items-center justify-center gap-1 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] font-['Agrandir',sans-serif] shadow-2xs transition cursor-pointer leading-none"
                                           title="Langsung balas via WhatsApp &amp; ubah status menjadi Dihubungi">
                                            <i class="fa-brands fa-whatsapp text-xs"></i>
                                            <span>Balas WA</span>
                                        </a>
                                    </template>

                                    <template x-if="msg.mailto_url">
                                        <a :href="msg.mailto_url"
                                           @click="markContactedAsync(msg.id)"
                                           class="w-8 h-8 inline-flex items-center justify-center rounded-xl text-slate-500 hover:text-[#3367A5] hover:bg-blue-50 transition"
                                           title="Balas via Email">
                                            <i class="fa-regular fa-envelope text-xs"></i>
                                        </a>
                                    </template>

                                    <form method="POST" :action="msg.destroy_url" class="inline-flex m-0 p-0"
                                          @submit="if (!confirm('Apakah Anda yakin ingin menghapus pesan dari ' + msg.name + '?')) $event.preventDefault()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 inline-flex items-center justify-center rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition cursor-pointer"
                                                title="Hapus Pesan">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <template x-if="messagesList.length === 0">
                        <tr>
                            <td colspan="6" class="py-16 text-center text-slate-400 font-['Questrial',sans-serif]">
                                <i class="fa-solid fa-envelope-open text-3xl mb-2 text-slate-300 block"></i>
                                <p class="font-['Agrandir',sans-serif] font-bold text-slate-700 text-sm">Tidak ada pesan ditemukan</p>
                                <p class="text-xs text-slate-400 mt-1">Belum ada pesan formulir kontak atau coba reset filter pencarian.</p>
                                @if ($isContactFiltered)
                                    <div class="mt-4">
                                        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-50 text-[#3367A5] font-bold text-xs font-['Agrandir',sans-serif] hover:bg-blue-100 transition">
                                            <i class="fa-solid fa-rotate-left"></i> Reset Filter
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <template x-teleport="body">
            <div x-cloak x-show="statusMenuMsg !== null"
                @click.outside="if (!statusTriggerEl || !statusTriggerEl.contains($event.target)) statusMenuMsg = null"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :style="statusMenuUp ? `position: fixed; left: ${statusMenuLeft}px; bottom: ${statusMenuBottom}px;` : `position: fixed; left: ${statusMenuLeft}px; top: ${statusMenuTop}px;`"
                class="w-40 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-[9990] overflow-hidden">
                <form id="sharedContactStatusForm" method="POST" :action="statusMenuMsg ? statusMenuMsg.status_url : '#'" class="m-0">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" id="sharedContactStatusInput" value="">
                    @foreach (['unread' => 'Baru', 'read' => 'Dibaca', 'contacted' => 'Dihubungi'] as $stKey => $stLabel)
                        <button type="button"
                            @click="document.getElementById('sharedContactStatusInput').value = '{{ $stKey }}'; document.getElementById('sharedContactStatusForm').submit()"
                            :class="statusMenuMsg?.status === '{{ $stKey }}' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'"
                            class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer">
                            <span>{{ $stLabel }}</span>
                            <i x-show="statusMenuMsg?.status === '{{ $stKey }}'" class="fa-solid fa-check text-[#3367A5] text-[10px]"></i>
                        </button>
                    @endforeach
                </form>
            </div>
        </template>

        @if ($messages->hasPages())
            <div class="px-5 py-3.5 border-t border-slate-100">
                {{ $messages->links() }}
            </div>
        @endif
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL: DETAIL PESAN KONTAK (Smooth Scroll, Pinned Header & Footer)        -->
    <!-- ========================================================================= -->
    <template x-teleport="body">
        <div x-cloak x-show="detailModalOpen"
             class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center p-3 sm:p-4 md:p-6 bg-slate-900/60 backdrop-blur-xs overflow-hidden"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-[28px] max-w-xl w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[90vh] overflow-hidden my-auto"
                 @click.outside="detailModalOpen = false">

                <!-- Pinned Header -->
                <div class="px-6 sm:px-7 pt-5 pb-3.5 border-b border-slate-100 flex items-center justify-between gap-3 shrink-0 bg-white">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold shrink-0">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 truncate" x-text="selectedMsg?.name"></h3>
                                <span class="h-5 px-2 inline-flex items-center justify-center rounded-md text-[10px] font-bold font-['Agrandir',sans-serif] leading-none"
                                      :class="selectedMsg?.status === 'unread' ? 'bg-rose-50 text-rose-700 border border-rose-200' : (selectedMsg?.status === 'contacted' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-700')"
                                      x-text="getStatusLabel(selectedMsg?.status)">
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-400 font-['Questrial',sans-serif]" x-text="'Diterima pada ' + (selectedMsg?.created_at_formatted || '')"></p>
                        </div>
                    </div>
                    <button type="button" @click="detailModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Smooth Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 sm:px-7 py-5 space-y-4 text-xs overscroll-contain"
                     style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">

                    <!-- Sender Profile Card -->
                    <div class="bg-[#f8fafd] rounded-2xl p-4 border border-slate-200/80 grid grid-cols-1 sm:grid-cols-2 gap-3 font-['Questrial',sans-serif]">
                        <div>
                            <span class="text-slate-400 text-[10px] block">Perusahaan / Instansi:</span>
                            <span class="font-bold text-slate-900" x-text="selectedMsg?.company"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[10px] block">Layanan / Topik:</span>
                            <span class="font-semibold text-[#3367A5]" x-text="selectedMsg?.service"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[10px] block">Email:</span>
                            <a :href="selectedMsg?.mailto_url" class="font-mono text-slate-700 hover:text-[#3367A5] hover:underline break-all" x-text="selectedMsg?.email || '-'"></a>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[10px] block">WhatsApp / Telepon:</span>
                            <template x-if="selectedMsg?.wa_url">
                                <a :href="selectedMsg?.wa_url" target="_blank" rel="noopener noreferrer"
                                   @click="markContactedAsync(selectedMsg.id)"
                                   class="font-mono text-emerald-600 hover:text-emerald-700 hover:underline font-semibold inline-flex items-center gap-1">
                                    <i class="fa-brands fa-whatsapp text-xs"></i>
                                    <span x-text="selectedMsg?.phone"></span>
                                </a>
                            </template>
                            <template x-if="!selectedMsg?.wa_url">
                                <span class="text-slate-400">-</span>
                            </template>
                        </div>
                    </div>

                    <!-- Full Message Body -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/90 space-y-2">
                        <span class="font-bold text-xs font-['Agrandir',sans-serif] text-slate-800 block">Isi Pesan Lengkap:</span>
                        <p class="text-xs text-slate-700 font-['Questrial',sans-serif] leading-relaxed whitespace-pre-line" x-text="selectedMsg?.message"></p>
                    </div>
                </div>

                <!-- Pinned Footer -->
                <div class="px-6 sm:px-7 py-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2.5 shrink-0 bg-white">
                    <div class="flex items-center gap-2">
                        <template x-if="selectedMsg?.mailto_url">
                            <a :href="selectedMsg?.mailto_url" @click="markContactedAsync(selectedMsg.id)"
                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-50 hover:bg-blue-100 text-[#3367A5] font-bold text-xs font-['Agrandir',sans-serif] border border-blue-200 transition">
                                <i class="fa-regular fa-envelope"></i> Balas Email
                            </a>
                        </template>
                    </div>

                    <div class="flex items-center gap-2">
                        <template x-if="selectedMsg?.wa_url">
                            <a :href="selectedMsg?.wa_url" target="_blank" rel="noopener noreferrer"
                               @click="markContactedAsync(selectedMsg.id)"
                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-md shadow-emerald-600/20 transition cursor-pointer active:scale-95">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Balas via WhatsApp</span>
                            </a>
                        </template>
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
