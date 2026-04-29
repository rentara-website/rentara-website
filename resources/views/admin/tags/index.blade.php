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
    @endif

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
                <tbody class="divide-y divide-gray-50 uppercase text-xs font-bold">
                    @forelse($tags as $tag)
                        <tr class="hover:bg-gray-50/50 transition group">
                            <td class="px-8 py-5 text-gray-900">
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-[#0A4088] group-hover:bg-[#0A4088] group-hover:text-white transition-colors">
                                    {{ $tag->name }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-gray-400 font-medium lowercase">?tag={{ $tag->slug }}</td>
                            <td class="px-8 py-5 text-gray-600">
                                {{ $tag->products()->count() }} Products
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">No tags found. Add your first tag above.</td>
                        </tr>
                    @endforelse
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
