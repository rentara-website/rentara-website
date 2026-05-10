@extends('admin.layout')

@section('admin_content')
<div class="max-w-4xl mx-auto pb-20">
    
    <!-- Header -->
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-gray-900">Edit Product</h1>
            <p class="text-gray-500 mt-1">Update information for "{{ $product->nama_produk }}"</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- Basic Information -->
        <div class="bg-white p-8 md:p-10 rounded-3xl border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-xl font-bold text-gray-900 border-b border-gray-50 pb-4">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Product Name</label>
                    <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" required
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                </div>
                
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Price (Per Day)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-bold">Rp</span>
                        <input type="number" name="harga" value="{{ $product->harga }}" required min="100000" step="10000"
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-12 pr-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Category</label>
                    <select name="category_id" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition appearance-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Tags</label>
                    <div class="flex flex-wrap gap-2 p-3 bg-gray-50 border border-gray-100 rounded-2xl min-h-12.5">
                        @php $productTags = $product->tags->pluck('id')->toArray(); @endphp
                        @foreach($tags as $tag)
                            <label class="flex items-center gap-2 bg-white px-3 py-1 rounded-full border border-gray-100 cursor-pointer hover:border-[#0A4088] transition group">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $productTags) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-3 h-3 rounded-full border border-gray-300 peer-checked:bg-[#0A4088] peer-checked:border-[#0A4088] transition"></div>
                                <span class="text-[10px] font-bold text-gray-500 peer-checked:text-[#0A4088]">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Description</label>
                <textarea name="deskripsi" required rows="5"
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">{{ $product->deskripsi }}</textarea>
            </div>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-3xl border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-xl font-bold text-gray-900 border-b border-gray-50 pb-4">Media Assets</h3>
            
            <!-- Main Image -->
            <div class="space-y-4">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Main Product Image</label>
                @if($product->image_product->isNotEmpty())
                    <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-2xl bg-gray-50">
                        <img src="{{ $product->image_product->first()->url }}" class="w-20 h-20 rounded-xl object-cover">
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-900">Current Image</p>
                            <p class="text-xs text-gray-500 mt-1">Upload a new image below to automatically replace this.</p>
                        </div>
                    </div>
                @endif
                <input type="file" name="product_image" accept="image/jpeg,image/png,image/webp"
                    class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
            </div>

            <!-- Portfolio Images -->
            <div class="space-y-4 pt-6 border-t border-gray-50">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Portfolio Assets</label>
                </div>
                
                @if($product->portfolios->isNotEmpty())
                    <p class="text-xs text-gray-500 mb-2">Select assets you want to <span class="text-red-500 font-bold">delete</span> upon saving.</p>
                    <div class="flex flex-wrap gap-4">
                        @foreach($product->portfolios as $portfolio)
                            <label class="relative group w-24 h-24 rounded-xl overflow-hidden border-2 border-transparent cursor-pointer hover:border-red-500 transition-colors has-checked:border-red-500 has-checked:opacity-50">
                                <input type="checkbox" name="delete_portfolios[]" value="{{ $portfolio->id }}" class="peer sr-only">
                                @if($portfolio->type === 'image')
                                    <img src="{{ $portfolio->url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-900 flex items-center justify-center">
                                        <i data-lucide="play" class="w-8 h-8 text-white/50"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-red-500/80 opacity-0 peer-checked:opacity-100 transition flex items-center justify-center">
                                    <i data-lucide="trash-2" class="w-6 h-6 text-white"></i>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Add Portfolio Images</label>
                        <input type="file" name="portfolio_images[]" multiple accept="image/jpeg,image/png,image/webp"
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Add Portfolio Videos</label>
                        <input type="file" name="portfolio_videos[]" multiple accept="video/mp4,video/quicktime,video/x-msvideo"
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" class="px-8 py-4 bg-white border border-gray-100 text-gray-400 font-bold rounded-2xl hover:bg-gray-50 transition">Cancel</a>
            <button type="submit" class="flex-1 bg-[#0A4088] hover:bg-[#08306b] text-white font-bold py-4 rounded-2xl transition shadow-xl shadow-[#0A4088]/30">
                Update Product Listing
            </button>
        </div>
    </form>
</div>
@endsection
