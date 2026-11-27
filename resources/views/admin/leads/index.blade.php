@extends('components.layouts.admin')

@section('title', 'Simulator Leads')

@section('content')
    @php
        $domainOptions = [
            'all' => [
                'label' => 'Semua Domain Mesin',
                'icon' => 'fa-solid fa-shapes',
                'color' => 'text-slate-400',
            ],
            'manufacturing' => [
                'label' => 'Manufacturing & FMCG',
                'icon' => 'fa-solid fa-industry',
                'color' => 'text-[#3367A5]',
            ],
            'automotive' => [
                'label' => 'Automotive Assembly',
                'icon' => 'fa-solid fa-car',
                'color' => 'text-[#3367A5]',
            ],
            'pharma' => [
                'label' => 'Pharma & Vision',
                'icon' => 'fa-solid fa-pills',
                'color' => 'text-emerald-600',
            ],
            'bms' => [
                'label' => 'BMS & Telemetri',
                'icon' => 'fa-solid fa-building-circle-check',
                'color' => 'text-cyan-600',
            ],
            'logistics' => [
                'label' => 'Logistics & Conveyor',
                'icon' => 'fa-solid fa-truck-ramp-box',
                'color' => 'text-indigo-600',
            ],
            'enpi' => [
                'label' => 'EnPI Energy SCADA',
                'icon' => 'fa-solid fa-bolt',
                'color' => 'text-amber-500',
            ],
        ];

        $statusOptions = [
            'all' => [
                'label' => 'Semua Status',
                'dot' => 'bg-slate-400',
            ],
            'new' => [
                'label' => 'Baru (New)',
                'dot' => 'bg-amber-500',
            ],
            'contacted' => [
                'label' => 'Sudah Dihubungi',
                'dot' => 'bg-[#3367A5]',
            ],
            'closed' => [
                'label' => 'Closed / PO',
                'dot' => 'bg-emerald-500',
            ],
        ];

        $activeDomain = $domainOptions[$domain] ?? $domainOptions['all'];
        $activeStatus = $statusOptions[$status] ?? $statusOptions['all'];
        $search = $search ?? '';
        $isFiltered = $domain !== 'all' || $status !== 'all' || !empty($search);
        $leadsJson = $leadsJson ?? $leads->getCollection()->map(fn ($l) => \App\Http\Controllers\Admin\SimulationLeadController::transformLead($l))->values();
    @endphp

    <div class="space-y-6" x-data="{
        leadsData: {{ json_encode($leadsJson) }},
        stats: {
            total_leads: {{ (int) $totalLeads }},
            new_leads: {{ (int) $newLeads }}
        },
        isFirstPage: {{ $leads->currentPage() === 1 ? 'true' : 'false' }},
        leadsPollTimer: null,
        statusMenuLead: null,
        statusMenuTop: 0,
        statusMenuBottom: 0,
        statusMenuLeft: 0,
        statusMenuUp: false,
        statusTriggerEl: null,
        openStatusMenu(lead, btnEl) {
            if (this.statusMenuLead && this.statusMenuLead.id === lead.id) {
                this.statusMenuLead = null;
                return;
            }
            const rect = btnEl.getBoundingClientRect();
            const spaceBelow = window.innerHeight - rect.bottom;
            this.statusMenuUp = spaceBelow < 190 && rect.top > 190;
            this.statusMenuTop = rect.bottom + 6;
            this.statusMenuBottom = window.innerHeight - rect.top + 6;
            this.statusMenuLeft = Math.max(8, Math.min(window.innerWidth - 216, rect.left));
            this.statusTriggerEl = btnEl;
            this.statusMenuLead = lead;
        },
        syncLeads() {
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
                if (Array.isArray(data.leads)) {
                    if (this.isFirstPage) {
                        this.leadsData = data.leads;
                    } else {
                        const byId = Object.fromEntries(data.leads.map(l => [l.id, l]));
                        this.leadsData = this.leadsData.map(l => byId[l.id] || l);
                    }
                    if (this.statusMenuLead) {
                        const updated = data.leads.find(l => l.id === this.statusMenuLead.id);
                        if (updated) this.statusMenuLead = updated;
                    }
                }
                if (data.stats) this.stats = data.stats;
            }).catch(() => {});
        },
        init() {
            this.leadsPollTimer = setInterval(() => {
                if (!document.hidden) this.syncLeads();
            }, 8000);
            try {
                if (typeof BroadcastChannel !== 'undefined') {
                    const ch = new BroadcastChannel('gat_cms_sync');
                    ch.onmessage = (ev) => {
                        if (ev?.data?.type === 'public_submission') {
                            this.syncLeads();
                        }
                    };
                }
            } catch (e) {}
        }
    }">

        <!-- Top Action & Stat Bar -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4.5 rounded-[24px] border border-[#3367A5]/15 shadow-sm min-h-[76px]">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-lg shrink-0 shadow-2xs">
                    <i class="fa-solid fa-users-viewfinder"></i>
                </div>
                <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none flex items-center">
                    Simulator Leads &amp; Inquiries
                </h2>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <div class="h-11 px-4 rounded-2xl bg-[#f8fafd] border border-slate-200/80 inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[96px]">
                    <span class="text-[10px] text-slate-400 font-semibold font-['Questrial',sans-serif] leading-tight block">Total Prospek</span>
                    <span class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight block mt-0.5" x-text="stats.total_leads">{{ $totalLeads }}</span>
                </div>
                <div class="h-11 px-4 rounded-2xl bg-blue-50 border border-blue-100 inline-flex flex-col items-center justify-center text-center shadow-2xs min-w-[96px]">
                    <span class="text-[10px] text-[#3367A5] font-semibold font-['Questrial',sans-serif] leading-tight block">Prospek Baru</span>
                    <span class="text-sm font-bold font-['Agrandir',sans-serif] text-[#3367A5] leading-tight block mt-0.5" x-text="stats.new_leads">{{ $newLeads }}</span>
                </div>
            </div>
        </div>

        <!-- Filter Bar with Corporate Custom Dropdowns -->
        <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 text-xs">
            <form id="leadsFilterForm" method="GET" action="{{ route('admin.leads.index') }}"
                class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <input type="hidden" name="domain" id="filterDomainInput" value="{{ $domain }}">
                <input type="hidden" name="status" id="filterStatusInput" value="{{ $status }}">

                <!-- Search Input -->
                <div class="relative w-full sm:w-auto">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama PIC, PT, email, WA..."
                           class="pl-8 pr-8 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-700 outline-none focus:border-[#3367A5] w-full sm:w-64 text-xs font-['Questrial',sans-serif] transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400"></i>
                    @if (!empty($search))
                        <button type="button" onclick="document.querySelector('#leadsFilterForm input[name=search]').value=''; document.getElementById('leadsFilterForm').submit()"
                                class="absolute right-2.5 top-2 text-slate-400 hover:text-slate-600 cursor-pointer" title="Hapus pencarian">
                            <i class="fa-solid fa-xmark text-xs"></i>
                        </button>
                    @endif
                </div>

                <!-- Custom Dropdown: Domain Mesin -->
                <div class="relative w-full sm:w-auto" x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                        class="w-full sm:w-auto inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer sm:min-w-[210px] {{ $domain !== 'all' ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                        <div class="flex items-center gap-2 truncate">
                            <i class="{{ $activeDomain['icon'] }} {{ $activeDomain['color'] }} text-xs shrink-0"></i>
                            <span class="truncate">{{ $activeDomain['label'] }}</span>
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
                        class="absolute left-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">
                        
                        <div class="max-h-64 overflow-y-auto py-1">
                            @foreach ($domainOptions as $key => $opt)
                                <button type="button"
                                    @click="document.getElementById('filterDomainInput').value = '{{ $key }}'; document.getElementById('leadsFilterForm').submit()"
                                    class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $domain === $key ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                    <div class="flex items-center gap-2.5 truncate">
                                        <i class="{{ $opt['icon'] }} {{ $opt['color'] }} text-xs w-4 text-center shrink-0"></i>
                                        <span class="font-['Questrial',sans-serif] truncate {{ $domain === $key ? 'font-bold text-[#3367A5]' : '' }}">{{ $opt['label'] }}</span>
                                    </div>
                                    @if ($domain === $key)
                                        <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Custom Dropdown: Status Prospek -->
                <div class="relative w-full sm:w-auto" x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                        class="w-full sm:w-auto inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer sm:min-w-[160px] {{ $status !== 'all' ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                        <div class="flex items-center gap-2 truncate">
                            <span class="w-2 h-2 rounded-full {{ $activeStatus['dot'] }} shrink-0"></span>
                            <span class="truncate">{{ $activeStatus['label'] }}</span>
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
                        class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">
                        
                        <div class="py-1">
                            @foreach ($statusOptions as $key => $opt)
                                <button type="button"
                                    @click="document.getElementById('filterStatusInput').value = '{{ $key }}'; document.getElementById('leadsFilterForm').submit()"
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
                @if ($isFiltered)
                    <a href="{{ route('admin.leads.index') }}"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-['Agrandir',sans-serif] text-xs font-semibold border border-rose-200/70 transition shadow-2xs"
                        title="Reset semua filter">
                        <i class="fa-solid fa-rotate-left text-[11px]"></i>
                        <span>Reset Filter</span>
                    </a>
                @endif
            </form>

            <!-- Export Excel Button (respects active filters) -->
            <a href="{{ route('admin.leads.export', request()->only(['domain', 'status', 'search'])) }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-200/90 hover:border-emerald-600 font-['Agrandir',sans-serif] text-xs font-bold transition shadow-2xs shrink-0"
               title="Unduh rekap Simulator Leads dalam format Excel (.xlsx) bertabel rapi">
                <i class="fa-solid fa-file-excel text-xs"></i>
                <span>Export Excel</span>
            </a>
        </div>

        <!-- Leads Table Card -->
        <div class="bg-white rounded-[24px] border border-[#3367A5]/15 shadow-sm overflow-hidden">
            <div class="overflow-x-auto admin-table-scroll">
                <table class="w-full min-w-[860px] text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-[#f8fafd] border-b border-slate-100 text-slate-500 font-['Agrandir',sans-serif] text-[10.5px] uppercase tracking-wider">
                            <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Tanggal</th>
                            <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Nama PIC &amp; Perusahaan</th>
                            <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Domain Simulasi</th>
                            <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Kontak WhatsApp / Email</th>
                            <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Catatan / Kebutuhan</th>
                            <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap">Status</th>
                            <th class="py-3.5 px-2.5 xl:px-3.5 font-bold whitespace-nowrap text-right">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700"
                           @scroll.window="statusMenuLead = null"
                           @resize.window="statusMenuLead = null">
                        <template x-for="lead in leadsData" :key="lead.id">
                            <tr class="hover:bg-[#f8fafd]/80 transition duration-150">
                                <!-- Tanggal -->
                                <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap align-middle">
                                    <div class="font-bold text-slate-800 text-xs font-['Agrandir',sans-serif]" x-text="lead.date_formatted"></div>
                                    <div class="text-[11px] text-slate-400 font-['Questrial',sans-serif] flex items-center gap-1 mt-0.5">
                                        <i class="fa-regular fa-clock text-[10px] text-slate-300"></i>
                                        <span x-text="lead.time_formatted"></span>
                                    </div>
                                </td>

                                <!-- Nama PIC, Jabatan & Perusahaan -->
                                <td class="py-3.5 px-2.5 xl:px-3.5 align-middle max-w-[195px]">
                                    <div class="font-bold text-slate-900 font-['Agrandir',sans-serif] text-xs flex items-center gap-1.5 min-w-0">
                                        <span class="truncate" :title="lead.pic_name" x-text="lead.pic_name"></span>
                                        <template x-if="lead.job_title">
                                            <span class="px-1.5 py-0.5 rounded-full text-[9.5px] font-semibold font-['Questrial',sans-serif] bg-slate-100 text-slate-600 shrink-0" x-text="lead.job_title"></span>
                                        </template>
                                    </div>
                                    <div class="text-[11px] text-[#3367A5] font-semibold font-['Questrial',sans-serif] flex items-center gap-1 mt-0.5 min-w-0">
                                        <i class="fa-regular fa-building text-[10px] text-slate-400 shrink-0"></i>
                                        <span class="truncate" :title="lead.company_name" x-text="lead.company_name"></span>
                                    </div>
                                </td>

                                <!-- Domain Simulasi -->
                                <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap align-middle">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-[#3367A5] border border-blue-100 uppercase tracking-wider font-['Agrandir',sans-serif]">
                                        <i :class="[lead.domain_icon, 'text-[10px]', lead.domain_color]"></i>
                                        <span x-text="lead.domain_label"></span>
                                    </span>
                                </td>

                                <!-- Kontak WhatsApp / Email -->
                                <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap align-middle max-w-[175px]">
                                    <div class="font-bold text-slate-800 text-xs flex items-center gap-1.5 font-mono">
                                        <a :href="lead.wa_url"
                                            target="_blank"
                                            class="font-bold text-slate-800 hover:text-emerald-700 text-xs flex items-center gap-1 font-mono group transition"
                                            :title="'Kirim pesan WhatsApp langsung ke ' + lead.pic_name + ' (' + lead.phone + ')'">
                                            <i class="fa-brands fa-whatsapp text-emerald-600 text-sm group-hover:scale-110 transition-transform"></i>
                                            <span x-text="lead.phone"></span>
                                        </a>
                                    </div>
                                    <div class="text-[11px] text-slate-400 font-['Questrial',sans-serif] flex items-center gap-1 mt-0.5 min-w-0">
                                        <i class="fa-regular fa-envelope text-[10px] text-slate-400 shrink-0"></i>
                                        <a :href="'mailto:' + lead.email" class="hover:text-[#3367A5] transition truncate" :title="lead.email" x-text="lead.email"></a>
                                    </div>
                                </td>

                                <!-- Catatan / Kebutuhan -->
                                <td class="py-3.5 px-2.5 xl:px-3.5 align-middle text-slate-600 font-['Questrial',sans-serif] max-w-[175px]">
                                    <template x-if="lead.notes">
                                        <div class="line-clamp-2 text-xs leading-relaxed" :title="lead.notes" x-text="lead.notes"></div>
                                    </template>
                                    <template x-if="!lead.notes">
                                        <span class="text-[11px] text-slate-400 italic font-['Questrial',sans-serif]">Tidak ada catatan</span>
                                    </template>
                                </td>

                                <!-- Status Pill -->
                                <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap align-middle">
                                    <button type="button"
                                        @click.stop="openStatusMenu(lead, $el)"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold font-['Agrandir',sans-serif] border transition cursor-pointer shadow-2xs hover:scale-[1.02] active:scale-95"
                                        :class="lead.status === 'new' ? 'bg-[#fffbeb] text-[#b45309] border-[#fde68a] hover:bg-[#fef3c7] hover:border-[#fcd34d]' : (lead.status === 'contacted' ? 'bg-blue-50 text-[#3367A5] border-blue-200 hover:bg-blue-100/80 hover:border-blue-300' : 'bg-emerald-50 text-emerald-800 border-emerald-200 hover:bg-emerald-100/80 hover:border-emerald-300')">
                                        <span class="w-2 h-2 rounded-full shrink-0"
                                              :class="lead.status === 'new' ? 'bg-amber-500' : (lead.status === 'contacted' ? 'bg-[#3367A5]' : 'bg-emerald-500')"></span>
                                        <span x-text="lead.status === 'new' ? 'New' : (lead.status === 'contacted' ? 'Contacted' : 'Closed')"></span>
                                        <svg class="w-3 h-3 transition-transform duration-200"
                                            :class="[lead.status === 'new' ? 'text-[#b45309]' : (lead.status === 'contacted' ? 'text-[#3367A5]' : 'text-emerald-700'), { 'rotate-180': statusMenuLead && statusMenuLead.id === lead.id }]"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </td>

                                <!-- Aksi Cepat -->
                                <td class="py-3.5 px-2.5 xl:px-3.5 whitespace-nowrap text-right align-middle space-x-1">
                                    <a :href="lead.wa_url" target="_blank"
                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] font-['Agrandir',sans-serif] shadow-xs transition hover:shadow-sm active:scale-95"
                                        :title="'Buka WhatsApp langsung ke nomor ' + lead.phone + ' (' + lead.pic_name + ')'">
                                        <i class="fa-brands fa-whatsapp text-xs"></i>
                                        <span>Hubungi WA</span>
                                    </a>

                                    <form method="POST" :action="lead.destroy_url"
                                        class="inline-block" @submit="if (!confirm('Hapus data prospek ini?')) $event.preventDefault()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-xl hover:bg-rose-50 transition border border-transparent hover:border-rose-100 cursor-pointer"
                                            title="Hapus data prospek">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </template>

                        <template x-if="leadsData.length === 0">
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 font-['Questrial',sans-serif]">
                                    <i class="fa-solid fa-users-slash text-3xl mb-2 text-slate-300 block"></i>
                                    Belum ada prospek simulasi yang tercatat.
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <template x-teleport="body">
                <div x-cloak x-show="statusMenuLead !== null"
                    @click.outside="if (!statusTriggerEl || !statusTriggerEl.contains($event.target)) statusMenuLead = null"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    :style="statusMenuUp ? `position: fixed; left: ${statusMenuLeft}px; bottom: ${statusMenuBottom}px;` : `position: fixed; left: ${statusMenuLeft}px; top: ${statusMenuTop}px;`"
                    class="w-52 bg-white rounded-2xl shadow-2xl border border-slate-200/90 py-1.5 z-[9990] text-slate-700 font-['Questrial',sans-serif] overflow-hidden">

                    <form id="sharedLeadStatusForm" method="POST" :action="statusMenuLead ? statusMenuLead.status_url : '#'">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" id="sharedLeadStatusInput" value="">

                        <button type="button"
                            @click="document.getElementById('sharedLeadStatusInput').value = 'new'; document.getElementById('sharedLeadStatusForm').submit()"
                            :class="statusMenuLead?.status === 'new' ? 'bg-amber-50/90 text-amber-900 font-bold' : 'text-slate-700'"
                            class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-amber-50/70 transition cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-amber-500 shrink-0"></span>
                                <div>
                                    <span class="font-['Agrandir',sans-serif] font-bold block leading-none">New</span>
                                    <span class="text-[10px] text-slate-400 font-['Questrial',sans-serif] block mt-0.5">Prospek Baru Masuk</span>
                                </div>
                            </div>
                            <i x-show="statusMenuLead?.status === 'new'" class="fa-solid fa-check text-amber-600 text-xs"></i>
                        </button>

                        <button type="button"
                            @click="document.getElementById('sharedLeadStatusInput').value = 'contacted'; document.getElementById('sharedLeadStatusForm').submit()"
                            :class="statusMenuLead?.status === 'contacted' ? 'bg-blue-50/90 text-[#3367A5] font-bold' : 'text-slate-700'"
                            class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-[#3367A5] shrink-0"></span>
                                <div>
                                    <span class="font-['Agrandir',sans-serif] font-bold block leading-none">Contacted</span>
                                    <span class="text-[10px] text-slate-400 font-['Questrial',sans-serif] block mt-0.5">Sudah Dihubungi PIC</span>
                                </div>
                            </div>
                            <i x-show="statusMenuLead?.status === 'contacted'" class="fa-solid fa-check text-[#3367A5] text-xs"></i>
                        </button>

                        <button type="button"
                            @click="document.getElementById('sharedLeadStatusInput').value = 'closed'; document.getElementById('sharedLeadStatusForm').submit()"
                            :class="statusMenuLead?.status === 'closed' ? 'bg-emerald-50/90 text-emerald-800 font-bold' : 'text-slate-700'"
                            class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-emerald-50/70 transition cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                                <div>
                                    <span class="font-['Agrandir',sans-serif] font-bold block leading-none">Closed</span>
                                    <span class="text-[10px] text-slate-400 font-['Questrial',sans-serif] block mt-0.5">Deal / PO Terbit</span>
                                </div>
                            </div>
                            <i x-show="statusMenuLead?.status === 'closed'" class="fa-solid fa-check text-emerald-600 text-xs"></i>
                        </button>
                    </form>
                </div>
            </template>

            @if ($leads->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $leads->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
