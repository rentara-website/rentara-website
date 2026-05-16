@extends('template')

@section('content')
    <div class="px-6 sm:px-8 md:px-10 lg:px-14 pb-16 lg:pb-32">
        {{-- Header Section --}}
        <div class="header z-10 relative mb-12">
            <div class="title-container mt-4 sm:mt-6 lg:mt-8">
                <h1 class="font-extrabold text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-center text-[#0A4088]">Apa yang
                    Kami
                    Tawarkan?</h1>
                <p
                    class="text-lg sm:text-xl md:text-2xl text-center max-w-4xl mx-auto mt-4 sm:mt-6 lg:mt-8 text-gray-600 leading-relaxed">
                    Membuat lebih mudah untuk menemukan dan menyewa gear yang Anda butuhkan, kapan pun Anda membutuhkannya.
                </p>
            </div>

            <form id="search-form" action="{{ url('/products') }}" method="GET" class="mt-10 sm:mt-12 lg:mt-14">
                <div class="relative max-w-2xl mx-auto group">
                    <input type="text" name="search" id="search-input" placeholder="Cari gear, kamera, atau aksesoris..."
                        value="{{ $search ?? '' }}"
                        class="w-full pl-14 pr-12 py-4 rounded-2xl border-2 border-gray-100 focus:border-[#0A4088] focus:ring-0 shadow-lg transition-all duration-300 text-lg"
                        autocomplete="off">
                    <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400"></i>

                    {{-- JS Clear Button --}}
                    <button type="button" id="clear-search"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors {{ !$search ? 'hidden' : '' }}">
                        <i data-lucide="x-circle" class="w-6 h-6"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-10 relative">
            {{-- Filter Sidebar --}}
            <aside class="w-full lg:w-72 shrink-0">
                <div class="lg:sticky lg:top-24 space-y-6 lg:space-y-8 mb-8 lg:mb-20">
                    {{-- Categories --}}
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="layers" class="w-5 h-5 text-[#0A4088]"></i> Kategori
                        </h3>
                        <div class="flex flex-wrap lg:flex-col gap-2">
                            <a href="{{ url('/products') . ($search ? '?search=' . $search : '') }}"
                                data-url="{{ url('/products') . ($search ? '?search=' . $search : '') }}" data-cat-slug=""
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

                    {{-- Tags --}}
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

                    {{-- Reset --}}
                    @if($search || $activeCategory || $activeTag)
                        <div id="reset-container" class="pt-4 border-t border-gray-100">
                            <a href="{{ url('/products') }}" data-url="{{ url('/products') }}"
                                class="filter-link flex items-center justify-center gap-2 w-full py-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors font-semibold">
                                <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Bersihkan Filter
                            </a>
                        </div>
                    @endif
                </div>
            </aside>

            {{-- Product Grid Container for AJAX --}}
            <main id="product-list-container" class="flex-1 transition-opacity duration-300">
                @include('products.partials.grid')
            </main>
        </div>
    </div>
@endsection