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