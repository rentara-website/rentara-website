@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Category Directory</h1>
            <p class="text-gray-500 text-sm mt-1">Manage platform categories and their associated products.</p>
        </div>
        
        <a href="{{ route('admin.categories.create') }}" class="bg-[#0A4088] text-white px-6 py-2.5 rounded-2xl hover:bg-[#08306b] transition font-bold flex items-center gap-1">
            <i data-lucide="plus" class="w-4 h-4 mr-1"></i>
            Add Category
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-3">
        <div class="relative w-full md:max-w-md">
            <i data-lucide="search" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            <input
                type="text"
                id="category-search"
                placeholder="Cari category..."
                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 bg-white"
            >
        </div>

        <div class="shrink-0 p-3 bg-blue-50 rounded-2xl text-[10px] font-bold text-[#0A4088] uppercase tracking-widest border border-blue-100">
            Total Categories: {{ $categories_count }}
        </div>
    </div>

</div>
    <div class="{{ session()->has('success') || session()->has('error') ? 'flex justify-between' : 'flex justify-end' }} gap-4">
        @if(session()->has('success'))
            <div class="bg-green-500 rounded-2xl px-4 py-2 w-full max-w-md flex items-center">
                <p class="text-white text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="bg-red-500 rounded-2xl px-4 py-2 w-full max-w-md flex items-center">
                <p class="text-white text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-8 py-5">Category</th>
                        <th class="px-8 py-5">Created At</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="categories-table-body" class="divide-y divide-gray-50 text-xs font-bold">
                    @include('admin.categories.partials.rows', ['categories' => $categories])
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
