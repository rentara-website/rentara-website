@extends('admin.layout')

@section('admin_content')
<div class="space-y-6" x-data="{ openCreate: false, openEdit: false, currentTag: {id: null, name: ''} }">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Product Tags</h1>
            <p class="text-gray-500 text-sm mt-1">Manage categories and tags used to organize your products.</p>
        </div>
        <button @click="openCreate = true" class="bg-[#0A4088] hover:bg-[#08306b] text-white px-6 py-3 rounded-2xl font-bold flex items-center justify-center gap-2 transition-all shadow-lg shadow-[#0A4088]/20 active:scale-95">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Add New Tag
        </button>
    </div>

    @if (session('success'))
        <div class="mt-2 bg-green-400 px-2 py-2 rounded-lg w-full">
            <p class="text-white">{{ session('success') }}</p>
        </div>
    @elseif(session('error'))
        <div class="mt-2 bg-red-400 px-2 py-2 rounded-lg w-full">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div class="relative w-full md:max-w-md">
            <i data-lucide="search" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            <input
                type="text"
                id="tag-search"
                placeholder="Cari tag..."
                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 bg-white"
            >
        </div>

        <div class="shrink-0 px-4 py-3 bg-blue-50 rounded-2xl text-[10px] font-bold text-[#0A4088] uppercase tracking-widest border border-blue-100">
            Total Tags: {{ $tags->count() }}
        </div>
    </div>

    <!-- Tags Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-8 py-5">Name</th>
                        <th class="px-8 py-5">Slug</th>
                        <th class="px-8 py-5">Products Count</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="tags-table-body" class="divide-y divide-gray-50 uppercase text-xs font-bold">
                    @include('admin.tags.partials.rows', ['tags' => $tags])
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div x-show="openCreate" class="fixed inset-0 z-60 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" style="display: none;">
        <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl" @click.away="openCreate = false">
            <h3 class="text-xl font-black text-gray-900 mb-6">Create New Tag</h3>
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div class="mb-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tag Name</label>
                        <input type="text" name="name" required placeholder="e.g. Photography"
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition category-name">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>

                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tag Slug</label>
                        <input type="text" name="slug" required placeholder="e.g. photography"
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition category-slug" readonly>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
                <div class="flex items-center gap-3 mt-8">
                    <button type="button" @click="openCreate = false" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-2xl transition">Cancel</button>
                    <button type="submit" class="flex-1 bg-[#0A4088] hover:bg-[#08306b] text-white font-bold py-3 rounded-2xl transition shadow-lg shadow-[#0A4088]/20">Create Tag</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
