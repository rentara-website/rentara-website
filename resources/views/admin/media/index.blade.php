@extends('admin.layout')

@section('admin_content')
<div class="space-y-10 pb-20">
    
    <!-- Header -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Media Library</h1>
            <p class="text-gray-500 text-sm mt-1">A central place to manage all uploaded images and videos.</p>
        </div>
    </div>

    <!-- Product Images Section -->
    <div class="space-y-4">
        <h3 class="text-lg font-bold text-[#0A4088] px-4 border-l-4 border-[#0A4088]">Main Product Images</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($productImages as $image)
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 aspect-square">
                    <img src="{{ Str::startsWith($image->image_path, 'http') ? $image->image_path : asset('storage/' . $image->image_path) }}" 
                         class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center p-4 text-center">
                        <p class="text-white text-[10px] font-bold mb-2">{{ $image->product->nama_produk ?? 'Unknown' }}</p>
                        <form action="{{ route('admin.media.destroyImage', $image->id) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Portfolio Media Section -->
    <div class="space-y-4">
        <h3 class="text-lg font-bold text-[#0A4088] px-4 border-l-4 border-[#0A4088]">Portfolio & Gallery Assets</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($portfolios as $item)
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 aspect-square">
                    @if($item->type === 'image')
                        <img src="{{ Str::startsWith($item->file_path, 'http') ? $item->file_path : asset('storage/' . $item->file_path) }}" 
                             class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-900 flex items-center justify-center">
                            <i data-lucide="play" class="w-10 h-10 text-white/20"></i>
                        </div>
                    @endif

                    <div class="absolute top-2 left-2">
                        @if($item->type === 'video')
                            <span class="bg-black/50 text-white text-[8px] px-2 py-0.5 rounded-full font-bold uppercase">Video</span>
                        @endif
                    </div>

                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center p-4 text-center">
                        <p class="text-white text-[10px] font-bold mb-1">{{ $item->title }}</p>
                        <p class="text-white/60 text-[8px] mb-3">{{ $item->product->nama_produk ?? 'Generic' }}</p>
                        <form action="{{ route('admin.media.destroyPortfolio', $item->id) }}" method="POST" onsubmit="return confirm('Delete this portfolio item?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
