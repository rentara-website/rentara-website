@forelse($ratings as $rating)
    <tr class="hover:bg-gray-50/50 transition">
        <td class="px-8 py-5">
            <div class="flex flex-col">
                <span class="text-gray-900">{{ $rating->nama }}</span>
                <span class="text-[10px] text-gray-400 font-medium normal-case">{{ $rating->email }}</span>
            </div>
        </td>
        <td class="px-8 py-5">{{ $rating->rating }} / 5</td>
        <td class="px-8 py-5">
            {{ \Illuminate\Support\Str::limit($rating->komentar, 50, '...') ?? $rating->komentar ?? '-' }}
        </td>
        <td class="px-8 py-5 text-right">
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.ratings.edit', $rating->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                    <i data-lucide="edit" class="w-4 h-4"></i>
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
        <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">No ratings found.</td>
    </tr>
@endforelse