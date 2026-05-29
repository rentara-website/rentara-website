@forelse($products as $product)
    <tr class="hover:bg-gray-50/50 transition">
        <td class="px-8 py-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 flex items-center justify-center shrink-0">
                    @if($product->image)
                        <img src="{{ $product->resolveMediaUrl($product->image, ['width' => 96, 'height' => 96, 'crop' => 'fill']) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/Rectangle24.png') }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <p class="text-gray-900 font-black">{{ $product->nama_produk }}</p>
                    <p class="text-[10px] text-gray-400 font-medium lowercase">/product/{{ $product->slug }}</p>
                </div>
            </div>
        </td>
        <td class="px-8 py-5">
            <span class="bg-blue-50 text-[#0A4088] px-3 py-1 rounded-full uppercase text-[10px]">
                {{ $product->category->name }}
            </span>
        </td>
        <td class="px-8 py-5 text-gray-900">
            Rp {{ number_format($product->harga, 0, ',', '.') }}
        </td>
        <td class="px-8 py-5">
            <div class="flex flex-wrap gap-1">
                @foreach($product->tags as $tag)
                    <span class="text-gray-400 text-[10px]">#{{ $tag->name }}</span>
                @endforeach
                @if($product->tags->isEmpty())
                    <span class="text-gray-300 italic font-medium">No tags</span>
                @endif
            </div>
        </td>
        <td class="px-8 py-5 text-right">
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.products.edit', $product->slug) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST" class="js-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="js-delete-btn px-4 py-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 font-semibold transition">
                        Delete
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">No products found. Start by creating one.</td>
    </tr>
@endforelse