@extends('template')

@section('content')
<div class="bg-gray-50 min-h-screen">

    {{-- Header Section --}}
    <section class="bg-[#0A4088] border-b border-white">
        <div class="px-6 sm:px-8 md:px-10 lg:px-14 py-20 lg:py-28">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h1 class="font-extrabold text-4xl sm:text-5xl lg:text-6xl leading-tight">
                    Apa yang Kami Tawarkan?
                </h1>

                <p class="text-base sm:text-lg md:text-xl mt-6 text-white/90 leading-relaxed max-w-3xl mx-auto">
                    Membuat lebih mudah untuk menemukan dan menyewa gear yang Anda butuhkan, kapan pun Anda membutuhkannya.
                </p>

                <form id="search-form" action="{{ url('/products') }}" method="GET" class="mt-10">
                    <div class="relative max-w-2xl mx-auto group">
                        <input type="text" name="search" id="search-input"
                            placeholder="Cari gear, kamera, atau aksesoris..."
                            value="{{ $search ?? '' }}"
                            class="w-full pl-14 pr-12 py-4 rounded-2xl border-0 focus:ring-4 focus:ring-white/20 shadow-xl text-gray-900 text-lg bg-white/90 backdrop-blur-sm focus:outline-none transition"
                            autocomplete="off">

                        <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400"></i>

                        <button type="button" id="clear-search"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors {{ !$search ? 'hidden' : '' }}">
                            <i data-lucide="x-circle" class="w-6 h-6"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <div class="px-6 sm:px-8 md:px-10 lg:px-14 py-10 lg:py-14">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-10 relative">

            {{-- Filter Sidebar --}}
            <aside class="w-full lg:w-72 shrink-0">
                <div class="lg:sticky lg:top-24 space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="layers" class="w-5 h-5 text-[#0A4088]"></i> Kategori
                        </h3>

                        <div class="flex flex-wrap lg:flex-col gap-2">
                            <a href="{{ url('/products') . ($search ? '?search=' . $search : '') }}"
                                data-url="{{ url('/products') . ($search ? '?search=' . $search : '') }}"
                                data-cat-slug=""
                                class="filter-link cat-link px-4 py-2.5 rounded-xl border bg-white text-gray-600 border-gray-200 hover:border-[#0A4088] hover:text-[#0A4088] transition-all duration-300 {{ !$activeCategory ? 'filter-active' : '' }}">
                                Semua Kategori
                            </a>

                            @foreach($categories as $category)
                                <a href="{{ url('/products?category=' . $category->slug . ($search ? '&search=' . $search : '') . ($activeTag ? '&tag=' . $activeTag : '')) }}"
                                    data-url="{{ url('/products?category=' . $category->slug . ($search ? '&search=' . $search : '') . ($activeTag ? '&tag=' . $activeTag : '')) }}"
                                    data-cat-slug="{{ $category->slug }}"
                                    class="filter-link cat-link px-4 py-2.5 rounded-xl border bg-white text-gray-600 border-gray-200 hover:border-[#0A4088] hover:text-[#0A4088] transition-all duration-300 {{ $activeCategory == $category->slug ? 'filter-active' : '' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="tag" class="w-5 h-5 text-[#0A4088]"></i> Tag Populer
                        </h3>

                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                                <a href="{{ url('/products?tag=' . $tag->slug . ($search ? '&search=' . $search : '') . ($activeCategory ? '&category=' . $activeCategory : '')) }}"
                                    data-url="{{ url('/products?tag=' . $tag->slug . ($search ? '&search=' . $search : '') . ($activeCategory ? '&category=' . $activeCategory : '')) }}"
                                    data-tag-slug="{{ $tag->slug }}"
                                    class="filter-link tag-link px-3 py-1.5 rounded-lg text-sm border bg-[#0A4088]/5 text-[#0A4088] border-transparent hover:bg-[#0A4088]/10 transition-all duration-300 {{ $activeTag == $tag->slug ? 'filter-active' : '' }}">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @if($search || $activeCategory || $activeTag)
                        <div class="pt-4 border-t border-gray-200">
                            <a href="{{ url('/products') }}" data-url="{{ url('/products') }}"
                                class="filter-link flex items-center justify-center gap-2 w-full py-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors font-semibold">
                                <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Bersihkan Filter
                            </a>
                        </div>
                    @endif
                </div>
            </aside>

            {{-- Product Grid --}}
            <main id="product-list-container" class="flex-1 transition-opacity duration-300">
                @include('products.partials.grid')
            </main>
        </div>
    </div>
</div>
@endsection