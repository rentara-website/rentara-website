@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Ratings Management</h1>
            <p class="text-gray-500 text-sm mt-1">Manage user ratings and feedback for your products.</p>
        </div>

        <div>
            <a href="{{ route('admin.ratings.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0A4088] text-white rounded-lg hover:bg-[#0A4088]/90 transition">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add New Rating
            </a>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div class="relative w-full md:max-w-md">
            <i data-lucide="search" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            <input
                type="text"
                id="rating-search"
                placeholder="Cari nama, email, atau komentar..."
                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 bg-white"
            >
        </div>

        <div class="shrink-0 p-3 bg-blue-50 rounded-2xl text-[10px] font-bold text-[#0A4088] uppercase tracking-widest border border-blue-100">
            Total Ratings: {{ $ratings->total() }}
        </div>
    </div>

    @if (session('success'))
        <div class="mt-2 bg-green-400 px-2 py-2 rounded-lg w-full">
            <p class="text-white">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="mt-2 bg-red-400 px-2 py-2 rounded-lg w-full">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif
        
        
    
    
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-8 py-5">User</th>
                        <th class="px-8 py-5">Rating</th>
                        <th class="px-8 py-5">Komentar</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="ratings-table-body" class="divide-y divide-gray-50 text-xs font-bold">
                    @include('admin.ratings.partials.rows', ['ratings' => $ratings])
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $ratings->links() }}
        </div>
    </div>
@endsection