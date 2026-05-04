@if($groupedProducts->isEmpty())
    <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-100">
        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="package-search" class="w-10 h-10 text-gray-300"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">No products found</h2>
        <p class="text-gray-500 mt-2">Try adjusting your filters or search terms.</p>
        <a href="{{ url('/products') }}" class="mt-6 inline-block text-[#0A4088] font-bold underline filter-link"
            data-url="{{ url('/products') }}">Clear all filters</a>
    </div>
@else
    @foreach ($groupedProducts as $categoryName => $categoryProducts)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-extrabold text-[#0A4088] flex items-center gap-3">
                    <span class="w-2 h-8 bg-[#0A4088] rounded-full"></span>
                    {{ $categoryName }}
                    <span class="text-sm font-normal text-gray-400">({{ count($categoryProducts) }} items)</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($categoryProducts as $product)
                    <div
                        class="group relative bg-white rounded-3xl border border-gray-100 p-4 transition-all duration-500 hover:shadow-[0_20px_50px_rgba(8,112,184,0.1)] hover:-translate-y-2">
                        {{-- Image Container --}}
                        <div class="relative overflow-hidden rounded-2xl aspect-4/3 mb-5">
                            <img src="{{ Str::startsWith($product->image_product->first()->image_path, 'http') ? $product->image_product->first()->image_path : asset('storage/' . $product->image_product->first()->image_path) }}" alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                            {{-- Category Badge --}}
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-[#0A4088] text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-sm">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            {{-- Hover Quick Action --}}
                            <div
                                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="https://wa.me/6281938092473?text=Halooo Saya tertarik menyewa {{ $product->nama_produk }} dari websitemu. Tolong berikan saya detail barangnya?"
                                    target="_blank"
                                    class="bg-white text-[#0A4088] px-6 py-2.5 rounded-full font-bold transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                    Rent Now
                                </a>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="px-2">
                            <h3
                                class="text-xl font-bold text-gray-900 group-hover:text-[#0A4088] transition-colors line-clamp-1 mb-2">
                                {{ $product->nama_produk }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2 mb-4 h-10">
                                {{ $product->deskripsi }}
                            </p>

                            {{-- Tags --}}
                            <div class="flex flex-wrap gap-1.5 mb-5">
                                @foreach ($product->tags as $tag)
                                    <a href="{{ url('/products?tag=' . $tag->slug) }}"
                                        class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-md hover:bg-gray-100 hover:text-[#0A4088] transition-colors filter-link"
                                        data-url="{{ url('/products?tag=' . $tag->slug) }}"
                                        data-tag-slug="{{ $tag->slug }}">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>

                            {{-- Footer --}}
                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Starting from</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-xl font-black text-[#0A4088] animate-pulse">Rp
                                            {{ number_format($product->harga, 0, ',', '.') }}</span>
                                        <span class="text-xs text-gray-400 font-medium">/day</span>
                                    </div>
                                </div>
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="px-4 py-2 bg-[#0A4088]/5 text-[#0A4088] text-xs font-bold rounded-lg hover:bg-[#0A4088] hover:text-white transition-all duration-300">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endif