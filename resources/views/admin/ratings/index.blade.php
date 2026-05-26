@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Ratings Management</h1>
            <p class="text-gray-500 text-sm mt-1">Manage user ratings and feedback for your products.</p>
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
                <tbody class="divide-y divide-gray-50 text-xs font-bold">
                    @forelse($ratings as $rating)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900">{{ $rating->name }}</span>
                                        <span class="text-[10px] text-gray-400 font-medium normal-case">{{ $rating->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                {{ $rating->rating }} / 5
                            </td>
                            <td class="px-8 py-5">
                                {{ \Illuminate\Support\Str::limit($rating->komentar, 50, '...') ?? $rating->komentar ?? '-' }}
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{route("admin.ratings.edit", $rating->id)}}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                    </a>

                                    <form action="{{ route('admin.ratings.destroy', $rating->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this rating?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                            <i data-lucide="trash" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">No ratings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $ratings->links() }}
        </div>
    </div>
@endsection