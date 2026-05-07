@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Products Inventory</h1>
            <p class="text-gray-500 text-sm mt-1">Manage your gear, portfolios, and availability.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-[#0A4088] hover:bg-[#08306b] text-white px-6 py-3 rounded-2xl font-bold flex items-center justify-center gap-2 transition-all shadow-lg shadow-[#0A4088]/20 active:scale-95 text-sm">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Create New Product
        </a>
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

    <!-- Products Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-8 py-5">Product</th>
                        <th class="px-8 py-5">Category</th>
                        <th class="px-8 py-5">Price</th>
                        <th class="px-8 py-5">Tags</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs font-bold">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 flex items-center justify-center shrink-0">
                                        @if($product->image_product->isNotEmpty())
                                            <img src="{{ $product->image_product->first()->url }}" alt="{{ $product->nama_produk }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <i data-lucide="image" class="w-6 h-6 text-gray-300"></i>
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
                                    <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
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
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">No products found. Start by creating one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
