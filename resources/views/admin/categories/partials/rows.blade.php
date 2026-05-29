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
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                </a>
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
        <td colspan="3" class="px-8 py-10 text-center text-gray-400 italic">No categories found.</td>
    </tr>
@endforelse