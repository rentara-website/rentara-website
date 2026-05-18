
@extends('template')

@section('content')
<div class="hero-section-container mt-4 sm:mt-24 lg:mt-8 flex flex-col lg:flex-row items-center justify-between gap-4 sm:gap-6 lg:gap-8 px-4 sm:px-6 md:px-8 lg:px-10 py-8 sm:py-10 lg:py-14">
    <div class="hero-section-left w-full lg:w-1/2 flex flex-col justify-center">
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold leading-tight">
            Platform Satu Hanya untuk Kamera, Gear Konten, dan Pembuat Konten di Bali
        </h1>
        <p class="mt-3 sm:mt-4 text-base sm:text-lg md:text-xl text-gray-500 leading-relaxed">
            Sewa kamera, gear konten, dan pesan fotografer atau videografer di Bali — semuanya di satu tempat. 📸🎥
        </p>
        <a href="/products"
            class="bg-[#0A4088] hover:bg-[#032d63] text-white font-bold py-2 px-4 sm:px-5 rounded-full mt-5 sm:mt-6 inline-flex items-center gap-2 transition duration-300 hover:cursor-pointer w-fit text-sm sm:text-base">
            Jelajahi Kategori
            <i data-lucide="arrow-right" class="w-4 h-4 text-white"></i>
        </a>
    </div>

    <div class="hero-section-right w-full lg:w-1/2 flex justify-center">
        <img src="/images/191981921.png" alt="Rentara Platform"
            class="w-full max-w-xs sm:max-w-sm lg:max-w-md xl:max-w-xl h-auto object-contain">
    </div>
</div>

<div class="about-us-container bg-[#0A4088] mt-8 lg:mt-10 flex items-center justify-center">
    <div class="about-us-wrapper px-4 sm:px-6 md:px-8 lg:px-10 py-8 sm:py-10 lg:py-14 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 w-full max-w-7xl">
        <div class="about-us-left flex justify-center md:justify-start">
            <img src="/images/Sandy_Gen-04_Single-081.png" alt="about us image"
                class="w-full max-w-xs sm:max-w-sm md:max-w-md h-auto object-contain">
        </div>
        <div class="about-us-right flex flex-col justify-center">
            <h1 class="text-white text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">
                Semua Kebutuhan Rental Berada di Satu Tempat
            </h1>
            <p class="text-gray-200 text-base sm:text-lg md:text-xl mt-3 sm:mt-4 leading-relaxed font-poppins">
                Rentara adalah platform Bali untuk menyewa kamera dan gear konten, serta terhubung dengan fotografer dan videografer profesional.
            </p>

            <p class="text-white text-base sm:text-lg md:text-xl underline mt-5 sm:mt-6 cursor-pointer hover:text-gray-200 transition">
                Semua opsi rental di satu platform
            </p>
        </div>
    </div>
</div>

<div class="popular-product-container mt-8 lg:mt-10">
    <div class="popular-product-wrapper px-4 sm:px-6 md:px-8 lg:px-10 py-8 sm:py-10 lg:py-14">
        <div class="text-center mb-6 sm:mb-8 lg:mb-10">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-black">
                Rental Terpopuler di Rentara
            </h1>
            <p class="text-gray-500 text-sm sm:text-base mt-3 max-w-2xl mx-auto">
                Temukan kamera, gear, dan rental terpopuler di Bali yang paling banyak dipesan oleh pelanggan Rentara.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @foreach($popularProducts as $product)
                <a href="/products/?category={{ $product->slug }}" class="group block h-full">
                    <div class="relative flex flex-col h-full bg-[#0A4088] rounded-2xl p-5 sm:p-6 overflow-hidden transition-all duration-300 group-hover:bg-[#EDEFEF] group-hover:shadow-xl group-hover:-translate-y-1">
                        <div class="w-10 h-10 rounded-xl bg-white/20 group-hover:bg-[#0A4088]/10 flex items-center justify-center mb-4 transition-colors duration-300">
                            <i data-lucide="camera" class="w-5 h-5 text-white group-hover:text-[#0A4088] transition-colors duration-300"></i>
                        </div>

                        <div class="flex-1">
                            <h2 class="text-lg sm:text-xl font-bold text-white group-hover:text-black transition-colors duration-300">
                                {{ $product->name }}
                            </h2>
                            <p class="text-white/80 group-hover:text-gray-600 text-sm mt-2 leading-relaxed transition-colors duration-300">
                                {{ $product->description }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2 mt-4 text-white group-hover:text-[#0A4088] font-semibold text-sm transition-colors duration-300">
                            Jelajahi Lebih Lanjut
                            <span class="w-6 h-6 rounded-full bg-white/20 group-hover:bg-[#0A4088] group-hover:text-white flex items-center justify-center transition-all duration-300">
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="why-rentara-container bg-gray-50">
    <div class="why-rentara-wrapper px-4 sm:px-6 md:px-8 lg:px-10 py-8 sm:py-10 lg:py-14 max-w-7xl mx-auto">
        <div class="mb-6 sm:mb-8 lg:mb-10 flex flex-col md:flex-row md:items-end md:justify-center gap-4">
            <div>
                <h1 class="text-center text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-black leading-tight">
                    Mengapa Sewa di Rentara?
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 auto-rows-auto gap-4">
            <div class="relative rounded-3xl overflow-hidden bg-[#0A4088] p-6 sm:p-7 flex flex-col justify-between lg:row-span-2 min-h-60 lg:min-h-96 group hover:shadow-2xl transition-all duration-300">
                <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full bg-white/5 group-hover:scale-150 transition-all duration-500"></div>
                <div class="absolute -bottom-6 -left-6 w-28 h-28 rounded-full bg-white/5 group-hover:scale-125 transition-all duration-500"></div>

                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center mb-4">
                        <i data-lucide="shield-check" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-white/40 text-6xl font-black leading-none select-none">#1</span>
                </div>

                <div class="relative z-10 mt-auto">
                    <h2 class="text-xl sm:text-2xl font-bold text-white mb-2">Verified Partners</h2>
                    <p class="text-white/70 text-sm leading-relaxed">
                        Setiap penyedia sewa di Rentara telah dilewati proses screening dan verifikasi — jadi Anda dapat memesan dengan percaya, setiap kali.
                    </p>
                </div>
            </div>

            <div class="relative rounded-3xl overflow-hidden bg-white border border-gray-100 p-5 sm:p-6 flex flex-col justify-between min-h-48 group hover:shadow-xl hover:border-[#0A4088]/20 transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full bg-[#0A4088]/5 group-hover:bg-[#0A4088]/10 transition-all duration-300"></div>

                <div class="flex items-start justify-between">
                    <div class="w-10 h-10 rounded-xl bg-[#0A4088]/10 flex items-center justify-center">
                        <i data-lucide="dollar-sign" class="w-5 h-5 text-[#0A4088]"></i>
                    </div>
                    <span class="text-5xl font-black leading-none select-none" style="color: transparent; -webkit-text-stroke: 2px #E5E7EB;">#2</span>
                </div>

                <div class="mt-3">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">Mudah Membandingkan harga</h2>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Bandingkan fotografer, videografer, dan peralatan konten dari beberapa penyedia — semuanya di satu tempat.
                    </p>
                </div>
            </div>

            <div class="relative rounded-3xl overflow-hidden bg-white border border-gray-100 p-5 sm:p-6 flex flex-col justify-between min-h-48 group hover:shadow-xl hover:border-[#0A4088]/20 transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full bg-green-50 group-hover:bg-green-100 transition-all duration-300"></div>

                <div class="flex items-start justify-between">
                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                        <i data-lucide="message-circle" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <span class="text-5xl font-black leading-none select-none z-10" style="color: transparent; -webkit-text-stroke: 2px #BBF7D0;">#3</span>
                </div>

                <div class="mt-3">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">Cepat Booking melalui WhatsApp</h2>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Hubungkan dengan penyedia sewa secara instan melalui WhatsApp dan konfirmasi pemesanan Anda dalam hitungan menit.
                    </p>
                </div>
            </div>

            <div class="relative rounded-3xl overflow-hidden bg-[#0A4088]/5 border border-[#0A4088]/10 p-5 sm:p-6 lg:p-7 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-5 lg:gap-6 sm:col-span-2 lg:col-span-2 min-h-36 sm:min-h-40 lg:min-h-44 group hover:shadow-xl hover:bg-[#0A4088]/10 transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full bg-[#0A4088]/10 group-hover:bg-[#0A4088]/20 transition-all duration-300 z-0">
                    <span class="absolute top-3 right-3 text-3xl sm:text-4xl font-black select-none z-10 text-[#0A4088]/40 leading-none">
                        #4
                    </span>
                </div>

                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-[#0A4088] flex items-center justify-center group-hover:scale-110 transition-transform duration-300 relative z-10">
                    <i data-lucide="layers" class="w-5 h-5 sm:w-6 sm:h-6 text-white"></i>
                </div>

                <div class="flex-1 space-y-2 relative z-10">
                    <h2 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 leading-tight">
                        Wide Rental Selection
                    </h2>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Dari kamera dan tripods ke peralatan konten lainnya — akses berbagai macam peralatan dan kendaraan dari mitra lokal Bali terpercaya, semuanya di satu platform.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="need-to-know bg-gray-50 py-8 sm:py-10 lg:py-14">
    <div class="need-to-know-wrapper px-4 sm:px-6 md:px-8 lg:px-10 max-w-6xl mx-auto">
        <div class="mb-6 sm:mb-8 lg:mb-10">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-black mb-3">Sering Ditanyakan</h1>
            <p class="text-gray-500 text-sm sm:text-base md:text-lg leading-relaxed">Temukan jawaban dari pertanyaan yang sering diajukan kepada kami.</p>
        </div>

        <div x-data="{ open: null }" class="space-y-3">

                <!-- Item 1 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                <button @click="open = open === 1 ? null : 1"
                    class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                    Bagaimana cara memesan sewa melalui Rentara?
                    <i data-lucide="chevron-down" x-bind:class="open === 1 ? 'rotate-180' : ''"
                        class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 shrink-0 ml-2"></i>
                </button>
                <div x-show="open === 1" x-transition
                    class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                    Anda dapat menelusuri fotografer, videografer, dan peralatan konten yang tersedia di Rentara dan memilih item yang Anda inginkan. Ketika Anda mengklik
                    “Book” atau “Contact,” Anda akan terhubung langsung ke penyedia sewa melalui WhatsApp untuk mengonfirmasi
                    ketersediaan, tanggal, dan detail. Setelah dikonfirmasi, Anda dapat melanjutkan dengan arrangement penyewaan.
                </div>
            </div>

            <!-- Item 2 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                <button @click="open = open === 2 ? null : 2"
                    class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                    Bagaimana kebijakan pemesanan untuk fotografer dan videografer di Rentara?
                    <i data-lucide="chevron-down" x-bind:class="open === 2 ? 'rotate-180' : ''"
                        class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 shrink-0 ml-2"></i>
                </button>
                <div x-show="open === 2" x-transition
                    class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                    Kebijakan pemesanan untuk fotografer dan videografer dapat bervariasi tergantung pada penyedia sewa. Kami menyarankan untuk menghubungi penyedia secara langsung melalui WhatsApp untuk mendiskusikan detail pemesanan, termasuk ketersediaan, harga, dan persyaratan lainnya sebelum mengonfirmasi pemesanan Anda.
                </div>
            </div>

            <!-- Item 3 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                <button @click="open = open === 3 ? null : 3"
                    class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                    Apakah penyedia sewa di Rentara telah diverifikasi?
                    <i data-lucide="chevron-down" x-bind:class="open === 3 ? 'rotate-180' : ''"
                        class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 shrink-0 ml-2"></i>
                </button>
                <div x-show="open === 3" x-transition
                    class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                    Ya, semua penyedia sewa di Rentara telah melewati proses screening dan verifikasi yang ketat untuk memastikan keandalan dan kualitas layanan mereka. Kami berkomitmen untuk memberikan pengalaman penyewaan yang aman dan terpercaya bagi pelanggan kami.
                </div>
            </div>

            <!-- Item 4 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                <button @click="open = open === 4 ? null : 4"
                    class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                    Bagaimana cara pembayaran di Rentara?
                    <i data-lucide="chevron-down" x-bind:class="open === 4 ? 'rotate-180' : ''"
                        class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 shrink-0 ml-2"></i>
                </button>
                <div x-show="open === 4" x-transition
                    class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                    Metode pembayaran bervariasi tergantung pada penyedia sewa. Opsi umum meliputi transfer bank, e-wallet (GCash, GoPay, OVO), dan pembayaran tunai saat pengambilan. Konfirmasikan metode pembayaran yang diinginkan saat menghubungi penyedia melalui WhatsApp.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-latest-listing-container py-8 sm:py-10 lg:py-14">
    <div class="our-latest-listing-wrapper px-4 sm:px-6 md:px-8 lg:px-10 max-w-7xl mx-auto">
        <div class="mb-6 sm:mb-8 lg:mb-10">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-black mb-3">
                Listing Produk Terbaru
            </h1>
            <p class="text-gray-500 text-sm sm:text-base md:text-lg leading-relaxed">
                Temukan kamera, gear, dan rental terbaru di Rentara.
            </p>
        </div>

        {{-- LATEST PRODUCTS (section) --}}
        <div class="mb-12">
            @if ($productLatest->isEmpty())
                <div class="bg-gray-50 border border-gray-100 rounded-3xl p-8 text-center">
                    <i data-lucide="package" class="w-10 h-10 text-gray-300 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-sm font-medium">Tidak ada produk yang tersedia saat ini.</p>
                    <p class="text-gray-400 text-xs mt-1">Produk akan muncul di sini setelah ditambahkan ke sistem.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach ($productLatest as $product)
                        <div class="group relative bg-white rounded-3xl border border-gray-100 p-4 h-full flex flex-col transition-all duration-500 hover:shadow-[0_20px_50px_rgba(8,112,184,0.1)] hover:-translate-y-2">
                            <div class="relative overflow-hidden rounded-2xl aspect-4/3 mb-4 shrink-0">
                                @if($product->image)
                                    <img src="{{ Cloudinary::url($product->image) }}" alt="{{ $product->nama_produk }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <img src="{{ asset('images/Rectangle24.png') }}" alt="{{ $product->nama_produk }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @endif

                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-sm text-[#0A4088] text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-sm">
                                        {{ $product->category->name ?? '' }}
                                    </span>
                                </div>

                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('whatsapp.rent', ['product' => $product->slug]) }}?text=Rental {{ urlencode($product->nama_produk) }} dari Rentara"
                                       target="_blank"
                                       class="bg-white text-[#0A4088] px-5 py-2 rounded-full font-bold transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 text-sm">
                                        Sewa Sekarang
                                    </a>
                                </div>
                            </div>

                            <div class="px-2 flex flex-col flex-1">
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-[#0A4088] transition-colors line-clamp-1 mb-2">
                                        {{ $product->nama_produk }}
                                    </h3>

                                    <p class="text-gray-500 text-sm line-clamp-2 mb-3">
                                        {{ \Illuminate\Support\Str::limit($product->deskripsi, 120, '...') }}
                                    </p>

                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach ($product->tags as $tag)
                                            <a href="{{ url('/products?tag=' . $tag->slug) }}"
                                               class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-md hover:bg-gray-100 hover:text-[#0A4088] transition-colors filter-link"
                                               data-url="{{ url('/products?tag=' . $tag->slug) }}"
                                               data-tag-slug="{{ $tag->slug }}">
                                                #{{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">
                                            Harga Mulai dari
                                        </p>
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-lg font-black text-[#0A4088] animate-pulse">
                                                Rp{{ number_format($product->harga, 0, ',', '.') }}
                                            </span>
                                            <span class="text-xs text-gray-400 font-medium">/hari</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('products.show', $product->slug) }}"
                                       class="shrink-0 px-4 py-2 bg-[#0A4088]/5 text-[#0A4088] text-xs font-bold rounded-lg hover:bg-[#0A4088] hover:text-white transition-all duration-300">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection