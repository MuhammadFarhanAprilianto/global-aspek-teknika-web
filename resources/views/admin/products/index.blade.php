@extends('components.layouts.admin')

@section('title', 'Katalog Produk & Hardware')

@section('content')
@php
    $selectedCategoryName = 'Semua Kategori';
    if ($categoryId !== 'all' && !empty($categoryId)) {
        $foundCategory = $categories->firstWhere('id', $categoryId);
        if ($foundCategory) {
            $selectedCategoryName = $foundCategory->name;
        }
    }

    $statusOptions = [
        'all' => 'Semua Status',
        'published' => 'Tayang (Published)',
        'draft' => 'Draft (Disembunyikan)',
    ];
    $selectedStatusName = $statusOptions[$status] ?? 'Semua Status';

    $isProductFiltered = ($categoryId !== 'all' && !empty($categoryId)) || !empty($search) || ($status !== 'all' && !empty($status));
@endphp

<div class="space-y-6" x-data="{ 
    createModalOpen: false, 
    editModalOpen: false,
    categoryModalOpen: {{ session('open_category_modal') || $errors->has('category_name') ? 'true' : 'false' }},
    editingCatId: null,
    editingCatName: '',
    editingCatDesc: '',
    createCategoryId: '{{ $categories->first()?->id ?? "" }}',
    createStatus: 'published',
    createIsRfqOnly: '1',
    categoriesMap: {
        @foreach ($categories as $cat)
            '{{ $cat->id }}': '{{ addslashes($cat->name) }}',
        @endforeach
    },
    getCategoryName(id) {
        return this.categoriesMap[String(id)] || 'Pilih Kategori';
    },
    getStatusLabel(status) {
        return status === 'published' ? 'Published (Tayang)' : 'Draft (Disembunyikan)';
    },
    getStatusDot(status) {
        return status === 'published' ? 'bg-emerald-500' : 'bg-slate-400';
    },
    getRfqLabel(val) {
        return (val == '1' || val === true || val === 1) ? 'Permintaan Penawaran Resmi (RFQ)' : 'Direct Purchase';
    },
    getRfqIcon(val) {
        return (val == '1' || val === true || val === 1) ? 'fa-solid fa-file-invoice text-[#3367A5]' : 'fa-solid fa-cart-shopping text-emerald-600';
    },
    editProduct: {
        id: null,
        category_id: '',
        sku: '',
        name: '',
        short_description: '',
        description: '',
        is_rfq_only: '1',
        is_featured: false,
        status: 'published',
        image_url: '',
        specs_text: ''
    },
    createSpecsGroups: [
        {
            name: 'Sumber Tenaga',
            options: [
                { value: 'Pneumatik / Kompresor Angin Bersih (Non-Electric / Spark-Free)', is_active: true },
                { value: 'Pneumatik + Filter Regulator Oiler (FRL Unit Terpadu)', is_active: true }
            ]
        },
        {
            name: 'Ukuran Lebar Tali Baja (Steel Strap Width)',
            options: [
                { value: 'Lebar 19 mm (Model Heavy-Duty Standard - Beban s/d 2.500 Kg)', is_active: true },
                { value: 'Lebar 16 mm (Model Medium-Heavy Variant - Beban s/d 1.800 Kg)', is_active: true }
            ]
        },
        {
            name: 'Paket Aksesoris & Koneksi Pneumatik',
            options: [
                { value: 'Paket Standar: Unit Mesin + Coupler + Toolset + Oli Pelumas', is_active: true },
                { value: 'Paket Lengkap: Paket Standar + Selang Pneumatik 10M + FRL Unit', is_active: true }
            ]
        }
    ],
    editSpecsGroups: [],

    addCreateGroup() {
        this.createSpecsGroups.push({
            name: '',
            options: [{ value: '', is_active: true }]
        });
    },
    removeCreateGroup(gIdx) {
        this.createSpecsGroups.splice(gIdx, 1);
        if (this.createSpecsGroups.length === 0) {
            this.addCreateGroup();
        }
    },
    addCreateOption(gIdx) {
        this.createSpecsGroups[gIdx].options.push({ value: '', is_active: true });
    },
    removeCreateOption(gIdx, oIdx) {
        this.createSpecsGroups[gIdx].options.splice(oIdx, 1);
        if (this.createSpecsGroups[gIdx].options.length === 0) {
            this.createSpecsGroups[gIdx].options.push({ value: '', is_active: true });
        }
    },
    toggleCreateOption(gIdx, oIdx) {
        this.createSpecsGroups[gIdx].options[oIdx].is_active = !this.createSpecsGroups[gIdx].options[oIdx].is_active;
    },

    addEditGroup() {
        this.editSpecsGroups.push({
            name: '',
            options: [{ value: '', is_active: true }]
        });
    },
    removeEditGroup(gIdx) {
        this.editSpecsGroups.splice(gIdx, 1);
        if (this.editSpecsGroups.length === 0) {
            this.addEditGroup();
        }
    },
    addEditOption(gIdx) {
        this.editSpecsGroups[gIdx].options.push({ value: '', is_active: true });
    },
    removeEditOption(gIdx, oIdx) {
        this.editSpecsGroups[gIdx].options.splice(oIdx, 1);
        if (this.editSpecsGroups[gIdx].options.length === 0) {
            this.editSpecsGroups[gIdx].options.push({ value: '', is_active: true });
        }
    },
    toggleEditOption(gIdx, oIdx) {
        this.editSpecsGroups[gIdx].options[oIdx].is_active = !this.editSpecsGroups[gIdx].options[oIdx].is_active;
    },

    openCreateModal() {
        this.createCategoryId = '{{ $categories->first()?->id ?? "" }}';
        this.createStatus = 'published';
        this.createIsRfqOnly = '1';
        this.createSpecsGroups = [
            {
                name: 'Sumber Tenaga',
                options: [
                    { value: 'Pneumatik / Kompresor Angin Bersih (Non-Electric / Spark-Free)', is_active: true },
                    { value: 'Pneumatik + Filter Regulator Oiler (FRL Unit Terpadu)', is_active: true }
                ]
            },
            {
                name: 'Ukuran Lebar Tali Baja (Steel Strap Width)',
                options: [
                    { value: 'Lebar 19 mm (Model Heavy-Duty Standard - Beban s/d 2.500 Kg)', is_active: true },
                    { value: 'Lebar 16 mm (Model Medium-Heavy Variant - Beban s/d 1.800 Kg)', is_active: true }
                ]
            },
            {
                name: 'Paket Aksesoris & Koneksi Pneumatik',
                options: [
                    { value: 'Paket Standar: Unit Mesin + Coupler + Toolset + Oli Pelumas', is_active: true },
                    { value: 'Paket Lengkap: Paket Standar + Selang Pneumatik 10M + FRL Unit', is_active: true }
                ]
            }
        ];
        this.createModalOpen = true;
    },
    openEditModal(data) {
        this.editProduct = Object.assign({}, data);
        this.editProduct.category_id = String(data.category_id || '');
        this.editProduct.status = data.status || 'published';
        this.editProduct.is_rfq_only = (data.is_rfq_only === true || data.is_rfq_only == 1 || data.is_rfq_only === '1') ? '1' : '0';
        
        this.editSpecsGroups = [];
        if (data.structured_specs && Array.isArray(data.structured_specs) && data.structured_specs.length > 0) {
            this.editSpecsGroups = JSON.parse(JSON.stringify(data.structured_specs));
        } else {
            this.editSpecsGroups = [
                { name: '', options: [{ value: '', is_active: true }] }
            ];
        }
        this.editModalOpen = true;
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

    <!-- Top Action & Stat Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white px-6 py-4.5 rounded-[24px] border border-[#3367A5]/15 shadow-sm min-h-[76px]">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold text-lg shrink-0 shadow-2xs">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <h2 class="text-lg font-bold font-['Agrandir',sans-serif] text-slate-900 leading-none flex items-center">
                Katalog Produk &amp; Hardware Otomasi
            </h2>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 shrink-0">
            <button type="button"
                    @click="categoryModalOpen = true"
                    class="h-11 px-4 inline-flex items-center justify-center gap-2 rounded-full bg-white hover:bg-[#f0f5fc] text-[#3367A5] border border-[#3367A5]/25 font-bold text-xs font-['Agrandir',sans-serif] shadow-2xs transition cursor-pointer active:scale-95 leading-none">
                <i class="fa-solid fa-tags text-xs"></i>
                <span>Kelola Kategori</span>
            </button>
            <button type="button" 
                    @click="openCreateModal()"
                    class="h-11 px-5 inline-flex items-center justify-center gap-2 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-95 leading-none">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Produk Baru</span>
            </button>
        </div>
    </div>

    <!-- Filter & Search Bar with Corporate Custom Dropdowns -->
    <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 text-xs">
        <form id="productsFilterForm" method="GET" action="{{ route('admin.product.index') }}" class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
            <input type="hidden" name="category" id="filterProductCategoryInput" value="{{ $categoryId }}">
            <input type="hidden" name="status" id="filterProductStatusInput" value="{{ $status }}">

            <!-- Search Input -->
            <div class="relative w-full sm:w-auto">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama produk, SKU..." 
                       class="pl-8 pr-8 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-700 outline-none focus:border-[#3367A5] w-full sm:w-64 text-xs font-['Questrial',sans-serif] transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400"></i>
                @if (!empty($search))
                    <button type="button" onclick="document.querySelector('input[name=search]').value=''; document.getElementById('productsFilterForm').submit()" 
                            class="absolute right-2.5 top-2 text-slate-400 hover:text-slate-600 cursor-pointer" title="Hapus pencarian">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                @endif
            </div>

            <!-- Custom Dropdown: Kategori Produk -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" @click="open = !open"
                    class="inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer min-w-[190px] {{ ($categoryId !== 'all' && !empty($categoryId)) ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                    <div class="flex items-center gap-2 truncate">
                        <i class="fa-solid fa-shapes text-xs {{ ($categoryId !== 'all' && !empty($categoryId)) ? 'text-[#3367A5]' : 'text-slate-400' }} shrink-0"></i>
                        <span class="truncate">{{ $selectedCategoryName }}</span>
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

                    <div class="max-h-60 overflow-y-auto py-1">
                        <button type="button" 
                            @click="document.getElementById('filterProductCategoryInput').value = 'all'; document.getElementById('productsFilterForm').submit()"
                            class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ ($categoryId === 'all' || empty($categoryId)) ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                            <div class="flex items-center gap-2.5 truncate">
                                <i class="fa-solid fa-layer-group text-xs text-slate-400 shrink-0"></i>
                                <span class="font-['Questrial',sans-serif] truncate">Semua Kategori</span>
                            </div>
                            @if ($categoryId === 'all' || empty($categoryId))
                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                            @endif
                        </button>

                        @foreach ($categories as $cat)
                            <button type="button" 
                                @click="document.getElementById('filterProductCategoryInput').value = '{{ $cat->id }}'; document.getElementById('productsFilterForm').submit()"
                                class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $categoryId == $cat->id ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                <div class="flex items-center gap-2.5 truncate">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $categoryId == $cat->id ? 'bg-[#3367A5]' : 'bg-slate-300' }} shrink-0"></span>
                                    <span class="font-['Questrial',sans-serif] truncate {{ $categoryId == $cat->id ? 'font-bold text-[#3367A5]' : '' }}">{{ $cat->name }}</span>
                                </div>
                                @if ($categoryId == $cat->id)
                                    <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Custom Dropdown: Status Produk -->
            <div class="relative" x-data="{ openStatus: false }">
                <button type="button" @click="openStatus = !openStatus"
                    class="inline-flex items-center justify-between gap-3 px-3.5 py-2 rounded-xl border border-slate-200/90 bg-[#f8fafd] hover:bg-white text-slate-700 hover:text-slate-900 font-['Agrandir',sans-serif] text-xs font-semibold shadow-xs transition hover:border-[#3367A5]/40 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer min-w-[160px] {{ ($status !== 'all' && !empty($status)) ? 'border-[#3367A5]/40 bg-blue-50/30 text-[#3367A5]' : '' }}">
                    <div class="flex items-center gap-2 truncate">
                        <span class="w-2 h-2 rounded-full {{ $status === 'published' ? 'bg-emerald-500' : ($status === 'draft' ? 'bg-slate-400' : 'bg-blue-400') }} shrink-0"></span>
                        <span class="truncate">{{ $selectedStatusName }}</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200"
                        :class="{ 'rotate-180': openStatus }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-cloak x-show="openStatus" @click.outside="openStatus = false"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                    class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 overflow-hidden">

                    <div class="py-1">
                        @foreach ($statusOptions as $key => $label)
                            <button type="button" 
                                @click="document.getElementById('filterProductStatusInput').value = '{{ $key }}'; document.getElementById('productsFilterForm').submit()"
                                class="w-full px-3.5 py-2 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer {{ $status === $key ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700' }}">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-2 h-2 rounded-full {{ $key === 'published' ? 'bg-emerald-500' : ($key === 'draft' ? 'bg-slate-400' : 'bg-blue-400') }} shrink-0"></span>
                                    <span class="font-['Questrial',sans-serif] {{ $status === $key ? 'font-bold text-[#3367A5]' : '' }}">{{ $label }}</span>
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
            @if ($isProductFiltered)
                <a href="{{ route('admin.product.index') }}" 
                   class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-['Agrandir',sans-serif] text-xs font-semibold border border-rose-200/70 transition shadow-2xs" 
                   title="Reset semua filter">
                    <i class="fa-solid fa-rotate-left text-[11px]"></i>
                    <span>Reset Filter</span>
                </a>
            @endif
        </form>
    </div>

    <!-- Products Grid Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse ($products as $p)
            @php
                $imageUrl = $p->image 
                    ? (str_starts_with($p->image, 'http') ? $p->image : asset('storage/' . $p->image)) 
                    : '';
                
                $structuredSpecs = [];
                $specsList = [];
                $specsText = '';
                if (!empty($p->specifications) && is_array($p->specifications)) {
                    $lines = [];
                    foreach ($p->specifications as $k => $v) {
                        $paramLabel = (string)$k;
                        $opts = [];
                        if (is_array($v)) {
                            foreach ($v as $sub) {
                                if (is_array($sub)) {
                                    $opts[] = [
                                        'value' => (string)($sub['value'] ?? ''),
                                        'is_active' => isset($sub['is_active']) ? (bool)$sub['is_active'] : true,
                                    ];
                                } else {
                                    $opts[] = [
                                        'value' => (string)$sub,
                                        'is_active' => true,
                                    ];
                                }
                            }
                        } elseif (is_string($v) && str_contains($v, ' / ')) {
                            foreach (explode(' / ', $v) as $sub) {
                                $opts[] = [
                                    'value' => trim($sub),
                                    'is_active' => true,
                                ];
                            }
                        } else {
                            $opts[] = [
                                'value' => (string)$v,
                                'is_active' => true,
                            ];
                        }

                        if (empty($opts)) {
                            $opts[] = ['value' => '', 'is_active' => true];
                        }

                        $optTexts = array_map(fn($o) => $o['value'], array_filter($opts, fn($o) => $o['is_active']));
                        if (empty($optTexts)) {
                            $optTexts = array_map(fn($o) => $o['value'], $opts);
                        }
                        $valStr = implode(', ', $optTexts);
                        $lines[] = "{$paramLabel}: {$valStr}";
                        $specsList[] = ['key' => $paramLabel, 'value' => $valStr];

                        $structuredSpecs[] = [
                            'name' => $paramLabel,
                            'options' => $opts,
                        ];
                    }
                    $specsText = implode("\n", $lines);
                }

                $productJson = [
                    'id' => $p->id,
                    'category_id' => $p->category_id,
                    'sku' => $p->sku,
                    'name' => $p->name,
                    'short_description' => $p->short_description,
                    'description' => $p->description,
                    'price' => $p->price,
                    'stock' => $p->stock,
                    'min_order_quantity' => $p->min_order_quantity,
                    'is_rfq_only' => (bool)$p->is_rfq_only,
                    'is_featured' => (bool)$p->is_featured,
                    'status' => $p->status,
                    'image' => $p->image,
                    'image_url' => $imageUrl,
                    'specs_text' => $specsText,
                    'specs_list' => $specsList,
                    'structured_specs' => $structuredSpecs,
                ];
            @endphp
            <div class="bg-white rounded-[24px] border border-slate-200/90 shadow-xs p-4 flex flex-col justify-between gap-3 hover:border-[#3367A5]/40 transition group">
                <div>
                    <!-- Product Image (No hover zoom) -->
                    <div class="relative w-full h-44 rounded-2xl bg-[#f8fafd] overflow-hidden border border-slate-100 mb-3 flex items-center justify-center">
                        @if ($p->image)
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $p->name }}" class="w-full h-full object-contain p-2">
                        @else
                            <i class="fa-solid fa-box text-3xl text-slate-300"></i>
                        @endif
                    </div>

                    <!-- Category & SKU (Clean Typography) -->
                    <div class="flex items-center justify-between text-xs mb-1.5 gap-2 min-h-[22px]">
                        <span class="font-['Questrial',sans-serif] text-slate-500 font-semibold truncate leading-none" title="{{ $p->category ? $p->category->name : 'General' }}">
                            {{ $p->category ? $p->category->name : 'General' }}
                        </span>
                        <span class="font-mono text-[11px] font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded-md shrink-0 leading-none inline-flex items-center justify-center">
                            {{ $p->sku }}
                        </span>
                    </div>

                    <!-- Product Name (Consistent Height & Centered) -->
                    <div class="min-h-[40px] flex items-center">
                        <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900 line-clamp-2 leading-snug" title="{{ $p->name }}">
                            {{ $p->name }}
                        </h3>
                    </div>

                    <!-- Short Description (Consistent Height) -->
                    <div class="min-h-[36px] mt-1.5">
                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed font-['Questrial',sans-serif]" title="{{ $p->short_description }}">
                            {{ $p->short_description }}
                        </p>
                    </div>

                    <!-- Price / RFQ & Status Badges (Sejajar Rata Tengah Atas Bawah Kanan Kiri) -->
                    <div class="mt-2.5 pt-2 border-t border-slate-100 space-y-1.5 text-xs">
                        <div class="flex items-center justify-between gap-2 h-7">
                            <span class="text-slate-400 font-['Questrial',sans-serif] leading-none shrink-0">Mode Pembelian:</span>
                            <span class="h-6 px-2.5 inline-flex items-center justify-center text-center font-bold text-xs font-['Agrandir',sans-serif] rounded-lg leading-none shrink-0 {{ $p->is_rfq_only ? 'text-[#3367A5] bg-blue-50 border border-blue-100/70' : 'text-emerald-700 bg-emerald-50 border border-emerald-100/70' }}">
                                {{ $p->is_rfq_only ? 'Permintaan Penawaran (RFQ)' : 'Direct Purchase' }}
                            </span>
                        </div>

                        <!-- Status & Featured Badges -->
                        <div class="flex items-center justify-between gap-2 h-7 pt-1 border-t border-slate-50">
                            <span class="text-slate-400 font-['Questrial',sans-serif] leading-none shrink-0">Status Produk:</span>
                            <div class="inline-flex items-center justify-end gap-1.5 shrink-0">
                                <!-- Status Toggle (Tanpa buletan, rata tengah sempurna) -->
                                <form method="POST" action="{{ route('admin.product.toggle-status', $p->id) }}" class="inline-flex m-0 p-0">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="h-6 px-2.5 inline-flex items-center justify-center text-center rounded-md text-[10px] font-bold font-['Agrandir',sans-serif] tracking-wider transition shadow-2xs cursor-pointer active:scale-95 leading-none {{ $p->status === 'published' ? 'bg-emerald-500 hover:bg-emerald-600 text-white' : 'bg-slate-400 hover:bg-slate-500 text-white' }}"
                                            title="Klik untuk ubah status ke {{ $p->status === 'published' ? 'DRAFT' : 'PUBLISHED' }}">
                                        {{ strtoupper($p->status) }}
                                    </button>
                                </form>

                                <!-- Featured Badge (Tanpa bintang, rata tengah sempurna) -->
                                @if ($p->is_featured)
                                    <form method="POST" action="{{ route('admin.product.toggle-featured', $p->id) }}" class="inline-flex m-0 p-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="h-6 px-2.5 inline-flex items-center justify-center text-center rounded-md text-[10px] font-bold font-['Agrandir',sans-serif] transition shadow-2xs cursor-pointer active:scale-95 bg-amber-400 hover:bg-amber-500 text-slate-900 leading-none"
                                                title="Klik untuk nonaktifkan status Featured">
                                            Featured
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons: Edit & Delete (Sejajar dan Presisi Tinggi) -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                    <button type="button" 
                            @click="openEditModal({{ json_encode($productJson) }})"
                            class="flex-1 h-9 px-3 rounded-xl border border-slate-200 hover:border-[#3367A5] hover:bg-blue-50/50 text-[#3367A5] font-bold text-xs transition inline-flex items-center justify-center gap-1.5 cursor-pointer active:scale-95 font-['Agrandir',sans-serif] leading-none text-center">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                        <span>Edit</span>
                    </button>
                    
                    <form method="POST" action="{{ route('admin.product.destroy', $p->id) }}" class="inline-flex m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk \'{{ addslashes($p->name) }}\' dari katalog?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-9 h-9 inline-flex items-center justify-center rounded-xl border border-slate-200 hover:border-rose-400 hover:bg-rose-50 text-rose-600 transition cursor-pointer active:scale-95 text-center shrink-0 leading-none" title="Hapus Produk">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-200">
                <i class="fa-solid fa-box-open text-4xl mb-3 text-slate-300 block"></i>
                <p class="font-['Agrandir',sans-serif] font-bold text-slate-700 text-sm">Tidak ada produk yang ditemukan</p>
                <p class="text-xs text-slate-400 font-['Questrial',sans-serif] mt-1">Coba sesuaikan kata kunci pencarian atau reset filter kategori.</p>
                @if ($isProductFiltered)
                    <div class="mt-4">
                        <a href="{{ route('admin.product.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-50 text-[#3367A5] font-bold text-xs font-['Agrandir',sans-serif] hover:bg-blue-100 transition">
                            <i class="fa-solid fa-rotate-left"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </div>
        @endforelse
    </div>


    <!-- ============================================================== -->
    <!-- MODAL: TAMBAH PRODUK BARU                                      -->
    <!-- ============================================================== -->
    <template x-teleport="body">
        <div x-cloak x-show="createModalOpen" 
             class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center p-3 sm:p-4 md:p-6 bg-slate-900/60 backdrop-blur-xs overflow-hidden"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data"
                 class="bg-white rounded-[28px] max-w-2xl w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[90vh] overflow-hidden my-auto"
                 @click.outside="createModalOpen = false">
                @csrf
            
                <!-- Pinned Header -->
                <div class="px-6 sm:px-7 pt-5 pb-3.5 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900">Tambah Produk / Hardware Baru</h3>
                            <p class="text-[10px] text-slate-400 font-['Questrial',sans-serif]">Data otomatis tampil di halaman katalog publik /product</p>
                        </div>
                    </div>
                    <button type="button" @click="createModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Single Smooth Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 sm:px-7 py-4 space-y-4 text-xs overscroll-contain"
                     style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Kategori Produk *</label>
                            <div class="relative" x-data="{ open: false, openUp: false }">
                                <input type="hidden" name="category_id" :value="createCategoryId" required>
                                <button type="button" 
                                    @click="openUp = ($el.getBoundingClientRect().bottom + 220 > window.innerHeight); open = !open"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] hover:bg-white text-slate-800 text-xs flex items-center justify-between font-['Questrial',sans-serif] outline-none transition hover:border-[#3367A5]/40 focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer shadow-2xs">
                                    <div class="flex items-center gap-2 truncate">
                                        <i class="fa-solid fa-shapes text-[#3367A5] text-xs shrink-0"></i>
                                        <span class="truncate font-semibold" x-text="getCategoryName(createCategoryId)"></span>
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
                                    :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
                                    class="absolute left-0 w-full bg-white rounded-2xl shadow-xl border border-slate-200 py-1.5 z-[70] overflow-hidden">
                                    <div class="max-h-52 overflow-y-auto py-1">
                                        @foreach ($categories as $cat)
                                            <button type="button" 
                                                @click="createCategoryId = '{{ $cat->id }}'; open = false"
                                                class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                                :class="createCategoryId == '{{ $cat->id }}' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                                <div class="flex items-center gap-2.5 truncate">
                                                    <span class="w-1.5 h-1.5 rounded-full shrink-0"
                                                          :class="createCategoryId == '{{ $cat->id }}' ? 'bg-[#3367A5]' : 'bg-slate-300'"></span>
                                                    <span class="font-['Questrial',sans-serif] truncate">{{ $cat->name }}</span>
                                                </div>
                                                <template x-if="createCategoryId == '{{ $cat->id }}'">
                                                    <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                                </template>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">SKU / Kode Part *</label>
                            <input type="text" name="sku" placeholder="Contoh: GAT-STR-011" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 outline-none focus:border-[#3367A5] uppercase font-mono">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Nama Produk / Mesin *</label>
                        <input type="text" name="name" placeholder="Contoh: Industrial High-Speed Bottle Vision Inspection System" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 outline-none focus:border-[#3367A5] font-['Questrial',sans-serif]">
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Deskripsi Singkat *</label>
                        <input type="text" name="short_description" placeholder="Contoh: Sistem kamera inspeksi 450 bpm dengan rejector otomatis" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 outline-none focus:border-[#3367A5] font-['Questrial',sans-serif]">
                    </div>

                    <!-- SPESIFIKASI & PILIHAN VARIAN QUOTATION (PILIH SPESIFIKASI QUOTATION) -->
                    <div class="p-4 rounded-2xl bg-[#f8fafd] border border-slate-200 space-y-3.5">
                        <div class="flex items-center justify-between gap-2 border-b border-slate-200/80 pb-3">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-sliders text-[#3367A5] text-xs"></i>
                                <label class="block text-slate-800 font-bold font-['Agrandir',sans-serif] text-xs">
                                    Pilih Spesifikasi Quotation &amp; Varian Hardware
                                </label>
                            </div>
                            <button type="button" @click="addCreateGroup()" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-xs transition cursor-pointer active:scale-95 shrink-0">
                                <i class="fa-solid fa-plus text-[10px]"></i> Tambah Parameter Spek
                            </button>
                        </div>

                        <!-- Parameter Groups Container: Natural Flow (No Nested Scroll Trap) -->
                        <div class="space-y-3.5">
                            <template x-for="(group, gIdx) in createSpecsGroups" :key="gIdx">
                                <div class="bg-white rounded-2xl p-3 border border-slate-200 shadow-2xs space-y-3">
                                    <!-- Group Header -->
                                    <div class="flex items-center justify-between gap-2 bg-[#f8fafd] p-2 rounded-xl border border-slate-200/90">
                                        <div class="flex items-center gap-2 flex-1">
                                            <i class="fa-solid fa-layer-group text-[#3367A5] text-xs shrink-0"></i>
                                            <input type="text" x-model="group.name" 
                                                   placeholder="Nama Parameter (cth: Ukuran Lebar Tali Baja, Sumber Tenaga)" 
                                                   class="flex-1 px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-800 text-xs font-bold font-['Agrandir',sans-serif] outline-none focus:border-[#3367A5] transition">
                                        </div>

                                        <div class="flex items-center gap-2 shrink-0">
                                            <span class="text-[10px] font-semibold text-slate-500 bg-white px-2 py-1 rounded-md border border-slate-200"
                                                  x-text="group.options.length + ' pilihan'"></span>
                                            <button type="button" @click="addCreateOption(gIdx)"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-[#3367A5] font-bold text-[11px] font-['Agrandir',sans-serif] border border-blue-200 transition cursor-pointer"
                                                    title="Tambah pilihan varian untuk parameter ini">
                                                <i class="fa-solid fa-plus text-[9px]"></i> Pilihan
                                            </button>
                                            <button type="button" @click="removeCreateGroup(gIdx)" 
                                                    class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition cursor-pointer" 
                                                    title="Hapus seluruh parameter ini">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Option Rows List -->
                                    <div class="space-y-1.5 pl-2 border-l-2 border-[#3367A5]/30">
                                        <template x-for="(opt, oIdx) in group.options" :key="oIdx">
                                            <div class="flex items-center gap-2 p-1.5 rounded-xl border transition"
                                                 :class="opt.is_active ? 'bg-[#fcfdfd] border-slate-200' : 'bg-rose-50/50 border-rose-200 opacity-80'">
                                                
                                                <!-- Toggle Button Status: Tersedia vs Habis -->
                                                <button type="button" @click="toggleCreateOption(gIdx, oIdx)"
                                                        class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg text-[10px] font-bold transition cursor-pointer shrink-0 select-none shadow-2xs min-w-[66px]"
                                                        :class="opt.is_active 
                                                            ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200 border border-emerald-300' 
                                                            : 'bg-rose-100 text-rose-800 hover:bg-rose-200 border border-rose-300'"
                                                        :title="opt.is_active ? 'Klik jika spek ini habis/kosong' : 'Klik untuk mengubah kembali menjadi Tersedia'">
                                                    <span x-text="opt.is_active ? 'Tersedia' : 'Habis'"></span>
                                                </button>

                                                <!-- Option Value Input -->
                                                <div class="flex-1">
                                                    <input type="text" x-model="opt.value" 
                                                           placeholder="Nilai Pilihan Varian (cth: Lebar 19 mm Heavy-Duty, Pneumatik 8 Bar)" 
                                                           class="w-full px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-800 text-xs outline-none focus:border-[#3367A5] font-['Questrial',sans-serif] transition"
                                                           :class="{ 'line-through text-slate-400': !opt.is_active }">
                                                </div>

                                                <!-- Delete Option Button -->
                                                <button type="button" @click="removeCreateOption(gIdx, oIdx)" 
                                                        class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition cursor-pointer shrink-0" 
                                                        title="Hapus pilihan ini">
                                                    <i class="fa-solid fa-xmark text-xs"></i>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Hidden input to serialize groups as JSON for form submission -->
                        <input type="hidden" name="spec_groups_json" :value="JSON.stringify(createSpecsGroups)">

                        <!-- Panduan Status: Rapi, Lega & Elegan -->
                        <div class="pt-3 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-2 text-[11px] font-['Questrial',sans-serif]">
                            <div class="flex items-center gap-2 text-slate-500">
                                <i class="fa-solid fa-circle-info text-[#3367A5] text-xs shrink-0"></i>
                                <span class="font-semibold">Panduan Status Varian:</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-600">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded-md bg-emerald-100/80 text-emerald-800 font-bold text-[10px]">Tersedia</span>
                                    <span class="text-slate-500">Tampil di Quotation</span>
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded-md bg-rose-100/80 text-rose-800 font-bold text-[10px]">Habis</span>
                                    <span class="text-slate-500">Disembunyikan</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Produk -->
                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Upload Foto Produk (JPG, PNG, WebP)</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-[#3367A5] file:text-white file:font-semibold cursor-pointer">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Custom Dropdown: Status Publikasi -->
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Status Publikasi</label>
                            <div class="relative" x-data="{ open: false, openUp: false }">
                                <input type="hidden" name="status" :value="createStatus">
                                <button type="button" 
                                    @click="openUp = ($el.getBoundingClientRect().bottom + 140 > window.innerHeight); open = !open"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] hover:bg-white text-slate-800 text-xs flex items-center justify-between font-['Questrial',sans-serif] outline-none transition hover:border-[#3367A5]/40 focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer shadow-2xs">
                                    <div class="flex items-center gap-2 truncate">
                                        <span class="w-2 h-2 rounded-full shrink-0" :class="getStatusDot(createStatus)"></span>
                                        <span class="truncate font-semibold" x-text="getStatusLabel(createStatus)"></span>
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
                                    :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
                                    class="absolute left-0 w-full bg-white rounded-2xl shadow-xl border border-slate-200 py-1.5 z-[70] overflow-hidden">
                                    <div class="py-1">
                                        <button type="button" 
                                            @click="createStatus = 'published'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="createStatus === 'published' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                                                <span class="font-['Questrial',sans-serif]">Published (Tayang)</span>
                                            </div>
                                            <template x-if="createStatus === 'published'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                        <button type="button" 
                                            @click="createStatus = 'draft'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="createStatus === 'draft' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                                                <span class="font-['Questrial',sans-serif]">Draft (Disembunyikan)</span>
                                            </div>
                                            <template x-if="createStatus === 'draft'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Custom Dropdown: Mode Pembelian -->
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Mode Pembelian</label>
                            <div class="relative" x-data="{ open: false, openUp: false }">
                                <input type="hidden" name="is_rfq_only" :value="createIsRfqOnly">
                                <button type="button" 
                                    @click="openUp = ($el.getBoundingClientRect().bottom + 140 > window.innerHeight); open = !open"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] hover:bg-white text-slate-800 text-xs flex items-center justify-between font-['Questrial',sans-serif] outline-none transition hover:border-[#3367A5]/40 focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer shadow-2xs">
                                    <div class="flex items-center gap-2 truncate">
                                        <i :class="getRfqIcon(createIsRfqOnly)" class="text-xs shrink-0"></i>
                                        <span class="truncate font-semibold" x-text="getRfqLabel(createIsRfqOnly)"></span>
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
                                    :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
                                    class="absolute left-0 w-full bg-white rounded-2xl shadow-xl border border-slate-200 py-1.5 z-[70] overflow-hidden">
                                    <div class="py-1">
                                        <button type="button" 
                                            @click="createIsRfqOnly = '1'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="createIsRfqOnly == '1' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <i class="fa-solid fa-file-invoice text-[#3367A5] text-xs shrink-0"></i>
                                                <span class="font-['Questrial',sans-serif]">Permintaan Penawaran Resmi (RFQ)</span>
                                            </div>
                                            <template x-if="createIsRfqOnly == '1'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                        <button type="button" 
                                            @click="createIsRfqOnly = '0'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="createIsRfqOnly == '0' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <i class="fa-solid fa-cart-shopping text-emerald-600 text-xs shrink-0"></i>
                                                <span class="font-['Questrial',sans-serif]">Direct Purchase</span>
                                            </div>
                                            <template x-if="createIsRfqOnly == '0'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1 pb-2">
                        <input type="checkbox" name="is_featured" id="create_is_featured" value="1" class="rounded border-slate-300 text-[#3367A5] focus:ring-[#3367A5] cursor-pointer">
                        <label for="create_is_featured" class="text-slate-700 font-semibold cursor-pointer select-none">
                            Tandai sebagai Produk Pilihan (Featured Card)
                        </label>
                    </div>
                </div>

                <!-- Pinned Footer: Solid, Never Overlapping -->
                <div class="px-6 sm:px-7 py-3.5 border-t border-slate-100 flex items-center gap-3 shrink-0 bg-white">
                    <button type="button" @click="createModalOpen = false" class="flex-1 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-[0.99]">Simpan Produk</button>
                </div>
            </form>
        </div>
    </template>

    <!-- ============================================================== -->
    <!-- MODAL: EDIT PRODUK (TEMPAT MODIFIKASI SPESIFIKASI DI ATAS)     -->
    <!-- ============================================================== -->
    <template x-teleport="body">
        <div x-cloak x-show="editModalOpen" 
             class="fixed inset-0 w-screen h-screen z-[9999] flex items-center justify-center p-3 sm:p-4 md:p-6 bg-slate-900/60 backdrop-blur-xs overflow-hidden"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <form method="POST" :action="'{{ url('admin/product') }}/' + editProduct.id" enctype="multipart/form-data"
                 class="bg-white rounded-[28px] max-w-2xl w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[90vh] overflow-hidden my-auto"
                 @click.outside="editModalOpen = false">
                @csrf
                @method('PUT')
            
                <!-- Pinned Header -->
                <div class="px-6 sm:px-7 pt-5 pb-3.5 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center font-bold">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900">Edit Data Produk / Hardware</h3>
                            <p class="text-[10px] text-slate-400 font-['Questrial',sans-serif]">Perbarui informasi teknis, foto, spesifikasi mesin atau mode RFQ</p>
                        </div>
                    </div>
                    <button type="button" @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Single Smooth Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 sm:px-7 py-4 space-y-4 text-xs overscroll-contain"
                     style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Kategori Produk *</label>
                            <div class="relative" x-data="{ open: false, openUp: false }">
                                <input type="hidden" name="category_id" :value="editProduct.category_id" required>
                                <button type="button" 
                                    @click="openUp = ($el.getBoundingClientRect().bottom + 220 > window.innerHeight); open = !open"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] hover:bg-white text-slate-800 text-xs flex items-center justify-between font-['Questrial',sans-serif] outline-none transition hover:border-[#3367A5]/40 focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer shadow-2xs">
                                    <div class="flex items-center gap-2 truncate">
                                        <i class="fa-solid fa-shapes text-[#3367A5] text-xs shrink-0"></i>
                                        <span class="truncate font-semibold" x-text="getCategoryName(editProduct.category_id)"></span>
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
                                    :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
                                    class="absolute left-0 w-full bg-white rounded-2xl shadow-xl border border-slate-200 py-1.5 z-[70] overflow-hidden">
                                    <div class="max-h-52 overflow-y-auto py-1">
                                        @foreach ($categories as $cat)
                                            <button type="button" 
                                                @click="editProduct.category_id = '{{ $cat->id }}'; open = false"
                                                class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                                :class="editProduct.category_id == '{{ $cat->id }}' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                                <div class="flex items-center gap-2.5 truncate">
                                                    <span class="w-1.5 h-1.5 rounded-full shrink-0"
                                                          :class="editProduct.category_id == '{{ $cat->id }}' ? 'bg-[#3367A5]' : 'bg-slate-300'"></span>
                                                    <span class="font-['Questrial',sans-serif] truncate">{{ $cat->name }}</span>
                                                </div>
                                                <template x-if="editProduct.category_id == '{{ $cat->id }}'">
                                                    <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                                </template>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">SKU / Kode Part *</label>
                            <input type="text" name="sku" x-model="editProduct.sku" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 outline-none focus:border-[#3367A5] uppercase font-mono">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Nama Produk / Mesin *</label>
                        <input type="text" name="name" x-model="editProduct.name" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 outline-none focus:border-[#3367A5] font-['Questrial',sans-serif]">
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Deskripsi Singkat *</label>
                        <input type="text" name="short_description" x-model="editProduct.short_description" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 outline-none focus:border-[#3367A5] font-['Questrial',sans-serif]">
                    </div>

                    <!-- SPESIFIKASI & PILIHAN VARIAN QUOTATION (PILIH SPESIFIKASI QUOTATION) -->
                    <div class="p-4 rounded-2xl bg-[#f8fafd] border border-slate-200 space-y-3.5">
                        <div class="flex items-center justify-between gap-2 border-b border-slate-200/80 pb-3">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-sliders text-[#3367A5] text-xs"></i>
                                <label class="block text-slate-800 font-bold font-['Agrandir',sans-serif] text-xs">
                                    Pilih Spesifikasi Quotation &amp; Varian Hardware
                                </label>
                            </div>
                            <button type="button" @click="addEditGroup()" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-xs font-['Agrandir',sans-serif] shadow-xs transition cursor-pointer active:scale-95 shrink-0">
                                <i class="fa-solid fa-plus text-[10px]"></i> Tambah Parameter Spek
                            </button>
                        </div>

                        <!-- Parameter Groups Container: Natural Flow (No Nested Scroll Trap) -->
                        <div class="space-y-3.5">
                            <template x-for="(group, gIdx) in editSpecsGroups" :key="gIdx">
                                <div class="bg-white rounded-2xl p-3 border border-slate-200 shadow-2xs space-y-3">
                                    <!-- Group Header -->
                                    <div class="flex items-center justify-between gap-2 bg-[#f8fafd] p-2 rounded-xl border border-slate-200/90">
                                        <div class="flex items-center gap-2 flex-1">
                                            <i class="fa-solid fa-layer-group text-[#3367A5] text-xs shrink-0"></i>
                                            <input type="text" x-model="group.name" 
                                                   placeholder="Nama Parameter (cth: Ukuran Lebar Tali Baja, Sumber Tenaga)" 
                                                   class="flex-1 px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-800 text-xs font-bold font-['Agrandir',sans-serif] outline-none focus:border-[#3367A5] transition">
                                        </div>

                                        <div class="flex items-center gap-2 shrink-0">
                                            <span class="text-[10px] font-semibold text-slate-500 bg-white px-2 py-1 rounded-md border border-slate-200"
                                                  x-text="group.options.length + ' pilihan'"></span>
                                            <button type="button" @click="addEditOption(gIdx)"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-[#3367A5] font-bold text-[11px] font-['Agrandir',sans-serif] border border-blue-200 transition cursor-pointer"
                                                    title="Tambah pilihan varian untuk parameter ini">
                                                <i class="fa-solid fa-plus text-[9px]"></i> Pilihan
                                            </button>
                                            <button type="button" @click="removeEditGroup(gIdx)" 
                                                    class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition cursor-pointer" 
                                                    title="Hapus seluruh parameter ini">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Option Rows List -->
                                    <div class="space-y-1.5 pl-2 border-l-2 border-[#3367A5]/30">
                                        <template x-for="(opt, oIdx) in group.options" :key="oIdx">
                                            <div class="flex items-center gap-2 p-1.5 rounded-xl border transition"
                                                 :class="opt.is_active ? 'bg-[#fcfdfd] border-slate-200' : 'bg-rose-50/50 border-rose-200 opacity-80'">
                                                
                                                <!-- Toggle Button Status: Tersedia vs Habis -->
                                                <button type="button" @click="toggleEditOption(gIdx, oIdx)"
                                                        class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg text-[10px] font-bold transition cursor-pointer shrink-0 select-none shadow-2xs min-w-[66px]"
                                                        :class="opt.is_active 
                                                            ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200 border border-emerald-300' 
                                                            : 'bg-rose-100 text-rose-800 hover:bg-rose-200 border border-rose-300'"
                                                        :title="opt.is_active ? 'Klik jika spek ini habis/kosong' : 'Klik untuk mengubah kembali menjadi Tersedia'">
                                                    <span x-text="opt.is_active ? 'Tersedia' : 'Habis'"></span>
                                                </button>

                                                <!-- Option Value Input -->
                                                <div class="flex-1">
                                                    <input type="text" x-model="opt.value" 
                                                           placeholder="Nilai Pilihan Varian (cth: Lebar 19 mm Heavy-Duty, Pneumatik 8 Bar)" 
                                                           class="w-full px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-800 text-xs outline-none focus:border-[#3367A5] font-['Questrial',sans-serif] transition"
                                                           :class="{ 'line-through text-slate-400': !opt.is_active }">
                                                </div>

                                                <!-- Delete Option Button -->
                                                <button type="button" @click="removeEditOption(gIdx, oIdx)" 
                                                        class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition cursor-pointer shrink-0" 
                                                        title="Hapus pilihan ini">
                                                    <i class="fa-solid fa-xmark text-xs"></i>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Hidden input to serialize groups as JSON for form submission -->
                        <input type="hidden" name="spec_groups_json" :value="JSON.stringify(editSpecsGroups)">

                        <!-- Panduan Status: Rapi, Lega & Elegan -->
                        <div class="pt-3 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-2 text-[11px] font-['Questrial',sans-serif]">
                            <div class="flex items-center gap-2 text-slate-500">
                                <i class="fa-solid fa-circle-info text-[#3367A5] text-xs shrink-0"></i>
                                <span class="font-semibold">Panduan Status Varian:</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-600">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded-md bg-emerald-100/80 text-emerald-800 font-bold text-[10px]">Tersedia</span>
                                    <span class="text-slate-500">Tampil di Quotation</span>
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded-md bg-rose-100/80 text-rose-800 font-bold text-[10px]">Habis</span>
                                    <span class="text-slate-500">Disembunyikan</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Current Image Preview & Upload Replacement -->
                    <div>
                        <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Foto Produk</label>
                        <div class="flex items-center gap-3 mb-2 p-2.5 rounded-xl bg-slate-50 border border-slate-100" x-show="editProduct.image_url">
                            <img :src="editProduct.image_url" alt="Preview" class="w-14 h-14 object-contain rounded-lg bg-white p-1 border border-slate-200 shrink-0">
                            <div class="text-[11px] text-slate-500 font-['Questrial',sans-serif]">
                                <span class="font-bold text-slate-700 block">Foto saat ini aktif</span>
                                <span>Upload file baru di bawah jika ingin mengganti gambar produk.</span>
                            </div>
                        </div>
                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-200 bg-[#f8fafd] text-slate-800 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-[#3367A5] file:text-white file:font-semibold cursor-pointer">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Custom Dropdown: Status Publikasi -->
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Status Publikasi</label>
                            <div class="relative" x-data="{ open: false, openUp: false }">
                                <input type="hidden" name="status" :value="editProduct.status">
                                <button type="button" 
                                    @click="openUp = ($el.getBoundingClientRect().bottom + 140 > window.innerHeight); open = !open"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] hover:bg-white text-slate-800 text-xs flex items-center justify-between font-['Questrial',sans-serif] outline-none transition hover:border-[#3367A5]/40 focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer shadow-2xs">
                                    <div class="flex items-center gap-2 truncate">
                                        <span class="w-2 h-2 rounded-full shrink-0" :class="getStatusDot(editProduct.status)"></span>
                                        <span class="truncate font-semibold" x-text="getStatusLabel(editProduct.status)"></span>
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
                                    :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
                                    class="absolute left-0 w-full bg-white rounded-2xl shadow-xl border border-slate-200 py-1.5 z-[70] overflow-hidden">
                                    <div class="py-1">
                                        <button type="button" 
                                            @click="editProduct.status = 'published'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="editProduct.status === 'published' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                                                <span class="font-['Questrial',sans-serif]">Published (Tayang)</span>
                                            </div>
                                            <template x-if="editProduct.status === 'published'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                        <button type="button" 
                                            @click="editProduct.status = 'draft'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="editProduct.status === 'draft' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                                                <span class="font-['Questrial',sans-serif]">Draft (Disembunyikan)</span>
                                            </div>
                                            <template x-if="editProduct.status === 'draft'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Custom Dropdown: Mode Pembelian -->
                        <div>
                            <label class="block text-slate-700 font-bold mb-1 font-['Agrandir',sans-serif]">Mode Pembelian</label>
                            <div class="relative" x-data="{ open: false, openUp: false }">
                                <input type="hidden" name="is_rfq_only" :value="editProduct.is_rfq_only">
                                <button type="button" 
                                    @click="openUp = ($el.getBoundingClientRect().bottom + 140 > window.innerHeight); open = !open"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-[#f8fafd] hover:bg-white text-slate-800 text-xs flex items-center justify-between font-['Questrial',sans-serif] outline-none transition hover:border-[#3367A5]/40 focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 cursor-pointer shadow-2xs">
                                    <div class="flex items-center gap-2 truncate">
                                        <i :class="getRfqIcon(editProduct.is_rfq_only)" class="text-xs shrink-0"></i>
                                        <span class="truncate font-semibold" x-text="getRfqLabel(editProduct.is_rfq_only)"></span>
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
                                    :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
                                    class="absolute left-0 w-full bg-white rounded-2xl shadow-xl border border-slate-200 py-1.5 z-[70] overflow-hidden">
                                    <div class="py-1">
                                        <button type="button" 
                                            @click="editProduct.is_rfq_only = '1'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="editProduct.is_rfq_only == '1' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <i class="fa-solid fa-file-invoice text-[#3367A5] text-xs shrink-0"></i>
                                                <span class="font-['Questrial',sans-serif]">Permintaan Penawaran Resmi (RFQ)</span>
                                            </div>
                                            <template x-if="editProduct.is_rfq_only == '1'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                        <button type="button" 
                                            @click="editProduct.is_rfq_only = '0'; open = false"
                                            class="w-full px-3.5 py-2.5 text-left text-xs flex items-center justify-between hover:bg-blue-50/70 transition cursor-pointer"
                                            :class="editProduct.is_rfq_only == '0' ? 'bg-blue-50 text-[#3367A5] font-bold' : 'text-slate-700'">
                                            <div class="flex items-center gap-2.5">
                                                <i class="fa-solid fa-cart-shopping text-emerald-600 text-xs shrink-0"></i>
                                                <span class="font-['Questrial',sans-serif]">Direct Purchase</span>
                                            </div>
                                            <template x-if="editProduct.is_rfq_only == '0'">
                                                <i class="fa-solid fa-check text-[#3367A5] text-xs shrink-0 ml-2"></i>
                                            </template>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1 pb-2">
                        <input type="checkbox" name="is_featured" id="edit_is_featured" value="1" :checked="editProduct.is_featured" class="rounded border-slate-300 text-[#3367A5] focus:ring-[#3367A5] cursor-pointer">
                        <label for="edit_is_featured" class="text-slate-700 font-semibold cursor-pointer select-none">
                            Tandai sebagai Produk Pilihan (Featured Card)
                        </label>
                    </div>
                </div>

                <!-- Pinned Footer: Solid, Never Overlapping -->
                <div class="px-6 sm:px-7 py-3.5 border-t border-slate-100 flex items-center gap-3 shrink-0 bg-white">
                    <button type="button" @click="editModalOpen = false" class="flex-1 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md shadow-[#3367A5]/25 transition cursor-pointer active:scale-[0.99]">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </template>

    <!-- ============================================================== -->
    <!-- MODAL KELOLA KATEGORI PRODUK (CRUD)                            -->
    <!-- ============================================================== -->
    <template x-teleport="body">
        <div x-cloak x-show="categoryModalOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[9999] bg-slate-900/55 backdrop-blur-xs flex items-center justify-center p-4"
             @click.self="categoryModalOpen = false">
            <div class="bg-white rounded-[28px] max-w-xl w-full shadow-2xl border border-[#3367A5]/20 flex flex-col max-h-[88vh] overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#3367A5] flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-tags text-sm"></i>
                        </div>
                        <h3 class="text-sm font-bold font-['Agrandir',sans-serif] text-slate-900">
                            Kelola Kategori Produk
                        </h3>
                    </div>
                    <button type="button" @click="categoryModalOpen = false"
                            class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5 text-xs">
                    <!-- Add New Category Form -->
                    <form method="POST" action="{{ route('admin.product-categories.store') }}"
                          class="p-4 rounded-2xl bg-[#f8fafd] border border-slate-200/80 space-y-3">
                        @csrf
                        <p class="font-bold text-slate-800 font-['Agrandir',sans-serif] text-xs">Tambah Kategori Baru</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <input type="text" name="category_name" required placeholder="Nama Kategori (mis. Vision Sensor)"
                                   class="w-full px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                            <input type="text" name="category_description" placeholder="Deskripsi singkat (opsional)"
                                   class="w-full px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-800 outline-none focus:border-[#3367A5]">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="h-9 px-5 rounded-full bg-[#3367A5] hover:bg-[#255187] text-white font-bold font-['Agrandir',sans-serif] inline-flex items-center gap-1.5 shadow-sm transition cursor-pointer active:scale-95">
                                <i class="fa-solid fa-plus text-[11px]"></i>
                                <span>Tambah Kategori</span>
                            </button>
                        </div>
                    </form>

                    <!-- Existing Categories List -->
                    <div class="space-y-2.5">
                        <p class="font-bold text-slate-700 font-['Agrandir',sans-serif] text-xs">
                            Daftar Kategori ({{ $allCategories->count() }})
                        </p>
                        @forelse ($allCategories as $catItem)
                            <div class="p-3.5 rounded-2xl border border-slate-200/80 bg-white space-y-2.5">
                                <!-- Normal View -->
                                <div x-show="editingCatId !== {{ $catItem->id }}" class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                                    <div class="min-w-0">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="font-bold text-slate-900 font-['Agrandir',sans-serif] text-xs">{{ $catItem->name }}</span>
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#E6F0FA] text-[#244E81]">
                                                {{ $catItem->products_count }} Produk
                                            </span>
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $catItem->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                                {{ $catItem->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </div>
                                        @if ($catItem->description)
                                            <p class="text-[11px] text-slate-500 mt-0.5 truncate">{{ $catItem->description }}</p>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-1.5 shrink-0">
                                        <button type="button"
                                                @click="editingCatId = {{ $catItem->id }}; editingCatName = @js($catItem->name); editingCatDesc = @js($catItem->description ?? '')"
                                                class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-[#3367A5] font-semibold text-[11px] transition cursor-pointer">
                                            Edit
                                        </button>

                                        <form method="POST" action="{{ route('admin.product-categories.toggle', $catItem->id) }}" class="inline m-0">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="px-2.5 py-1.5 rounded-lg border text-[11px] font-semibold transition cursor-pointer {{ $catItem->is_active ? 'border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100' : 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                                                {{ $catItem->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                        @if ($catItem->products_count === 0)
                                            <form method="POST" action="{{ route('admin.product-categories.destroy', $catItem->id) }}"
                                                  onsubmit="return confirm('Hapus kategori {{ addslashes($catItem->name) }}?')" class="inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white font-semibold text-[11px] transition cursor-pointer">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="px-2.5 py-1.5 rounded-lg bg-slate-50 text-slate-300 font-semibold text-[11px] cursor-not-allowed"
                                                  title="Masih digunakan oleh {{ $catItem->products_count }} produk">
                                                Hapus
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Inline Edit Form -->
                                <form x-cloak x-show="editingCatId === {{ $catItem->id }}"
                                      method="POST" action="{{ route('admin.product-categories.update', $catItem->id) }}"
                                      class="space-y-2.5">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <input type="text" name="category_name" x-model="editingCatName" required
                                               class="w-full px-3 py-1.5 rounded-xl border border-[#3367A5]/40 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none">
                                        <input type="text" name="category_description" x-model="editingCatDesc" placeholder="Deskripsi singkat"
                                               class="w-full px-3 py-1.5 rounded-xl border border-slate-200 bg-[#f8fafd] focus:bg-white text-slate-800 outline-none">
                                    </div>
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" @click="editingCatId = null"
                                                class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-[11px] cursor-pointer">
                                            Batal
                                        </button>
                                        <button type="submit"
                                                class="px-3.5 py-1.5 rounded-lg bg-[#3367A5] hover:bg-[#255187] text-white font-bold text-[11px] cursor-pointer">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400">Belum ada kategori produk.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-3.5 border-t border-slate-100 flex justify-end shrink-0 bg-white">
                    <button type="button" @click="categoryModalOpen = false"
                            class="h-9 px-6 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </template>

</div>
@endsection
