@extends('template')

@section('content')
<div class="bg-white min-h-screen" x-data="portfolioLightbox()">
    
    {{-- Product Hero --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-center">
            
            {{-- Product Image --}}
            <div class="w-full lg:w-1/2 relative group">
                <div class="absolute inset-0 bg-[#0A4088]/5 rounded-3xl -rotate-2 transform group-hover:rotate-0 transition-transform duration-500"></div>
                <div class="relative bg-gray-50 rounded-3xl p-8 md:p-12 overflow-hidden shadow-2xl shadow-[#0A4088]/10 border border-gray-100">
                    <img src="/images/Rectangle24.png" alt="{{ $product->nama_produk }}" class="w-full h-auto max-h-[500px] object-contain transform group-hover:scale-105 transition-transform duration-700">
                    
                    {{-- Category Badge --}}
                    <div class="absolute top-6 left-6">
                        <span class="bg-[#0A4088] text-white text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full shadow-lg">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="w-full lg:w-1/2 space-y-8">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-tight">
                        {{ $product->nama_produk }}
                    </h1>
                </div>

                {{-- Price & Action --}}
                <div class="bg-gray-50 rounded-2xl p-6 md:p-8 border border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Rental Price</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black text-[#0A4088]">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-400 font-bold uppercase tracking-widest">/ Day</span>
                        </div>
                    </div>
                    
                    <a href="https://wa.me/6289519929891?text={{ urlencode('Halo Rentara, saya tertarik untuk menyewa ' . $product->nama_produk) }}" target="_blank" class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white px-10 py-5 rounded-2xl font-bold shadow-xl shadow-green-100 transition-all transform hover:-translate-y-1 active:scale-95">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                        Rent Now
                    </a>
                </div>

                {{-- Description --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-b-2 border-[#0A4088] w-fit pb-1">About this Gear</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        {{ $product->deskripsi }}
                    </p>
                </div>

                {{-- Tags --}}
                <div class="pt-4">
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->tags as $tag)
                            <a href="{{ url('/products?tag=' . $tag->slug) }}" class="px-4 py-2 bg-gray-100 hover:bg-[#0A4088] hover:text-white text-gray-500 rounded-xl font-bold text-xs transition-colors group">
                                <span class="group-hover:text-white/80">#</span>{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Portfolio Section (If Photographer/Videographer) --}}
    @if(in_array(strtolower($product->category->slug), ['photographer', 'videographer']))
    <div class="bg-gray-50 py-20 md:py-32 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#0A4088] mb-4">Our Work Portfolio</h2>
                    <p class="text-gray-500 max-w-xl">
                        Hasil karya otentik yang dihasilkan menggunakan gear ini oleh tim profesional kami.
                    </p>
                </div>
            </div>

            {{-- Masonry Grid --}}
            @if($product->portfolios->isEmpty())
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                    <i data-lucide="image-off" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                    <h2 class="text-xl font-bold text-gray-700">No portfolio items yet</h2>
                    <p class="text-gray-400 mt-2">Projects will be updated soon.</p>
                </div>
            @else
                <div class="masonry-grid">
                    @foreach($product->portfolios as $item)
                        <div class="masonry-item group cursor-zoom-in"
                             @click="openLightbox('{{ $item->type }}', '{{ $item->file_path }}', '{{ $item->title ?? 'Portofolio' }}', '{{ $product->nama_produk }}', '{{ $product->category->name }}')">
                            
                            @if($item->type === 'image')
                                <img src="{{ $item->file_path }}" alt="{{ $item->title }}" class="w-full h-auto object-cover" loading="lazy">
                            @elseif($item->type === 'video')
                                <video src="{{ $item->file_path }}" class="w-full h-auto object-cover" muted loop preload="metadata" onmouseover="this.play()" onmouseout="this.pause()"></video>
                            @endif

                            {{-- Pinterest Style Overlay --}}
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                {{-- Save Button (Top Right) --}}
                                <div class="absolute top-4 right-4 pointer-events-auto">
                                    <button class="bg-[#E60023] hover:bg-[#AD001B] text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg transition-colors">
                                        Simpan
                                    </button>
                                </div>

                                {{-- Info (Bottom) --}}
                                <div class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end">
                                    @if($item->title)
                                        <h3 class="text-white font-bold text-sm leading-tight line-clamp-1">{{ $item->title }}</h3>
                                    @endif
                                </div>
                            </div>

                            {{-- Video Indicator --}}
                            @if($item->type === 'video')
                                <div class="absolute top-4 left-4 pointer-events-none bg-black/40 backdrop-blur-md rounded-full p-2 group-hover:hidden">
                                    <i data-lucide="play" class="w-3 h-3 text-white fill-white"></i>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Breadcrumbs / Back Navigation --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <a href="{{ url('/products') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-2xl transition-all">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to Products
        </a>
    </div>

    {{-- Lightbox (Google Drive Style) --}}
    <div x-show="isOpen" 
         style="display: none;"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        
        <div class="absolute inset-0 bg-black/90 backdrop-blur-md" @click="closeLightbox()"></div>

        <div class="relative w-full max-w-5xl bg-transparent flex flex-col items-center pointer-events-none" @click.stop>
            {{-- Toolbar --}}
            <div class="absolute -top-12 left-0 right-0 flex justify-between items-center text-white pointer-events-auto">
                <div class="flex items-center gap-3">
                    <span x-text="category" class="bg-[#0A4088] text-white text-[10px] font-bold uppercase py-1 px-3 rounded-full"></span>
                    <h3 x-text="title" class="font-bold text-lg drop-shadow-md"></h3>
                </div>
                <button type="button" @click="closeLightbox()" class="p-2 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-md transition-colors text-white">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            {{-- Media --}}
            <div class="w-full flex justify-center items-center pointer-events-auto mt-2">
                <template x-if="type === 'image'">
                    <img :src="src" class="max-h-[80vh] w-auto max-w-full rounded-2xl shadow-2xl object-contain" alt="Preview">
                </template>
                <template x-if="type === 'video'">
                    <video :src="src" class="max-h-[80vh] w-auto max-w-full rounded-2xl shadow-2xl" controls autoplay loop></video>
                </template>
            </div>
        </div>
    </div>

</div>

<script>
    function portfolioLightbox() {
        return {
            isOpen: false,
            type: 'image',
            src: '',
            title: '',
            productName: '',
            category: '',
            
            openLightbox(type, src, title, productName, category) {
                this.type = type;
                this.src = src;
                this.title = title;
                this.productName = productName;
                this.category = category;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            
            closeLightbox() {
                this.isOpen = false;
                this.src = ''; 
                document.body.style.overflow = '';
            }
        }
    }
</script>
@endsection
