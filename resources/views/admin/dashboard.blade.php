@extends('components.layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div x-data="dashboardApp()" class="w-full">
        @if (!empty($isEphemeralSqlite))
            <div class="mb-4 rounded-2xl border border-amber-200 bg-amber-50/90 px-4 py-3 text-xs text-amber-950 flex flex-col sm:flex-row sm:items-center justify-between gap-2 shadow-2xs">
                <div class="flex items-start sm:items-center gap-2.5">
                    <i class="fa-solid fa-database text-amber-600 text-sm mt-0.5 sm:mt-0 shrink-0"></i>
                    <div>
                        <span class="font-bold font-['Agrandir',sans-serif]">Mode Penyimpanan Sementara Vercel (`/tmp/database.sqlite`):</span>
                        <span class="text-amber-900">Belum ada Database Cloud permanen yang terhubung di Environment Variables Vercel, sehingga visitor, order, leads, &amp; pesan kontak bisa ter-reset saat deploy/pindah kontainer. Hubungkan MySQL/PostgreSQL Cloud (`DATABASE_URL` atau `DB_HOST`) agar seluruh statistik tersimpan 100% permanen.</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- ============================================================== -->
        <!-- ROW 1: EXECUTIVE KPI STRIP (100% REAL-TIME DATABASE TELEMETRY) -->
        <!-- ============================================================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4 mb-5 items-stretch">

            <!-- 1. Akses Web (Real-Time Dual Wave Spline Chart) -->
            <div class="col-span-1 md:col-span-2 lg:col-span-4 bg-white rounded-[24px] p-5 border border-[#3367A5]/15 shadow-sm hover:shadow-md transition flex flex-col justify-between relative overflow-hidden">
                <div class="flex items-start justify-between relative z-10 mb-1">
                    <div>
                        <span class="text-xs sm:text-sm font-bold text-slate-800 font-['Agrandir',sans-serif] uppercase tracking-wider block">Akses Web</span>
                        <div class="flex items-baseline gap-2.5 mt-1">
                            <h4 class="text-4xl sm:text-5xl font-extrabold font-['Agrandir',sans-serif] text-slate-900 tracking-tight leading-none"
                                x-text="liveVisitorsToday">{{ number_format($totalVisitorsToday ?? 0) }}</h4>
                            <span class="text-sm sm:text-base text-slate-400 font-medium font-['Questrial',sans-serif]">hari ini</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 font-['Questrial',sans-serif] mt-1.5">Total akses: <strong class="text-[#3367A5] font-bold text-sm sm:text-base" x-text="liveVisitorsAll">{{ number_format($totalVisitorsAll ?? 0) }}</strong> kunjungan</p>
                    </div>

                    <button type="button"
                            x-show="panOffset > 0"
                            x-cloak
                            @click="resetToToday()"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#3367A5]/10 border border-[#3367A5]/25 text-xs font-bold text-[#3367A5] hover:bg-[#3367A5] hover:text-white transition cursor-pointer shadow-2xs shrink-0"
                            title="Kembali ke hari ini (Real-time)">
                        <i class="fa-solid fa-clock-rotate-left text-[11px]"></i>
                        <span>Hari Ini</span>
                    </button>
                </div>

                <!-- SVG Spline Line Chart with Mouse Drag (Pan Kiri-Kanan) -->
                <div class="w-full relative mt-3 select-none touch-pan-x min-h-[165px]"
                     @mousedown="startPan($event)"
                     @mousemove.window="onWindowMouseMove($event)"
                     @mouseup.window="onWindowMouseUp()"
                     @touchstart="startTouch($event)"
                     @touchmove="moveTouch($event)"
                     @touchend="onWindowMouseUp()"
                     :class="{ 'cursor-grabbing': isDragging, 'cursor-grab': !isDragging }"
                     title="Geser/drag horizontal untuk melihat riwayat hari sebelumnya">

                    <svg viewBox="0 0 340 160" class="w-full h-auto overflow-visible select-none">
                        <text x="20" y="38" fill="#94a3b8" font-size="11" font-weight="500" text-anchor="end" font-family="'Questrial', sans-serif" x-text="currentYAxis[0]">30</text>
                        <text x="20" y="78" fill="#94a3b8" font-size="11" font-weight="500" text-anchor="end" font-family="'Questrial', sans-serif" x-text="currentYAxis[1]">20</text>
                        <text x="20" y="118" fill="#94a3b8" font-size="11" font-weight="500" text-anchor="end" font-family="'Questrial', sans-serif" x-text="currentYAxis[2]">10</text>

                        <line x1="28" y1="35" x2="325" y2="35" stroke="#f1f5f9" stroke-width="1"/>
                        <line x1="28" y1="75" x2="325" y2="75" stroke="#f1f5f9" stroke-width="1"/>
                        <line x1="28" y1="115" x2="325" y2="115" stroke="#f1f5f9" stroke-width="1"/>

                        <line :x1="activeTrafficPoint.x" y1="24" :x2="activeTrafficPoint.x" y2="135"
                              stroke="#3367A5" stroke-width="1.5" stroke-dasharray="3,3" opacity="0.65" class="transition-all duration-150"/>

                        <path :d="curve2" fill="none" stroke="#93C5FD" stroke-width="2.2" stroke-linecap="round" class="transition-all duration-300 ease-out"/>
                        <path :d="curve1" fill="none" stroke="#3367A5" stroke-width="2.6" stroke-linecap="round" class="transition-all duration-300 ease-out"/>

                        <circle :cx="activeTrafficPoint.x" :cy="activeTrafficPoint.y1" r="3.5" fill="#3367A5" stroke="#ffffff" stroke-width="1.5" class="transition-all duration-150 shadow-sm"/>

                        <g class="transition-all duration-150 pointer-events-none">
                            <rect :x="pillGroupX" y="6" width="68" height="20" rx="10" fill="#1E2E48"/>
                            <text :x="pillGroupX + 34" y="19.5" fill="#ffffff" font-size="10" font-weight="700" text-anchor="middle" font-family="'Questrial', sans-serif" x-text="activeTrafficPoint.text">0 Akses</text>

                            <circle :cx="activeTrafficPoint.x" cy="16" r="4.5" fill="#3b82f6" fill-opacity="0.25"/>
                            <circle :cx="activeTrafficPoint.x" cy="16" r="2.5" fill="#2563eb" stroke="#ffffff" stroke-width="1"/>

                            <rect :x="pillGroupX + 72" y="6" width="72" height="20" rx="10" fill="#eff6ff" stroke="#bfdbfe" stroke-width="1"/>
                            <text :x="pillGroupX + 72 + 36" y="19.5" fill="#3367A5" font-size="10" font-weight="700" text-anchor="middle" font-family="'Questrial', sans-serif" x-text="activeTrafficPoint.textNo">0 Unik</text>
                        </g>

                        <g class="cursor-pointer font-['Questrial',sans-serif]">
                            @for ($i = 0; $i < 7; $i++)
                                <text :x="computedPoints[{{ $i }}] ? computedPoints[{{ $i }}].x : {{ 45 + ($i * 44) }}" y="148"
                                      :fill="activePointIndex === {{ $i }} ? '#3367A5' : (computedPoints[{{ $i }}] && computedPoints[{{ $i }}].is_today ? '#2563eb' : '#94a3b8')"
                                      :font-weight="activePointIndex === {{ $i }} || (computedPoints[{{ $i }}] && computedPoints[{{ $i }}].is_today) ? '700' : '500'"
                                      font-size="10.5" text-anchor="middle"
                                      @click="selectPoint({{ $i }})" @mouseenter="selectPoint({{ $i }})"
                                      x-show="computedPoints.length > {{ $i }}"
                                      x-text="computedPoints[{{ $i }}] ? computedPoints[{{ $i }}].label : ''"></text>
                            @endfor
                        </g>
                    </svg>
                </div>
            </div>

            <!-- 2. Pesanan B2B & WA (Real-Time Donut Gauge) -->
            <a href="{{ route('admin.orders.index') }}"
                class="col-span-1 md:col-span-2 lg:col-span-4 bg-white rounded-[24px] p-5 border border-[#3367A5]/15 shadow-sm hover:shadow-md transition flex flex-col justify-between relative overflow-hidden group">

                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center justify-center text-slate-700 group-hover:border-[#3367A5]/40 transition shadow-2xs">
                            <svg class="w-4 h-4 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-slate-900 font-['Agrandir',sans-serif] block leading-tight">Pesanan B2B &amp; WA</span>
                    </div>

                    <span class="px-3 py-1 rounded-full text-xs font-semibold text-slate-600 bg-white border border-slate-200/80 shadow-2xs font-['Questrial',sans-serif] leading-none">
                        {{ now()->translatedFormat('F') }}
                    </span>
                </div>

                <div class="relative w-full flex items-center justify-center my-2 select-none">
                    <svg viewBox="0 0 180 180" class="w-40 h-40 overflow-visible">
                        <circle cx="90" cy="90" r="66" fill="none" stroke="#e2e8f0" stroke-width="7.5"
                            stroke-linecap="round" stroke-dasharray="44 16 44 16 44 260" transform="rotate(220 90 90)" />
                        <circle cx="90" cy="90" r="66" fill="none" stroke="#3367A5" stroke-width="8"
                            stroke-linecap="round"
                            :stroke-dasharray="Math.round(192 * (Math.min(100, liveOrderStats.po_submitted_pct || 0) / 100)) + ' 414.69'"
                            stroke-dasharray="{{ round(192 * (min(100, $orderStats['po_submitted_pct'] ?? 0) / 100)) }} 414.69" transform="rotate(38 90 90)"
                            class="transition-all duration-700 ease-out" />
                        <g class="pointer-events-none select-none">
                            <text x="90" y="83" text-anchor="middle" dominant-baseline="central" fill="#0f172a"
                                font-size="18" font-weight="800" font-family="'Questrial', sans-serif"
                                x-text="liveOrderStats.revenue_formatted">{{ $orderStats['revenue_formatted'] ?? 'Rp 0' }}</text>
                            <text x="90" y="103" text-anchor="middle" dominant-baseline="central" fill="#3367A5"
                                font-size="11" font-weight="700" font-family="'Questrial', sans-serif"
                                x-text="(liveOrderStats.total_orders || 0) + ' Order'">{{ $totalOrders ?? 0 }} Order</text>
                        </g>
                    </svg>
                </div>

                <div class="flex justify-center my-1.5">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-50/90 border border-slate-200/70 text-[11px] font-medium text-slate-700 shadow-2xs">
                        <svg class="w-3 h-3 text-[#3367A5] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z" />
                        </svg>
                        <span>PO Terkirim <strong class="text-[#3367A5] font-bold" x-text="(liveOrderStats.po_submitted_pct || 0) + '%'">{{ $orderStats['po_submitted_pct'] ?? 0 }}%</strong>
                            <span class="text-slate-400 font-normal" x-text="'(' + (liveOrderStats.po_submitted_count || 0) + ' dari ' + (liveOrderStats.total_orders || 0) + ')'">({{ $orderStats['po_submitted_count'] ?? 0 }} dari {{ $totalOrders ?? 0 }})</span></span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-3 gap-y-1.5 pt-2 border-t border-slate-100 text-xs font-['Questrial',sans-serif]">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-center text-slate-600 shrink-0">
                            <i class="fa-solid fa-file-circle-check text-[10px] text-[#3367A5]"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[10px] text-slate-400 block truncate">PO Terkirim</span>
                            <span class="text-xs font-bold text-slate-800 font-['Questrial',sans-serif]" x-text="liveOrderStats.po_submitted_formatted">{{ $orderStats['po_submitted_formatted'] ?? 'Rp 0' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-center text-slate-600 shrink-0">
                            <i class="fa-solid fa-hourglass-half text-[10px] text-amber-500"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[10px] text-slate-400 block truncate">Menunggu PO</span>
                            <span class="text-xs font-bold text-slate-800 font-['Questrial',sans-serif]" x-text="liveOrderStats.awaiting_po_formatted">{{ $orderStats['awaiting_po_formatted'] ?? 'Rp 0' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-center text-slate-600 shrink-0">
                            <i class="fa-solid fa-eye text-[10px] text-slate-600"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[10px] text-slate-400 block truncate">Inspeksi</span>
                            <span class="text-xs font-bold text-slate-800 font-['Questrial',sans-serif]" x-text="liveOrderStats.inspection_formatted">{{ $orderStats['inspection_formatted'] ?? 'Rp 0' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-slate-50 border border-slate-200/70 flex items-center justify-center text-slate-600 shrink-0">
                            <i class="fa-solid fa-microchip text-[10px] text-slate-600"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[10px] text-slate-400 block truncate">Otomasi</span>
                            <span class="text-xs font-bold text-slate-800 font-['Questrial',sans-serif]" x-text="liveOrderStats.automation_formatted">{{ $orderStats['automation_formatted'] ?? 'Rp 0' }}</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- 3. Column 3: Stacked Real-Time CRM Cards (Leads Simulator & Pesan Kontak) -->
            <div class="col-span-1 md:col-span-2 lg:col-span-4 flex flex-col justify-between gap-4">

                <!-- 3A. Leads Simulator (100% Real DB Data) -->
                <a href="{{ route('admin.leads.index') }}"
                    class="flex-1 bg-white rounded-[24px] p-5 border border-[#3367A5]/15 shadow-sm hover:shadow-md transition flex flex-col justify-between group cursor-pointer relative overflow-hidden">

                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-[16px] bg-blue-50 border border-blue-100 flex flex-col items-center justify-center shrink-0 shadow-2xs">
                                <span class="text-base font-extrabold text-[#3367A5] font-['Questrial',sans-serif] leading-none tabular-nums"
                                      x-text="liveLeadsCount">{{ $totalSimulationLeads ?? 0 }}</span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm sm:text-base font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight truncate">
                                    Leads Simulator</h4>
                                <p class="text-[11px] text-slate-500 font-['Questrial',sans-serif] mt-0.5">Prospek ROI &amp; Vision dari web</p>
                            </div>
                        </div>
                        <template x-if="liveNewLeads > 0">
                            <span class="h-6 px-2.5 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none shrink-0"
                                  x-text="liveNewLeads + ' Baru'">{{ $newSimulationLeads ?? 0 }} Baru</span>
                        </template>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100 mt-3 text-xs font-['Questrial',sans-serif]">
                        <div>
                            <span class="text-[11px] text-slate-400 font-medium block mb-0.5">Total Prospek</span>
                            <span class="text-sm font-bold font-['Questrial',sans-serif] text-slate-900 block truncate"
                                  x-text="liveLeadsCount + ' Perusahaan'">{{ $totalSimulationLeads ?? 0 }} Perusahaan</span>
                        </div>

                        <div>
                            <span class="text-[11px] text-slate-400 font-medium block mb-0.5">Aksi</span>
                            <span class="text-xs font-bold text-[#3367A5] font-['Agrandir',sans-serif] flex items-center gap-1 group-hover:underline">
                                <span>Buka Leads</span>
                                <i class="fa-solid fa-arrow-right text-[10px] transition-transform group-hover:translate-x-0.5"></i>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- 3B. Pesan Kontak (100% Real DB Data — No More "3.k Comments") -->
                <a href="{{ route('admin.contacts.index') }}"
                    class="flex-1 bg-white rounded-[24px] p-5 border border-[#3367A5]/15 shadow-sm hover:shadow-md transition flex flex-col justify-between group cursor-pointer relative overflow-hidden">

                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-[16px] bg-blue-50 border border-blue-100 flex flex-col items-center justify-center shrink-0 shadow-2xs">
                            <span class="text-base font-extrabold text-[#3367A5] font-['Questrial',sans-serif] leading-none tabular-nums"
                                  x-text="liveInquiriesCount">{{ $totalInquiries ?? 0 }}</span>
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <h4 class="text-sm sm:text-base font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight truncate">
                                    Pesan Kontak</h4>
                                <span class="text-[10px] font-bold font-['Questrial',sans-serif]"
                                      :class="liveUnreadInquiries > 0 ? 'text-rose-600' : 'text-emerald-600'"
                                      x-text="liveUnreadInquiries > 0 ? (liveUnreadInquiries + ' Belum Dibaca') : 'Semua Terbaca'">
                                    {{ ($unreadInquiries ?? 0) > 0 ? ($unreadInquiries . ' Belum Dibaca') : 'Semua Terbaca' }}
                                </span>
                            </div>

                            <div class="w-full bg-slate-100/90 rounded-full h-2 mt-2 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-[#3367A5] via-[#2A578E] to-[#1E4373] transition-all duration-500 ease-out"
                                     :style="'width: ' + contactsHandledPct + '%'" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100 mt-3 text-xs font-['Questrial',sans-serif]">
                        <div>
                            <span class="text-[11px] text-slate-400 font-medium block mb-0.5">Inbox</span>
                            <span class="text-sm font-bold font-['Questrial',sans-serif] text-slate-900 block truncate"
                                  x-text="liveInquiriesCount + ' Pesan'">{{ $totalInquiries ?? 0 }} Pesan</span>
                        </div>

                        <div>
                            <span class="text-[11px] text-slate-400 font-medium block mb-0.5">Aksi</span>
                            <span class="text-xs font-bold text-[#3367A5] font-['Agrandir',sans-serif] flex items-center gap-1 group-hover:underline">
                                <span>Buka Inbox</span>
                                <i class="fa-solid fa-arrow-right text-[10px] transition-transform group-hover:translate-x-0.5"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- ROW 2: REAL-TIME PIPELINE SUMMARY & LIVE ACTIVITY FEED         -->
        <!-- ============================================================== -->
        <div class="flex flex-col xl:flex-row gap-5 2xl:gap-6 items-stretch w-full">

            <!-- LEFT COLUMN: Real B2B Revenue Hero + Live Website CMS Summary -->
            <div class="w-full xl:w-[320px] 2xl:w-[340px] shrink-0 flex flex-col justify-between gap-5">

                <!-- Card 1: Total Nilai PO & RFQ (Corporate Blue Gradient — 100% Real IDR) -->
                <div class="bg-gradient-to-br from-[#3367A5] via-[#2A578E] to-[#1E4373] rounded-[24px] p-5 sm:p-6 text-white shadow-lg shadow-[#3367A5]/20 border border-[#3367A5]/30 relative flex flex-col justify-between min-h-[220px] overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-sky-400/15 rounded-full blur-xl pointer-events-none"></div>

                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <h3 class="text-xs font-bold text-blue-100 font-['Agrandir',sans-serif]">Total Nilai PO &amp; RFQ</h3>
                            <p class="text-[11px] text-blue-200/80 font-['Questrial',sans-serif]">PT Global Aspect Technology</p>
                        </div>
                        <span class="h-6 px-2.5 rounded-full bg-white/15 border border-white/25 text-[10px] font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none">
                            <span>IDR Live</span>
                        </span>
                    </div>

                    <div class="py-4 relative z-10">
                        <span class="text-xs text-blue-200/90 block font-['Questrial',sans-serif] mb-1">Akumulasi Penawaran Aktif</span>
                        <h2 class="text-2xl sm:text-[26px] font-extrabold font-['Questrial',sans-serif] tracking-tight text-white leading-tight tabular-nums"
                            x-text="liveOrderStats.full_revenue_formatted || 'Rp 0'">
                            {{ $orderStats['full_revenue_formatted'] ?? 'Rp 0' }}
                        </h2>
                        <p class="text-[11px] text-blue-100/85 mt-1.5 font-['Questrial',sans-serif]">
                            <span x-text="liveOrderStats.po_submitted_count || 0">{{ $orderStats['po_submitted_count'] ?? 0 }}</span> PO terkirim ·
                            <span x-text="liveOrderStats.awaiting_po_count || 0">{{ $orderStats['awaiting_po_count'] ?? 0 }}</span> menunggu PO
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 pt-2 relative z-10">
                        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer"
                           class="h-10 px-3 rounded-full border border-white/35 hover:border-white/80 bg-white/15 hover:bg-white/25 text-xs font-bold font-['Questrial',sans-serif] text-white inline-flex items-center justify-center gap-1.5 leading-none transition shadow-2xs">
                            <span>Lihat Website</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                        <a href="{{ route('admin.orders.index') }}"
                           class="h-10 px-3 rounded-full bg-white text-[#244E81] hover:bg-blue-50 text-xs font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center gap-1.5 leading-none transition shadow-2xs">
                            <span>Kelola Order</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Ringkasan Konten Website (CMS Live Status) -->
                <div class="bg-white border border-[#3367A5]/15 shadow-sm rounded-[24px] p-5 flex flex-col justify-between gap-4 flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight">Status Konten Website</h3>
                            <p class="text-[11px] text-slate-400 font-['Questrial',sans-serif] mt-0.5">Sinkronisasi real-time dengan web publik</p>
                        </div>
                        <span class="w-8 h-8 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-arrows-rotate text-xs"></i>
                        </span>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <a href="{{ route('admin.product.index') }}"
                           class="flex items-center justify-between p-3 rounded-2xl bg-[#f8fafd] hover:bg-blue-50/70 border border-slate-200/70 transition group">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="w-8 h-8 rounded-xl bg-white border border-slate-200/80 text-[#3367A5] flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-box-open text-xs"></i>
                                </span>
                                <div class="min-w-0">
                                    <span class="font-bold text-slate-800 block leading-tight group-hover:text-[#3367A5]">Katalog Produk</span>
                                    <span class="text-[10px] text-slate-400 block mt-0.5"
                                          x-text="livePublishedProducts + ' tayang dari ' + liveTotalProducts + ' total'">{{ $publishedProducts ?? 0 }} tayang dari {{ $totalProducts ?? 0 }} total</span>
                                </div>
                            </div>
                            <span class="h-6 min-w-[26px] px-2 rounded-full bg-[#E6F0FA] text-[#244E81] text-[11px] font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none tabular-nums"
                                  x-text="liveTotalProducts">{{ $totalProducts ?? 0 }}</span>
                        </a>

                        <a href="{{ route('admin.solutions.index') }}"
                           class="flex items-center justify-between p-3 rounded-2xl bg-[#f8fafd] hover:bg-blue-50/70 border border-slate-200/70 transition group">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="w-8 h-8 rounded-xl bg-white border border-slate-200/80 text-[#3367A5] flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-grid-2 text-xs fa-cubes"></i>
                                </span>
                                <div class="min-w-0">
                                    <span class="font-bold text-slate-800 block leading-tight group-hover:text-[#3367A5]">Layanan Solusi</span>
                                    <span class="text-[10px] text-slate-400 block mt-0.5"
                                          x-text="liveShownSolutions + ' tampil di navbar · ' + liveTotalSolutions + ' total'">{{ $shownSolutions ?? 0 }} tampil di navbar · {{ $totalSolutions ?? 0 }} total</span>
                                </div>
                            </div>
                            <span class="h-6 min-w-[26px] px-2 rounded-full bg-[#E6F0FA] text-[#244E81] text-[11px] font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none tabular-nums"
                                  x-text="liveTotalSolutions">{{ $totalSolutions ?? 0 }}</span>
                        </a>

                        <a href="{{ route('admin.projects.index') }}"
                           class="flex items-center justify-between p-3 rounded-2xl bg-[#f8fafd] hover:bg-blue-50/70 border border-slate-200/70 transition group">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="w-8 h-8 rounded-xl bg-white border border-slate-200/80 text-[#3367A5] flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-briefcase text-xs"></i>
                                </span>
                                <div class="min-w-0">
                                    <span class="font-bold text-slate-800 block leading-tight group-hover:text-[#3367A5]">Portofolio Proyek</span>
                                    <span class="text-[10px] text-slate-400 block mt-0.5"
                                          x-text="liveShownProjects + ' tayang dari ' + liveTotalProjects + ' total'">{{ $shownProjects ?? 0 }} tayang dari {{ $totalProjects ?? 0 }} total</span>
                                </div>
                            </div>
                            <span class="h-6 min-w-[26px] px-2 rounded-full bg-[#E6F0FA] text-[#244E81] text-[11px] font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none tabular-nums"
                                  x-text="liveTotalProjects">{{ $totalProjects ?? 0 }}</span>
                        </a>
                    </div>

                    <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px]">
                        <span class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Real-Time Live</span>
                            <span class="text-[10px] text-slate-400 font-normal" x-show="lastSyncTime" x-text="'· ' + lastSyncTime"></span>
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="text-slate-400 font-['Questrial',sans-serif]" x-text="onlineNow + ' online'">{{ (int) ($onlineNow ?? 0) }} online</span>
                            <button type="button" @click="pollTraffic()" title="Segarkan Data Dashboard"
                                class="text-[#3367A5] hover:text-[#244E81] transition cursor-pointer">
                                <i class="fa-solid fa-rotate text-[10px]" :class="isPolling ? 'animate-spin' : ''"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: 3 Real-Time Live Tables (Pesanan & RFQ, Log Pengunjung, Leads Simulator) -->
            <div class="w-full xl:flex-1 min-w-0 bg-white border border-[#3367A5]/15 shadow-sm rounded-[24px] p-5 sm:p-6 flex flex-col justify-between self-stretch">

                <!-- Header Tabs & Filters -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-1.5 p-1 bg-slate-100 rounded-xl font-['Questrial',sans-serif] overflow-x-auto max-w-full">
                        <button type="button" @click="activeCenterTab = 'orders'"
                            :class="activeCenterTab === 'orders' ? 'bg-white text-[#3367A5] font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900 font-medium'"
                            class="h-8 px-3 rounded-lg text-xs inline-flex items-center justify-center leading-none transition cursor-pointer whitespace-nowrap shrink-0">
                            Pesanan &amp; RFQ
                        </button>
                        <button type="button" @click="activeCenterTab = 'traffic'"
                            :class="activeCenterTab === 'traffic' ? 'bg-white text-[#3367A5] font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900 font-medium'"
                            class="h-8 px-3 rounded-lg text-xs inline-flex items-center justify-center leading-none transition cursor-pointer whitespace-nowrap shrink-0">
                            <span>Log Pengunjung</span>
                        </button>
                        <button type="button" @click="activeCenterTab = 'leads'"
                            :class="activeCenterTab === 'leads' ? 'bg-white text-[#3367A5] font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900 font-medium'"
                            class="h-8 px-3 rounded-lg text-xs inline-flex items-center justify-center leading-none transition cursor-pointer whitespace-nowrap shrink-0">
                            Leads Simulator
                        </button>
                    </div>

                    <!-- Search & Status Filter (for Orders tab) -->
                    <div class="flex items-center gap-2" x-show="activeCenterTab === 'orders'">
                        <button type="button" @click="inlineSearchOpen = !inlineSearchOpen"
                            class="w-8 h-8 rounded-xl border border-slate-200/80 flex items-center justify-center text-slate-500 hover:text-[#3367A5] hover:border-[#3367A5]/30 transition cursor-pointer shadow-2xs"
                            title="Cari pesanan">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>

                        <div class="relative" x-data="{ filterOpen: false }">
                            <button type="button" @click="filterOpen = !filterOpen"
                                class="h-8 px-3 rounded-xl border border-slate-200/80 bg-[#f8fafd] hover:bg-white inline-flex items-center gap-2 text-xs font-semibold text-slate-700 hover:border-[#3367A5]/30 transition cursor-pointer shadow-2xs">
                                <span x-text="selectedOrderFilterLabel">Semua Status</span>
                                <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': filterOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-cloak x-show="filterOpen" @click.outside="filterOpen = false"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 class="absolute right-0 mt-1.5 w-44 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 text-xs z-50">
                                <template x-for="opt in orderFilterOptions" :key="opt.value">
                                    <button type="button" @click="selectedOrderFilter = opt.value; filterOpen = false"
                                        :class="selectedOrderFilter === opt.value ? 'font-bold text-[#3367A5] bg-blue-50' : 'text-slate-700 hover:bg-blue-50/60'"
                                        class="w-full px-3.5 py-2 text-left flex items-center justify-between transition cursor-pointer">
                                        <span x-text="opt.label"></span>
                                        <i x-show="selectedOrderFilter === opt.value" class="fa-solid fa-check text-[#3367A5] text-[10px]"></i>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expandable Inline Search Bar -->
                <div x-show="inlineSearchOpen && activeCenterTab === 'orders'" x-cloak class="pt-3 pb-1">
                    <div class="relative">
                        <input type="text" x-model="searchQuery" placeholder="Cari nama PT, pemesan, atau nomor order..."
                            class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-[#f8fafd] border border-slate-200/80 outline-none focus:border-[#3367A5]">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs absolute left-3 top-2.5"></i>
                    </div>
                </div>

                <!-- TAB 1: REAL B2B ORDERS & RFQ (100% REAL MYSQL DATA) -->
                <div x-show="activeCenterTab === 'orders'" class="flex-1 flex flex-col justify-between">
                    <div class="divide-y divide-slate-100 flex-1">
                        <template x-for="ord in filteredOrders.slice(0, 8)" :key="ord.id">
                            <a :href="ord.detail_url"
                               class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 sm:gap-3 hover:bg-slate-50/80 rounded-xl px-2 transition group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                                         :class="{
                                             'bg-amber-50 text-amber-600': ord.status === 'awaiting_po',
                                             'bg-emerald-50 text-emerald-600': ord.status === 'po_submitted' || ord.status === 'completed',
                                             'bg-blue-50 text-[#3367A5]': ord.status === 'confirmed' || ord.status === 'processing',
                                             'bg-rose-50 text-rose-500': ord.status === 'cancelled'
                                         }">
                                        <i class="fa-solid text-xs"
                                           :class="{
                                               'fa-hourglass-half': ord.status === 'awaiting_po',
                                               'fa-file-circle-check': ord.status === 'po_submitted' || ord.status === 'completed',
                                               'fa-circle-check': ord.status === 'confirmed' || ord.status === 'processing',
                                               'fa-ban': ord.status === 'cancelled'
                                           }"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold font-['Agrandir',sans-serif] text-slate-800 group-hover:text-[#3367A5] truncate" x-text="ord.company_name"></span>
                                            <span class="text-[10px] text-slate-400 font-mono shrink-0" x-text="'#' + ord.order_number"></span>
                                        </div>
                                        <p class="text-[11px] text-slate-400 font-['Questrial',sans-serif] truncate">
                                            <span x-text="ord.customer_name + ' · ' + ord.date_formatted"></span>
                                            <span class="mx-1">·</span>
                                            <span class="font-semibold"
                                                  :class="ord.whatsapp_contacted ? 'text-emerald-600' : 'text-slate-400'"
                                                  x-text="ord.wa_status_label || (ord.whatsapp_contacted ? 'WA Terkirim' : 'Belum WA')"></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 sm:gap-5 shrink-0">
                                    <span class="h-6 px-2.5 rounded-full text-[10px] font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none"
                                          :class="{
                                              'bg-amber-50 text-amber-700': ord.status === 'awaiting_po',
                                              'bg-emerald-50 text-emerald-700': ord.status === 'po_submitted' || ord.status === 'completed',
                                              'bg-blue-50 text-[#3367A5]': ord.status === 'confirmed' || ord.status === 'processing',
                                              'bg-rose-50 text-rose-600': ord.status === 'cancelled'
                                          }"
                                          x-text="ord.status_label"></span>
                                    <span class="text-xs font-bold font-['Questrial',sans-serif] text-slate-900 text-right min-w-[95px] tabular-nums"
                                          x-text="ord.grand_total_formatted"></span>
                                </div>
                            </a>
                        </template>

                        <template x-if="filteredOrders.length === 0">
                            <div class="py-10 text-center text-xs text-slate-400">
                                Tidak ada pesanan B2B yang cocok dengan filter pencarian.
                            </div>
                        </template>
                    </div>

                    <div class="pt-3 text-center border-t border-slate-100 mt-2">
                        <a href="{{ route('admin.orders.index') }}"
                           class="inline-flex items-center gap-1.5 text-xs font-bold text-[#3367A5] hover:underline">
                            <span x-text="'Lihat Semua Pesanan & RFQ (' + liveOrdersCount + ')'">Lihat Semua Pesanan &amp; RFQ ({{ $totalOrders ?? 0 }})</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- TAB 2: REAL-TIME LOG PENGUNJUNG -->
                <div x-show="activeCenterTab === 'traffic'" x-cloak class="flex-1 divide-y divide-slate-100">
                    <template x-for="v in liveRecentVisitors.slice(0, 8)" :key="v.id">
                        <div class="py-2.5 flex items-center justify-between gap-3 hover:bg-slate-50/60 rounded-xl px-2 transition">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-xs shrink-0">
                                    <i class="fa-solid fa-globe text-[11px]"></i>
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold font-mono text-slate-800" x-text="v.ip"></span>
                                        <span class="text-[10px] text-slate-400 truncate" x-text="v.device + ' · ' + v.browser"></span>
                                    </div>
                                    <p class="text-[11px] text-[#3367A5] font-['Questrial',sans-serif] truncate" x-text="v.page_url"></p>
                                </div>
                            </div>
                            <span class="text-[10px] text-slate-400 shrink-0" x-text="v.time_ago"></span>
                        </div>
                    </template>
                    <template x-if="liveRecentVisitors.length === 0">
                        <div class="py-10 text-center text-xs text-slate-400">
                            Belum ada kunjungan halaman publik tercatat pada database saat ini.
                        </div>
                    </template>
                </div>

                <!-- TAB 3: REAL-TIME LEADS SIMULATOR -->
                <div x-show="activeCenterTab === 'leads'" x-cloak class="flex-1 flex flex-col justify-between">
                    <div class="divide-y divide-slate-100 flex-1">
                        <template x-for="lead in liveRecentLeads.slice(0, 8)" :key="lead.id">
                            <a href="{{ route('admin.leads.index') }}"
                               class="py-2.5 flex items-center justify-between gap-3 hover:bg-slate-50/60 rounded-xl px-2 transition">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-xs shrink-0">
                                        <i class="fa-solid fa-industry text-[11px]"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold font-['Agrandir',sans-serif] text-slate-800 truncate" x-text="lead.company_name"></span>
                                            <span class="text-[10px] text-slate-400 shrink-0" x-text="lead.industry_type"></span>
                                        </div>
                                        <p class="text-[11px] text-slate-400 font-['Questrial',sans-serif]" x-text="lead.time_ago"></p>
                                    </div>
                                </div>
                                <span class="h-5 px-2.5 rounded-full text-[10px] font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none shrink-0"
                                      :class="lead.status === 'new' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700'"
                                      x-text="lead.status === 'new' ? 'Baru' : 'Ditindaklanjuti'"></span>
                            </a>
                        </template>
                        <template x-if="liveRecentLeads.length === 0">
                            <div class="py-10 text-center text-xs text-slate-400">Belum ada prospek simulator tercatat.</div>
                        </template>
                    </div>
                    <div class="pt-3 text-center border-t border-slate-100 mt-2">
                        <a href="{{ route('admin.leads.index') }}"
                           class="inline-flex items-center gap-1.5 text-xs font-bold text-[#3367A5] hover:underline">
                            <span x-text="'Kelola Semua Leads Simulator (' + liveLeadsCount + ')'">Kelola Semua Leads Simulator ({{ $totalSimulationLeads ?? 0 }})</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- ALPINE.JS REAL-TIME CONTROLLER FOR GAT DASHBOARD               -->
    <!-- ============================================================== -->
    <script>
    function dashboardApp() {
        return {
            activeCenterTab: 'orders',
            inlineSearchOpen: false,
            searchQuery: '',
            selectedOrderFilter: 'all',
            orderFilterOptions: [
                { value: 'all', label: 'Semua Status' },
                { value: 'awaiting_po', label: 'Menunggu PO' },
                { value: 'po_submitted', label: 'PO Terkirim' },
                { value: 'confirmed', label: 'Dikonfirmasi' },
                { value: 'completed', label: 'Selesai' }
            ],
            get selectedOrderFilterLabel() {
                const found = this.orderFilterOptions.find(o => o.value === this.selectedOrderFilter);
                return found ? found.label : 'Semua Status';
            },

            // Real-Time Integrated Telemetry State
            liveVisitorsToday: {{ (int) ($totalVisitorsToday ?? 0) }},
            liveVisitorsAll: {{ (int) ($totalVisitorsAll ?? 0) }},
            onlineNow: {{ (int) ($onlineNow ?? 0) }},
            isPolling: false,
            lastSyncTime: '{{ now()->format("H:i:s") }}',
            liveLeadsCount: {{ (int) ($totalSimulationLeads ?? 0) }},
            liveNewLeads: {{ (int) ($newSimulationLeads ?? 0) }},
            liveOrdersCount: {{ (int) ($totalOrders ?? 0) }},
            liveInquiriesCount: {{ (int) ($totalInquiries ?? 0) }},
            liveUnreadInquiries: {{ (int) ($unreadInquiries ?? 0) }},
            liveTotalProducts: {{ (int) ($totalProducts ?? 0) }},
            livePublishedProducts: {{ (int) ($publishedProducts ?? 0) }},
            liveTotalSolutions: {{ (int) ($totalSolutions ?? 0) }},
            liveShownSolutions: {{ (int) ($shownSolutions ?? 0) }},
            liveTotalProjects: {{ (int) ($totalProjects ?? 0) }},
            liveShownProjects: {{ (int) ($shownProjects ?? 0) }},
            liveOrderStats: @json($orderStats ?? []),
            liveRecentOrders: @json($recentOrdersData ?? []),
            liveRecentLeads: @json($recentLeadsData ?? []),
            liveRecentVisitors: [
                @foreach ($recentVisitors ?? [] as $v)
                    {
                        id: {{ $v->id }},
                        ip: '{{ $v->ip_address }}',
                        page_url: '{{ $v->page_url }}',
                        device: '{{ $v->device ?? "Desktop" }}',
                        browser: '{{ $v->browser ?? "Browser" }}',
                        time_ago: '{{ $v->created_at->diffForHumans() }}'
                    },
                @endforeach
            ],

            get contactsHandledPct() {
                if (!this.liveInquiriesCount || this.liveInquiriesCount <= 0) return 100;
                const handled = Math.max(0, this.liveInquiriesCount - this.liveUnreadInquiries);
                return Math.min(100, Math.max(12, Math.round((handled / this.liveInquiriesCount) * 100)));
            },

            get filteredOrders() {
                const q = (this.searchQuery || (this.$store && this.$store.admin ? this.$store.admin.searchQuery : '') || '').toLowerCase().trim();
                return (this.liveRecentOrders || []).filter(ord => {
                    if (this.selectedOrderFilter !== 'all' && ord.status !== this.selectedOrderFilter) return false;
                    if (q) {
                        return (ord.company_name || '').toLowerCase().includes(q)
                            || (ord.customer_name || '').toLowerCase().includes(q)
                            || (ord.order_number || '').toLowerCase().includes(q)
                            || (ord.grand_total_formatted || '').toLowerCase().includes(q);
                    }
                    return true;
                });
            },

            // Dynamic Spline Chart & Pan Navigation
            trafficSeries: @json($allTrafficSeries ?? []),
            currentTodayDate: '{{ today()->format("Y-m-d") }}',
            currentTimeframe: 'hari',
            panOffset: 0,
            visibleCount: 7,
            activePointIndex: 6,
            isDragging: false,
            dragStartX: 0,
            dragStartOffset: 0,

            get currentRawList() {
                return (this.trafficSeries && this.trafficSeries.daily) ? this.trafficSeries.daily : [];
            },
            get maxPanOffset() {
                return Math.max(0, this.currentRawList.length - this.visibleCount);
            },
            get clampedPanOffset() {
                return Math.max(0, Math.min(this.maxPanOffset, this.panOffset));
            },
            get visibleSlice() {
                const list = this.currentRawList;
                if (!list || list.length === 0) return [];
                const endIdx = list.length - this.clampedPanOffset;
                const startIdx = Math.max(0, endIdx - this.visibleCount);
                return list.slice(startIdx, endIdx);
            },
            get yMax() {
                const slice = this.visibleSlice;
                if (!slice || slice.length === 0) return 30;
                let maxVal = 0;
                slice.forEach(p => {
                    if (p.report > maxVal) maxVal = p.report;
                    if (p.noReport > maxVal) maxVal = p.noReport;
                });
                if (maxVal <= 10) return 15;
                if (maxVal <= 20) return 25;
                if (maxVal <= 35) return 40;
                if (maxVal <= 60) return 70;
                if (maxVal <= 100) return 120;
                return Math.ceil((maxVal * 1.25) / 10) * 10;
            },
            get currentYAxis() {
                const m = this.yMax;
                return [String(m), String(Math.round(m * 0.6)), String(Math.round(m * 0.3))];
            },
            get computedPoints() {
                const slice = this.visibleSlice;
                if (!slice || slice.length === 0) return [];
                const count = slice.length;
                const yMax = this.yMax;
                const stepX = count > 1 ? (310 - 45) / (count - 1) : 0;

                return slice.map((item, idx) => {
                    const x = 45 + idx * stepX;
                    const y1 = Math.max(38, Math.min(118, 118 - (item.report / yMax) * 76));
                    const y2 = Math.max(48, Math.min(124, 122 - (item.noReport / yMax) * 70));
                    const displayLabel = item.day ? String(item.day) : String(item.label || '');

                    return {
                        ...item,
                        index: idx,
                        label: displayLabel,
                        x: Math.round(x * 10) / 10,
                        y1: Math.round(y1 * 10) / 10,
                        y2: Math.round(y2 * 10) / 10,
                        text: item.report + ' Akses',
                        textNo: item.noReport + ' Unik',
                        is_today: item.is_today || (item.date === this.currentTodayDate),
                    };
                });
            },
            get curve1() {
                return this.buildSpline(this.computedPoints.map(p => ({ x: p.x, y: p.y1 })));
            },
            get curve2() {
                return this.buildSpline(this.computedPoints.map(p => ({ x: p.x, y: p.y2 })));
            },
            buildSpline(pts) {
                if (!pts || pts.length === 0) return '';
                if (pts.length === 1) return `M ${pts[0].x} ${pts[0].y}`;
                if (pts.length === 2) return `M ${pts[0].x} ${pts[0].y} L ${pts[1].x} ${pts[1].y}`;
                let path = `M ${pts[0].x} ${pts[0].y}`;
                for (let i = 0; i < pts.length - 1; i++) {
                    const p0 = pts[i === 0 ? 0 : i - 1];
                    const p1 = pts[i];
                    const p2 = pts[i + 1];
                    const p3 = pts[i + 2 < pts.length ? i + 2 : i + 1];
                    const cp1x = p1.x + (p2.x - p0.x) / 6;
                    const cp1y = p1.y + (p2.y - p0.y) / 6;
                    const cp2x = p2.x - (p3.x - p1.x) / 6;
                    const cp2y = p2.y - (p3.y - p1.y) / 6;
                    path += ` C ${Math.round(cp1x * 10) / 10} ${Math.round(cp1y * 10) / 10}, ${Math.round(cp2x * 10) / 10} ${Math.round(cp2y * 10) / 10}, ${Math.round(p2.x * 10) / 10} ${Math.round(p2.y * 10) / 10}`;
                }
                return path;
            },
            get activeTrafficPoint() {
                const pts = this.computedPoints;
                if (!pts || pts.length === 0) return { x: 310, y1: 75, y2: 105, text: '0 Akses', textNo: '0 Unik', is_today: true };
                const idx = Math.max(0, Math.min(pts.length - 1, this.activePointIndex ?? (pts.length - 1)));
                return pts[idx] || pts[pts.length - 1];
            },
            get pillGroupX() {
                return Math.max(28, Math.min(192, Math.round(this.activeTrafficPoint.x - 72)));
            },
            resetToToday() {
                this.panOffset = 0;
                this.activePointIndex = Math.max(0, this.computedPoints.length - 1);
            },
            selectPoint(idx) {
                this.activePointIndex = idx;
            },
            startPan(e) {
                this.isDragging = true;
                this.dragStartX = e.clientX;
                this.dragStartOffset = this.panOffset;
            },
            onWindowMouseMove(e) {
                if (!this.isDragging) return;
                const steps = Math.round(-(e.clientX - this.dragStartX) / 30);
                this.panOffset = Math.max(0, Math.min(this.maxPanOffset, this.dragStartOffset + steps));
            },
            onWindowMouseUp() {
                this.isDragging = false;
            },
            startTouch(e) {
                if (e.touches && e.touches[0]) {
                    this.isDragging = true;
                    this.dragStartX = e.touches[0].clientX;
                    this.dragStartOffset = this.panOffset;
                }
            },
            moveTouch(e) {
                if (!this.isDragging || !e.touches || !e.touches[0]) return;
                const steps = Math.round(-(e.touches[0].clientX - this.dragStartX) / 30);
                this.panOffset = Math.max(0, Math.min(this.maxPanOffset, this.dragStartOffset + steps));
            },

            pollTraffic() {
                if (this.isPolling) return;
                this.isPolling = true;
                fetch('{{ route("admin.api.live-traffic") }}', {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    cache: 'no-store'
                })
                .then(res => {
                    if (res.status === 401) {
                        window.location.href = '{{ route("login") }}';
                        return null;
                    }
                    return res.ok ? res.json() : null;
                })
                .then(data => {
                    if (!data) return;
                    if (data.timestamp) {
                        this.lastSyncTime = String(data.timestamp).slice(11, 19);
                    }
                    this.liveVisitorsToday = data.today;
                    this.liveVisitorsAll = data.total;
                    this.onlineNow = Number(data.online_now ?? 0);
                    this.liveLeadsCount = data.total_leads;
                    this.liveNewLeads = data.new_leads;
                    this.liveOrdersCount = data.total_orders;
                    this.liveInquiriesCount = data.total_inquiries;
                    this.liveUnreadInquiries = data.unread_inquiries;
                    this.liveTotalProducts = data.total_products ?? this.liveTotalProducts;
                    this.livePublishedProducts = data.published_products ?? this.livePublishedProducts;
                    this.liveTotalSolutions = data.total_solutions ?? this.liveTotalSolutions;
                    this.liveShownSolutions = data.shown_solutions ?? this.liveShownSolutions;
                    this.liveTotalProjects = data.total_projects ?? this.liveTotalProjects;
                    this.liveShownProjects = data.shown_projects ?? this.liveShownProjects;

                    if (data.order_stats) this.liveOrderStats = data.order_stats;
                    if (Array.isArray(data.recent_orders)) this.liveRecentOrders = data.recent_orders;
                    if (Array.isArray(data.recent_leads)) this.liveRecentLeads = data.recent_leads;
                    if (Array.isArray(data.recent_visitors)) this.liveRecentVisitors = data.recent_visitors;

                    if (data.today_date && data.today_date !== this.currentTodayDate) {
                        this.currentTodayDate = data.today_date;
                        if (data.series) this.trafficSeries = data.series;
                        this.panOffset = 0;
                        this.activePointIndex = Math.max(0, this.computedPoints.length - 1);
                    } else if (data.series) {
                        this.trafficSeries = data.series;
                    }

                    try {
                        if (window.Alpine && Alpine.store('admin')?.applyLiveBadgesPayload) {
                            Alpine.store('admin').applyLiveBadgesPayload(data);
                        }
                    } catch (e) {}
                })
                .catch(() => {})
                .finally(() => {
                    this.isPolling = false;
                });
            },

            init() {
                window.__gatDashboardOwnsPoll = true;
                this.trafficPollTimer = setInterval(() => {
                    if (!document.hidden) this.pollTraffic();
                }, 10000);
                try {
                    if (typeof BroadcastChannel !== 'undefined') {
                        const ch = new BroadcastChannel('gat_cms_sync');
                        ch.onmessage = (ev) => {
                            if (ev?.data?.type === 'public_submission') {
                                this.pollTraffic();
                            }
                        };
                    }
                } catch (e) {}
            }
        };
    }
    </script>
@endsection
