<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - PT GLOBAL ASPECT TECHNOLOGY</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Fonts: GAT Corporate Typography System (Agrandir & Questrial) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Questrial', 'sans-serif'],
                        heading: ['Agrandir', 'sans-serif'],
                        agrandir: ['Agrandir', 'sans-serif'],
                        questrial: ['Questrial', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Hide native Edge/IE password reveal icon so only our single custom eye toggle shows */
        input::-ms-reveal,
        input::-ms-clear,
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
            pointer-events: none !important;
        }

        /* Unified single-color sidebar counter badge with dead-center numeric alignment */
        .sidebar-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 24px;
            padding: 0 6px;
            border-radius: 9999px;
            background-color: #E6F0FA;
            color: #244E81;
            font-family: 'Questrial', sans-serif;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: 0;
            font-variant-numeric: tabular-nums;
            text-align: center;
            flex-shrink: 0;
            box-sizing: border-box;
        }

        /* Uniform single-color badge for Mobile & Tablet Bottom Bar */
        .bottom-nav-badge {
            position: absolute;
            top: 2px;
            right: calc(50% - 22px);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 17px;
            height: 17px;
            padding: 0 4px;
            border-radius: 9999px;
            background-color: #E6F0FA;
            color: #244E81;
            font-family: 'Questrial', sans-serif;
            font-size: 9.5px;
            font-weight: 700;
            line-height: 1;
            font-variant-numeric: tabular-nums;
            text-align: center;
            box-shadow: 0 1px 4px rgba(15, 23, 42, 0.18);
        }

        @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
        @import url('https://fonts.cdnfonts.com/css/agrandir');

        /* Explicit @font-face fallbacks to guarantee instant render without delay */
        @font-face {
            font-family: 'Agrandir';
            font-style: normal;
            font-weight: 400;
            src: local('Agrandir Regular'), local('Agrandir'), url('https://fonts.cdnfonts.com/s/122717/agrandir-regular.woff') format('woff');
            font-display: swap;
        }

        @font-face {
            font-family: 'Agrandir';
            font-style: normal;
            font-weight: 700;
            src: local('Agrandir Bold'), local('Agrandir'), url('https://fonts.cdnfonts.com/s/122717/agrandir-bold.woff') format('woff');
            font-display: swap;
        }

        @font-face {
            font-family: 'Agrandir';
            font-style: normal;
            font-weight: 800;
            src: local('Agrandir Heavy'), local('Agrandir Bold'), url('https://fonts.cdnfonts.com/s/122717/agrandir-heavy.woff') format('woff');
            font-display: swap;
        }

        /* Typography matching PT Global Aspect Technology Website (Strictly Questrial & Agrandir) */
        html,
        body {
            font-family: 'Questrial', sans-serif !important;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* All form controls inherit the font */
        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* Headings, numbers, brand titles default to Agrandir */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-heading,
        .font-agrandir,
        [class*="font-['Agrandir']"],
        [class*="font-['Agrandir',sans-serif]"],
        .brand-title {
            font-family: 'Agrandir', sans-serif !important;
        }

        .font-questrial,
        [class*="font-['Questrial']"],
        [class*="font-['Questrial',sans-serif]"] {
            font-family: 'Questrial', sans-serif !important;
        }

        /* Sembunyikan visual scrollbar vertikal/halaman utama namun pertahankan fungsi scroll */
        * {
            scrollbar-width: none !important;
            /* Firefox */
            -ms-overflow-style: none !important;
            /* IE and Edge */
        }

        *::-webkit-scrollbar,
        ::-webkit-scrollbar {
            display: none !important;
            /* Chrome, Safari, Edge, Opera */
            width: 0 !important;
            height: 0 !important;
            background: transparent !important;
        }

        /* Tampilkan scrollbar horizontal tipis & rapi khusus untuk tabel admin yang melebar */
        .admin-table-scroll,
        .overflow-x-auto {
            scrollbar-width: thin !important;
            scrollbar-color: rgba(51, 103, 165, 0.38) #f1f5f9 !important;
            -ms-overflow-style: auto !important;
            -webkit-overflow-scrolling: touch;
        }

        .admin-table-scroll::-webkit-scrollbar,
        .overflow-x-auto::-webkit-scrollbar {
            display: block !important;
            height: 7px !important;
            width: 7px !important;
        }

        .admin-table-scroll::-webkit-scrollbar-track,
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9 !important;
            border-radius: 9999px !important;
        }

        .admin-table-scroll::-webkit-scrollbar-thumb,
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: rgba(51, 103, 165, 0.35) !important;
            border-radius: 9999px !important;
        }

        .admin-table-scroll::-webkit-scrollbar-thumb:hover,
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(51, 103, 165, 0.6) !important;
        }

        /* Cegah overscroll / elastic bounce / rubber-band saat mentok ke atas atau ke bawah */
        html,
        body {
            overscroll-behavior: none !important;
            overscroll-behavior-y: none !important;
            overscroll-behavior-x: none !important;
        }

        @media (min-width: 1024px) {

            html,
            body {
                height: 100vh !important;
                max-height: 100vh !important;
                overflow: hidden !important;
            }
        }

        main,
        aside,
        .overflow-y-auto {
            overscroll-behavior: contain !important;
            overscroll-behavior-y: contain !important;
            overscroll-behavior-x: none !important;
        }
    </style>

    @php
        $adminUser = auth()->user();
        $profileProgress = $adminUser ? $adminUser->profileCompletion() : 40;
        $isIdentityVerified = $adminUser ? $adminUser->isIdentityVerified() : false;
        $profileChecklist = $adminUser ? $adminUser->profileChecklist() : [];
        $adminAvatarUrl = $adminUser ? $adminUser->avatarUrl() : null;
        $adminInitials = $adminUser ? $adminUser->initials() : 'AD';
        $flashToast = session('admin_toast');
        $reopenModal =
            session('admin_modal') ?:
            ($errors->hasAny(['current_password', 'new_password', 'code', 'idle_timeout_minutes', 'new_admin_name', 'new_admin_email', 'new_admin_password', 'reset_password'])
                ? 'settings'
                : null);
        $initialSettingsTab =
            session('admin_settings_tab') ?:
            ($errors->hasAny(['new_admin_name', 'new_admin_email', 'new_admin_password', 'reset_password'])
                ? 'admins'
                : ($errors->hasAny(['new_password', 'code']) ? 'security' : 'profile'));
        $managedAdmins = \App\Models\User::orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END")
            ->orderBy('id')
            ->get();
        $newRecoveryCodes = session('new_recovery_codes', []);
        $adminHas2fa = $adminUser ? $adminUser->hasTwoFactorEnabled() : false;
        $adminRecoveryRemaining = $adminUser ? $adminUser->remainingRecoveryCodesCount() : 0;
        $adminIdleMinutes = is_null($adminUser?->idle_timeout_minutes) ? 120 : (int) $adminUser->idle_timeout_minutes;
        $adminIdleLabel = match ($adminIdleMinutes) {
            0 => 'Nonaktif',
            30 => 'Aktif: 30 mnt',
            60 => 'Aktif: 1 Jam',
            120 => 'Aktif: 2 Jam',
            240 => 'Aktif: 4 Jam',
            default => "Aktif: {$adminIdleMinutes} mnt",
        };
        $isDefaultAdminEmail = strtolower(trim((string) ($adminUser?->email ?? ''))) === 'admin@admin.com';
        $currentSessionId = session()->getId();

        $adminActiveSessions = $adminUser
            ? \App\Models\AdminActiveSession::where('user_id', $adminUser->id)
                ->orderByDesc('last_active_at')
                ->take(8)
                ->get()
            : collect();
        $adminSecurityLogs = $adminUser
            ? \App\Models\AdminSecurityLog::where(function ($q) use ($adminUser) {
                $q->where('user_id', $adminUser->id)->orWhere('email', $adminUser->email);
            })
                ->latest()
                ->take(10)
                ->get()
            : collect();

        $didAdminMutate = session()->has('success') || session()->has('admin_toast');

        if (isset($precomputedSidebarBadges) && is_array($precomputedSidebarBadges)) {
            $sidebarBadges = $precomputedSidebarBadges;
        } else {
            $todayStart = today()->startOfDay()->toDateTimeString();
            $badgeRow = \Illuminate\Support\Facades\DB::selectOne(
                "SELECT
                    (SELECT COUNT(*) FROM visitor_logs WHERE created_at >= ?) as today_visitors,
                    (SELECT COUNT(*) FROM simulation_leads) as total_leads,
                    (SELECT COUNT(*) FROM simulation_leads WHERE status = 'new') as new_leads,
                    (SELECT COUNT(*) FROM products) as total_products,
                    (SELECT COUNT(*) FROM orders) as total_orders,
                    (SELECT COUNT(*) FROM orders WHERE status = 'awaiting_po') as new_orders,
                    (SELECT COUNT(*) FROM solutions) as total_solutions,
                    (SELECT COUNT(*) FROM projects) as total_projects,
                    (SELECT COUNT(*) FROM contact_us) as total_inquiries,
                    (SELECT COUNT(*) FROM contact_us WHERE status = 'unread') as unread_inquiries",
                [$todayStart]
            );

            $sidebarBadges = [
                'today_visitors' => (int) ($badgeRow->today_visitors ?? 0),
                'total_leads' => (int) ($badgeRow->total_leads ?? 0),
                'new_leads' => (int) ($badgeRow->new_leads ?? 0),
                'total_products' => (int) ($badgeRow->total_products ?? 0),
                'total_orders' => (int) ($badgeRow->total_orders ?? 0),
                'new_orders' => (int) ($badgeRow->new_orders ?? 0),
                'total_solutions' => (int) ($badgeRow->total_solutions ?? 0),
                'total_projects' => (int) ($badgeRow->total_projects ?? 0),
                'total_inquiries' => (int) ($badgeRow->total_inquiries ?? 0),
                'unread_inquiries' => (int) ($badgeRow->unread_inquiries ?? 0),
                'active_channels' => \App\Models\SiteSetting::activeChannelsCount(),
            ];
        }
    @endphp

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('admin', {
                searchQuery: '',
                profileProgress: {{ $profileProgress }},
                isVerified: {{ $isIdentityVerified ? 'true' : 'false' }},
                verifyModalOpen: {{ $reopenModal === 'verify' ? 'true' : 'false' }},
                settingsModalOpen: {{ $reopenModal === 'settings' ? 'true' : 'false' }},
                badges: @js($sidebarBadges),
                idleTimeoutMinutes: {{ $adminIdleMinutes }},
                idleWarningOpen: false,
                idleCountdown: 60,
                _lastActivityMs: Date.now(),
                _lastHeartbeatMs: Date.now(),
                _idleLoggingOut: false,
                toast: {
                    show: {{ !empty($flashToast) ? 'true' : 'false' }},
                    title: @js($flashToast['title'] ?? ''),
                    message: @js($flashToast['message'] ?? ''),
                    type: @js($flashToast['type'] ?? 'success')
                },
                init() {
                    if (this.toast.show) {
                        setTimeout(() => {
                            this.toast.show = false;
                        }, 4500);
                    }

                    // Broadcast CMS update to open public website tabs whenever an admin mutation succeeds
                    @if ($didAdminMutate)
                        try {
                            const ts = String(Date.now());
                            localStorage.setItem('gat_cms_sync_ts', ts);
                            if (typeof BroadcastChannel !== 'undefined') {
                                const ch = new BroadcastChannel('gat_cms_sync');
                                ch.postMessage({
                                    type: 'cms_updated',
                                    ts
                                });
                                ch.close();
                            }
                        } catch (e) {}
                    @endif

                    // Listen for immediate public form submission broadcasts (same browser)
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            const ch = new BroadcastChannel('gat_cms_sync');
                            ch.onmessage = (ev) => {
                                if (ev?.data?.type === 'public_submission') {
                                    this.syncLiveBadges();
                                }
                            };
                        }
                    } catch (e) {}

                    // Global real-time badge & incoming alert poller across ALL 7 admin pages (every 8s)
                    setInterval(() => {
                        if (!document.hidden) {
                            this.syncLiveBadges();
                        }
                    }, 8000);

                    // Smart Auto-Lock: tracks mouse/keyboard/scroll activity + cross-tab sync + 60s countdown warning
                    if (this.idleTimeoutMinutes > 0) {
                        this.startSmartAutoLock();
                    }
                },
                startSmartAutoLock() {
                    const markActive = () => {
                        if (this.idleWarningOpen || this._idleLoggingOut) return;
                        const now = Date.now();
                        this._lastActivityMs = now;
                        try {
                            localStorage.setItem('gat_admin_activity_ts', String(now));
                        } catch (e) {}

                        // Keep server session clock fresh while admin types/works (throttled every 90s)
                        if ((now - this._lastHeartbeatMs) >= 90000) {
                            this._lastHeartbeatMs = now;
                            this.sendHeartbeat();
                        }
                    };

                    ['mousemove', 'mousedown', 'keydown', 'scroll', 'touchstart'].forEach((evt) => {
                        window.addEventListener(evt, markActive, {
                            passive: true
                        });
                    });

                    // Sync activity across multiple open Admin tabs
                    window.addEventListener('storage', (ev) => {
                        if (ev.key === 'gat_admin_activity_ts' && ev.newValue) {
                            const ts = Number(ev.newValue);
                            if (ts > this._lastActivityMs) {
                                this._lastActivityMs = ts;
                                this.idleWarningOpen = false;
                            }
                        }
                    });

                    setInterval(() => {
                        if (this.idleTimeoutMinutes <= 0 || this._idleLoggingOut) return;
                        const totalMs = this.idleTimeoutMinutes * 60 * 1000;
                        const remainingSec = Math.ceil((totalMs - (Date.now() - this
                            ._lastActivityMs)) / 1000);

                        if (remainingSec <= 0) {
                            this.forceIdleLogout();
                        } else if (remainingSec <= 60) {
                            this.idleWarningOpen = true;
                            this.idleCountdown = remainingSec;
                        } else if (this.idleWarningOpen) {
                            this.idleWarningOpen = false;
                        }
                    }, 1000);
                },
                sendHeartbeat() {
                    return fetch('{{ route('admin.profile.heartbeat') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(r => {
                        if (r.status === 401) window.location.href = '{{ route('login') }}';
                    }).catch(() => {});
                },
                stayLoggedIn() {
                    const now = Date.now();
                    this._lastActivityMs = now;
                    this._lastHeartbeatMs = now;
                    this.idleWarningOpen = false;
                    this.idleCountdown = 60;
                    try {
                        localStorage.setItem('gat_admin_activity_ts', String(now));
                    } catch (e) {}
                    this.sendHeartbeat();
                    this.showToast('Sesi administrator diperpanjang. Silakan lanjutkan pekerjaan Anda.',
                        'Sesi Diperpanjang', 'success');
                },
                forceIdleLogout() {
                    if (this._idleLoggingOut) return;
                    this._idleLoggingOut = true;
                    const form = document.getElementById('smart-idle-logout-form');
                    if (form) {
                        form.submit();
                    } else {
                        window.location.href = '{{ route('login') }}';
                    }
                },
                syncLiveBadges() {
                    fetch('{{ route('admin.api.live-traffic') }}', {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(r => {
                            if (r.status === 401) {
                                window.location.href = '{{ route('login') }}';
                                return null;
                            }
                            return r.ok ? r.json() : null;
                        })
                        .then(data => {
                            if (!data) return;
                            const prev = this.badges;
                            const next = {
                                today_visitors: Number(data.today ?? prev.today_visitors),
                                total_leads: Number(data.total_leads ?? prev.total_leads),
                                new_leads: Number(data.new_leads ?? prev.new_leads),
                                total_products: Number(data.total_products ?? prev.total_products),
                                total_orders: Number(data.total_orders ?? prev.total_orders),
                                new_orders: Number(data.new_orders ?? prev.new_orders),
                                total_solutions: Number(data.total_solutions ?? prev
                                    .total_solutions),
                                total_projects: Number(data.total_projects ?? prev.total_projects),
                                total_inquiries: Number(data.total_inquiries ?? prev
                                    .total_inquiries),
                                unread_inquiries: Number(data.unread_inquiries ?? prev
                                    .unread_inquiries),
                                active_channels: Number(data.active_channels ?? prev
                                    .active_channels),
                            };

                            if (next.new_orders > prev.new_orders) {
                                this.showToast(
                                    'Ada pengajuan pesanan / Sales Quote B2B baru masuk dari website.',
                                    'Pesanan B2B Baru', 'info');
                            } else if (next.unread_inquiries > prev.unread_inquiries) {
                                this.showToast(
                                    'Ada pesan formulir kontak baru masuk dari pengunjung website.',
                                    'Pesan Kontak Baru', 'info');
                            } else if (next.new_leads > prev.new_leads) {
                                this.showToast(
                                    'Ada prospek baru yang menjalankan simulator otomasi di website.',
                                    'Prospek Simulator Baru', 'info');
                            }

                            this.badges = next;
                        })
                        .catch(() => {});
                },
                showToast(message, title = 'Berhasil', type = 'success') {
                    this.toast = {
                        show: true,
                        title,
                        message,
                        type
                    };
                    setTimeout(() => {
                        this.toast.show = false;
                    }, 4500);
                }
            });
        });

        // Global keyboard shortcut: Ctrl+F or Cmd+F focuses the Admin Search input
        window.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'f') {
                e.preventDefault();
                const searchInput = document.getElementById('admin-search-input');
                if (searchInput) {
                    searchInput.focus();
                    searchInput.select();
                }
            }
        });

        // Strict boundary lock: khusus desktop (>=1024px) agar scroll sentuh HP & tablet tetap mulus alami
        document.addEventListener('DOMContentLoaded', () => {
            const lockBoundaries = (el) => {
                if (!el || el._hasScrollLock) return;
                el._hasScrollLock = true;

                el.addEventListener('wheel', (e) => {
                    if (window.innerWidth < 1024) return;
                    const isAtTop = el.scrollTop <= 0;
                    const isAtBottom = Math.ceil(el.scrollTop + el.clientHeight) >= el.scrollHeight;
                    if ((isAtTop && e.deltaY < 0) || (isAtBottom && e.deltaY > 0)) {
                        e.preventDefault();
                    }
                }, {
                    passive: false
                });
            };

            const initLocks = () => {
                if (window.innerWidth < 1024) return;
                document.querySelectorAll('main, aside, .overflow-y-auto').forEach(lockBoundaries);
            };

            initLocks();
            const observer = new MutationObserver(initLocks);
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
    </script>
</head>

<body
    class="bg-[#eef4f9] bg-gradient-to-br from-[#ebf3fa] via-[#e6eff7] to-[#dbe8f5] text-slate-900 antialiased font-['Questrial',sans-serif] min-h-screen lg:h-screen lg:max-h-screen lg:overflow-hidden p-2 sm:p-3 lg:p-4 flex flex-col lg:justify-center relative"
    x-data>

    @php
        $gaugeOffset = round(87.96 - 87.96 * ($profileProgress / 100), 2);
        $isComplete = $profileProgress >= 100 && $isIdentityVerified;
    @endphp

    <!-- Outermost Rounded Dashboard Container (Blue & White Theme) -->
    <div
        class="w-full max-w-[1760px] mx-auto bg-white rounded-[24px] lg:rounded-[32px] p-2 sm:p-3 lg:p-3.5 border border-[#3367A5]/15 shadow-[0_20px_50px_rgba(51,103,165,0.08)] flex flex-col lg:flex-row min-h-[calc(100vh-1rem)] lg:min-h-0 lg:h-[calc(100vh-2rem)] lg:overflow-hidden">

        <!-- ============================================================== -->
        <!-- MOBILE & TABLET COMPACT HEADER (< lg)                          -->
        <!-- ============================================================== -->
        <header
            class="lg:hidden flex items-center justify-between gap-2 px-3.5 py-2.5 mb-2.5 rounded-[20px] text-white bg-gradient-to-r from-[#2B588F] via-[#3367A5] to-[#244E81] shadow-md shrink-0">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-2.5 min-w-0 focus:outline-none select-none">
                <div
                    class="w-9 h-9 rounded-xl bg-white p-1.5 flex items-center justify-center shrink-0 shadow-xs border border-white/20">
                    <img src="{{ asset('storage/Logo_Perusahaan(1).png') }}?v={{ time() }}" alt="GAT Logo"
                        class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col justify-center min-w-0">
                    <span
                        class="text-sm font-bold font-['Agrandir',sans-serif] tracking-tight text-white leading-tight truncate">GAT
                        Dashboard</span>
                    <span
                        class="text-[8.5px] uppercase tracking-wider text-blue-100/90 font-medium leading-tight mt-0.5 truncate">PT
                        GLOBAL ASPECT TECHNOLOGY</span>
                </div>
            </a>

            <div class="flex items-center gap-1.5 shrink-0">
                @if (!$isComplete)
                    <button type="button" @click="$store.admin.verifyModalOpen = true"
                        class="h-8 px-2.5 rounded-xl bg-white text-[#3367A5] text-[10px] font-bold font-['Agrandir',sans-serif] inline-flex items-center justify-center leading-none shadow-xs cursor-pointer">
                        {{ $profileProgress }}%
                    </button>
                @endif

                <button type="button" @click="$store.admin.settingsModalOpen = true"
                    class="relative w-8 h-8 rounded-full shrink-0 cursor-pointer focus:outline-none"
                    title="Pengaturan Akun &amp; Keamanan">
                    @if ($adminAvatarUrl)
                        <img src="{{ $adminAvatarUrl }}" alt="{{ $adminUser?->name ?? 'Administrator' }}"
                            class="w-8 h-8 rounded-full object-cover border-2 border-white/50">
                    @else
                        <div
                            class="w-8 h-8 rounded-full bg-white text-[#3367A5] border-2 border-white/50 flex items-center justify-center font-bold text-[10px] font-['Agrandir',sans-serif]">
                            {{ $adminInitials }}
                        </div>
                    @endif
                </button>

                <button type="button" @click="$store.admin.settingsModalOpen = true"
                    class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-white inline-flex items-center justify-center transition cursor-pointer"
                    title="Pengaturan Akun &amp; Keamanan">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>

                <form action="{{ route('logout') }}" method="POST" class="inline-flex m-0 p-0"
                    onsubmit="return confirm('Keluar dari panel Admin?')">
                    @csrf
                    <button type="submit"
                        class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-white inline-flex items-center justify-center transition cursor-pointer"
                        title="Keluar (Logout)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- ============================================================== -->
        <!-- DESKTOP LEFT SIDEBAR (ONLY >= lg / 1024px)                     -->
        <!-- ============================================================== -->
        <aside
            class="hidden lg:flex lg:w-64 xl:w-72 shrink-0 p-5 flex-col justify-between text-white bg-gradient-to-b from-[#2B588F] via-[#3367A5] to-[#244E81] rounded-[26px] shadow-lg h-full overflow-y-auto overscroll-contain">

            <div class="space-y-6">
                <!-- Sidebar Header: Company Logo & Brand -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 group focus:outline-none select-none">
                        <!-- Company Logo Badge: Centered Top-Bottom Left-Right -->
                        <div
                            class="w-11 h-11 rounded-2xl bg-white p-2 flex items-center justify-center shrink-0 shadow-sm border border-white/20">
                            <img src="{{ asset('storage/Logo_Perusahaan(1).png') }}?v={{ time() }}"
                                alt="GAT Logo" class="w-full h-full object-contain">
                        </div>
                        <div class="flex flex-col justify-center min-w-0">
                            <span
                                class="text-base font-bold font-['Agrandir',sans-serif] tracking-tight text-white leading-tight">GAT
                                Dashboard</span>
                            <span
                                class="text-[9.5px] uppercase tracking-wider text-blue-100/90 font-medium leading-tight mt-1 whitespace-nowrap">PT
                                GLOBAL ASPECT TECHNOLOGY</span>
                        </div>
                    </a>

                    <!-- Mobile Menu Toggle Button -->
                    <button type="button" @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden text-white/80 hover:text-white p-1.5 focus:outline-none" title="Toggle Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links (7 Core CMS & CRM Modules) -->
                <nav class="space-y-1.5 pt-2" :class="{ 'block': sidebarOpen, 'hidden lg:block': !sidebarOpen }">
                    <!-- 1. Dashboard Overview -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="truncate">Dashboard</span>
                        </span>
                        @unless (request()->routeIs('admin.dashboard'))
                            <span class="sidebar-badge" title="Kunjungan website hari ini"
                                x-text="$store.admin.badges.today_visitors">{{ $sidebarBadges['today_visitors'] }}</span>
                        @endunless
                    </a>

                    <!-- 2. Simulator Leads (Prospek Simulasi Aplikasi) -->
                    <a href="{{ route('admin.leads.index') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.leads.*') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.leads.*') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="truncate">Simulator Leads</span>
                        </span>
                        @unless (request()->routeIs('admin.leads.*'))
                            <span class="sidebar-badge" title="Total prospek simulator"
                                x-text="$store.admin.badges.total_leads">{{ $sidebarBadges['total_leads'] }}</span>
                        @endunless
                    </a>

                    <!-- 3. Products Catalog (CRUD & Upload Foto) -->
                    <a href="{{ route('admin.product.index') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.product.*') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.product.*') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="truncate">Cards &amp; Products</span>
                        </span>
                        @unless (request()->routeIs('admin.product.*'))
                            <span class="sidebar-badge" title="Total produk katalog"
                                x-text="$store.admin.badges.total_products">{{ $sidebarBadges['total_products'] }}</span>
                        @endunless
                    </a>

                    <!-- 4. Orders & RFQ (Tracking Checkout & WhatsApp Click) -->
                    <a href="{{ route('admin.orders.index') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.orders.*') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.orders.*') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="truncate">Orders &amp; RFQ</span>
                        </span>
                        @unless (request()->routeIs('admin.orders.*'))
                            <span class="sidebar-badge" title="Total pesanan &amp; RFQ"
                                x-text="$store.admin.badges.total_orders">{{ $sidebarBadges['total_orders'] }}</span>
                        @endunless
                    </a>

                    <!-- 5. Solutions (CRUD & Dynamic Navbar Integration) -->
                    <a href="{{ route('admin.solutions.index') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.solutions.*') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.solutions.*') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span class="truncate">Solutions</span>
                        </span>
                        @unless (request()->routeIs('admin.solutions.*'))
                            <span class="sidebar-badge" title="Total layanan solusi"
                                x-text="$store.admin.badges.total_solutions">{{ $sidebarBadges['total_solutions'] }}</span>
                        @endunless
                    </a>

                    <!-- 6. Projects & Portfolio (CRUD Proyek Dinamis) -->
                    <a href="{{ route('admin.projects.index') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.projects.*') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.projects.*') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="truncate">Projects</span>
                        </span>
                        @unless (request()->routeIs('admin.projects.*'))
                            <span class="sidebar-badge" title="Total portofolio proyek"
                                x-text="$store.admin.badges.total_projects">{{ $sidebarBadges['total_projects'] }}</span>
                        @endunless
                    </a>

                    <!-- 7. Contact Inquiries (Pesan Masuk Contact Us) -->
                    <a href="{{ route('admin.contacts.index') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.contacts.*') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.contacts.*') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="truncate">Contact Inquiries</span>
                        </span>
                        @unless (request()->routeIs('admin.contacts.*'))
                            <span class="sidebar-badge" title="Total pesan masuk"
                                x-text="$store.admin.badges.total_inquiries">{{ $sidebarBadges['total_inquiries'] }}</span>
                        @endunless
                    </a>

                    <!-- 8. WhatsApp Gateway, Webhook & Social Media -->
                    <a href="{{ route('admin.integrations.index') }}"
                        class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.integrations.*') ? 'bg-white text-[#3367A5] shadow-md font-bold' : 'text-white/85 hover:text-white hover:bg-white/10' }}">
                        <span class="flex items-center gap-3 min-w-0">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.integrations.*') ? 'text-[#3367A5]' : 'text-white/85' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <span class="truncate">WA &amp; Social</span>
                        </span>
                        @unless (request()->routeIs('admin.integrations.*'))
                            <span class="sidebar-badge" title="Kanal WA &amp; Social Media aktif"
                                x-text="$store.admin.badges.active_channels">{{ $sidebarBadges['active_channels'] }}</span>
                        @endunless
                    </a>
                </nav>
            </div>

            <!-- Lower Sidebar Section: Floating White Card (Only When < 100%) & Real Admin Profile -->
            <div class="pt-6 space-y-4" :class="{ 'block': sidebarOpen, 'hidden lg:block': !sidebarOpen }">

                @php
                    $gaugeOffset = round(87.96 - 87.96 * ($profileProgress / 100), 2);
                    $isComplete = $profileProgress >= 100 && $isIdentityVerified;
                @endphp

                @if (!$isComplete)
                    <!-- Real Database-Backed Profile Completeness Card (Hidden automatically at 100%) -->
                    <div class="bg-white rounded-[22px] p-4 text-slate-900 shadow-md flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div class="relative w-11 h-11 shrink-0 flex items-center justify-center">
                                <svg class="w-11 h-11 -rotate-90" viewBox="0 0 36 36">
                                    <circle cx="18" cy="18" r="14" fill="none"
                                        class="stroke-slate-100" stroke-width="3.2"></circle>
                                    <circle cx="18" cy="18" r="14" fill="none" stroke="#3367A5"
                                        stroke-width="3.2" stroke-dasharray="87.96"
                                        stroke-dashoffset="{{ $gaugeOffset }}" stroke-linecap="round"
                                        class="transition-all duration-700"></circle>
                                </svg>
                                <span
                                    class="absolute text-[10px] font-bold font-['Agrandir',sans-serif] text-[#3367A5]">
                                    {{ $profileProgress }}%
                                </span>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <h4
                                    class="text-xs font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight truncate">
                                    Lengkapi Profil
                                </h4>
                                <p class="text-[10px] text-slate-500 font-['Questrial',sans-serif] leading-tight">
                                    Lengkapi data admin &amp; verifikasi akun
                                </p>
                            </div>
                        </div>
                        <button type="button" @click="$store.admin.verifyModalOpen = true"
                            class="w-full py-2 px-3 rounded-xl font-bold text-xs font-['Agrandir',sans-serif] text-center transition shadow-xs cursor-pointer active:scale-95 bg-[#3367A5] hover:bg-[#255187] text-white">
                            Verifikasi Profil
                        </button>
                    </div>
                @endif

                <!-- Admin User Profile Bar at Bottom -->
                <div class="flex items-center justify-between gap-2 pt-1 px-1">
                    <button type="button" @click="$store.admin.settingsModalOpen = true"
                        class="flex items-center gap-2.5 min-w-0 flex-1 text-left cursor-pointer group focus:outline-none"
                        title="Buka Pengaturan Akun Administrator">
                        <div class="relative w-10 h-10 rounded-full shrink-0">
                            @if ($adminAvatarUrl)
                                <img src="{{ $adminAvatarUrl }}" alt="{{ $adminUser?->name ?? 'Administrator' }}"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-white/40 group-hover:ring-2 group-hover:ring-white transition">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-white text-[#3367A5] border-2 border-white/40 flex items-center justify-center font-bold text-xs font-['Agrandir',sans-serif] shadow-xs group-hover:ring-2 group-hover:ring-white transition">
                                    {{ $adminInitials }}
                                </div>
                            @endif
                            @if ($isIdentityVerified)
                                <span
                                    class="absolute -bottom-0.5 -right-0.5 w-4 h-4 rounded-full bg-emerald-500 border-2 border-[#244E81] flex items-center justify-center text-white"
                                    title="Terverifikasi">
                                    <i class="fa-solid fa-check text-[7px]"></i>
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span
                                class="text-xs font-bold text-white font-['Agrandir',sans-serif] truncate group-hover:underline leading-tight">
                                {{ $adminUser?->name ?? 'Administrator' }}
                            </span>
                            <span
                                class="text-[11px] text-blue-100/80 font-['Questrial',sans-serif] truncate leading-tight mt-0.5">
                                {{ $adminUser?->email ?? 'admin@admin.com' }}
                            </span>
                        </div>
                    </button>

                    <!-- Actions: Settings Modal & Logout -->
                    <div class="flex items-center gap-0.5 shrink-0">
                        <button type="button" @click="$store.admin.settingsModalOpen = true"
                            class="text-white/80 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition cursor-pointer"
                            title="Pengaturan Akun &amp; Sandi">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>

                        <form action="{{ route('logout') }}" method="POST" class="inline-flex m-0 p-0"
                            onsubmit="return confirm('Keluar dari panel Admin?')">
                            @csrf
                            <button type="submit"
                                class="text-white/80 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition cursor-pointer"
                                title="Keluar (Logout)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </aside>

        <!-- Right Main Canvas (Crisp Clean White Surface with Soft Blue Tints) -->
        <main
            class="flex-1 min-w-0 bg-[#f8fafd] rounded-[20px] lg:rounded-[26px] p-3.5 sm:p-5 lg:p-7 pb-24 lg:pb-7 flex flex-col lg:overflow-y-auto lg:h-full lg:max-h-full ml-0 lg:ml-2.5 border border-[#3367A5]/10 relative lg:overscroll-contain">

            <!-- Page Content Body -->
            <div class="flex-1 relative z-10 min-w-0">
                @yield('content')
            </div>

        </main>

    </div>

    <!-- ============================================================== -->
    <!-- MOBILE & TABLET CORPORATE BOTTOM NAVIGATION BAR (< lg / 1024px) -->
    <!-- Zero horizontal scroll: 4 Core + Hamburger Menu on Phone, 8-col on Tablet -->
    <!-- ============================================================== -->
    @php
        $isMoreMenuActive = request()->routeIs(
            'admin.solutions.*',
            'admin.projects.*',
            'admin.contacts.*',
            'admin.integrations.*',
        );
    @endphp
    <div class="lg:hidden" x-data="{ moreMenuOpen: false }">

        <!-- Slide-Up Hamburger Menu Sheet (Phone: Solutions, Projects, Contact Inquiries, WA & Social) -->
        <div x-cloak x-show="moreMenuOpen" @click="moreMenuOpen = false"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="md:hidden fixed inset-0 z-40 bg-slate-900/45 backdrop-blur-[1px]"></div>

        <div x-cloak x-show="moreMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="md:hidden fixed left-3 right-3 bottom-[calc(4.9rem+env(safe-area-inset-bottom))] z-50 bg-gradient-to-b from-[#2B588F] via-[#3367A5] to-[#244E81] text-white rounded-[24px] p-3.5 shadow-2xl border border-white/20">
            <div class="flex items-center justify-between px-1.5 pb-2.5 mb-2 border-b border-white/15">
                <span class="text-xs font-bold font-['Agrandir',sans-serif] tracking-wide text-white">Menu
                    Lainnya</span>
                <button type="button" @click="moreMenuOpen = false"
                    class="w-7 h-7 rounded-xl bg-white/10 hover:bg-white/20 text-white inline-flex items-center justify-center cursor-pointer transition">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
            <div class="space-y-1.5">
                <a href="{{ route('admin.solutions.index') }}"
                    class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.solutions.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/90 hover:bg-white/10' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Solutions</span>
                    </span>
                    @unless (request()->routeIs('admin.solutions.*'))
                        <span class="sidebar-badge"
                            x-text="$store.admin.badges.total_solutions">{{ $sidebarBadges['total_solutions'] }}</span>
                    @endunless
                </a>

                <a href="{{ route('admin.projects.index') }}"
                    class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.projects.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/90 hover:bg-white/10' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Projects</span>
                    </span>
                    @unless (request()->routeIs('admin.projects.*'))
                        <span class="sidebar-badge"
                            x-text="$store.admin.badges.total_projects">{{ $sidebarBadges['total_projects'] }}</span>
                    @endunless
                </a>

                <a href="{{ route('admin.contacts.index') }}"
                    class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/90 hover:bg-white/10' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Contact Inquiries</span>
                    </span>
                    @unless (request()->routeIs('admin.contacts.*'))
                        <span class="sidebar-badge"
                            x-text="$store.admin.badges.total_inquiries">{{ $sidebarBadges['total_inquiries'] }}</span>
                    @endunless
                </a>

                <a href="{{ route('admin.integrations.index') }}"
                    class="flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.integrations.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/90 hover:bg-white/10' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        <span>WA &amp; Social</span>
                    </span>
                    @unless (request()->routeIs('admin.integrations.*'))
                        <span class="sidebar-badge"
                            x-text="$store.admin.badges.active_channels">{{ $sidebarBadges['active_channels'] }}</span>
                    @endunless
                </a>
            </div>
        </div>

        <!-- Fixed Corporate Bottom Navigation Bar (No Horizontal Scroll) -->
        <nav aria-label="Navigasi Admin Mobile &amp; Tablet"
            class="fixed bottom-0 inset-x-0 z-50 bg-gradient-to-r from-[#244E81] via-[#3367A5] to-[#2B588F] text-white rounded-t-[24px] border-t border-white/20 shadow-[0_-10px_30px_rgba(36,78,129,0.28)] px-2 pt-2 pb-[calc(0.55rem+env(safe-area-inset-bottom))]">
            <div class="grid grid-cols-5 md:grid-cols-8 gap-1 max-w-4xl mx-auto">

                <!-- 1. Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="relative flex flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Dashboard</span>
                    @unless (request()->routeIs('admin.dashboard'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.today_visitors">{{ $sidebarBadges['today_visitors'] }}</span>
                    @endunless
                </a>

                <!-- 2. Simulator Leads -->
                <a href="{{ route('admin.leads.index') }}"
                    class="relative flex flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.leads.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Leads</span>
                    @unless (request()->routeIs('admin.leads.*'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.total_leads">{{ $sidebarBadges['total_leads'] }}</span>
                    @endunless
                </a>

                <!-- 3. Cards & Products -->
                <a href="{{ route('admin.product.index') }}"
                    class="relative flex flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.product.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Products</span>
                    @unless (request()->routeIs('admin.product.*'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.total_products">{{ $sidebarBadges['total_products'] }}</span>
                    @endunless
                </a>

                <!-- 4. Orders & RFQ -->
                <a href="{{ route('admin.orders.index') }}"
                    class="relative flex flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.orders.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Orders</span>
                    @unless (request()->routeIs('admin.orders.*'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.total_orders">{{ $sidebarBadges['total_orders'] }}</span>
                    @endunless
                </a>

                <!-- 5 (Phone Only): Hamburger Menu Toggle for Solutions, Projects, Inbox, WA & Social -->
                <button type="button" @click="moreMenuOpen = !moreMenuOpen"
                    :class="(moreMenuOpen || {{ $isMoreMenuActive ? 'true' : 'false' }}) ?
                    'bg-white text-[#3367A5] shadow-sm font-bold' :
                    'text-white/85 hover:text-white hover:bg-white/10 font-medium'"
                    class="md:hidden relative flex flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 cursor-pointer focus:outline-none">
                    <svg x-show="!moreMenuOpen" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="moreMenuOpen" x-cloak class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Menu</span>
                </button>

                <!-- 5–8 (Tablet Only >= md): Direct Equal 8-Column Tabs, Zero Scroll -->
                <a href="{{ route('admin.solutions.index') }}"
                    class="hidden md:flex relative flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.solutions.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Solutions</span>
                    @unless (request()->routeIs('admin.solutions.*'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.total_solutions">{{ $sidebarBadges['total_solutions'] }}</span>
                    @endunless
                </a>

                <a href="{{ route('admin.projects.index') }}"
                    class="hidden md:flex relative flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.projects.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Projects</span>
                    @unless (request()->routeIs('admin.projects.*'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.total_projects">{{ $sidebarBadges['total_projects'] }}</span>
                    @endunless
                </a>

                <a href="{{ route('admin.contacts.index') }}"
                    class="hidden md:flex relative flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.contacts.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">Inbox</span>
                    @unless (request()->routeIs('admin.contacts.*'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.total_inquiries">{{ $sidebarBadges['total_inquiries'] }}</span>
                    @endunless
                </a>

                <a href="{{ route('admin.integrations.index') }}"
                    class="hidden md:flex relative flex-col items-center justify-center gap-1 py-1.5 px-1 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.integrations.*') ? 'bg-white text-[#3367A5] shadow-sm font-bold' : 'text-white/85 hover:text-white hover:bg-white/10 font-medium' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    <span class="text-[10px] leading-none truncate max-w-full">WA &amp; Social</span>
                    @unless (request()->routeIs('admin.integrations.*'))
                        <span class="bottom-nav-badge"
                            x-text="$store.admin.badges.active_channels">{{ $sidebarBadges['active_channels'] }}</span>
                    @endunless
                </a>

            </div>
        </nav>
    </div>

    <!-- ============================================================== -->
    <!-- GLOBAL TOAST NOTIFICATION COMPONENT                            -->
    <!-- ============================================================== -->
    <div x-cloak x-show="$store.admin.toast.show" x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-3 left-3 right-3 sm:left-auto sm:top-5 sm:right-5 z-[60] sm:max-w-sm sm:w-full bg-white rounded-2xl shadow-2xl border border-[#3367A5]/25 p-4 pointer-events-auto flex items-start gap-3.5">
        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-white shadow-xs"
            :class="{
                'bg-emerald-500': $store.admin.toast.type === 'success',
                'bg-[#3367A5]': $store.admin.toast.type === 'info',
                'bg-amber-500': $store.admin.toast.type === 'warning',
                'bg-rose-500': $store.admin.toast.type === 'error'
            }">
            <template x-if="$store.admin.toast.type === 'success'"><i
                    class="fa-solid fa-check text-xs"></i></template>
            <template x-if="$store.admin.toast.type === 'info'"><i class="fa-solid fa-info text-xs"></i></template>
            <template x-if="$store.admin.toast.type === 'warning'"><i
                    class="fa-solid fa-triangle-exclamation text-xs"></i></template>
            <template x-if="$store.admin.toast.type === 'error'"><i class="fa-solid fa-xmark text-xs"></i></template>
        </div>
        <div class="flex-1 min-w-0">
            <h5 class="text-xs font-bold text-slate-900 font-['Agrandir',sans-serif]"
                x-text="$store.admin.toast.title"></h5>
            <p class="text-[11px] text-slate-600 mt-0.5 leading-snug" x-text="$store.admin.toast.message"></p>
        </div>
        <button type="button" @click="$store.admin.toast.show = false"
            class="text-slate-400 hover:text-slate-600 p-1">
            <i class="fa-solid fa-xmark text-xs"></i>
        </button>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: LENGKAPI & VERIFIKASI PROFIL ADMINISTRATOR (REAL DB)    -->
    <!-- ============================================================== -->
    <div x-cloak x-show="$store.admin.verifyModalOpen"
        class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center p-3 sm:p-4 bg-slate-900/60 backdrop-blur-xs overflow-hidden"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-data="{ avatarPreview: @js($adminAvatarUrl ?? '') }">
        <form method="POST" action="{{ route('admin.profile.verify') }}" enctype="multipart/form-data"
            class="bg-white rounded-[28px] max-w-md w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[90vh] overflow-hidden my-auto"
            @click.outside="$store.admin.verifyModalOpen = false">
            @csrf
            @method('PUT')

            <!-- Pinned Header -->
            <div
                class="px-6 pt-5 pb-3.5 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold shrink-0">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none">
                        Verifikasi Profil Administrator
                    </h3>
                </div>
                <button type="button" @click="$store.admin.verifyModalOpen = false"
                    class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Smooth Scrollable Body -->
            <div class="flex-1 overflow-y-auto px-6 py-4 space-y-4 text-xs overscroll-contain">
                <!-- Real Progress Checklist -->
                <div class="p-3.5 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-2">
                    <div class="flex items-center justify-between text-[11px] font-bold font-['Agrandir',sans-serif]">
                        <span class="text-slate-700">Kelengkapan Profil</span>
                        <span
                            class="{{ $profileProgress >= 100 ? 'text-emerald-600' : 'text-[#3367A5]' }}">{{ $profileProgress }}%</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-slate-200/80 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 {{ $profileProgress >= 100 ? 'bg-emerald-500' : 'bg-[#3367A5]' }}"
                            style="width: {{ $profileProgress }}%"></div>
                    </div>
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        @foreach ($profileChecklist as $item)
                            <span
                                class="px-2 py-0.5 rounded-md text-[10px] font-semibold inline-flex items-center gap-1 {{ $item['done'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/80' : 'bg-white text-slate-500 border border-slate-200' }}">
                                <i
                                    class="fa-solid {{ $item['done'] ? 'fa-check text-emerald-500' : 'fa-circle text-[6px] text-slate-300' }}"></i>
                                <span>{{ $item['label'] }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Avatar Upload with Preview -->
                <div class="flex items-center gap-3.5">
                    <div
                        class="w-14 h-14 rounded-full overflow-hidden border-2 border-[#3367A5]/20 bg-blue-50 flex items-center justify-center shrink-0">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="Preview Avatar" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!avatarPreview">
                            <span
                                class="font-bold text-sm font-['Agrandir',sans-serif] text-[#3367A5]">{{ $adminInitials }}</span>
                        </template>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Foto Profil
                            (Opsional)</label>
                        <input type="file" name="avatar" accept="image/*"
                            @change="if ($event.target.files?.[0]) avatarPreview = URL.createObjectURL($event.target.files[0])"
                            class="w-full text-[11px] text-slate-600 file:mr-2.5 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-[#3367A5] file:font-bold file:cursor-pointer cursor-pointer">
                    </div>
                </div>

                <div>
                    <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Nama Lengkap
                        Administrator *</label>
                    <input type="text" name="name" value="{{ old('name', $adminUser?->name) }}" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                </div>

                <div>
                    <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Email Korporat
                        *</label>
                    <input type="email" name="email" value="{{ old('email', $adminUser?->email) }}" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">WhatsApp
                            Operasional *</label>
                        <input type="text" name="phone" value="{{ old('phone', $adminUser?->phone) }}"
                            placeholder="0812-xxxx-xxxx" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Jabatan /
                            Divisi *</label>
                        <input type="text" name="job_title"
                            value="{{ old('job_title', $adminUser?->job_title) }}"
                            placeholder="Sales &amp; Engineering Admin" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                    </div>
                </div>
            </div>

            <!-- Pinned Footer -->
            <div class="px-6 py-4 border-t border-slate-100 flex items-center gap-3 shrink-0 bg-white">
                <button type="button" @click="$store.admin.verifyModalOpen = false"
                    class="flex-1 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95">
                    Simpan &amp; Verifikasi
                </button>
            </div>
        </form>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: PENGATURAN AKUN & KEAMANAN KETAT ADMINISTRATOR (3 TAB)  -->
    <!-- ============================================================== -->
    <div x-cloak x-show="$store.admin.settingsModalOpen"
        class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center p-3 sm:p-4 bg-slate-900/60 backdrop-blur-xs overflow-hidden"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-data="{
            activeTab: @js($initialSettingsTab),
            settingsAvatarPreview: @js($adminAvatarUrl ?? ''),
            removeAvatar: false,
            originalEmail: @js($adminUser?->email ?? ''),
            emailInput: @js(old('email', $adminUser?->email ?? '')),
            showCurrentPassProfile: false,
            showCurrentPassSec: false,
            showNewPass: false,
            showConfirmPass: false,
            newPass: '',
            confirmPass: '',
            twoFaSetupLoading: false,
            twoFaQrSvg: '',
            twoFaFormattedSecret: '',
            twoFaShowDisable: false,
            copiedSecret: false,
            copiedRecovery: false,
            get emailChanged() {
                return (this.emailInput || '').trim().toLowerCase() !== (this.originalEmail || '').trim().toLowerCase();
            },
            get passRules() {
                const p = this.newPass || '';
                return {
                    len: p.length >= 10,
                    mixed: /[a-z]/.test(p) && /[A-Z]/.test(p),
                    num: /[0-9]/.test(p),
                    sym: /[^A-Za-z0-9]/.test(p),
                };
            },
            get passScore() {
                const r = this.passRules;
                return (r.len ? 1 : 0) + (r.mixed ? 1 : 0) + (r.num ? 1 : 0) + (r.sym ? 1 : 0);
            },
            get passStrengthLabel() {
                if (!this.newPass) return '';
                return ['Sangat Lemah', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat (Ketat)'][this.passScore];
            },
            async startTwoFactorSetup() {
                this.twoFaSetupLoading = true;
                try {
                    const res = await fetch('{{ route('admin.profile.2fa.setup') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (res.ok) {
                        const data = await res.json();
                        this.twoFaQrSvg = data.qr_svg || '';
                        this.twoFaFormattedSecret = data.formatted_secret || data.secret || '';
                    }
                } catch (e) {}
                this.twoFaSetupLoading = false;
            },
            copyText(text, flag) {
                if (!text) return;
                navigator.clipboard?.writeText(text).then(() => {
                    this[flag] = true;
                    setTimeout(() => { this[flag] = false; }, 2200);
                });
            }
        }">
        <div class="bg-white rounded-[28px] max-w-lg w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[90vh] overflow-hidden my-auto"
            @click.outside="$store.admin.settingsModalOpen = false">

            <!-- Pinned Header -->
            <div class="px-6 pt-5 pb-3 border-b border-slate-100 shrink-0 bg-white space-y-3.5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div
                            class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold shrink-0">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight">
                                Pengaturan Akun &amp; Keamanan
                            </h3>
                            <p class="text-[11px] text-slate-500">Proteksi ketat portal Administrator</p>
                        </div>
                    </div>
                    <button type="button" @click="$store.admin.settingsModalOpen = false"
                        class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- 4 Security & Admin Tabs -->
                <div
                    class="grid grid-cols-2 sm:grid-cols-4 gap-1.5 p-1 rounded-2xl bg-[#f1f6fc] border border-[#3367A5]/10 text-[11px] font-bold font-['Questrial',sans-serif]">
                    <button type="button" @click="activeTab = 'profile'"
                        :class="activeTab === 'profile' ? 'bg-white text-[#3367A5] shadow-xs' :
                            'text-slate-500 hover:text-slate-800'"
                        class="h-9 px-2 rounded-xl transition inline-flex items-center justify-center gap-1.5 leading-none text-center cursor-pointer">
                        <i class="fa-solid fa-user-gear text-[11px] leading-none"></i>
                        <span class="leading-none">Profil</span>
                    </button>
                    <button type="button" @click="activeTab = 'security'"
                        :class="activeTab === 'security' ? 'bg-white text-[#3367A5] shadow-xs' :
                            'text-slate-500 hover:text-slate-800'"
                        class="h-9 px-2 rounded-xl transition inline-flex items-center justify-center gap-1.5 leading-none text-center cursor-pointer">
                        <i class="fa-solid fa-key text-[11px] leading-none"></i>
                        <span class="leading-none">Sandi &amp; 2FA</span>
                    </button>
                    <button type="button" @click="activeTab = 'sessions'"
                        :class="activeTab === 'sessions' ? 'bg-white text-[#3367A5] shadow-xs' :
                            'text-slate-500 hover:text-slate-800'"
                        class="h-9 px-2 rounded-xl transition inline-flex items-center justify-center gap-1.5 leading-none text-center cursor-pointer">
                        <i class="fa-solid fa-clock-rotate-left text-[11px] leading-none"></i>
                        <span class="leading-none">Sesi &amp; Audit</span>
                    </button>
                    <button type="button" @click="activeTab = 'admins'"
                        :class="activeTab === 'admins' ? 'bg-white text-[#3367A5] shadow-xs' :
                            'text-slate-500 hover:text-slate-800'"
                        class="h-9 px-2 rounded-xl transition inline-flex items-center justify-center gap-1.5 leading-none text-center cursor-pointer">
                        <i class="fa-solid fa-users-gear text-[11px] leading-none"></i>
                        <span class="leading-none">Kelola Admin</span>
                    </button>
                </div>
            </div>

            <!-- Validation Errors Banner (if any) -->
            @if ($errors->hasAny(['name', 'email', 'current_password', 'new_password', 'code', 'idle_timeout_minutes', 'new_admin_name', 'new_admin_email', 'new_admin_password', 'reset_password']))
                <div
                    class="mx-6 mt-3 p-3 rounded-xl bg-rose-50 border border-rose-200 text-[11px] text-rose-700 space-y-0.5 shrink-0">
                    @foreach ($errors->all() as $err)
                        <p class="flex items-start gap-1.5"><i
                                class="fa-solid fa-circle-exclamation mt-0.5 shrink-0"></i><span>{{ $err }}</span>
                        </p>
                    @endforeach
                </div>
            @endif

            <!-- Smooth Scrollable Body -->
            <div class="flex-1 overflow-y-auto px-6 py-4 text-xs overscroll-contain">

                <!-- ========================================= -->
                <!-- TAB 1: PROFIL & KONTAK                    -->
                <!-- ========================================= -->
                <form x-show="activeTab === 'profile'" method="POST"
                    action="{{ route('admin.profile.settings') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="active_tab" value="profile">
                    <input type="hidden" name="remove_avatar" :value="removeAvatar ? '1' : '0'">

                    @if ($isDefaultAdminEmail)
                        <div
                            class="p-3 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-[11px] flex items-start gap-2.5">
                            <i class="fa-solid fa-triangle-exclamation text-amber-500 mt-0.5 shrink-0"></i>
                            <div class="leading-relaxed">
                                <span class="font-bold">Rekomendasi Keamanan:</span> Akun masih memakai email bawaan
                                <span class="font-mono font-bold">admin@admin.com</span>. Ganti ke email korporat PT
                                Global Aspect Technology agar lebih aman dari serangan tebak akun.
                            </div>
                        </div>
                    @endif

                    <!-- Avatar Upload / Remove -->
                    <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-[#f8fafd] border border-slate-200/80">
                        <div
                            class="w-12 h-12 rounded-full overflow-hidden border-2 border-[#3367A5]/20 bg-blue-50 flex items-center justify-center shrink-0">
                            <template x-if="settingsAvatarPreview && !removeAvatar">
                                <img :src="settingsAvatarPreview" alt="Avatar" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!settingsAvatarPreview || removeAvatar">
                                <span
                                    class="font-bold text-xs font-['Agrandir',sans-serif] text-[#3367A5]">{{ $adminInitials }}</span>
                            </template>
                        </div>
                        <div class="flex-1 min-w-0 space-y-1">
                            <input type="file" name="avatar" accept="image/*"
                                @change="if ($event.target.files?.[0]) { settingsAvatarPreview = URL.createObjectURL($event.target.files[0]); removeAvatar = false; }"
                                class="w-full text-[11px] text-slate-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:bg-[#3367A5] file:text-white file:font-semibold file:cursor-pointer cursor-pointer">
                            <template x-if="settingsAvatarPreview && !removeAvatar">
                                <button type="button" @click="removeAvatar = true"
                                    class="text-[10px] text-rose-600 hover:underline font-semibold cursor-pointer">
                                    Hapus foto &amp; gunakan inisial
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Nama
                                Tampilan *</label>
                            <input type="text" name="name" value="{{ old('name', $adminUser?->name) }}"
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Jabatan /
                                Divisi</label>
                            <input type="text" name="job_title"
                                value="{{ old('job_title', $adminUser?->job_title) }}" placeholder="Administrator"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Email Login
                                Administrator *</label>
                            <input type="email" name="email" x-model="emailInput" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">WhatsApp
                                Operasional</label>
                            <input type="text" name="phone" value="{{ old('phone', $adminUser?->phone) }}"
                                placeholder="0812-xxxx-xxxx"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>
                    </div>

                    <!-- Strict Password Verification Prompt (appears automatically when Email is modified) -->
                    <div x-show="emailChanged" x-transition
                        class="p-3.5 rounded-2xl bg-blue-50/80 border border-[#3367A5]/25 space-y-2">
                        <p class="text-[11px] font-bold text-[#244E81] flex items-center gap-1.5">
                            <i class="fa-solid fa-lock"></i>
                            <span>Verifikasi Perubahan Email Login</span>
                        </p>
                        <p class="text-[11px] text-slate-600 leading-snug">
                            Demi keamanan, masukkan <strong>Kata Sandi Saat Ini</strong> untuk mengonfirmasi perubahan
                            email login. Sesi di perangkat lain akan diputus otomatis.
                        </p>
                        <div class="relative">
                            <input :type="showCurrentPassProfile ? 'text' : 'password'" name="current_password"
                                :required="emailChanged" autocomplete="current-password"
                                placeholder="Masukkan kata sandi saat ini"
                                class="w-full px-3.5 py-2.5 pr-10 rounded-xl border border-[#3367A5]/30 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            <button type="button" @click="showCurrentPassProfile = !showCurrentPassProfile"
                                class="absolute inset-y-0 right-0 px-3 text-slate-400 hover:text-[#3367A5] flex items-center justify-center cursor-pointer"
                                title="Tampilkan / Sembunyikan Sandi">
                                <svg x-show="!showCurrentPassProfile" class="w-4 h-4" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17c4.227 0 6.334-3.491 6.913-4.64a.8.8 0 0 0 0-.722C18.334 10.49 16.227 7 12 7s-6.334 3.49-6.913 4.638a.8.8 0 0 0 0 .723C5.666 13.509 7.773 17 12 17" />
                                    <circle cx="12" cy="11.999" r="2.5" />
                                </svg>
                                <svg x-show="showCurrentPassProfile" x-cloak class="w-4 h-4 text-[#3367A5]"
                                    fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M19.9999 15.5C18.0664 17.6534 15.2285 19 11.9999 19C7.31078 19 3.8221 14.8706 2.45604 12.955C2.15201 12.5287 2 12.3155 2 12C2 11.6845 2.15201 11.4713 2.45604 11.045C3.3323 9.81635 5.09311 7.74794 7.49992 6.5" />
                                    <path
                                        d="M9.5 8C10.2452 7.37191 11.0827 7 11.9999 7C14.7613 7 16.9999 9.23858 16.9999 12C16.9999 12.9172 16.628 13.7547 16 14.5" />
                                    <path d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center gap-3">
                        <button type="button" @click="$store.admin.settingsModalOpen = false"
                            class="flex-1 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">
                            Tutup
                        </button>
                        <button type="submit"
                            class="flex-1 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95">
                            Simpan Profil
                        </button>
                    </div>
                </form>

                <!-- ========================================= -->
                <!-- TAB 2: SANDI KUAT & 2FA AUTHENTICATOR     -->
                <!-- ========================================= -->
                <div x-show="activeTab === 'security'" class="space-y-4">

                    <!-- Section A: Strict Password Change -->
                    <form method="POST" action="{{ route('admin.profile.settings') }}"
                        class="p-4 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="active_tab" value="security">
                        <input type="hidden" name="name" value="{{ $adminUser?->name }}">
                        <input type="hidden" name="email" value="{{ $adminUser?->email }}">
                        <input type="hidden" name="phone" value="{{ $adminUser?->phone }}">
                        <input type="hidden" name="job_title" value="{{ $adminUser?->job_title }}">

                        <div class="flex items-center justify-between">
                            <span
                                class="font-bold text-slate-900 font-['Agrandir',sans-serif] flex items-center gap-1.5">
                                <i class="fa-solid fa-lock text-[#3367A5] text-[11px]"></i> Ganti Kata Sandi (Kebijakan
                                Ketat)
                            </span>
                            @if ($adminUser?->password_changed_at)
                                <span class="text-[10px] text-slate-500">Diubah
                                    {{ $adminUser->password_changed_at->diffForHumans() }}</span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-slate-600 font-semibold mb-1">Kata Sandi Saat Ini *</label>
                            <div class="relative">
                                <input :type="showCurrentPassSec ? 'text' : 'password'" name="current_password"
                                    required autocomplete="current-password"
                                    placeholder="Masukkan kata sandi saat ini"
                                    class="w-full px-3 py-2 pr-9 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                <button type="button" @click="showCurrentPassSec = !showCurrentPassSec"
                                    class="absolute inset-y-0 right-0 px-3 text-slate-400 hover:text-[#3367A5] flex items-center justify-center cursor-pointer"
                                    title="Tampilkan / Sembunyikan Sandi">
                                    <svg x-show="!showCurrentPassSec" class="w-4 h-4" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17c4.227 0 6.334-3.491 6.913-4.64a.8.8 0 0 0 0-.722C18.334 10.49 16.227 7 12 7s-6.334 3.49-6.913 4.638a.8.8 0 0 0 0 .723C5.666 13.509 7.773 17 12 17" />
                                        <circle cx="12" cy="11.999" r="2.5" />
                                    </svg>
                                    <svg x-show="showCurrentPassSec" x-cloak class="w-4 h-4 text-[#3367A5]"
                                        fill="none" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path
                                            d="M19.9999 15.5C18.0664 17.6534 15.2285 19 11.9999 19C7.31078 19 3.8221 14.8706 2.45604 12.955C2.15201 12.5287 2 12.3155 2 12C2 11.6845 2.15201 11.4713 2.45604 11.045C3.3323 9.81635 5.09311 7.74794 7.49992 6.5" />
                                        <path
                                            d="M9.5 8C10.2452 7.37191 11.0827 7 11.9999 7C14.7613 7 16.9999 9.23858 16.9999 12C16.9999 12.9172 16.628 13.7547 16 14.5" />
                                        <path d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <div>
                                <label class="block text-slate-600 font-semibold mb-1">Sandi Baru *</label>
                                <div class="relative">
                                    <input :type="showNewPass ? 'text' : 'password'" name="new_password"
                                        x-model="newPass" required autocomplete="new-password"
                                        placeholder="Min. 10 karakter"
                                        class="w-full px-3 py-2 pr-9 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                    <button type="button" @click="showNewPass = !showNewPass"
                                        class="absolute inset-y-0 right-0 px-3 text-slate-400 hover:text-[#3367A5] flex items-center justify-center cursor-pointer"
                                        title="Tampilkan / Sembunyikan Sandi">
                                        <svg x-show="!showNewPass" class="w-4 h-4" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path
                                                d="M12 17c4.227 0 6.334-3.491 6.913-4.64a.8.8 0 0 0 0-.722C18.334 10.49 16.227 7 12 7s-6.334 3.49-6.913 4.638a.8.8 0 0 0 0 .723C5.666 13.509 7.773 17 12 17" />
                                            <circle cx="12" cy="11.999" r="2.5" />
                                        </svg>
                                        <svg x-show="showNewPass" x-cloak class="w-4 h-4 text-[#3367A5]"
                                            fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path
                                                d="M19.9999 15.5C18.0664 17.6534 15.2285 19 11.9999 19C7.31078 19 3.8221 14.8706 2.45604 12.955C2.15201 12.5287 2 12.3155 2 12C2 11.6845 2.15201 11.4713 2.45604 11.045C3.3323 9.81635 5.09311 7.74794 7.49992 6.5" />
                                            <path
                                                d="M9.5 8C10.2452 7.37191 11.0827 7 11.9999 7C14.7613 7 16.9999 9.23858 16.9999 12C16.9999 12.9172 16.628 13.7547 16 14.5" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-slate-600 font-semibold mb-1">Konfirmasi Sandi Baru *</label>
                                <div class="relative">
                                    <input :type="showConfirmPass ? 'text' : 'password'"
                                        name="new_password_confirmation" x-model="confirmPass" required
                                        autocomplete="new-password" placeholder="Ulangi sandi baru"
                                        class="w-full px-3 py-2 pr-9 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                    <button type="button" @click="showConfirmPass = !showConfirmPass"
                                        class="absolute inset-y-0 right-0 px-3 text-slate-400 hover:text-[#3367A5] flex items-center justify-center cursor-pointer"
                                        title="Tampilkan / Sembunyikan Sandi">
                                        <svg x-show="!showConfirmPass" class="w-4 h-4" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path
                                                d="M12 17c4.227 0 6.334-3.491 6.913-4.64a.8.8 0 0 0 0-.722C18.334 10.49 16.227 7 12 7s-6.334 3.49-6.913 4.638a.8.8 0 0 0 0 .723C5.666 13.509 7.773 17 12 17" />
                                            <circle cx="12" cy="11.999" r="2.5" />
                                        </svg>
                                        <svg x-show="showConfirmPass" x-cloak class="w-4 h-4 text-[#3367A5]"
                                            fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path
                                                d="M19.9999 15.5C18.0664 17.6534 15.2285 19 11.9999 19C7.31078 19 3.8221 14.8706 2.45604 12.955C2.15201 12.5287 2 12.3155 2 12C2 11.6845 2.15201 11.4713 2.45604 11.045C3.3323 9.81635 5.09311 7.74794 7.49992 6.5" />
                                            <path
                                                d="M9.5 8C10.2452 7.37191 11.0827 7 11.9999 7C14.7613 7 16.9999 9.23858 16.9999 12C16.9999 12.9172 16.628 13.7547 16 14.5" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Live Password Strength Meter & Strict Checklist -->
                        <div class="space-y-2 pt-0.5">
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="text-slate-500 font-semibold">Kekuatan Sandi</span>
                                <span class="font-bold"
                                    :class="passScore >= 4 ? 'text-emerald-600' : (passScore >= 2 ? 'text-amber-600' :
                                        'text-rose-500')"
                                    x-text="passStrengthLabel || 'Wajib 4 syarat di bawah'"></span>
                            </div>
                            <div class="grid grid-cols-4 gap-1 h-1.5">
                                <div class="rounded-full transition-colors"
                                    :class="passScore >= 1 ? (passScore >= 4 ? 'bg-emerald-500' : (passScore >= 2 ?
                                        'bg-amber-400' : 'bg-rose-400')) : 'bg-slate-200'">
                                </div>
                                <div class="rounded-full transition-colors"
                                    :class="passScore >= 2 ? (passScore >= 4 ? 'bg-emerald-500' : 'bg-amber-400') :
                                        'bg-slate-200'">
                                </div>
                                <div class="rounded-full transition-colors"
                                    :class="passScore >= 3 ? (passScore >= 4 ? 'bg-emerald-500' : 'bg-amber-400') :
                                        'bg-slate-200'">
                                </div>
                                <div class="rounded-full transition-colors"
                                    :class="passScore >= 4 ? 'bg-emerald-500' : 'bg-slate-200'"></div>
                            </div>
                            <div class="flex flex-wrap gap-1.5 text-[10px] font-['Questrial',sans-serif]">
                                <span
                                    class="h-6 px-2.5 rounded-md border font-semibold inline-flex items-center justify-center gap-1.5 leading-none"
                                    :class="passRules.len ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                        'bg-white text-slate-500 border-slate-200'">
                                    <i class="fa-solid leading-none"
                                        :class="passRules.len ? 'fa-check text-emerald-500 text-[9px]' :
                                            'fa-circle text-[5px] text-slate-300'"></i><span>Min
                                        10 Karakter</span>
                                </span>
                                <span
                                    class="h-6 px-2.5 rounded-md border font-semibold inline-flex items-center justify-center gap-1.5 leading-none"
                                    :class="passRules.mixed ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                        'bg-white text-slate-500 border-slate-200'">
                                    <i class="fa-solid leading-none"
                                        :class="passRules.mixed ? 'fa-check text-emerald-500 text-[9px]' :
                                            'fa-circle text-[5px] text-slate-300'"></i><span>Huruf
                                        Besar &amp; Kecil</span>
                                </span>
                                <span
                                    class="h-6 px-2.5 rounded-md border font-semibold inline-flex items-center justify-center gap-1.5 leading-none"
                                    :class="passRules.num ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                        'bg-white text-slate-500 border-slate-200'">
                                    <i class="fa-solid leading-none"
                                        :class="passRules.num ? 'fa-check text-emerald-500 text-[9px]' :
                                            'fa-circle text-[5px] text-slate-300'"></i><span>Angka</span>
                                </span>
                                <span
                                    class="h-6 px-2.5 rounded-md border font-semibold inline-flex items-center justify-center gap-1.5 leading-none"
                                    :class="passRules.sym ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                        'bg-white text-slate-500 border-slate-200'">
                                    <i class="fa-solid leading-none"
                                        :class="passRules.sym ? 'fa-check text-emerald-500 text-[9px]' :
                                            'fa-circle text-[5px] text-slate-300'"></i><span>Simbol
                                        (!@#$)</span>
                                </span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full h-10 px-4 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Questrial',sans-serif] leading-none inline-flex items-center justify-center text-center shadow-sm transition cursor-pointer active:scale-[0.99]">
                            Perbarui Sandi &amp; Putus Sesi Perangkat Lain
                        </button>
                    </form>

                    <!-- Section B: 2FA Google / Microsoft Authenticator -->
                    <div class="p-4 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="font-bold text-slate-900 font-['Agrandir',sans-serif] flex items-center gap-1.5">
                                <i class="fa-solid fa-mobile-screen-button text-[#3367A5] text-[12px]"></i> Autentikasi
                                2 Faktor (2FA)
                            </span>
                            @if ($adminHas2fa)
                                <span
                                    class="h-5 px-2.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold font-['Questrial',sans-serif] leading-none inline-flex items-center justify-center text-center">AKTIF</span>
                            @else
                                <span
                                    class="h-5 px-2.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold font-['Questrial',sans-serif] leading-none inline-flex items-center justify-center text-center">BELUM
                                    AKTIF</span>
                            @endif
                        </div>

                        @if (!empty($newRecoveryCodes))
                            <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-bold text-emerald-800">Simpan 8 Kode Pemulihan
                                        Darurat (1x Tampil)</span>
                                    <button type="button"
                                        @click="copyText(@js(implode("\n", $newRecoveryCodes)), 'copiedRecovery')"
                                        class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold cursor-pointer">
                                        <span x-text="copiedRecovery ? 'Tersalin!' : 'Salin Semua'"></span>
                                    </button>
                                </div>
                                <p class="text-[10px] text-emerald-700">Gunakan salah satu kode ini jika HP
                                    Authenticator hilang/reset.</p>
                                <div class="grid grid-cols-2 gap-1.5 font-mono text-[11px] font-bold text-slate-800">
                                    @foreach ($newRecoveryCodes as $rc)
                                        <div
                                            class="px-2.5 py-1.5 rounded-lg bg-white border border-emerald-200 text-center">
                                            {{ $rc }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (!$adminHas2fa)
                            <p class="text-[11px] text-slate-600 leading-relaxed">
                                Lindungi login dengan kode 6 digit yang berganti tiap 30 detik menggunakan
                                <strong>Google Authenticator</strong> atau <strong>Microsoft Authenticator</strong>.
                            </p>

                            <template x-if="!twoFaQrSvg">
                                <button type="button" @click="startTwoFactorSetup()" :disabled="twoFaSetupLoading"
                                    class="w-full h-10 px-4 rounded-xl bg-white hover:bg-blue-50 text-[#3367A5] border border-[#3367A5]/30 text-xs font-bold font-['Questrial',sans-serif] leading-none transition cursor-pointer inline-flex items-center justify-center gap-2 text-center">
                                    <i class="fa-solid fa-qrcode leading-none"></i>
                                    <span class="leading-none"
                                        x-text="twoFaSetupLoading ? 'Menyiapkan QR Code...' : 'Aktifkan 2FA (Tampilkan QR Code)'"></span>
                                </button>
                            </template>

                            <template x-if="twoFaQrSvg">
                                <form method="POST" action="{{ route('admin.profile.2fa.confirm') }}"
                                    class="space-y-3 pt-1">
                                    @csrf
                                    <div
                                        class="flex flex-col sm:flex-row items-center gap-3.5 p-3 rounded-xl bg-white border border-slate-200">
                                        <img :src="twoFaQrSvg" alt="2FA QR Code"
                                            class="w-36 h-36 rounded-lg border border-slate-100 shrink-0 bg-white p-1">
                                        <div class="space-y-2 text-[11px] text-slate-600 min-w-0 flex-1">
                                            <p class="font-bold text-slate-800">1. Scan QR dengan Authenticator</p>
                                            <p>Atau masukkan kunci manual berikut:</p>
                                            <div class="flex items-center gap-1.5">
                                                <code
                                                    class="px-2 py-1 rounded bg-slate-100 text-[10px] font-bold text-slate-800 break-all"
                                                    x-text="twoFaFormattedSecret"></code>
                                                <button type="button"
                                                    @click="copyText(twoFaFormattedSecret.replace(/\s+/g, ''), 'copiedSecret')"
                                                    class="px-2 py-1 rounded bg-blue-50 text-[#3367A5] font-bold text-[10px] shrink-0 cursor-pointer">
                                                    <span x-text="copiedSecret ? 'OK' : 'Salin'"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                        <div>
                                            <label class="block text-slate-600 font-semibold mb-1">Kata Sandi Saat Ini
                                                *</label>
                                            <input type="password" name="current_password" required
                                                placeholder="Verifikasi sandi"
                                                class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                        </div>
                                        <div>
                                            <label class="block text-slate-600 font-semibold mb-1">Kode 6 Digit OTP
                                                *</label>
                                            <input type="text" name="code" required maxlength="6"
                                                inputmode="numeric" placeholder="000000"
                                                class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 font-mono font-bold tracking-widest text-center outline-none focus:border-[#3367A5]">
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="twoFaQrSvg = ''; twoFaFormattedSecret = ''"
                                            class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-100 cursor-pointer">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="flex-1 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold font-['Agrandir',sans-serif] cursor-pointer">
                                            Konfirmasi &amp; Aktifkan 2FA
                                        </button>
                                    </div>
                                </form>
                            </template>
                        @else
                            <div class="text-[11px] text-slate-600 space-y-1">
                                <p>Diaktifkan sejak
                                    <strong>{{ $adminUser?->two_factor_confirmed_at?->format('d M Y, H:i') }}</strong>.
                                </p>
                                <p>Sisa Kode Pemulihan darurat: <strong>{{ $adminRecoveryRemaining }} kode</strong>.
                                </p>
                            </div>

                            <button type="button" @click="twoFaShowDisable = !twoFaShowDisable"
                                class="text-[11px] font-bold text-rose-600 hover:underline cursor-pointer">
                                <span
                                    x-text="twoFaShowDisable ? 'Batal nonaktifkan 2FA' : 'Nonaktifkan 2FA dari akun ini'"></span>
                            </button>

                            <form x-show="twoFaShowDisable" x-transition method="POST"
                                action="{{ route('admin.profile.2fa.disable') }}"
                                class="space-y-2.5 pt-1 border-t border-slate-200">
                                @csrf
                                @method('DELETE')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                    <input type="password" name="current_password" required
                                        placeholder="Kata sandi saat ini"
                                        class="w-full px-3 py-2 rounded-xl border border-rose-200 bg-white text-slate-800 outline-none focus:border-rose-500">
                                    <input type="text" name="code" required placeholder="Kode OTP / Recovery"
                                        class="w-full px-3 py-2 rounded-xl border border-rose-200 bg-white text-slate-800 font-mono text-center outline-none focus:border-rose-500">
                                </div>
                                <button type="submit"
                                    class="w-full py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold cursor-pointer">
                                    Konfirmasi Nonaktifkan 2FA
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- ========================================= -->
                <!-- TAB 3: SESI AKTIF, AUTO-LOCK & AUDIT LOG  -->
                <!-- ========================================= -->
                <div x-show="activeTab === 'sessions'" class="space-y-4">

                    <!-- Smart Auto-Lock Idle Timeout -->
                    <form method="POST" action="{{ route('admin.profile.idle-timeout') }}"
                        class="p-3.5 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-2.5"
                        x-data="{
                            openIdle: false,
                            selectedIdle: {{ $adminIdleMinutes }},
                            idleOptions: [
                                { value: 0, label: 'Nonaktif (Tetap Masuk / Pantau Layar)' },
                                { value: 30, label: '30 Menit (Ketat)' },
                                { value: 60, label: '1 Jam (60 Menit)' },
                                { value: 120, label: '2 Jam (Direkomendasikan)' },
                                { value: 240, label: '4 Jam' }
                            ],
                            get selectedIdleLabel() {
                                const found = this.idleOptions.find(o => o.value === this.selectedIdle);
                                return found ? found.label : '2 Jam (Direkomendasikan)';
                            }
                        }">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="idle_timeout_minutes" :value="selectedIdle">
                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="font-bold text-slate-900 font-['Agrandir',sans-serif] flex items-center gap-1.5">
                                <i class="fa-solid fa-hourglass-half text-[#3367A5] text-[11px]"></i> Smart Auto-Lock
                                (Idle)
                            </span>
                            <span
                                class="h-5 px-2.5 rounded-full text-[10px] font-bold font-['Questrial',sans-serif] leading-none inline-flex items-center justify-center text-center {{ $adminIdleMinutes === 0 ? 'bg-slate-200/80 text-slate-600' : 'bg-blue-50 text-[#3367A5]' }}">
                                {{ $adminIdleLabel }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 leading-snug">
                            Timer otomatis reset saat Anda menggerakkan mouse atau mengetik, dan memunculkan peringatan
                            <strong>60 detik</strong> sebelum logout.
                        </p>
                        <div class="flex items-center gap-2">
                            <!-- Custom Dropdown matching Admin Panel Standard -->
                            <div class="relative flex-1 min-w-0">
                                <button type="button" @click="openIdle = !openIdle"
                                    class="w-full h-9 inline-flex items-center justify-between gap-2 px-3.5 rounded-xl border border-slate-200/90 bg-white hover:border-[#3367A5]/40 text-slate-700 hover:text-slate-900 font-['Questrial',sans-serif] text-xs font-semibold shadow-xs transition focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer">
                                    <span class="truncate leading-none" x-text="selectedIdleLabel"></span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200"
                                        :class="{ 'rotate-180': openIdle }" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-cloak x-show="openIdle" @click.outside="openIdle = false"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                    class="absolute left-0 right-0 mt-1.5 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">
                                    <template x-for="opt in idleOptions" :key="opt.value">
                                        <button type="button" @click="selectedIdle = opt.value; openIdle = false"
                                            :class="selectedIdle === opt.value ? 'bg-blue-50 text-[#3367A5] font-bold' :
                                                'text-slate-700 hover:bg-blue-50/70'"
                                            class="w-full px-3.5 py-2 text-left text-xs font-['Questrial',sans-serif] flex items-center justify-between gap-2 transition cursor-pointer">
                                            <span class="truncate leading-snug" x-text="opt.label"></span>
                                            <i x-show="selectedIdle === opt.value"
                                                class="fa-solid fa-check text-[#3367A5] text-xs shrink-0"></i>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <button type="submit"
                                class="h-9 px-4 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold font-['Questrial',sans-serif] leading-none inline-flex items-center justify-center text-center cursor-pointer shrink-0 transition active:scale-95">
                                Simpan
                            </button>
                        </div>
                    </form>

                    <!-- Active Sessions & Force Logout Other Devices -->
                    <div class="p-3.5 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-3">
                        <div class="flex items-center justify-between">
                            <span
                                class="font-bold text-slate-900 font-['Agrandir',sans-serif] flex items-center gap-1.5">
                                <i class="fa-solid fa-laptop text-[#3367A5] text-[11px]"></i> Perangkat &amp; Sesi
                                Aktif
                            </span>
                            <span
                                class="text-[10px] text-slate-500 font-semibold">{{ max(1, $adminActiveSessions->count()) }}
                                sesi</span>
                        </div>

                        <div class="space-y-1.5 max-h-36 overflow-y-auto pr-1">
                            @forelse ($adminActiveSessions as $sess)
                                <div
                                    class="flex items-center justify-between gap-2 px-3 py-2 rounded-xl bg-white border border-slate-200/70">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-1.5">
                                            <span
                                                class="font-bold text-slate-800 truncate">{{ $sess->device_label ?: 'Browser' }}</span>
                                            @if ($sess->session_id === $currentSessionId)
                                                <span
                                                    class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-700 text-[9px] font-bold shrink-0">Perangkat
                                                    Ini</span>
                                            @endif
                                        </div>
                                        <p class="text-[10px] text-slate-500">IP {{ $sess->ip_address ?: '-' }} ·
                                            Aktif {{ $sess->last_active_at?->diffForHumans() ?? 'baru saja' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="px-3 py-2 rounded-xl bg-white border border-slate-200/70 text-[11px] text-slate-600">
                                    Sesi perangkat ini sedang aktif (IP {{ request()->ip() }}).
                                </div>
                            @endforelse
                        </div>

                        <form method="POST" action="{{ route('admin.profile.sessions.revoke') }}"
                            class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 pt-1 border-t border-slate-200">
                            @csrf
                            <input type="password" name="current_password" required
                                placeholder="Konfirmasi kata sandi saat ini"
                                class="flex-1 px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-rose-500">
                            <button type="submit"
                                class="px-3.5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-[11px] font-bold cursor-pointer shrink-0">
                                Keluar Semua Perangkat Lain
                            </button>
                        </form>
                    </div>

                    <!-- Security Audit Log -->
                    <div class="p-3.5 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-2.5">
                        <span class="font-bold text-slate-900 font-['Agrandir',sans-serif] flex items-center gap-1.5">
                            <i class="fa-solid fa-shield-cat text-[#3367A5] text-[11px]"></i> Riwayat Login &amp;
                            Audit Keamanan
                        </span>
                        <div class="space-y-1.5 max-h-48 overflow-y-auto pr-1">
                            @forelse ($adminSecurityLogs as $log)
                                @php
                                    $borderAccent = match ($log->status) {
                                        'danger' => 'border-l-2 border-l-rose-500',
                                        'warning' => 'border-l-2 border-l-amber-400',
                                        default => 'border-l-2 border-l-emerald-500',
                                    };
                                @endphp
                                <div
                                    class="flex items-start px-3 py-2 rounded-xl bg-white border border-slate-200/70 {{ $borderAccent }}">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-2">
                                            <span
                                                class="font-bold text-slate-800 text-[11px] truncate">{{ $log->eventLabel() }}</span>
                                            <span
                                                class="text-[10px] text-slate-400 shrink-0">{{ $log->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-[10px] text-slate-500 truncate">
                                            {{ $log->device_label ?: 'Browser' }} · IP {{ $log->ip_address ?: '-' }}
                                        </p>
                                        @if ($log->details)
                                            <p class="text-[10px] text-slate-500 mt-0.5 leading-snug">
                                                {{ $log->details }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-[11px] text-slate-500 text-center py-3">Belum ada riwayat aktivitas
                                    keamanan tercatat.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- ========================================= -->
                <!-- TAB 4: KELOLA AKUN ADMIN (MULTI-ADMIN)    -->
                <!-- ========================================= -->
                <div x-show="activeTab === 'admins'" class="space-y-4"
                     x-data="{ showAddAdmin: {{ $errors->hasAny(['new_admin_name', 'new_admin_email', 'new_admin_password']) ? 'true' : 'false' }}, resetTargetId: null }">

                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <h4 class="font-bold text-slate-900 font-['Agrandir',sans-serif] text-xs">
                                Daftar Akun Portal Admin ({{ $managedAdmins->count() }})
                            </h4>
                        </div>
                        <button type="button" @click="showAddAdmin = !showAddAdmin"
                                class="h-8 px-3.5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-[11px] font-bold font-['Agrandir',sans-serif] inline-flex items-center gap-1.5 shadow-xs transition cursor-pointer active:scale-95 shrink-0">
                            <i class="fa-solid" :class="showAddAdmin ? 'fa-minus' : 'fa-user-plus'"></i>
                            <span x-text="showAddAdmin ? 'Tutup Form' : 'Tambah Admin'"></span>
                        </button>
                    </div>

                    <!-- Form Tambah Akun Admin Baru -->
                    <form x-cloak x-show="showAddAdmin" x-transition
                          method="POST" action="{{ route('admin.admins.store') }}"
                          class="p-4 rounded-2xl bg-[#f8fafd] border border-[#3367A5]/20 space-y-3">
                        @csrf
                        <p class="font-bold text-slate-800 font-['Agrandir',sans-serif] text-xs flex items-center gap-1.5">
                            <i class="fa-solid fa-user-plus text-[#3367A5]"></i>
                            <span>Buat Akun Admin / Staf Baru</span>
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 mb-1">Nama Lengkap *</label>
                                <input type="text" name="new_admin_name" value="{{ old('new_admin_name') }}" required
                                       placeholder="Nama staf / marketing"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 mb-1">Jabatan / Divisi</label>
                                <input type="text" name="new_admin_job_title" value="{{ old('new_admin_job_title') }}"
                                       placeholder="Sales / Marketing"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 mb-1">Email Login *</label>
                                <input type="email" name="new_admin_email" value="{{ old('new_admin_email') }}" required
                                       placeholder="staf@gat-aspect.com"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 mb-1">Kata Sandi Akun Baru *</label>
                                <input type="password" name="new_admin_password" required autocomplete="new-password"
                                       placeholder="Min. 8 kar (Huruf Besar, Kecil, Angka)"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                        </div>

                        <div class="pt-1 border-t border-slate-200/70">
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Konfirmasi Sandi Anda Saat Ini *</label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <input type="password" name="current_password" required autocomplete="current-password"
                                       placeholder="Masukkan kata sandi akun Anda"
                                       class="flex-1 px-3 py-2 rounded-xl border border-[#3367A5]/30 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                <button type="submit"
                                        class="h-9 px-4 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-xs font-['Agrandir',sans-serif] transition cursor-pointer shrink-0">
                                    Simpan Akun
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Daftar Akun Admin -->
                    <div class="space-y-2">
                        @foreach ($managedAdmins as $adm)
                            @php
                                $isSelf = $adminUser && $adm->id === $adminUser->id;
                                $isActiveAdmin = $adm->role === 'admin';
                            @endphp
                            <div class="p-3 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-2.5">
                                <div class="flex items-center justify-between gap-2.5">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-9 h-9 rounded-full bg-[#E6F0FA] text-[#244E81] font-bold text-[11px] font-['Agrandir',sans-serif] flex items-center justify-center shrink-0">
                                            {{ $adm->initials() }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex flex-wrap items-center gap-1.5">
                                                <span class="font-bold text-slate-900 text-xs truncate">{{ $adm->name }}</span>
                                                @if ($isSelf)
                                                    <span class="px-1.5 py-0.5 rounded bg-blue-100 text-[#244E81] text-[9px] font-bold">Anda</span>
                                                @endif
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-bold {{ $isActiveAdmin ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                                    {{ $isActiveAdmin ? 'Admin Aktif' : 'Nonaktif' }}
                                                </span>
                                            </div>
                                            <p class="text-[11px] text-slate-500 truncate">
                                                {{ $adm->email }}@if ($adm->job_title) · {{ $adm->job_title }}@endif
                                            </p>
                                        </div>
                                    </div>

                                    @if (!$isSelf)
                                        <div class="flex items-center gap-1 shrink-0">
                                            <button type="button"
                                                    @click="resetTargetId = (resetTargetId === {{ $adm->id }} ? null : {{ $adm->id }})"
                                                    class="px-2 py-1 rounded-lg bg-white border border-slate-200 hover:border-[#3367A5]/40 text-slate-700 hover:text-[#3367A5] text-[10px] font-semibold transition cursor-pointer"
                                                    title="Reset kata sandi akun ini">
                                                Reset Sandi
                                            </button>
                                            <form method="POST" action="{{ route('admin.admins.toggle', $adm->id) }}" class="inline m-0">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="px-2 py-1 rounded-lg text-[10px] font-semibold transition cursor-pointer {{ $isActiveAdmin ? 'bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200' }}">
                                                    {{ $isActiveAdmin ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.admins.destroy', $adm->id) }}"
                                                  onsubmit="return confirm('Hapus permanen akun {{ addslashes($adm->name) }}?')" class="inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-7 h-7 rounded-lg bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white inline-flex items-center justify-center transition cursor-pointer"
                                                        title="Hapus akun">
                                                    <i class="fa-regular fa-trash-can text-[11px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                                @if (!$isSelf)
                                    <!-- Inline Reset Password Mini-Form -->
                                    <form x-cloak x-show="resetTargetId === {{ $adm->id }}" x-transition
                                          method="POST" action="{{ route('admin.admins.reset-password', $adm->id) }}"
                                          class="pt-2 border-t border-slate-200/80 grid grid-cols-1 sm:grid-cols-3 gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="password" name="reset_password" required autocomplete="new-password"
                                               placeholder="Sandi baru staf (min 8 kar)"
                                               class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                        <input type="password" name="current_password" required autocomplete="current-password"
                                               placeholder="Sandi Anda saat ini"
                                               class="px-3 py-1.5 rounded-xl border border-[#3367A5]/30 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                        <button type="submit"
                                                class="py-1.5 px-3 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-[11px] transition cursor-pointer">
                                            Terapkan Sandi
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: SMART AUTO-LOCK 60-SECOND COUNTDOWN WARNING             -->
    <!-- ============================================================== -->
    <form id="smart-idle-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <div x-cloak x-show="$store.admin.idleWarningOpen"
        class="fixed inset-0 w-screen h-screen z-[10000] flex items-center justify-center p-4 bg-slate-900/65 backdrop-blur-xs"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div
            class="bg-white rounded-[28px] max-w-sm w-full p-6 shadow-2xl border border-[#3367A5]/20 text-center space-y-4">
            <div
                class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-600 border border-amber-200/80 flex items-center justify-center">
                <i class="fa-solid fa-clock text-2xl"></i>
            </div>
            <div class="space-y-1.5">
                <h3 class="text-base font-bold font-['Agrandir',sans-serif] text-slate-900">
                    Sesi Akan Berakhir Otomatis
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Tidak ada aktivitas mouse atau keyboard terdeteksi. Demi keamanan akun, Anda akan logout otomatis
                    dalam:
                </p>
            </div>
            <div
                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-2xl bg-[#E6F0FA] text-[#244E81] font-['Questrial',sans-serif] font-bold text-xl tabular-nums leading-none">
                <span x-text="$store.admin.idleCountdown">60</span>
                <span class="text-xs font-semibold">detik</span>
            </div>
            <div class="flex items-center gap-2.5 pt-1">
                <button type="button" @click="$store.admin.forceIdleLogout()"
                    class="flex-1 h-10 px-4 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 inline-flex items-center justify-center leading-none transition cursor-pointer">
                    Keluar Sekarang
                </button>
                <button type="button" @click="$store.admin.stayLoggedIn()"
                    class="flex-1 h-10 px-4 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Questrial',sans-serif] inline-flex items-center justify-center leading-none shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95">
                    Tetap Masuk
                </button>
            </div>
        </div>
    </div>

</body>

</html>
