@extends('components.layouts.admin')

@section('title', 'WA & Social Media')

@section('content')
<div class="w-full space-y-5"
     x-data="{
        waAdminNumber: @js(old('wa_admin_number', $settings['wa_admin_number'] ?? '6285732021121')),
        waPublicNumber: @js(old('wa_public_number', $settings['wa_public_number'] ?? '6285280002573')),
        testTargetRole: 'admin',
        testPhone: @js(old('test_phone', $settings['wa_admin_number'] ?? '6285732021121')),
        testMessage: @js(old('test_message', 'Halo Admin PT Global Aspect Technology, ini pesan uji koneksi WhatsApp dari GAT Dashboard.')),
        testSending: false,

        // Live WhatsApp Gateway State (Inline QR Scan & 1-Click Start)
        waGatewayMode: @js(old('wa_gateway_mode', $settings['wa_gateway_mode'] ?? 'local')),
        gwLoading: true,
        gwStarting: false,
        gwLoggingOut: false,
        gwReachable: false,
        gwLocalSupported: true,
        gwState: 'checking', // 'checking' | 'offline' | 'connecting' | 'qr_ready' | 'connected' | 'disconnected' | 'serverless' | 'external'
        gwDevice: null,
        gwQr: null,
        _gwTimer: null,

        // Live Social Media & Email Hide/Unhide State
        activeChannelsCount: {{ (int) $activeChannelsCount }},
        socialVisible: {
            linkedin: @js(old('social_linkedin_visible', $settings['social_linkedin_visible'] ?? '1') === '1'),
            instagram: @js(old('social_instagram_visible', $settings['social_instagram_visible'] ?? '0') === '1'),
            youtube: @js(old('social_youtube_visible', $settings['social_youtube_visible'] ?? '0') === '1'),
            facebook: @js(old('social_facebook_visible', $settings['social_facebook_visible'] ?? '0') === '1'),
            tiktok: @js(old('social_tiktok_visible', $settings['social_tiktok_visible'] ?? '0') === '1'),
            email: @js(old('social_email_visible', $settings['social_email_visible'] ?? '1') === '1'),
        },
        socialValues: {
            linkedin: @js(old('social_linkedin', $settings['social_linkedin'] ?? '')),
            instagram: @js(old('social_instagram', $settings['social_instagram'] ?? '')),
            youtube: @js(old('social_youtube', $settings['social_youtube'] ?? '')),
            facebook: @js(old('social_facebook', $settings['social_facebook'] ?? '')),
            tiktok: @js(old('social_tiktok', $settings['social_tiktok'] ?? '')),
            email: @js(old('social_email', $settings['social_email'] ?? 'admin@gat-aspect.com')),
        },
        socialToggling: {},

        async toggleSocialChannel(channel) {
            if (this.socialToggling[channel]) return;
            const nextState = !this.socialVisible[channel];
            this.socialVisible[channel] = nextState;
            this.socialToggling[channel] = true;

            try {
                const res = await fetch('{{ route('admin.integrations.social.toggle') }}', {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ channel, visible: nextState })
                });
                const data = await res.json();
                if (res.ok && data.ok) {
                    this.activeChannelsCount = data.active_channels_count;
                    if (window.Alpine && Alpine.store('admin')) {
                        Alpine.store('admin').showToast(
                            data.message || 'Status kanal diperbarui.',
                            nextState ? 'Kanal Ditampilkan' : 'Kanal Disembunyikan',
                            nextState && !data.has_value ? 'info' : 'success'
                        );
                    }
                    // Broadcast live CMS update ke tab website publik yang terbuka
                    try {
                        localStorage.setItem('gat_cms_sync_ts', String(Date.now()));
                        if (typeof BroadcastChannel !== 'undefined') {
                            const ch = new BroadcastChannel('gat_cms_sync');
                            ch.postMessage({ type: 'cms_updated', source: 'social_toggle' });
                            ch.close();
                        }
                    } catch (e) {}
                } else {
                    this.socialVisible[channel] = !nextState;
                }
            } catch (e) {
                this.socialVisible[channel] = !nextState;
                if (window.Alpine && Alpine.store('admin')) {
                    Alpine.store('admin').showToast('Gagal menyimpan perubahan visibilitas kanal.', 'Kendala Koneksi', 'error');
                }
            } finally {
                this.socialToggling[channel] = false;
            }
        },

        init() {
            this.fetchGatewayStatus(true);
            this._gwTimer = setInterval(() => {
                if (!document.hidden) {
                    this.fetchGatewayStatus(false);
                }
            }, 4000);
        },

        async fetchGatewayStatus(showSpinner = false) {
            if (showSpinner) this.gwLoading = true;
            try {
                const res = await fetch('{{ route('admin.integrations.whatsapp.status') }}', {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    cache: 'no-store'
                });
                if (res.ok) {
                    const data = await res.json();
                    this.gwReachable = !!data.reachable;
                    this.gwLocalSupported = data.local_supported !== false;
                    if (data.state === 'serverless' || data.device_status === 'serverless') {
                        this.gwState = 'serverless';
                        this.gwDevice = null;
                        this.gwQr = null;
                        if (this._gwTimer) {
                            clearInterval(this._gwTimer);
                            this._gwTimer = null;
                        }
                    } else if (data.state === 'external' || data.device_status === 'external') {
                        this.gwState = 'external';
                        this.gwDevice = null;
                        this.gwQr = null;
                        if (this._gwTimer) {
                            clearInterval(this._gwTimer);
                            this._gwTimer = null;
                        }
                    } else if (!this.gwReachable) {
                        this.gwState = 'offline';
                        this.gwDevice = null;
                        this.gwQr = null;
                    } else {
                        this.gwState = data.state || (data.device_status === 'connect' ? 'connected' : 'disconnected');
                        this.gwDevice = data.device || null;
                        this.gwQr = data.qr || null;
                    }
                }
            } catch (e) {
                this.gwReachable = false;
                this.gwState = 'offline';
            } finally {
                this.gwLoading = false;
            }
        },

        async startGatewayServer() {
            this.gwStarting = true;
            try {
                const res = await fetch('{{ route('admin.integrations.whatsapp.start') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await res.json();
                if (window.Alpine && Alpine.store('admin')) {
                    Alpine.store('admin').showToast(
                        data.message || 'Menyalakan WhatsApp Gateway...',
                        data.ok ? 'Gateway Dinyalakan' : 'Gagal Menyalakan',
                        data.ok ? 'success' : 'error'
                    );
                }
                await this.fetchGatewayStatus(true);
                setTimeout(() => this.fetchGatewayStatus(false), 2000);
                setTimeout(() => this.fetchGatewayStatus(false), 4500);
            } catch (e) {
                if (window.Alpine && Alpine.store('admin')) {
                    Alpine.store('admin').showToast('Gagal menghubungi backend untuk menyalakan Gateway.', 'Kendala Koneksi', 'error');
                }
            } finally {
                this.gwStarting = false;
            }
        },

        async logoutGatewayDevice() {
            if (!confirm('Putuskan perangkat WhatsApp saat ini dan tampilkan QR Code baru untuk scan ulang?')) return;
            this.gwLoggingOut = true;
            try {
                const res = await fetch('{{ route('admin.integrations.whatsapp.logout') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (res.ok && window.Alpine && Alpine.store('admin')) {
                    Alpine.store('admin').showToast('Perangkat diputuskan. Menyiapkan QR Code baru...', 'Perangkat Diputus', 'info');
                }
                setTimeout(() => this.fetchGatewayStatus(true), 1500);
                setTimeout(() => this.fetchGatewayStatus(false), 4000);
            } catch (e) {} finally {
                this.gwLoggingOut = false;
            }
        },

        selectTestTarget(role) {
            this.testTargetRole = role;
            this.testPhone = role === 'marketing' ? this.waPublicNumber : this.waAdminNumber;
        },

        normalizePhone(raw) {
            const digits = String(raw || '').replace(/\D+/g, '');
            if (digits.startsWith('0')) return '62' + digits.slice(1);
            return digits;
        },

        async sendSmartWhatsAppTest() {
            const target = this.normalizePhone(this.testPhone);
            const msg = String(this.testMessage || '').trim();
            if (!target || target.length < 9) {
                if (window.Alpine && Alpine.store('admin')) {
                    Alpine.store('admin').showToast('Masukkan nomor WhatsApp tujuan yang valid (contoh: 62857xxxxxxxx).', 'Nomor Tidak Valid', 'error');
                }
                return;
            }
            if (!msg) {
                if (window.Alpine && Alpine.store('admin')) {
                    Alpine.store('admin').showToast('Isi pesan uji tidak boleh kosong.', 'Pesan Kosong', 'error');
                }
                return;
            }

            // Jika Gateway sedang Connected / Cloud API aktif, kirim otomatis di belakang layar!
            if (this.gwState === 'connected' || this.gwState === 'external') {
                this.testSending = true;
                try {
                    const res = await fetch('{{ route('admin.integrations.whatsapp.test') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ test_phone: target, test_message: msg })
                    });
                    const data = await res.json();
                    if (res.ok && data.ok) {
                        if (data.mode === 'direct' && data.wa_url) {
                            window.open(data.wa_url, '_blank', 'noopener,noreferrer');
                        }
                        if (window.Alpine && Alpine.store('admin')) {
                            Alpine.store('admin').showToast(data.message || ('Pesan uji terkirim ke ' + target), 'Uji Kirim WA Berhasil', 'success');
                        }
                        return;
                    }
                } catch (e) {
                    // Fallback ke direct wa.me
                } finally {
                    this.testSending = false;
                }
            }

            // Fallback mulus ke Direct WhatsApp (wa.me) tanpa error merah
            const waUrl = 'https://wa.me/' + target + '?text=' + encodeURIComponent(msg);
            window.open(waUrl, '_blank', 'noopener,noreferrer');
            if (window.Alpine && Alpine.store('admin')) {
                Alpine.store('admin').showToast('Mengarahkan pesan uji langsung ke WhatsApp ' + target + '.', 'WhatsApp Terbuka', 'success');
            }
        }
     }">

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
            <p class="font-bold font-['Agrandir',sans-serif] flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Periksa kembali input Anda:</span>
            </p>
            <ul class="list-disc list-inside text-rose-700 space-y-0.5 pl-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Standardized Top Action & Stat Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4 rounded-[24px] border border-[#3367A5]/15 shadow-sm min-h-[76px]">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-lg shrink-0 shadow-2xs">
                <i class="fa-solid fa-link"></i>
            </div>
            <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none flex items-center">
                WhatsApp &amp; Social Media
            </h2>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 shrink-0">
            <div class="h-11 px-4 rounded-2xl bg-[#f8fafd] border border-slate-200/80 inline-flex flex-col items-center justify-center text-center min-w-[100px]">
                <span class="text-[10px] text-slate-400 font-semibold leading-tight">Kanal Aktif</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-[#3367A5] leading-tight mt-0.5" x-text="activeChannelsCount">{{ $activeChannelsCount }}</span>
            </div>
            <div class="h-11 px-4 rounded-2xl border inline-flex flex-col items-center justify-center text-center min-w-[128px] transition-colors"
                 :class="{
                    'bg-emerald-50 border-emerald-200/80 text-emerald-700': gwState === 'connected' || gwState === 'external',
                    'bg-blue-50 border-blue-200/80 text-[#3367A5]': gwState === 'serverless',
                    'bg-amber-50 border-amber-200/80 text-amber-800': gwState === 'qr_ready' || gwState === 'connecting',
                    'bg-slate-50 border-slate-200 text-slate-600': gwState === 'offline' || gwState === 'disconnected' || gwState === 'checking'
                 }">
                <span class="text-[10px] font-semibold leading-tight opacity-80">WA Gateway PDF</span>
                <span class="text-xs font-bold font-['Agrandir',sans-serif] leading-tight mt-0.5"
                      x-text="gwState === 'connected' ? 'Terhubung' : (gwState === 'external' ? 'Cloud API Aktif' : (gwState === 'serverless' ? 'Mode wa.me' : (gwState === 'qr_ready' ? 'Siap Scan QR' : (gwState === 'connecting' ? 'Menghubungkan...' : (gwState === 'checking' ? 'Memeriksa...' : 'Belum Aktif')))))">
                    Memeriksa...
                </span>
            </div>
        </div>
    </div>

    <!-- Main Balanced 2-Column Workspace (Bottom-Aligned Equal Height) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-5 items-stretch">

        <!-- ============================================================== -->
        <!-- LEFT COLUMN (6 COLS): NOMOR WA + GATEWAY QR + UJI KIRIM        -->
        <!-- ============================================================== -->
        <div class="xl:col-span-6 flex flex-col gap-5">

            <!-- Card 1: Pengaturan Nomor WhatsApp -->
            <form method="POST" action="{{ route('admin.integrations.whatsapp.update') }}"
                  class="bg-white rounded-[24px] p-6 border border-[#3367A5]/15 shadow-sm space-y-5 text-xs">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                    </div>
                    <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none">
                        Pengaturan Nomor WhatsApp
                    </h3>
                </div>

                <!-- Admin & Marketing WhatsApp Numbers -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-700 font-bold mb-1.5 font-['Agrandir',sans-serif]">WhatsApp Admin Order Quotation *</label>
                        <input type="text" name="wa_admin_number"
                               x-model="waAdminNumber"
                               @input="if (testTargetRole === 'admin') testPhone = waAdminNumber"
                               required
                               placeholder="Contoh: 085732021121 atau 6285732021121"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 font-semibold outline-none focus:border-[#3367A5] transition">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-bold mb-1.5 font-['Agrandir',sans-serif]">WhatsApp Admin Marketing *</label>
                        <input type="text" name="wa_public_number"
                               x-model="waPublicNumber"
                               @input="if (testTargetRole === 'marketing') testPhone = waPublicNumber"
                               required
                               placeholder="Contoh: 085280002573 atau 6285280002573"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 font-semibold outline-none focus:border-[#3367A5] transition">
                    </div>
                </div>

                <!-- Optional Cloud Gateway Mode (Fonnte / Custom API) -->
                <details class="rounded-2xl bg-[#f8fafd] border border-slate-200/80 px-4 py-3 text-xs"
                         @if (($settings['wa_gateway_mode'] ?? 'local') === 'cloud') open @endif>
                    <summary class="font-bold font-['Agrandir',sans-serif] text-slate-700 cursor-pointer select-none flex items-center justify-between">
                        <span>Pengaturan Cloud API Gateway / Fonnte (Opsional untuk Auto-PDF)</span>
                        <span class="text-[10px] font-normal text-slate-500" x-text="waGatewayMode === 'cloud' ? 'Mode Cloud API' : 'Mode Default'"></span>
                    </summary>
                    <div class="pt-3 mt-3 border-t border-slate-200/70 space-y-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1">Mode Pengiriman</label>
                            <select name="wa_gateway_mode" x-model="waGatewayMode"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 font-semibold outline-none focus:border-[#3367A5]">
                                <option value="local">Default (Gateway Lokal / Direct wa.me di Vercel)</option>
                                <option value="cloud">Cloud API Eksternal (Fonnte / Wablas / Custom Endpoint)</option>
                            </select>
                        </div>
                        <div x-show="waGatewayMode === 'cloud'" x-cloak class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-slate-700 font-bold mb-1">Endpoint URL</label>
                                <input type="url" name="wa_gateway_endpoint"
                                       value="{{ old('wa_gateway_endpoint', str_contains((string) ($settings['wa_gateway_endpoint'] ?? ''), '127.0.0.1') ? 'https://api.fonnte.com/send' : ($settings['wa_gateway_endpoint'] ?? 'https://api.fonnte.com/send')) }}"
                                       placeholder="https://api.fonnte.com/send"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                            <div>
                                <label class="block text-slate-700 font-bold mb-1">API Token</label>
                                <input type="password" name="wa_gateway_token"
                                       value="{{ old('wa_gateway_token', ($settings['wa_gateway_token'] ?? '') === 'gat-internal-wa-secret-2026' ? '' : ($settings['wa_gateway_token'] ?? '')) }}"
                                       placeholder="Masukkan Token Fonnte / Cloud API"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                        </div>
                    </div>
                </details>

                <!-- Submit -->
                <div class="flex justify-end pt-2 border-t border-slate-100">
                    <button type="submit"
                            class="w-full sm:w-auto h-10 px-6 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] inline-flex items-center justify-center leading-none shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95 shrink-0">
                        Simpan WA Gateway
                    </button>
                </div>
            </form>

            <!-- Card 2: Koneksi WhatsApp Gateway (Scan QR Langsung di Dashboard untuk Kirim 1 Bubble PDF + Teks) -->
            <div class="bg-white rounded-[24px] p-6 border border-[#3367A5]/15 shadow-sm space-y-4 text-xs">
                <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-qrcode text-sm"></i>
                        </div>
                        <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none">
                            Koneksi WhatsApp Gateway (PDF Otomatis)
                        </h3>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="fetchGatewayStatus(true)"
                                class="h-8 px-3 rounded-xl bg-[#f8fafd] hover:bg-blue-50 border border-slate-200/90 text-slate-700 hover:text-[#3367A5] text-[11px] font-bold inline-flex items-center gap-1.5 transition cursor-pointer">
                            <i class="fa-solid fa-rotate text-[11px]" :class="gwLoading ? 'animate-spin' : ''"></i>
                            <span>Segarkan</span>
                        </button>
                    </div>
                </div>

                <!-- STATE A: Connected -->
                <div x-cloak x-show="gwState === 'connected'"
                     class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="font-bold font-['Agrandir',sans-serif] text-sm text-emerald-900">WhatsApp Gateway Terhubung</span>
                            </div>
                            <p class="text-xs text-emerald-800/90 mt-0.5 truncate">
                                Perangkat Pengirim: <strong class="font-mono" x-text="gwDevice ? ('+' + gwDevice) : 'Aktif'"></strong> — Pengiriman 1 bubble PDF Sales Quote + Teks aktif otomatis.
                            </p>
                        </div>
                    </div>

                    <button type="button" @click="logoutGatewayDevice()" :disabled="gwLoggingOut"
                            class="h-9 px-4 rounded-xl bg-white hover:bg-rose-50 text-rose-600 border border-rose-200 font-bold text-[11px] inline-flex items-center justify-center gap-1.5 transition cursor-pointer shrink-0 disabled:opacity-50">
                        <i class="fa-solid fa-right-from-bracket text-[11px]"></i>
                        <span x-text="gwLoggingOut ? 'Memutus...' : 'Ganti Perangkat'"></span>
                    </button>
                </div>

                <!-- STATE B: QR Ready (Scan Directly Right Here!) -->
                <div x-cloak x-show="gwState === 'qr_ready' && gwQr"
                     class="p-4 rounded-2xl bg-[#f8fafd] border border-[#3367A5]/20 flex flex-col sm:flex-row items-center gap-5">
                    <div class="p-2.5 bg-white rounded-2xl border border-slate-200 shadow-sm shrink-0">
                        <img :src="gwQr" alt="QR Code WhatsApp Gateway" class="w-44 h-44 object-contain">
                    </div>
                    <div class="space-y-2.5 text-center sm:text-left">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-[#E6F0FA] text-[#244E81] text-[10px] font-bold uppercase tracking-wider font-['Agrandir',sans-serif]">
                            Scan QR di Sini
                        </span>
                        <h4 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900">
                            Tautkan WhatsApp Pengirim (1x Scan)
                        </h4>
                        <ol class="text-xs text-slate-600 space-y-1 list-decimal list-inside leading-relaxed">
                            <li>Buka aplikasi <strong>WhatsApp</strong> di HP Anda.</li>
                            <li>Pilih menu <strong>Perangkat Tertaut → Tautkan Perangkat</strong>.</li>
                            <li>Arahkan kamera ke QR Code di samping (otomatis tersambung &amp; tersimpan permanen).</li>
                        </ol>
                    </div>
                </div>

                <!-- STATE C: Connecting / Initializing -->
                <div x-cloak x-show="gwState === 'connecting' || gwState === 'checking' || (gwState === 'qr_ready' && !gwQr)"
                     class="p-5 rounded-2xl bg-[#f8fafd] border border-slate-200/80 flex items-center justify-center gap-3 text-slate-600">
                    <i class="fa-solid fa-circle-notch animate-spin text-[#3367A5] text-base"></i>
                    <span class="font-semibold">Menghubungkan ke WhatsApp Gateway &amp; menyiapkan QR Code...</span>
                </div>

                <!-- STATE D: Offline (1-Click Start Button! Only when local/VPS server.js exists) -->
                <div x-cloak x-show="gwState === 'offline' || gwState === 'disconnected'"
                     class="p-5 rounded-2xl bg-[#f8fafd] border border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5 text-center sm:text-left">
                        <div class="w-11 h-11 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-power-off text-base"></i>
                        </div>
                        <div>
                            <p class="font-bold font-['Agrandir',sans-serif] text-slate-900 text-xs sm:text-sm">
                                Mesin WhatsApp Gateway Belum Menyala
                            </p>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">
                                Nyalakan dengan 1 klik untuk mengaktifkan pengiriman otomatis <strong>File PDF + Teks dalam 1 pesan</strong> saat order masuk.
                            </p>
                        </div>
                    </div>

                    <button type="button" @click="startGatewayServer()" :disabled="gwStarting"
                            class="w-full sm:w-auto h-10 px-5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] inline-flex items-center justify-center gap-2 shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95 shrink-0 disabled:opacity-60">
                        <i class="fa-solid" :class="gwStarting ? 'fa-circle-notch animate-spin' : 'fa-play'"></i>
                        <span x-text="gwStarting ? 'Menyalakan...' : 'Nyalakan Gateway'"></span>
                    </button>
                </div>

                <!-- STATE E: Serverless Cloud Hosting (Vercel -> Direct wa.me Active, No Local Node Daemon) -->
                <div x-cloak x-show="gwState === 'serverless'"
                     class="p-5 rounded-2xl bg-[#f0f6ff] border border-[#3367A5]/20 flex items-start gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-white text-[#3367A5] border border-[#3367A5]/15 flex items-center justify-center shrink-0">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </div>
                    <div class="space-y-1.5 text-left">
                        <p class="font-bold font-['Agrandir',sans-serif] text-slate-900 text-xs sm:text-sm">
                            Mode Tautan WhatsApp Langsung (wa.me) Aktif di Cloud Vercel
                        </p>
                        <p class="text-[11px] text-slate-600 leading-relaxed">
                            Serverless Vercel tidak menjalankan mesin Node.js lokal (<code class="px-1 py-0.5 rounded bg-white text-[#3367A5]">whatsapp-gateway/server.js</code>). Pengajuan PO B2B dan tombol Uji Kirim WA otomatis membuka chat WhatsApp Admin dengan draf pesanan siap kirim.
                        </p>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Ingin kirim file PDF otomatis di belakang layar? Isi <strong>Cloud API (Fonnte)</strong> pada bagian Pengaturan di atas, atau jalankan website di <strong>VPS</strong> nanti saat Go-Live.
                        </p>
                    </div>
                </div>

                <!-- STATE F: Cloud API Active (Fonnte / Custom Endpoint) -->
                <div x-cloak x-show="gwState === 'external'"
                     class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200/80 flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                        <i class="fa-solid fa-cloud text-base"></i>
                    </div>
                    <div>
                        <span class="font-bold font-['Agrandir',sans-serif] text-sm text-emerald-900">Cloud WhatsApp API Aktif</span>
                        <p class="text-xs text-emerald-800/90 mt-0.5">
                            Pengiriman otomatis Sales Quote PDF ke WhatsApp Admin menggunakan Cloud API eksternal.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Uji Kirim Pesan WA -->
            <form method="POST" action="{{ route('admin.integrations.whatsapp.test') }}"
                  @submit.prevent="sendSmartWhatsAppTest()"
                  class="flex-1 bg-white rounded-[24px] p-6 border border-[#3367A5]/15 shadow-sm flex flex-col justify-between gap-4 text-xs">
                @csrf
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-paper-plane text-sm"></i>
                            </div>
                            <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none">Uji Kirim Pesan WA</h3>
                        </div>

                        <div class="inline-flex items-center p-1 rounded-full bg-[#f4f7fb] border border-slate-200/80">
                            <button type="button"
                                    @click="selectTestTarget('admin')"
                                    :class="testTargetRole === 'admin' ? 'bg-[#3367A5] text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                                    class="px-3 py-1 rounded-full text-[11px] font-semibold transition cursor-pointer">
                                Order Quotation
                            </button>
                            <button type="button"
                                    @click="selectTestTarget('marketing')"
                                    :class="testTargetRole === 'marketing' ? 'bg-[#3367A5] text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                                    class="px-3 py-1 rounded-full text-[11px] font-semibold transition cursor-pointer">
                                Marketing
                            </button>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Nomor Tujuan Uji *</label>
                            <input type="text" name="test_phone"
                                   x-model="testPhone"
                                   required
                                   placeholder="62857xxxxxxxx"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 font-semibold outline-none focus:border-[#3367A5] transition">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Isi Pesan Uji *</label>
                            <textarea name="test_message" rows="3" required x-model="testMessage"
                                      class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] resize-none transition"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" :disabled="testSending"
                        class="w-full h-10 px-4 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold font-['Agrandir',sans-serif] inline-flex items-center justify-center gap-2 leading-none shadow-sm transition cursor-pointer active:scale-[0.99] disabled:opacity-60">
                    <i class="fa-solid text-[11px]" :class="testSending ? 'fa-circle-notch animate-spin' : 'fa-paper-plane'"></i>
                    <span x-text="testSending ? 'Mengirim via Gateway...' : 'Kirim Pesan Uji Sekarang'"></span>
                </button>
            </form>
        </div>

        <!-- ============================================================== -->
        <!-- RIGHT COLUMN (6 COLS): SOCIAL MEDIA & KONTAK PUBLIK MANAGER    -->
        <!-- ============================================================== -->
        <div class="xl:col-span-6 flex">
            <form method="POST" action="{{ route('admin.integrations.social.update') }}"
                  class="w-full h-full bg-white rounded-[24px] p-6 border border-[#3367A5]/15 shadow-sm flex flex-col justify-between gap-4 text-xs">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div class="flex flex-wrap items-center justify-between gap-2 pb-3.5 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-share-nodes text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none">
                                    Social Media &amp; Kontak Publik
                                </h3>
                                <p class="text-[11px] text-slate-400 mt-1">
                                    Atur Hide / Unhide masing-masing kanal untuk tombol Popout (+) &amp; Footer.
                                </p>
                            </div>
                        </div>
                    </div>

                    @php
                        $socialFields = [
                            [
                                'key' => 'linkedin',
                                'name' => 'social_linkedin',
                                'label' => 'LinkedIn Perusahaan',
                                'icon' => 'fa-brands fa-linkedin text-[#0A66C2]',
                                'placeholder' => 'https://www.linkedin.com/in/gat-aspect/',
                            ],
                            [
                                'key' => 'instagram',
                                'name' => 'social_instagram',
                                'label' => 'Instagram',
                                'icon' => 'fa-brands fa-instagram text-pink-600',
                                'placeholder' => 'https://www.instagram.com/globalaspect.id/',
                            ],
                            [
                                'key' => 'youtube',
                                'name' => 'social_youtube',
                                'label' => 'YouTube Channel',
                                'icon' => 'fa-brands fa-youtube text-red-600',
                                'placeholder' => 'https://www.youtube.com/@globalaspect',
                            ],
                            [
                                'key' => 'facebook',
                                'name' => 'social_facebook',
                                'label' => 'Facebook Page',
                                'icon' => 'fa-brands fa-facebook text-blue-600',
                                'placeholder' => 'https://www.facebook.com/globalaspect',
                            ],
                            [
                                'key' => 'tiktok',
                                'name' => 'social_tiktok',
                                'label' => 'TikTok',
                                'icon' => 'fa-brands fa-tiktok text-slate-900',
                                'placeholder' => 'https://www.tiktok.com/@globalaspect',
                            ],
                        ];
                    @endphp

                    @foreach ($socialFields as $sf)
                        <div class="space-y-1.5">
                            <input type="hidden" name="{{ $sf['name'] }}_visible" :value="socialVisible.{{ $sf['key'] }} ? '1' : '0'">
                            <div class="flex items-center justify-between gap-2">
                                <label class="flex items-center gap-2 text-slate-700 font-bold font-['Agrandir',sans-serif]">
                                    <i class="{{ $sf['icon'] }} text-sm"></i>
                                    <span>{{ $sf['label'] }}</span>
                                </label>
                                <button type="button"
                                        @click="toggleSocialChannel('{{ $sf['key'] }}')"
                                        :disabled="!!socialToggling['{{ $sf['key'] }}']"
                                        :class="socialVisible.{{ $sf['key'] }}
                                            ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100'
                                            : 'bg-slate-100 text-slate-500 border-slate-200 hover:bg-slate-200/80'"
                                        class="h-7 px-2.5 rounded-full border text-[11px] font-bold inline-flex items-center gap-1.5 transition cursor-pointer shrink-0 disabled:opacity-60">
                                    <i class="fa-solid text-[10px]"
                                       :class="socialToggling['{{ $sf['key'] }}'] ? 'fa-circle-notch animate-spin' : (socialVisible.{{ $sf['key'] }} ? 'fa-eye' : 'fa-eye-slash')"></i>
                                    <span x-text="socialVisible.{{ $sf['key'] }} ? 'Tampil' : 'Disembunyikan'"></span>
                                </button>
                            </div>
                            <input type="url" name="{{ $sf['name'] }}"
                                   x-model="socialValues.{{ $sf['key'] }}"
                                   placeholder="{{ $sf['placeholder'] }}"
                                   :class="!socialVisible.{{ $sf['key'] }} ? 'opacity-60 bg-slate-50' : 'bg-[#f8fafd] focus:bg-white'"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-800 outline-none focus:border-[#3367A5] transition">
                            <p x-cloak x-show="socialVisible.{{ $sf['key'] }} && !String(socialValues.{{ $sf['key'] }} || '').trim()"
                               class="text-[11px] text-amber-600 font-medium">
                                Isi tautan {{ $sf['label'] }} lalu klik Simpan agar ikon muncul di Popout (+).
                            </p>
                        </div>
                    @endforeach

                    <!-- Public Email (Gmail) -->
                    <div class="pt-2 border-t border-slate-100 space-y-1.5">
                        <input type="hidden" name="social_email_visible" :value="socialVisible.email ? '1' : '0'">
                        <div class="flex items-center justify-between gap-2">
                            <label class="flex items-center gap-2 text-slate-700 font-bold font-['Agrandir',sans-serif]">
                                <i class="fa-solid fa-envelope text-[#EA4335] text-sm"></i>
                                <span>Email Kontak Publik (Gmail) *</span>
                            </label>
                            <button type="button"
                                    @click="toggleSocialChannel('email')"
                                    :disabled="!!socialToggling['email']"
                                    :class="socialVisible.email
                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100'
                                        : 'bg-slate-100 text-slate-500 border-slate-200 hover:bg-slate-200/80'"
                                    class="h-7 px-2.5 rounded-full border text-[11px] font-bold inline-flex items-center gap-1.5 transition cursor-pointer shrink-0 disabled:opacity-60">
                                <i class="fa-solid text-[10px]"
                                   :class="socialToggling['email'] ? 'fa-circle-notch animate-spin' : (socialVisible.email ? 'fa-eye' : 'fa-eye-slash')"></i>
                                <span x-text="socialVisible.email ? 'Tampil' : 'Disembunyikan'"></span>
                            </button>
                        </div>
                        <input type="email" name="social_email"
                               x-model="socialValues.email" required
                               placeholder="admin@gat-aspect.com"
                               :class="!socialVisible.email ? 'opacity-60 bg-slate-50' : 'bg-[#f8fafd] focus:bg-white'"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-800 outline-none focus:border-[#3367A5] transition">
                    </div>
                </div>

                <button type="submit"
                        class="w-full h-10 px-6 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] inline-flex items-center justify-center leading-none shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-[0.99]">
                    Simpan Social Media &amp; Kontak
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
