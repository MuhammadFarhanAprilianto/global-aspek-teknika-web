@extends('components.layouts.admin')

@section('title', 'Manajemen Portofolio Proyek')

@section('content')
@php
    $visibilityOptions = [
        'all' => ['label' => 'Semua Status', 'dot' => 'bg-blue-400'],
        'shown' => ['label' => 'Tayang (Publik)', 'dot' => 'bg-emerald-500'],
        'hidden' => ['label' => 'Hidden (Disembunyikan)', 'dot' => 'bg-slate-400'],
    ];
    $activeVisibility = $visibilityOptions[$visibility] ?? $visibilityOptions['all'];
    $selectedCategoryName = ($category !== 'all' && !empty($category)) ? $category : 'Semua Kategori';
    $isProjectFiltered = ($category !== 'all' && !empty($category)) || ($visibility !== 'all' && !empty($visibility)) || !empty($search);

    $projectsData = $projects->getCollection()->mapWithKeys(function ($proj) {
        return [
            $proj->id => [
                'id' => $proj->id,
                'title' => $proj->title,
                'client_name' => $proj->client_name ?? '',
                'category' => $proj->category ?: 'Automotive',
                'year' => $proj->year ?: date('Y'),
                'description' => $proj->description ?? '',
                'image_url' => $proj->imageUrl() ?? '',
                'is_featured' => (bool) $proj->is_featured,
                'sort_order' => $proj->sort_order ?? 0,
            ],
        ];
    });
@endphp

<div class="space-y-6" x-data="{
    modalOpen: false,
    modalMode: 'create',
    projectsMap: @js($projectsData),
    previewUrl: '',
    form: {
        id: null,
        title: '',
        client_name: '',
        category: 'Automotive',
        year: '{{ date('Y') }}',
        description: '',
        image_url: '',
        is_featured: true,
        sort_order: {{ $totalProjects + 1 }}
    },
    openCreateModal() {
        this.modalMode = 'create';
        this.previewUrl = '';
        this.form = {
            id: null,
            title: '',
            client_name: '',
            category: 'Automotive',
            year: '{{ date('Y') }}',
            description: '',
            image_url: '',
            is_featured: true,
            sort_order: {{ $totalProjects + 1 }}
        };
        this.$nextTick(() => {
            if (this.$refs.imageInput) this.$refs.imageInput.value = '';
        });
        this.modalOpen = true;
    },
    openEditModal(id) {
        const data = this.projectsMap[id];
        if (!data) return;
        this.modalMode = 'edit';
        this.previewUrl = data.image_url || '';
        this.form = {
            id: data.id,
            title: data.title || '',
            client_name: data.client_name || '',
            category: data.category || 'Automotive',
            year: data.year || '{{ date('Y') }}',
            description: data.description || '',
            image_url: data.image_url || '',
            is_featured: Boolean(data.is_featured),
            sort_order: data.sort_order ?? 0
        };
        this.$nextTick(() => {
            if (this.$refs.imageInput) this.$refs.imageInput.value = '';
        });
        this.modalOpen = true;
    },
    handleFileChange(event) {
        const file = event.target.files?.[0];
        if (!file) {
            this.previewUrl = this.form.image_url || '';
            return;
        }
        this.previewUrl = URL.createObjectURL(file);
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
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none flex items-center">
                Portofolio &amp; Proyek Otomasi Pabrik
            </h2>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('admin.projects.index') }}"
               class="hidden md:inline-flex h-11 px-4 rounded-2xl bg-[#f8fafd] hover:bg-slate-100 border {{ $visibility === 'all' && $category === 'all' && empty($search) ? 'border-[#3367A5]/40 ring-2 ring-[#3367A5]/10' : 'border-slate-200/80' }} flex-col items-center justify-center text-center shadow-2xs min-w-[92px] transition"
               title="Tampilkan semua proyek">
                <span class="text-[10px] text-slate-400 font-semibold font-['Questrial',sans-serif] leading-tight block">Total Proyek</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 leading-tight block mt-0.5">{{ $totalProjects }}</span>
            </a>
            <a href="{{ route('admin.projects.index', ['visibility' => 'shown']) }}"
               class="hidden md:inline-flex h-11 px-4 rounded-2xl bg-emerald-50 hover:bg-emerald-100/80 border {{ $visibility === 'shown' ? 'border-emerald-400 ring-2 ring-emerald-500/15' : 'border-emerald-200/80' }} flex-col items-center justify-center text-center shadow-2xs min-w-[92px] transition"
               title="Filter proyek yang tayang di publik">
                <span class="text-[10px] text-emerald-700 font-semibold font-['Questrial',sans-serif] leading-tight block">Tayang</span>
                <span class="text-sm font-bold font-['Agrandir',sans-serif] text-emerald-700 leading-tight block mt-0.5">{{ $shownProjectsCount }}</span>
            </a>
            <button type="button"
                    @click="openCreateModal()"
                    class="h-11 px-5 inline-flex items-center justify-center gap-2 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95 leading-none">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Proyek Baru</span>
            </button>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 text-xs">
        <form id="projectsFilterForm" method="GET" action="{{ route('admin.projects.index') }}" class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
            <input type="hidden" name="category" id="filterProjectCategoryInput" value="{{ $category }}">
            <input type="hidden" name="visibility" id="filterProjectVisibilityInput" value="{{ $visibility }}">

            <!-- Search Input -->
            <div class="relative w-full sm:w-auto">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul proyek, klien, tahun..."
                       class="pl-8 pr-8 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-700 outline-none focus:border-[#3367A5] w-full sm:w-64 text-xs font-['Questrial',sans-serif] transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400"></i>
                @if (!empty($search))
                    <button type="button" onclick="document.querySelector('#projectsFilterForm input[name=search]').value=''; document.getElementById('projectsFilterForm').submit()"
                            class="absolute right-2.5 top-2 text-slate-400 hover:text-slate-600 cursor-pointer" title="Hapus pencarian">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                @endif
            </div>

            <!-- Custom Dropdown: Kategori Proyek -->
            <div class="relative" x-data="{ openCat: false }">
                <button type="button" @click="openCat = !openCat"
                    class="inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer min-w-[180px] {{ ($category !== 'all' && !empty($category)) ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                    <div class="flex items-center gap-2 truncate">
                        <i class="fa-solid fa-shapes text-xs {{ ($category !== 'all' && !empty($category)) ? 'text-[#3367A5]' : 'text-slate-400' }} shrink-0"></i>
                        <span class="truncate">{{ $selectedCategoryName }}</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200"
                        :class="{ 'rotate-180': openCat }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-cloak x-show="openCat" @click.outside="openCat = false"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                    class="absolute left-0 mt-2 w-60 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">

                    <div class="max-h-60 overflow-y-auto py-1">
                        <button type="button"
                            @click="document.getElementById('filterProjectCategoryInput').value = 'all'; document.getElementById('projectsFilterForm').submit()"
                            class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ ($category === 'all' || empty($category)) ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                            <div class="flex items-center gap-2.5 truncate">
                                <i class="fa-solid fa-layer-group text-xs text-slate-400 shrink-0"></i>
                                <span class="font-['Questrial',sans-serif] truncate">Semua Kategori</span>
                            </div>
                            @if ($category === 'all' || empty($category))
                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                            @endif
                        </button>

                        @foreach ($categories as $cat)
                            <button type="button"
                                @click="document.getElementById('filterProjectCategoryInput').value = '{{ addslashes($cat) }}'; document.getElementById('projectsFilterForm').submit()"
                                class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $category === $cat ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                <div class="flex items-center gap-2.5 truncate">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $category === $cat ? 'bg-[#3367A5]' : 'bg-slate-300' }} shrink-0"></span>
                                    <span class="font-['Questrial',sans-serif] truncate {{ $category === $cat ? 'font-bold text-[#3367A5]' : '' }}">{{ $cat }}</span>
                                </div>
                                @if ($category === $cat)
                                    <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Custom Dropdown: Status Penayangan -->
            <div class="relative" x-data="{ openVis: false }">
                <button type="button" @click="openVis = !openVis"
                    class="inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer min-w-[165px] {{ ($visibility !== 'all' && !empty($visibility)) ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
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
                                @click="document.getElementById('filterProjectVisibilityInput').value = '{{ $key }}'; document.getElementById('projectsFilterForm').submit()"
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

            @if ($isProjectFiltered)
                <a href="{{ route('admin.projects.index') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-rose-600 hover:bg-rose-50 font-semibold transition">
                    <i class="fa-solid fa-rotate-left text-[11px]"></i>
                    <span>Reset</span>
                </a>
            @endif
        </form>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse ($projects as $proj)
            @php
                $imageUrl = $proj->imageUrl();
            @endphp
            <div class="bg-white rounded-[24px] border border-slate-200/90 shadow-xs p-4 flex flex-col justify-between gap-3.5 hover:border-[#3367A5]/40 transition group">
                <div>
                    <!-- Clean Project Image Banner (Zero Overlapping Clutter) -->
                    <div class="w-full h-44 rounded-2xl bg-[#f8fafd] overflow-hidden border border-slate-100 mb-3 flex items-center justify-center">
                        @if ($imageUrl)
                            <img src="{{ $imageUrl }}" alt="{{ $proj->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex flex-col items-center justify-center text-slate-300 gap-1.5">
                                <i class="fa-solid fa-industry text-3xl"></i>
                                <span class="text-[10px] font-['Questrial',sans-serif] text-slate-400">Belum ada foto</span>
                            </div>
                        @endif
                    </div>

                    <!-- Category & Year Row (Clean, Uniform, Centered) -->
                    <div class="flex items-center justify-between gap-2 mb-2 min-h-[24px]">
                        <span class="h-6 px-2.5 inline-flex items-center justify-center rounded-md bg-blue-50 text-[#3367A5] border border-blue-100/80 text-[10px] font-bold font-['Agrandir',sans-serif] truncate leading-none" title="{{ $proj->category }}">
                            {{ $proj->category ?: 'Otomasi' }}
                        </span>
                        <span class="h-6 px-2.5 inline-flex items-center justify-center rounded-md bg-slate-100 text-slate-700 font-mono text-[10px] font-bold shrink-0 leading-none">
                            {{ $proj->year ?: date('Y') }}
                        </span>
                    </div>

                    <!-- Client Name -->
                    <div class="min-h-[18px] text-[11px] text-[#3367A5] font-bold font-['Agrandir',sans-serif] truncate" title="{{ $proj->client_name }}">
                        {{ $proj->client_name ?: 'Klien Industri Rahasia' }}
                    </div>

                    <!-- Project Title (Consistent 2-line height) -->
                    <div class="min-h-[40px] flex items-center mt-1">
                        <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 line-clamp-2 leading-snug" title="{{ $proj->title }}">
                            {{ $proj->title }}
                        </h3>
                    </div>

                    <!-- Project Description (Consistent 3-line height) -->
                    <div class="min-h-[58px] mt-1.5">
                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed font-['Questrial',sans-serif]">
                            {{ $proj->description }}
                        </p>
                    </div>

                    <!-- Interactive Status Row -->
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between gap-2 h-8">
                        <span class="text-xs text-slate-400 font-['Questrial',sans-serif] leading-none">Status Tayang:</span>
                        <form method="POST" action="{{ route('admin.projects.toggle-status', $proj->id) }}" class="inline-flex m-0 p-0">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="h-6 px-2.5 inline-flex items-center justify-center text-center rounded-md text-[10px] font-bold font-['Agrandir',sans-serif] tracking-wider transition shadow-2xs cursor-pointer active:scale-95 leading-none {{ $proj->is_featured ? 'bg-emerald-500 hover:bg-emerald-600 text-white' : 'bg-slate-400 hover:bg-slate-500 text-white' }}"
                                    title="Klik untuk ubah status ke {{ $proj->is_featured ? 'HIDDEN' : 'TAYANG' }}">
                                {{ $proj->is_featured ? 'TAYANG' : 'HIDDEN' }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Card Footer Actions (Uniform Height & Centered) -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                    <button type="button"
                            @click="openEditModal({{ $proj->id }})"
                            class="flex-1 h-9 px-3 rounded-xl border border-slate-200 hover:border-[#3367A5] hover:bg-blue-50/50 text-[#3367A5] font-bold text-xs font-['Agrandir',sans-serif] transition inline-flex items-center justify-center gap-1.5 cursor-pointer leading-none">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                        <span>Edit</span>
                    </button>

                    <a href="{{ route('projects') }}" target="_blank" rel="noopener noreferrer"
                       class="w-9 h-9 rounded-xl border border-slate-200 hover:border-[#3367A5] hover:bg-blue-50/50 text-slate-500 hover:text-[#3367A5] inline-flex items-center justify-center transition shrink-0"
                       title="Lihat halaman publik /projects">
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </a>

                    <form method="POST" action="{{ route('admin.projects.destroy', $proj->id) }}" class="inline-flex m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek {{ addslashes($proj->title) }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-9 h-9 rounded-xl border border-slate-200 hover:border-rose-400 hover:bg-rose-50 text-rose-600 inline-flex items-center justify-center transition cursor-pointer shrink-0"
                                title="Hapus Proyek">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-200">
                <i class="fa-solid fa-briefcase text-4xl mb-3 text-slate-300 block"></i>
                <p class="font-['Agrandir',sans-serif] font-bold text-slate-700 text-sm">Tidak ada proyek yang ditemukan</p>
                <p class="text-xs text-slate-400 font-['Questrial',sans-serif] mt-1">Coba sesuaikan kata kunci pencarian atau reset filter kategori.</p>
                @if ($isProjectFiltered)
                    <div class="mt-4">
                        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-50 text-[#3367A5] font-bold text-xs font-['Agrandir',sans-serif] hover:bg-blue-100 transition">
                            <i class="fa-solid fa-rotate-left"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($projects->hasPages())
        <div class="bg-white px-5 py-3.5 rounded-2xl border border-slate-200/80 shadow-2xs">
            {{ $projects->links() }}
        </div>
    @endif

    <!-- ========================================================================= -->
    <!-- UNIFIED SMOOTH-SCROLL MODAL: TAMBAH & EDIT PROYEK                         -->
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
                  :action="modalMode === 'edit' ? `{{ url('admin/projects') }}/${form.id}` : '{{ route('admin.projects.store') }}'"
                  enctype="multipart/form-data"
                  class="bg-white rounded-[28px] max-w-xl w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[90vh] overflow-hidden my-auto"
                  @click.outside="modalOpen = false">
                @csrf
                <template x-if="modalMode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <!-- Pinned Header -->
                <div class="px-6 sm:px-7 pt-5 pb-3.5 border-b border-slate-100 flex items-center justify-between gap-3 shrink-0 bg-white">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold shrink-0">
                            <i :class="modalMode === 'edit' ? 'fa-solid fa-pen-to-square' : 'fa-solid fa-plus'"></i>
                        </div>
                        <h3 class="text-sm sm:text-base font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none truncate"
                            x-text="modalMode === 'edit' ? 'Edit Portofolio Proyek' : 'Tambah Proyek / Portofolio Baru'"></h3>
                    </div>
                    <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Single Smooth Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 sm:px-7 py-5 space-y-4 text-xs overscroll-contain"
                     style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">

                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Judul Proyek *</label>
                        <input type="text" name="title" x-model="form.title" placeholder="Contoh: Line Inspeksi Botol Otomatis 450 BPM" required
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Nama Klien / Instansi</label>
                            <input type="text" name="client_name" x-model="form.client_name" placeholder="Contoh: PT Kalbe Farma Tbk"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>

                        <!-- Custom Corporate Dropdown: Kategori Proyek -->
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Kategori Proyek *</label>
                            <div class="relative" x-data="{ open: false }">
                                <input type="hidden" name="category" :value="form.category" required>
                                <button type="button" @click="open = !open"
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] hover:bg-white text-slate-800 text-xs flex items-center justify-between outline-none transition focus:border-[#3367A5] cursor-pointer">
                                    <span class="truncate font-semibold" x-text="form.category"></span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-cloak x-show="open" @click.outside="open = false"
                                     class="absolute left-0 mt-1.5 w-full bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 max-h-52 overflow-y-auto">
                                    @foreach ($categories as $cat)
                                        <button type="button" @click="form.category = '{{ addslashes($cat) }}'; open = false"
                                                class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                                :class="form.category === '{{ addslashes($cat) }}' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <span>{{ $cat }}</span>
                                            <i x-show="form.category === '{{ addslashes($cat) }}'" class="fa-solid fa-check text-[#3367A5] text-[10px]"></i>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Tahun Pengerjaan</label>
                            <input type="text" name="year" x-model="form.year" placeholder="2024"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Urutan Tampil</label>
                            <input type="number" name="sort_order" min="0" x-model="form.sort_order"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition">
                        </div>
                    </div>

                    <!-- Photo Upload + Live Preview -->
                    <div class="p-3.5 rounded-2xl border border-slate-200/80 bg-[#f8fafd] space-y-2.5">
                        <label class="block text-slate-700 font-bold font-['Agrandir',sans-serif]">Foto Proyek (JPG, PNG, WebP — maks 3MB)</label>
                        <template x-if="previewUrl">
                            <div class="w-full h-36 rounded-xl overflow-hidden border border-slate-200 bg-white">
                                <img :src="previewUrl" alt="Preview" class="w-full h-full object-cover">
                            </div>
                        </template>
                        <input type="file" name="image" x-ref="imageInput" @change="handleFileChange($event)" accept="image/*"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-[#3367A5] file:text-white file:font-semibold file:text-xs file:cursor-pointer cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Deskripsi Proyek &amp; Hasil Capaian *</label>
                        <textarea name="description" rows="4" x-model="form.description" required placeholder="Uraikan tantangan pabrik, solusi otomasi yang diterapkan GAT, dan hasil efisiensi yang diraih..."
                                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none focus:border-[#3367A5] transition leading-relaxed"></textarea>
                    </div>

                    <div class="p-3.5 rounded-xl bg-blue-50/60 border border-blue-100 flex items-center gap-2.5">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" x-model="form.is_featured" id="modal_proj_featured" class="w-4 h-4 rounded text-[#3367A5] cursor-pointer">
                        <label for="modal_proj_featured" class="text-xs text-slate-800 font-medium cursor-pointer select-none">Tayangkan di halaman publik /projects</label>
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
                            x-text="modalMode === 'edit' ? 'Perbarui Proyek' : 'Simpan Proyek'">
                    </button>
                </div>
            </form>
        </div>
    </template>

</div>
@endsection
