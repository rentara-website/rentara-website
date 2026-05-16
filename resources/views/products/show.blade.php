@extends('template')

@section('content')
    <div class="bg-white min-h-screen" x-data="portfolioLightbox()">

        {{-- Product Hero --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-center">

                {{-- Product Image --}}
                <div class="w-full lg:w-1/2 relative group">
                    <div
                        class="absolute inset-0 bg-[#0A4088]/5 rounded-3xl -rotate-2 transform group-hover:rotate-0 transition-transform duration-500">
                    </div>
                    <div
                        class="relative bg-gray-50 rounded-3xl p-8 md:p-12 overflow-hidden shadow-2xl shadow-[#0A4088]/10 border border-gray-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama_produk }}"
                                class="w-full h-auto max-h-125 object-contain transform group-hover:scale-105 transition-transform duration-700">
                        @else
                            <img src="{{ asset('images/Rectangle24.png') }}" alt="{{ $product->nama_produk }}"
                                class="w-full h-auto max-h-125 object-contain transform group-hover:scale-105 transition-transform duration-700">
                        @endif

                        {{-- Category Badge --}}
                        <div class="absolute top-6 left-6">
                            <span
                                class="bg-[#0A4088] text-white text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full shadow-lg">
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
                        <div
                            class="mt-4 flex items-center gap-2 text-sm font-bold text-gray-500 bg-gray-100 w-fit px-4 py-2 rounded-full">
                            <i data-lucide="shopping-bag" class="w-4 h-4 text-[#0A4088]"></i>
                            Telah dipesan {{ $product->orders()->where('status', 'Completed')->count() }} kali
                        </div>
                    </div>

                    {{-- Price & Action --}}
                    <div
                        class="bg-gray-50 rounded-2xl p-6 md:p-8 border border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Harga Rental</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl font-black text-[#0A4088]">Rp
                                    {{ number_format($product->harga, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-400 font-bold uppercase tracking-widest">/ Hari</span>
                            </div>
                        </div>

                        <a href="{{ route('whatsapp.rent') }}?text={{ urlencode('Halo Rentara, saya tertarik untuk menyewa ' . $product->nama_produk) }}"
                            target="_blank"
                            class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white px-10 py-5 rounded-2xl font-bold shadow-xl shadow-green-100 transition-all transform hover:-translate-y-1 active:scale-95">
                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                            Sewa Sekarang
                        </a>
                    </div>

                    {{-- Description --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-900 border-b-2 border-[#0A4088] w-fit pb-1">Tentang Produk
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            {{ $product->deskripsi }}
                        </p>
                    </div>

                    {{-- Tags --}}
                    <div class="pt-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->tags as $tag)
                                <a href="{{ url('/products?tag=' . $tag->slug) }}"
                                    class="px-4 py-2 bg-gray-100 hover:bg-[#0A4088] hover:text-white text-gray-500 rounded-xl font-bold text-xs transition-colors group">
                                    <span class="group-hover:text-white/80">#</span>{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Portfolio Section (If Photographer/Videographer) --}}
        <div class="bg-gray-50 py-20 md:py-32 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

                <h2 class="text-3xl md:text-4xl font-black text-[#0A4088] mb-4">Portofolio Kami</h2>
                <p class="text-gray-500 max-w-xl mx-auto mb-8">
                    Lihat hasil karya otentik yang dihasilkan oleh tim profesional kami.
                </p>

                @if($product->link_portofolio)
                    <a href="{{ $product->link_portofolio }}" target="_blank"
                        class="inline-flex items-center justify-center gap-3 bg-[#0A4088] hover:bg-[#08306b] text-white px-10 py-5 rounded-2xl font-bold shadow-xl shadow-[#0A4088]/20 transition-all transform hover:-translate-y-1 active:scale-95">
                        <i data-lucide="external-link" class="w-6 h-6"></i>
                        Buka Link Portofolio
                    </a>
                @else
                    <div class="py-12 bg-white rounded-3xl border border-dashed border-gray-200">
                        <i data-lucide="link-2-off" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                        <h2 class="text-xl font-bold text-gray-700">Belum ada portofolio</h2>
                    </div>
                @endif

            </div>
        </div>

        {{-- Breadcrumbs / Back Navigation --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <a href="{{ url('/products') }}"
                class="inline-flex items-center gap-2 px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-2xl transition-all">
                <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali ke Produk
            </a>
        </div>
    </div>
@endsection