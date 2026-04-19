@extends('admin.layout')

@section('admin_content')
<div class="max-w-4xl mx-auto pb-20">
    
    <!-- Header -->
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-gray-900">Create New Product</h1>
            <p class="text-gray-500 mt-1">Fill in the details to list a new piece of gear or service.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white p-8 md:p-10 rounded-3xl border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-xl font-bold text-gray-900 border-b border-gray-50 pb-4">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Product Name</label>
                    <input type="text" name="nama_produk" required placeholder="e.g. Sony A7IV"
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                </div>
                
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Price (Per Day)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-bold">Rp</span>
                        <input type="number" name="harga" required placeholder="500000"
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-12 pr-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Category</label>
                    <select name="category_id" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition appearance-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Tags</label>
                    <div class="flex flex-wrap gap-2 p-3 bg-gray-50 border border-gray-100 rounded-2xl min-h-[50px]">
                        @foreach($tags as $tag)
                            <label class="flex items-center gap-2 bg-white px-3 py-1 rounded-full border border-gray-100 cursor-pointer hover:border-[#0A4088] transition group">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="sr-only peer">
                                <div class="w-3 h-3 rounded-full border border-gray-300 peer-checked:bg-[#0A4088] peer-checked:border-[#0A4088] transition"></div>
                                <span class="text-[10px] font-bold text-gray-500 peer-checked:text-[#0A4088]">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Description</label>
                <textarea name="deskripsi" required rows="5" placeholder="Describe the specifications and features..."
                          class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition"></textarea>
            </div>
        </div>

        <!-- Media Upload -->
        <div class="bg-white p-8 md:p-10 rounded-3xl border border-gray-100 shadow-sm space-y-8">
            <h3 class="text-xl font-bold text-gray-900 border-b border-gray-50 pb-4">Media & Assets</h3>
            
            <!-- Main Featured Image -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Main Featured Image</label>
                        <p class="text-[10px] text-gray-400">This will be the primary image for the product.</p>
                    </div>
                </div>
                <div class="relative group h-48 bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl flex flex-col items-center justify-center transition hover:border-[#0A4088] hover:bg-[#0A4088]/5">
                    <input type="file" name="product_image" required class="absolute inset-0 opacity-0 cursor-pointer">
                    <i data-lucide="image-plus" class="w-10 h-10 text-gray-300 group-hover:text-[#0A4088] transition mb-2"></i>
                    <p class="text-xs font-bold text-gray-400 group-hover:text-[#0A4088]">Click or drag to upload featured image</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                <!-- Portfolio Images -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Portfolio Images (Optional)</label>
                    <div class="relative h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition hover:border-[#0A4088]">
                        <input type="file" name="portfolio_images[]" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                        <i data-lucide="images" class="w-6 h-6 text-gray-300 mb-1"></i>
                        <p class="text-[10px] font-bold text-gray-400">Multiple allowed</p>
                    </div>
                </div>

                <!-- Portfolio Videos -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Portfolio Videos (Optional)</label>
                    <div class="relative h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition hover:border-[#0A4088]">
                        <input type="file" name="portfolio_videos[]" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                        <i data-lucide="video" class="w-6 h-6 text-gray-300 mb-1"></i>
                        <p class="text-[10px] font-bold text-gray-400">MP4, MOV supported</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="reset" class="px-8 py-4 bg-white border border-gray-100 text-gray-400 font-bold rounded-2xl hover:bg-gray-50 transition">Reset Form</button>
            <button type="submit" class="flex-1 bg-[#0A4088] hover:bg-[#08306b] text-white font-bold py-4 rounded-2xl transition shadow-xl shadow-[#0A4088]/30">
                Publish Product Listing
            </button>
        </div>
    </form>
</div>
@endsection
