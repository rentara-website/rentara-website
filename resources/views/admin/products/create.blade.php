@extends('admin.layout')

@section('admin_content')
<div class="max-w-4xl mx-auto pb-20 px-4 sm:px-6 lg:px-8 pt-4 sm:pt-8">
    
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

    <!-- Alert Messages -->
    @if ($errors->any() || session('error'))
        <div class="mb-8 p-6 bg-red-50 border border-red-100 rounded-2xl">
            <div class="flex items-start gap-4">
                <i data-lucide="alert-circle" class="w-6 h-6 text-red-500 mt-0.5 flex-shrink-0"></i>
                <div>
                    <h3 class="text-sm font-bold text-red-800 mb-1">There were some problems with your submission</h3>
                    @if (session('error'))
                        <p class="text-sm text-red-600 mb-2">{{ session('error') }}</p>
                    @endif
                    @if ($errors->any())
                        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white p-6 sm:p-8 md:p-10 rounded-3xl border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-xl font-bold text-gray-900 border-b border-gray-50 pb-4">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Product Name</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required placeholder="e.g. Sony A7IV"
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                </div>
                
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Price (Per Day)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-bold">Rp</span>
                        <input type="number" name="harga" value="{{ old('harga') }}" required placeholder="500000" min="100000" step="10000"
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-12 pr-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Category</label>
                    <select name="category_id" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition appearance-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Tags</label>
                    <div class="flex flex-wrap gap-2 p-3 bg-gray-50 border border-gray-100 rounded-2xl min-h-[50px]">
                        @foreach($tags as $tag)
                            <label class="flex items-center gap-2 bg-white px-3 py-1 rounded-full border border-gray-100 cursor-pointer hover:border-[#0A4088] transition group">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="sr-only peer">
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
                          class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">{{ old('deskripsi') }}</textarea>
            </div>
        </div>

        <!-- Media Upload -->
        <div class="bg-white p-6 sm:p-8 md:p-10 rounded-3xl border border-gray-100 shadow-sm space-y-8">
            <h3 class="text-xl font-bold text-gray-900 border-b border-gray-50 pb-4">Media & Assets</h3>
            
            <!-- Main Featured Image -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Main Featured Image</label>
                        <p class="text-[10px] text-gray-400">This will be the primary image for the product.</p>
                    </div>
                </div>
                <div id="product_image_container" class="relative group h-48 sm:h-64 bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl flex flex-col items-center justify-center transition hover:border-[#0A4088] hover:bg-[#0A4088]/5 overflow-hidden">
                    <input type="file" id="product_image_input" name="product_image" required accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full">
                    <div id="product_image_placeholder" class="flex flex-col items-center justify-center text-center px-4 pointer-events-none">
                        <i data-lucide="image-plus" class="w-10 h-10 text-gray-300 group-hover:text-[#0A4088] transition mb-2"></i>
                        <p class="text-xs font-bold text-gray-400 group-hover:text-[#0A4088]">Click or drag to upload featured image</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                <!-- Portfolio Images -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Portfolio Images (Optional)</label>
                    <div id="portfolio_images_container" class="relative h-32 sm:h-40 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition hover:border-[#0A4088] overflow-hidden">
                        <input type="file" id="portfolio_images_input" name="portfolio_images[]" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full">
                        <div id="portfolio_images_placeholder" class="flex flex-col items-center justify-center text-center px-4 pointer-events-none">
                            <i data-lucide="images" class="w-6 h-6 text-gray-300 mb-1"></i>
                            <p class="text-[10px] font-bold text-gray-400">Click or drag images here<br>Multiple allowed</p>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Videos -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Portfolio Videos (Optional)</label>
                    <div id="portfolio_videos_container" class="relative h-32 sm:h-40 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition hover:border-[#0A4088] overflow-hidden">
                        <input type="file" id="portfolio_videos_input" name="portfolio_videos[]" multiple accept="video/mp4,video/quicktime" class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full">
                        <div id="portfolio_videos_placeholder" class="flex flex-col items-center justify-center text-center px-4 pointer-events-none">
                            <i data-lucide="video" class="w-6 h-6 text-gray-300 mb-1"></i>
                            <p class="text-[10px] font-bold text-gray-400">Click or drag videos here<br>MP4, MOV supported</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4">
            <button type="reset" class="w-full sm:w-auto px-8 py-4 bg-white border border-gray-100 text-gray-400 font-bold rounded-2xl hover:bg-gray-50 transition">Reset Form</button>
            <button type="submit" class="w-full sm:flex-1 bg-[#0A4088] hover:bg-[#08306b] text-white font-bold py-4 rounded-2xl transition shadow-xl shadow-[#0A4088]/30">
                Publish Product Listing
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function setupPreview(inputId, containerId, placeholderId, isMultiple = false, isVideo = false) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        const placeholder = document.getElementById(placeholderId);
        
        if (!input || !container || !placeholder) return;

        // Visual feedback for drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            container.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            container.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            container.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            container.classList.add('border-[#0A4088]', 'bg-[#0A4088]/5');
        }

        function unhighlight(e) {
            container.classList.remove('border-[#0A4088]', 'bg-[#0A4088]/5');
        }

        container.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            input.files = files; // Update input files
            handleFiles(files);
        }

        input.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            // Remove existing previews
            const existingPreviews = container.querySelectorAll('.preview-item');
            existingPreviews.forEach(el => el.remove());

            if (files.length === 0) {
                placeholder.classList.remove('hidden');
                placeholder.classList.add('flex');
                return;
            }

            // Hide placeholder
            placeholder.classList.add('hidden');
            placeholder.classList.remove('flex');

            if (!isMultiple) {
                // Single preview
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.className = 'preview-item absolute inset-0 w-full h-full object-cover z-0 pointer-events-none rounded-2xl';
                    container.appendChild(img);
                }
            } else {
                // Multiple previews grid
                const grid = document.createElement('div');
                grid.className = 'preview-item absolute inset-0 w-full h-full overflow-y-auto p-2 grid grid-cols-3 sm:grid-cols-4 gap-2 z-0 pointer-events-none';
                
                Array.from(files).forEach(file => {
                    const item = document.createElement('div');
                    item.className = 'relative aspect-square bg-gray-100 rounded-lg overflow-hidden border border-gray-200';
                    
                    if (isVideo || file.type.startsWith('video/')) {
                        const iconHtml = `<div class="flex flex-col items-center justify-center h-full p-2 bg-gray-800 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 mb-1 opacity-70"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg><span class="text-[8px] text-center w-full truncate px-1">${file.name}</span></div>`;
                        item.innerHTML = iconHtml;
                    } else if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.className = 'w-full h-full object-cover';
                        item.appendChild(img);
                    }
                    
                    grid.appendChild(item);
                });
                
                container.appendChild(grid);
            }
        }
    }

    setupPreview('product_image_input', 'product_image_container', 'product_image_placeholder', false, false);
    setupPreview('portfolio_images_input', 'portfolio_images_container', 'portfolio_images_placeholder', true, false);
    setupPreview('portfolio_videos_input', 'portfolio_videos_container', 'portfolio_videos_placeholder', true, true);
});
</script>
@endsection
