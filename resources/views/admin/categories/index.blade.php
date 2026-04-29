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


    <div class="p-3 bg-blue-50 rounded-2xl text-[10px] font-bold text-[#0A4088] uppercase tracking-widest border border-blue-100">
        Total Categories: {{ $categories_count }}
    </div>
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
                <tbody class="divide-y divide-gray-50 text-xs font-bold">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900">{{ $category->name }}</span>
                                        <span class="text-[10px] text-gray-400 font-medium normal-case">{{ $category->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-gray-400">{{ $category->created_at->format('d M Y') }}</td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <div>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
