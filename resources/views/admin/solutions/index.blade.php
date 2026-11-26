@extends('components.layouts.admin')

@section('title', 'Manajemen Solusi Otomasi')

@section('content')
@php
    $visibilityOptions = [
        'all' => ['label' => 'Semua Status', 'dot' => 'bg-blue-400'],
        'shown' => ['label' => 'Tayang (Navbar)', 'dot' => 'bg-emerald-500'],
        'hidden' => ['label' => 'Hidden (Disembunyikan)', 'dot' => 'bg-slate-400'],
    ];
    $activeVisibility = $visibilityOptions[$visibility] ?? $visibilityOptions['all'];
    $isSolutionFiltered = ($visibility !== 'all' && !empty($visibility)) || !empty($search);

    $solutionsData = $solutions->getCollection()->mapWithKeys(function ($sol) {
        $pc = $sol->resolvedPageContent();
        return [
            $sol->id => [
                'id' => $sol->id,
                'name' => $sol->name,
                'short_description' => $sol->short_description ?? '',
                'description' => $sol->description ?? '',
                'sort_order' => $sol->sort_order ?? 0,
                'show_in_navbar' => (bool) $sol->show_in_navbar,
                'public_url' => $sol->publicUrl(),
                'page_content' => [
                    'hero_subtitle' => $pc['hero_subtitle'] ?? '',
                    'stats' => $pc['stats'] ?? [],
                    'tags_text' => implode(', ', $pc['tags'] ?? []),
                    'deliverables_subtitle' => $pc['deliverables_subtitle'] ?? '',
                    'deliverables' => $pc['deliverables'] ?? [],
                    'process_subtitle' => $pc['process_subtitle'] ?? '',
                    'process_steps' => $pc['process_steps'] ?? [],
                    'faqs' => $pc['faqs'] ?? [],
                    'cta_title' => $pc['cta_title'] ?? '',
                    'cta_description' => $pc['cta_description'] ?? '',
                    'cta_button_text' => $pc['cta_button_text'] ?? 'Get A Quote / Consultation',
                ],
            ],
        ];
    });

    $solutionIconMap = [
        'plc-progamming' => 'fa-solid fa-microchip',
        'inspection' => 'fa-solid fa-camera',
        'software' => 'fa-solid fa-chart-line',
        'intergrator' => 'fa-solid fa-diagram-project',
        'laser-marking' => 'fa-solid fa-crosshairs',
        'strapping' => 'fa-solid fa-box-open',
    ];
@endphp

<div class="space-y-6" x-data="{
    modalOpen: false,
    modalMode: 'create',
    activeTab: 'hero',
    solutionsMap: @js($solutionsData),
    form: {
        id: null,
        name: '',
        short_description: '',
        description: '',
        sort_order: {{ $totalSolutions + 1 }},
        show_in_navbar: true,
        public_url: '',
        hero_subtitle: '',
        tags_text: '',
        stats: [],
        deliverables_subtitle: '',
        deliverables: [],
        process_subtitle: '',
        process_steps: [],
        faqs: [],
        cta_title: '',
        cta_description: '',
        cta_button_text: 'Get A Quote / Consultation'
    },
    defaultNewForm() {
        return {
            id: null,
            name: '',
            short_description: '',
            description: '',
            sort_order: {{ $totalSolutions + 1 }},
            show_in_navbar: true,
            public_url: '',
            hero_subtitle: '',
            tags_text: '',
            stats: [
                { value: '100+', label: 'Industrial Lines Deployed' },
                { value: '99.9%', label: 'Operational Uptime SLA' },
                { value: '24/7', label: 'Engineering Support' }
            ],
            deliverables_subtitle: 'Comprehensive industrial engineering capabilities tailored to your plant floor.',
            deliverables: [
                { title: '', description: '', highlights: [''] }
            ],
            process_subtitle: 'A structured engineering methodology guaranteeing seamless deployment and high uptime.',
            process_steps: [
                { title: 'Audit & Architecture', description: '' },
                { title: 'Engineering & Setup', description: '' },
                { title: 'Testing & FAT', description: '' },
                { title: 'Commissioning & Handover', description: '' }
            ],
            faqs: [
                { question: '', answer: '' }
            ],
            cta_title: '',
            cta_description: 'Contact our automation engineering team to discuss your machinery specs, cycle time goals, and custom integration blueprint.',
            cta_button_text: 'Get A Quote / Consultation'
        };
    },
    openCreateModal() {
        this.modalMode = 'create';
        this.activeTab = 'hero';
        this.form = this.defaultNewForm();
        this.modalOpen = true;
    },
    openEditModal(id) {
        const data = this.solutionsMap[id];
        if (!data) return;
        const pc = data.page_content || {};
        this.modalMode = 'edit';
        this.activeTab = 'hero';
        this.form = {
            id: data.id,
            name: data.name || '',
            short_description: data.short_description || '',
            description: data.description || '',
            sort_order: data.sort_order ?? 0,
            show_in_navbar: Boolean(data.show_in_navbar),
            public_url: data.public_url || '',
            hero_subtitle: pc.hero_subtitle || '',
            tags_text: pc.tags_text || '',
            stats: JSON.parse(JSON.stringify(pc.stats && pc.stats.length ? pc.stats : [{ value: '', label: '' }])),
            deliverables_subtitle: pc.deliverables_subtitle || '',
            deliverables: JSON.parse(JSON.stringify(pc.deliverables && pc.deliverables.length ? pc.deliverables.map(d => ({
                title: d.title || '',
                description: d.description || '',
                highlights: (d.highlights && d.highlights.length) ? d.highlights : ['']
            })) : [{ title: '', description: '', highlights: [''] }])),
            process_subtitle: pc.process_subtitle || '',
            process_steps: JSON.parse(JSON.stringify(pc.process_steps && pc.process_steps.length ? pc.process_steps : [{ title: '', description: '' }])),
            faqs: JSON.parse(JSON.stringify(pc.faqs && pc.faqs.length ? pc.faqs : [{ question: '', answer: '' }])),
            cta_title: pc.cta_title || '',
            cta_description: pc.cta_description || '',
            cta_button_text: pc.cta_button_text || 'Get A Quote / Consultation'
        };
        this.modalOpen = true;
    },
    addStat() {
        this.form.stats.push({ value: '', label: '' });
    },
    removeStat(idx) {
        this.form.stats.splice(idx, 1);
    },
    addDeliverable() {
        this.form.deliverables.push({ title: '', description: '', highlights: [''] });
    },
    removeDeliverable(idx) {
        this.form.deliverables.splice(idx, 1);
    },
    addHighlight(dIdx) {
        this.form.deliverables[dIdx].highlights.push('');
    },
    removeHighlight(dIdx, hIdx) {
        this.form.deliverables[dIdx].highlights.splice(hIdx, 1);
        if (this.form.deliverables[dIdx].highlights.length === 0) {
            this.form.deliverables[dIdx].highlights.push('');
        }
    },
    addProcessStep() {
        this.form.process_steps.push({ title: '', description: '' });
    },
    removeProcessStep(idx) {
        this.form.process_steps.splice(idx, 1);
    },
    addFaq() {
        this.form.faqs.push({ question: '', answer: '' });
    },
    removeFaq(idx) {
        this.form.faqs.splice(idx, 1);
    },
    serializedPageContent() {
        return JSON.stringify({
            hero_subtitle: this.form.hero_subtitle,
            tags: this.form.tags_text.split(',').map(t => t.trim()).filter(Boolean),
            stats: this.form.stats,
            deliverables_subtitle: this.form.deliverables_subtitle,
            deliverables: this.form.deliverables,
            process_subtitle: this.form.process_subtitle,
            process_steps: this.form.process_steps,
            faqs: this.form.faqs,
            cta_title: this.form.cta_title,
            cta_description: this.form.cta_description,
            cta_button_text: this.form.cta_button_text
        });
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
                <i class="fa-solid fa-microchip"></i>
            </div>
            <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none flex items-center">
                Solusi &amp; Sistem Otomasi Pabrik
            </h2>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('admin.solutions.index') }}"
               class="hidden md:inline-flex h-11 px-4 rounded-2xl bg-[#f8fafd] hover:bg-slate-100 border {{ $visibility === 'all' && empty($search) ? 'border-[#3367A5]/40 ring-2 ring-[#3367A5]/10' : 'border-slate-200/80' }} flex-col items-center justify-center text-center shadow-2xs min-w-[92px] transition"
               title="Tampilkan semua solusi">
                <span class="text-[10px] text-slate-400 font-semibold font-['Questrial',sans-serif] leading-tight block">Total Solusi</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight block mt-0.5">{{ $totalSolutions }}</span>
            </a>
            <a href="{{ route('admin.solutions.index', ['visibility' => 'shown']) }}"
               class="hidden md:inline-flex h-11 px-4 rounded-2xl bg-emerald-50 hover:bg-emerald-100/80 border {{ $visibility === 'shown' ? 'border-emerald-400 ring-2 ring-emerald-500/15' : 'border-emerald-200/80' }} flex-col items-center justify-center text-center shadow-2xs min-w-[92px] transition"
               title="Filter solusi yang sedang tayang">
                <span class="text-[10px] text-emerald-700 font-semibold font-['Questrial',sans-serif] leading-tight block">Tayang</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-emerald-700 leading-tight block mt-0.5">{{ $shownSolutionsCount }}</span>
            </a>
            <button type="button"
                    @click="openCreateModal()"
                    class="h-11 px-5 inline-flex items-center justify-center gap-2 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95 leading-none">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Solusi Baru</span>
            </button>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 text-xs">
        <form id="solutionsFilterForm" method="GET" action="{{ route('admin.solutions.index') }}" class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
            <input type="hidden" name="visibility" id="filterSolutionVisibilityInput" value="{{ $visibility }}">

            <!-- Search Input -->
            <div class="relative w-full sm:w-auto">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau deskripsi solusi..."
                       class="pl-8 pr-8 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-700 outline-none focus:border-[#3367A5] w-full sm:w-64 text-xs font-['Questrial',sans-serif] transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400"></i>
                @if (!empty($search))
                    <button type="button" onclick="document.querySelector('#solutionsFilterForm input[name=search]').value=''; document.getElementById('solutionsFilterForm').submit()"
                            class="absolute right-2.5 top-2 text-slate-400 hover:text-slate-600 cursor-pointer" title="Hapus pencarian">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                @endif
            </div>

            <!-- Custom Dropdown: Status Penayangan -->
            <div class="relative" x-data="{ openVis: false }">
                <button type="button" @click="openVis = !openVis"
                    class="inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer min-w-[170px] {{ ($visibility !== 'all' && !empty($visibility)) ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                    <div class="flex items-center gap-2 truncate">
                        <span class="w-2 h-2 rounded-full {{ $activeVisibility['dot'] }} shrink-0"></span>
                        <span class="truncate">{{ $activeVisibility['label'] }}</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200"
                        :class="{ 'rotate-180': openVis }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-cloak x-show="openVis" @click.outside="openVis = false"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                    class="absolute left-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">

                    <div class="py-1">
                        @foreach ($visibilityOptions as $key => $opt)
                            <button type="button"
                                @click="document.getElementById('filterSolutionVisibilityInput').value = '{{ $key }}'; document.getElementById('solutionsFilterForm').submit()"
                                class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $visibility === $key ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-2 h-2 rounded-full {{ $opt['dot'] }} shrink-0"></span>
                                    <span class="font-['Questrial',sans-serif] {{ $visibility === $key ? 'font-bold text-[#3367A5]' : '' }}">{{ $opt['label'] }}</span>
                                </div>
                                @if ($visibility === $key)
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

            @if ($isSolutionFiltered)
                <a href="{{ route('admin.solutions.index') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-rose-600 hover:bg-rose-50 font-semibold transition">
                    <i class="fa-solid fa-rotate-left text-[11px]"></i>
                    <span>Reset</span>
                </a>
            @endif
        </form>
    </div>

    <!-- Solutions Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse ($solutions as $sol)
            @php
                $publicUrl = $sol->publicUrl();
                $iconClass = $solutionIconMap[$sol->slug] ?? 'fa-solid fa-gears';
            @endphp
            <div class="bg-white rounded-[24px] border border-slate-200/90 shadow-xs p-5 flex flex-col justify-between gap-4 hover:border-[#3367A5]/40 transition group">
                <div>
                    <!-- Card Header: Distinct Icon -->
                    <div class="flex items-center justify-between gap-2 mb-3.5">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold shrink-0">
                            <i class="{{ $iconClass }} text-base"></i>
                        </div>
                    </div>

                    <!-- Title & Sub-label (Consistent Heights) -->
                    <div class="min-h-[26px] flex items-center">
                        <h3 class="text-base font-bold font-['Agrandir',sans-serif] text-slate-900 leading-snug line-clamp-1" title="{{ $sol->name }}">
                            {{ $sol->name }}
                        </h3>
                    </div>

                    <div class="min-h-[20px] mt-0.5">
                        <p class="text-xs text-[#3367A5] font-semibold line-clamp-1 font-['Questrial',sans-serif]" title="{{ $sol->short_description }}">
                            {{ $sol->short_description ?: 'Layanan Otomasi Presisi GAT' }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="min-h-[60px] mt-2">
                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed font-['Questrial',sans-serif]">
                            {{ $sol->description }}
                        </p>
                    </div>

                    <!-- Interactive Status Row (Ditempatkan tepat di atas tombol aksi) -->
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between gap-2 h-8">
                        <span class="text-xs text-slate-400 font-['Questrial',sans-serif] leading-none">Status Tayang:</span>
                        <form method="POST" action="{{ route('admin.solutions.toggle-navbar', $sol->id) }}" class="inline-flex m-0 p-0">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="h-6 px-2.5 inline-flex items-center justify-center text-center rounded-md text-[10px] font-bold font-['Agrandir',sans-serif] tracking-wider transition shadow-2xs cursor-pointer active:scale-95 leading-none {{ $sol->show_in_navbar ? 'bg-emerald-500 hover:bg-emerald-600 text-white' : 'bg-slate-400 hover:bg-slate-500 text-white' }}"
                                    title="Klik untuk ubah status ke {{ $sol->show_in_navbar ? 'HIDDEN' : 'TAYANG' }}">
                                {{ $sol->show_in_navbar ? 'TAYANG' : 'HIDDEN' }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Card Footer Actions (Uniform Height & Centered) -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                    <button type="button"
                            @click="openEditModal({{ $sol->id }})"
                            class="flex-1 h-9 px-3 rounded-xl border border-slate-200 hover:border-[#3367A5] hover:bg-blue-50/50 text-[#3367A5] font-bold text-xs font-['Agrandir',sans-serif] transition inline-flex items-center justify-center gap-1.5 cursor-pointer leading-none">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                        <span>Edit Halaman</span>
                    </button>

                    <a href="{{ $publicUrl }}" target="_blank" rel="noopener noreferrer"
                       class="w-9 h-9 rounded-xl border border-slate-200 hover:border-[#3367A5] hover:bg-blue-50/50 text-slate-500 hover:text-[#3367A5] inline-flex items-center justify-center transition shrink-0"
                       title="Buka halaman publik solusi ini">
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </a>

                    <form method="POST" action="{{ route('admin.solutions.destroy', $sol->id) }}" class="inline-flex m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus solusi {{ addslashes($sol->name) }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-9 h-9 rounded-xl border border-slate-200 hover:border-rose-400 hover:bg-rose-50 text-rose-600 inline-flex items-center justify-center transition cursor-pointer shrink-0"
                                title="Hapus Solusi">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-200">
                <i class="fa-solid fa-microchip text-4xl mb-3 text-slate-300 block"></i>
                <p class="font-['Agrandir',sans-serif] font-bold text-slate-700 text-sm">Tidak ada solusi yang ditemukan</p>
                <p class="text-xs text-slate-400 font-['Questrial',sans-serif] mt-1">Coba sesuaikan kata kunci pencarian atau reset filter status.</p>
                @if ($isSolutionFiltered)
                    <div class="mt-4">
                        <a href="{{ route('admin.solutions.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-50 text-[#3367A5] font-bold text-xs font-['Agrandir',sans-serif] hover:bg-blue-100 transition">
                            <i class="fa-solid fa-rotate-left"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($solutions->hasPages())
        <div class="bg-white px-5 py-3.5 rounded-2xl border border-slate-200/80 shadow-2xs">
            {{ $solutions->links() }}
        </div>
    @endif

    <!-- ========================================================================= -->
    <!-- UNIFIED 4-TAB PAGE BUILDER MODAL (TAMBAH & EDIT HALAMAN SOLUSI LENGKAP)   -->
    <!-- ========================================================================= -->
    <template x-teleport="body">
        <div x-cloak x-show="modalOpen"
             class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center p-3 sm:p-4 md:p-6 bg-slate-900/60 backdrop-blur-xs overflow-hidden"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <form method="POST"
                  :action="modalMode === 'edit' ? `{{ url('admin/solutions') }}/${form.id}` : '{{ route('admin.solutions.store') }}'"
                  enctype="multipart/form-data"
                  class="bg-white rounded-[28px] max-w-3xl w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[92vh] overflow-hidden my-auto"
                  @click.outside="modalOpen = false">
                @csrf
                <template x-if="modalMode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <input type="hidden" name="page_content_json" :value="serializedPageContent()">

                <!-- Pinned Header -->
                <div class="px-6 sm:px-7 pt-5 pb-3.5 border-b border-slate-100 flex items-center justify-between gap-3 shrink-0 bg-white">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold shrink-0">
                            <i :class="modalMode === 'edit' ? 'fa-solid fa-pen-to-square' : 'fa-solid fa-plus'"></i>
                        </div>
                        <h3 class="text-sm sm:text-base font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none truncate"
                            x-text="modalMode === 'edit' ? 'Edit Halaman Solusi: ' + form.name : 'Tambah Solusi & Halaman Baru'"></h3>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <template x-if="modalMode === 'edit' && form.public_url">
                            <a :href="form.public_url" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-[#3367A5] font-bold text-[11px] font-['Agrandir',sans-serif] transition">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                <span>Lihat Halaman</span>
                            </a>
                        </template>
                        <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Pinned 4-Tab Section Bar -->
                <div class="px-6 sm:px-7 py-2.5 bg-[#f8fafd] border-b border-slate-100 flex flex-wrap items-center gap-1.5 shrink-0">
                    <button type="button" @click="activeTab = 'hero'"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold font-['Agrandir',sans-serif] transition cursor-pointer inline-flex items-center gap-1.5"
                            :class="activeTab === 'hero' ? 'bg-[#3367A5] text-white shadow-xs' : 'text-slate-600 hover:bg-white hover:text-[#3367A5]'">
                        <i class="fa-solid fa-heading text-[11px]"></i>
                        <span>Hero &amp; Info</span>
                    </button>
                    <button type="button" @click="activeTab = 'deliverables'"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold font-['Agrandir',sans-serif] transition cursor-pointer inline-flex items-center gap-1.5"
                            :class="activeTab === 'deliverables' ? 'bg-[#3367A5] text-white shadow-xs' : 'text-slate-600 hover:bg-white hover:text-[#3367A5]'">
                        <i class="fa-solid fa-layer-group text-[11px]"></i>
                        <span>Layanan (<span x-text="form.deliverables.length"></span>)</span>
                    </button>
                    <button type="button" @click="activeTab = 'process'"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold font-['Agrandir',sans-serif] transition cursor-pointer inline-flex items-center gap-1.5"
                            :class="activeTab === 'process' ? 'bg-[#3367A5] text-white shadow-xs' : 'text-slate-600 hover:bg-white hover:text-[#3367A5]'">
                        <i class="fa-solid fa-diagram-next text-[11px]"></i>
                        <span>Proses (<span x-text="form.process_steps.length"></span>)</span>
                    </button>
                    <button type="button" @click="activeTab = 'faq'"
                            class="px-3.5 py-2 rounded-xl text-xs font-bold font-['Agrandir',sans-serif] transition cursor-pointer inline-flex items-center gap-1.5"
                            :class="activeTab === 'faq' ? 'bg-[#3367A5] text-white shadow-xs' : 'text-slate-600 hover:bg-white hover:text-[#3367A5]'">
                        <i class="fa-solid fa-circle-question text-[11px]"></i>
                        <span>FAQ &amp; CTA</span>
                    </button>
                </div>

                <!-- Single Smooth Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 sm:px-7 py-5 space-y-5 text-xs overscroll-contain"
                     style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">

                    <!-- ================= TAB 1: HERO & INFO ================= -->
                    <div x-show="activeTab === 'hero'" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                            <div class="sm:col-span-3">
                                <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Nama Solusi / Judul Halaman *</label>
                                <input type="text" name="name" x-model="form.name" placeholder="Contoh: PLC Programming" required
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                            </div>
                            <div>
                                <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Urutan Tampil</label>
                                <input type="number" name="sort_order" min="0" x-model="form.sort_order"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Sub-label Ringkas (Navbar)</label>
                                <input type="text" name="short_description" x-model="form.short_description" placeholder="Contoh: Mitsubishi, Omron, Siemens, etc."
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                            </div>
                            <div>
                                <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Tags Teknologi (pisah koma)</label>
                                <input type="text" x-model="form.tags_text" placeholder="Mitsubishi, Siemens, Omron, Keyence"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Tagline Hero Halaman (Teks Biru Besar)</label>
                            <input type="text" x-model="form.hero_subtitle" placeholder="Contoh: Mission-Critical Logic Architecture, Motion Control & System Retrofitting"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Deskripsi Utama (Hero &amp; Kartu Solusi) *</label>
                            <textarea name="description" rows="3" x-model="form.description" required placeholder="Uraikan kapabilitas teknik, brand hardware yang didukung, dan solusi industri..."
                                      class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition leading-relaxed"></textarea>
                        </div>

                        <!-- Hero Stats Cards Builder -->
                        <div class="p-4 rounded-2xl border border-slate-200/80 bg-[#f8fafd] space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-800 font-['Agrandir',sans-serif] flex items-center gap-2">
                                    <i class="fa-solid fa-chart-simple text-[#3367A5]"></i> Statistik Hero Halaman
                                </span>
                                <button type="button" @click="addStat()"
                                        class="px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-[#3367A5] font-bold text-[11px] transition cursor-pointer">
                                    + Tambah Stat
                                </button>
                            </div>

                            <div class="space-y-2">
                                <template x-for="(stat, sIdx) in form.stats" :key="sIdx">
                                    <div class="flex items-center gap-2">
                                        <input type="text" x-model="stat.value" placeholder="Angka (mis. 150+)"
                                               class="w-32 px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-900 font-bold outline-none focus:border-[#3367A5]">
                                        <input type="text" x-model="stat.label" placeholder="Keterangan (mis. Industrial Lines Deployed)"
                                               class="flex-1 px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 outline-none focus:border-[#3367A5]">
                                        <button type="button" @click="removeStat(sIdx)"
                                                class="w-8 h-8 rounded-xl border border-slate-200 hover:border-rose-300 hover:bg-rose-50 text-rose-500 inline-flex items-center justify-center shrink-0 cursor-pointer transition"
                                                title="Hapus stat">
                                            <i class="fa-solid fa-trash-can text-[11px]"></i>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-xl bg-blue-50/60 border border-blue-100 flex items-center gap-2.5">
                            <input type="hidden" name="show_in_navbar" value="0">
                            <input type="checkbox" name="show_in_navbar" value="1" x-model="form.show_in_navbar" id="modal_sol_nav" class="w-4 h-4 rounded text-[#3367A5] cursor-pointer">
                            <label for="modal_sol_nav" class="text-xs text-slate-800 font-medium cursor-pointer select-none">Tampilkan di Navbar &amp; Halaman Solusi Publik</label>
                        </div>
                    </div>

                    <!-- ================= TAB 2: LAYANAN / DELIVERABLES ================= -->
                    <div x-show="activeTab === 'deliverables'" class="space-y-4">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Sub-judul Bagian "What We Deliver"</label>
                            <input type="text" x-model="form.deliverables_subtitle" placeholder="Contoh: Comprehensive PLC lifecycle engineering customized to your exact production demands."
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <span class="font-bold text-slate-800 font-['Agrandir',sans-serif]">Kartu Layanan / Capabilities</span>
                            <button type="button" @click="addDeliverable()"
                                    class="px-3 py-1.5 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-[11px] font-['Agrandir',sans-serif] transition cursor-pointer">
                                + Tambah Kartu Layanan
                            </button>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(del, dIdx) in form.deliverables" :key="dIdx">
                                <div class="p-4 rounded-2xl border border-slate-200 bg-[#f8fafd] space-y-3">
                                    <div class="flex items-center justify-between gap-2 pb-2 border-b border-slate-200/70">
                                        <span class="font-bold text-[#3367A5] font-['Agrandir',sans-serif]" x-text="'Layanan #' + (dIdx + 1)"></span>
                                        <button type="button" @click="removeDeliverable(dIdx)"
                                                class="px-2.5 py-1 rounded-lg text-rose-600 hover:bg-rose-50 font-semibold text-[11px] cursor-pointer transition">
                                            <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                                        </button>
                                    </div>

                                    <div>
                                        <label class="block text-slate-600 font-bold mb-1">Judul Layanan</label>
                                        <input type="text" x-model="del.title" placeholder="Contoh: New Program Development"
                                               class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                                    </div>

                                    <div>
                                        <label class="block text-slate-600 font-bold mb-1">Deskripsi Layanan</label>
                                        <textarea rows="2" x-model="del.description" placeholder="Jelaskan lingkup layanan..."
                                                  class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5] leading-relaxed"></textarea>
                                    </div>

                                    <div class="space-y-1.5">
                                        <div class="flex items-center justify-between">
                                            <label class="text-slate-600 font-bold">Key Highlights (Poin Sorotan)</label>
                                            <button type="button" @click="addHighlight(dIdx)"
                                                    class="text-[#3367A5] hover:underline font-bold text-[11px] cursor-pointer">
                                                + Tambah Poin
                                            </button>
                                        </div>
                                        <template x-for="(hl, hIdx) in del.highlights" :key="hIdx">
                                            <div class="flex items-center gap-2">
                                                <input type="text" x-model="del.highlights[hIdx]" placeholder="Contoh: Fail-safe Interlocks & Emergency Logic"
                                                       class="flex-1 px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 outline-none focus:border-[#3367A5]">
                                                <button type="button" @click="removeHighlight(dIdx, hIdx)"
                                                        class="w-7 h-7 rounded-lg border border-slate-200 hover:bg-rose-50 text-rose-500 inline-flex items-center justify-center shrink-0 cursor-pointer">
                                                    <i class="fa-solid fa-xmark text-[10px]"></i>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- ================= TAB 3: PROSES KERJA ================= -->
                    <div x-show="activeTab === 'process'" class="space-y-4">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Sub-judul Bagian Proses Kerja</label>
                            <input type="text" x-model="form.process_subtitle" placeholder="Contoh: A proven engineering framework that minimizes production disruption..."
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <span class="font-bold text-slate-800 font-['Agrandir',sans-serif]">Tahapan / Fase Proses</span>
                            <button type="button" @click="addProcessStep()"
                                    class="px-3 py-1.5 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-[11px] font-['Agrandir',sans-serif] transition cursor-pointer">
                                + Tambah Fase
                            </button>
                        </div>

                        <div class="space-y-3">
                            <template x-for="(step, pIdx) in form.process_steps" :key="pIdx">
                                <div class="p-4 rounded-2xl border border-slate-200 bg-[#f8fafd] space-y-2.5">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-bold text-[#3367A5] font-['Agrandir',sans-serif]" x-text="'Phase ' + (pIdx + 1)"></span>
                                        <button type="button" @click="removeProcessStep(pIdx)"
                                                class="px-2 py-1 rounded-lg text-rose-600 hover:bg-rose-50 font-semibold text-[11px] cursor-pointer">
                                            <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                                        </button>
                                    </div>
                                    <input type="text" x-model="step.title" placeholder="Judul Fase (mis. Audit & Architecture)"
                                           class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 font-semibold outline-none focus:border-[#3367A5]">
                                    <textarea rows="2" x-model="step.description" placeholder="Deskripsi aktivitas pada fase ini..."
                                              class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 outline-none focus:border-[#3367A5] leading-relaxed"></textarea>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- ================= TAB 4: FAQ & BANNER CTA ================= -->
                    <div x-show="activeTab === 'faq'" class="space-y-5">
                        <!-- FAQ List -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-800 font-['Agrandir',sans-serif]">Daftar Pertanyaan (FAQ Accordion)</span>
                                <button type="button" @click="addFaq()"
                                        class="px-3 py-1.5 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-[11px] font-['Agrandir',sans-serif] transition cursor-pointer">
                                    + Tambah FAQ
                                </button>
                            </div>

                            <div class="space-y-3">
                                <template x-for="(faq, fIdx) in form.faqs" :key="fIdx">
                                    <div class="p-4 rounded-2xl border border-slate-200 bg-[#f8fafd] space-y-2.5">
                                        <div class="flex items-center justify-between gap-2">
                                            <span class="font-bold text-[#3367A5] font-['Agrandir',sans-serif]" x-text="'FAQ #' + (fIdx + 1)"></span>
                                            <button type="button" @click="removeFaq(fIdx)"
                                                    class="px-2 py-1 rounded-lg text-rose-600 hover:bg-rose-50 font-semibold text-[11px] cursor-pointer">
                                                <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                                            </button>
                                        </div>
                                        <input type="text" x-model="faq.question" placeholder="Pertanyaan..."
                                               class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 font-semibold outline-none focus:border-[#3367A5]">
                                        <textarea rows="2" x-model="faq.answer" placeholder="Jawaban lengkap..."
                                                  class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 outline-none focus:border-[#3367A5] leading-relaxed"></textarea>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Banner CTA -->
                        <div class="p-4 rounded-2xl border border-blue-200/80 bg-blue-50/40 space-y-3">
                            <span class="font-bold text-slate-800 font-['Agrandir',sans-serif] flex items-center gap-2">
                                <i class="fa-solid fa-bullhorn text-[#3367A5]"></i> Banner Konsultasi Bawah (CTA)
                            </span>
                            <div>
                                <label class="block text-slate-600 font-bold mb-1">Judul Banner CTA</label>
                                <input type="text" x-model="form.cta_title" placeholder="Contoh: Ready to Build Your Next High-Performance Automation?"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                            <div>
                                <label class="block text-slate-600 font-bold mb-1">Deskripsi Banner CTA</label>
                                <textarea rows="2" x-model="form.cta_description" placeholder="Ajakan konsultasi teknis..."
                                          class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 outline-none focus:border-[#3367A5] leading-relaxed"></textarea>
                            </div>
                            <div>
                                <label class="block text-slate-600 font-bold mb-1">Teks Tombol CTA</label>
                                <input type="text" x-model="form.cta_button_text" placeholder="Get A Quote / Consultation"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Pinned Footer -->
                <div class="px-6 sm:px-7 py-4 border-t border-slate-100 flex items-center justify-between gap-3 shrink-0 bg-white">
                    <button type="button" @click="modalOpen = false"
                            class="px-6 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-7 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95"
                            x-text="modalMode === 'edit' ? 'Perbarui Halaman Solusi' : 'Simpan & Buat Halaman Solusi'">
                    </button>
                </div>
            </form>
        </div>
    </template>

</div>
@endsection
