@extends('template')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="portfolioLightbox()">

    {{-- Header --}}
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#0A4088] mb-4">
            @if(isset($activeCategory))
                Portofolio {{ $activeCategory->name }}
            @else
                Karya Pilihan (Portofolio)
            @endif
        </h1>
        <p class="text-gray-500 max-w-2xl mx-auto">
            Jelajahi hasil karya profesional dari para vendor kami. Temukan inspirasi dan temukan kreator yang tepat untuk kebutuhan Anda.
        </p>

        @if(isset($activeCategory))
        <div class="mt-6">
            <a href="{{ url('/products?category=' . $activeCategory->slug) }}" class="inline-flex items-center gap-2 px-6 py-2 bg-[#0A4088]/10 text-[#0A4088] font-semibold rounded-full hover:bg-[#0A4088]/20 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Produk {{ $activeCategory->name }}
            </a>
        </div>
        @else
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="{{ url('/portfolio') }}" class="px-5 py-2 rounded-full font-bold transition-all text-sm {{ !request()->filled('category') ? 'bg-[#0A4088] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">All</a>
            <a href="{{ url('/portfolio?category=photographer') }}" class="px-5 py-2 rounded-full font-bold transition-all text-sm {{ request()->query('category') == 'photographer' ? 'bg-[#0A4088] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Photography</a>
            <a href="{{ url('/portfolio?category=videographer') }}" class="px-5 py-2 rounded-full font-bold transition-all text-sm {{ request()->query('category') == 'videographer' ? 'bg-[#0A4088] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Videography</a>
        </div>
        @endif
    </div>

    {{-- Masonry Grid --}}
    @if($portfolios->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-3xl border border-gray-100">
            <i data-lucide="image-off" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-700">Belum Ada Portofolio</h2>
            <p class="text-gray-500 mt-2">Karya akan segera ditambahkan di sini.</p>
        </div>
    @else
        <div class="masonry-grid">
            @foreach($portfolios as $item)
                <div class="masonry-item group cursor-zoom-in"
                     @click="openLightbox('{{ $item->type }}', '{{ $item->file_path }}', '{{ $item->title ?? 'Portofolio' }}', '{{ $item->product ? $item->product->nama_produk : '' }}', '{{ $item->category ? $item->category->name : '' }}')">
                    
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
                            @if($item->product)
                                <p class="text-white/80 text-[10px] mt-1 flex items-center gap-1">
                                    <i data-lucide="user" class="w-2.5 h-2.5"></i> {{ $item->product->nama_produk }}
                                </p>
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

    {{-- Google Drive Style Lightbox --}}
    <div x-show="isOpen" 
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        
        {{-- Backdrop Blur --}}
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="closeLightbox()"></div>

        {{-- Lightbox Content --}}
        <div class="relative w-full max-w-5xl bg-transparent flex flex-col items-center pointer-events-none" @click.stop>
            
            {{-- Toolbar (Top) --}}
            <div class="absolute -top-12 left-0 right-0 flex justify-between items-center text-white pointer-events-auto">
                <div class="flex items-center gap-3">
                    <span x-text="category" class="bg-[#0A4088] text-white text-[10px] font-bold uppercase py-1 px-3 rounded-full"></span>
                    <h3 x-text="title" class="font-bold text-lg drop-shadow-md"></h3>
                </div>
                <button type="button" @click="closeLightbox()" class="p-2 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-md transition-colors text-white">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            {{-- Media Container --}}
            <div class="w-full flex justify-center items-center pointer-events-auto mt-2">
                <template x-if="type === 'image'">
                    <img :src="src" class="max-h-[80vh] w-auto max-w-full rounded-lg shadow-2xl object-contain border border-white/10" alt="Preview">
                </template>
                <template x-if="type === 'video'">
                    <video :src="src" class="max-h-[80vh] w-auto max-w-full rounded-lg shadow-2xl border border-white/10" controls autoplay loop></video>
                </template>
            </div>

            {{-- Call to Action (Bottom) --}}
            <template x-if="productName">
                <div class="absolute -bottom-16 w-full flex justify-center pointer-events-auto">
                    <a :href="'/products?search=' + encodeURIComponent(productName)" class="group flex items-center gap-3 bg-white hover:bg-gray-50 text-[#0A4088] px-8 py-3 rounded-full font-bold shadow-xl transition-transform hover:-translate-y-1">
                        Sewa / Hubungi <span x-text="productName"></span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </template>

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
                this.src = ''; // Stop video playback
                document.body.style.overflow = '';
            }
        }
    }
</script>
@endsection
