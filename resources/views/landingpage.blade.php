@extends('template')

@section('content')
    <div
        class="hero-section-container mt-6 sm:mt-8 lg:mt-10 flex flex-col lg:flex-row items-center justify-between gap-6 sm:gap-8 lg:gap-10 px-6 sm:px-8 md:px-10 lg:px-14 py-10 sm:py-14 lg:py-20">
        <div class="hero-section-left w-full lg:w-1/2 flex flex-col justify-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">One-Stop Platform for Cameras,
                Content Gear & Creators in Bali</h1>
            <p class="mt-4 sm:mt-5 text-lg sm:text-xl md:text-2xl text-gray-500 leading-relaxed">
                Rent cameras, content gear, and book photographers or videographers in Bali — all in one place. 📸🎥
            </p>
            <button type="button"
                class="bg-[#0A4088] hover:bg-[#032d63] text-white font-bold py-2 sm:py-3 px-4 sm:px-6 rounded-full mt-6 sm:mt-8 inline-flex items-center gap-2 transition duration-300 hover:cursor-pointer w-fit">
                Explore Categories
                <i data-lucide="arrow-right" class="w-4 h-4 text-white"></i>
            </button>
        </div>

        <div class="hero-section-right w-full lg:w-1/2 flex justify-center">
            <img src="/images/191981921.png" alt="Rentara Platform"
                class="w-full max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-2xl h-auto object-contain">
        </div>

    </div>

    <div class="about-us-container bg-[#0A4088] mt-10 lg:mt-14 flex items-center justify-center">
        <div
            class="about-us-wrapper px-6 sm:px-8 md:px-10 lg:px-14 py-10 sm:py-14 lg:py-20 grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10 w-full max-w-7xl">
            <div class="about-us-left flex justify-center md:justify-start">
                <img src="/images/Sandy_Gen-04_Single-081.png" alt="about us image"
                    class="w-full max-w-xs sm:max-w-sm md:max-w-md h-auto object-contain">
            </div>
            <div class="about-us-right flex flex-col justify-center">
                <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">All Your Bali Rental Needs
                    in One Place</h1>
                <p class="text-gray-200 text-lg sm:text-xl md:text-2xl mt-4 sm:mt-6 leading-relaxed font-poppins">
                    Rentara is a Bali platform to rent cameras and content gear, and connect with professional photographers
                    and videographers.
                </p>

                <p
                    class="text-white text-lg sm:text-xl md:text-2xl underline mt-6 sm:mt-8 cursor-pointer hover:text-gray-200 transition">
                    All rental options in one platform?</p>
            </div>
        </div>
    </div>

    <div class="popular-product-container mt-10 lg:mt-14">
        <div class="popular-product-wrapper px-6 sm:px-8 md:px-10 lg:px-14 py-10 sm:py-14 lg:py-20">

            <div class="text-center mb-8 sm:mb-10 lg:mb-14">
                <span
                    class="inline-block bg-[#0A4088]/10 text-[#0A4088] text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    Most Popular
                </span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-black">
                    The Most Popular Rentals in Rentara
                </h1>
                <p class="text-gray-500 text-base sm:text-lg mt-3 sm:mt-4 max-w-2xl mx-auto">
                    Browse our top-rated services and find the perfect match for your Bali adventure.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">

                {{-- Card 1: Photographer --}}
                <a href="#" class="group block h-full">
                    <div
                        class="relative flex flex-col h-full bg-[#0A4088] rounded-2xl p-7 sm:p-8 overflow-hidden transition-all duration-300 group-hover:bg-[#EDEFEF] group-hover:shadow-xl group-hover:-translate-y-1">

                        {{-- Icon Badge --}}
                        <div
                            class="w-12 h-12 rounded-xl bg-white/20 group-hover:bg-[#0A4088]/10 flex items-center justify-center mb-6 transition-colors duration-300">
                            <i data-lucide="camera"
                                class="w-6 h-6 text-white group-hover:text-[#0A4088] transition-colors duration-300"></i>
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <h2
                                class="text-xl sm:text-2xl font-bold text-white group-hover:text-black transition-colors duration-300">
                                Photographer
                            </h2>
                            <p
                                class="text-white/80 group-hover:text-gray-600 text-sm sm:text-base mt-3 leading-relaxed transition-colors duration-300">
                                Discover professional photographers in Bali to capture your moments and create
                                high-quality content with ease.
                            </p>
                        </div>

                        {{-- Footer --}}
                        <div
                            class="flex items-center gap-2 mt-6 text-white group-hover:text-[#0A4088] font-semibold text-sm transition-colors duration-300">
                            Explore More
                            <span
                                class="w-7 h-7 rounded-full bg-white/20 group-hover:bg-[#0A4088] group-hover:text-white flex items-center justify-center transition-all duration-300">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Card 2: Videographer --}}
                <a href="#" class="group block h-full">
                    <div
                        class="relative flex flex-col h-full bg-[#0A4088] rounded-2xl p-7 sm:p-8 overflow-hidden transition-all duration-300 group-hover:bg-[#EDEFEF] group-hover:shadow-xl group-hover:-translate-y-1">

                        {{-- Icon Badge --}}
                        <div
                            class="w-12 h-12 rounded-xl bg-white/20 group-hover:bg-[#0A4088]/10 flex items-center justify-center mb-6 transition-colors duration-300">
                            <i data-lucide="video"
                                class="w-6 h-6 text-white group-hover:text-[#0A4088] transition-colors duration-300"></i>
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <h2
                                class="text-xl sm:text-2xl font-bold text-white group-hover:text-black transition-colors duration-300">
                                Videographer
                            </h2>
                            <p
                                class="text-white/80 group-hover:text-gray-600 text-sm sm:text-base mt-3 leading-relaxed transition-colors duration-300">
                                Hire skilled videographers in Bali to create cinematic videos that bring your
                                story to life.
                            </p>
                        </div>

                        {{-- Footer --}}
                        <div
                            class="flex items-center gap-2 mt-6 text-white group-hover:text-[#0A4088] font-semibold text-sm transition-colors duration-300">
                            Explore More
                            <span
                                class="w-7 h-7 rounded-full bg-white/20 group-hover:bg-[#0A4088] group-hover:text-white flex items-center justify-center transition-all duration-300">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Card 3: Content Equipment --}}
                <a href="#" class="group block h-full sm:col-span-2 lg:col-span-1">
                    <div
                        class="relative flex flex-col h-full bg-[#0A4088] rounded-2xl p-7 sm:p-8 overflow-hidden transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1 group-hover:bg-motorbike bg-cover bg-center">

                        {{-- Dark overlay on hover --}}
                        <div
                            class="absolute inset-0 rounded-2xl bg-black/0 group-hover:bg-[#EDEFEF] transition-all duration-300">
                        </div>

                        {{-- Icon Badge --}}
                        <div
                            class="relative z-10 w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-6 group-hover:bg-[#0A4088]/10">
                            <i data-lucide="package" class="w-6 h-6 text-white group-hover:text-[#0A4088]"></i>
                        </div>

                        {{-- Content --}}
                        <div class="relative z-10 flex-1">
                            <h2 class="text-xl sm:text-2xl font-bold text-white group-hover:text-black">
                                Content Equipment
                            </h2>
                            <p class="text-white/80 group-hover:text-gray-600 text-sm sm:text-base mt-3 leading-relaxed">
                                Rent tripods, lighting kits, and accessories from trusted local rental partners
                                for your production needs.
                            </p>
                        </div>

                        {{-- Footer --}}
                        <div
                            class="relative z-10 flex items-center gap-2 mt-6 text-white font-semibold text-sm group-hover:text-[#0A4088]">
                            Explore More
                            <span
                                class="text-white w-7 h-7 rounded-full bg-white/20 group-hover:bg-[#0A4088] flex items-center justify-center transition-all duration-300">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </span>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <div class="why-rentara-container bg-gray-50">
        <div class="why-rentara-wrapper px-6 sm:px-8 md:px-10 lg:px-14 py-10 sm:py-14 lg:py-20 max-w-7xl mx-auto">

            {{-- Header --}}
            <div class="mb-8 sm:mb-12 lg:mb-16 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span
                        class="inline-block bg-[#0A4088]/10 text-[#0A4088] text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                        Why Us
                    </span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-black leading-tight">
                        Why Rent<br>with Rentara?
                    </h1>
                </div>
                <p class="text-gray-500 text-base sm:text-lg leading-relaxed max-w-sm md:text-right">
                    Simple, safe, and trusted — your all-in-one Bali rental platform.
                </p>
            </div>

            {{-- Bento Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 auto-rows-auto gap-5">

                {{-- ITEM 1 — LARGE (spans 2 rows on lg) — Verified Partners --}}
                <div
                    class="relative rounded-3xl overflow-hidden bg-[#0A4088] p-8 sm:p-10 flex flex-col justify-between lg:row-span-2 min-h-[280px] lg:min-h-[480px] group hover:shadow-2xl transition-all duration-300">
                    {{-- Decorative circle --}}
                    <div
                        class="absolute -top-10 -right-10 w-48 h-48 rounded-full bg-white/5 group-hover:scale-150 transition-all duration-500">
                    </div>
                    <div
                        class="absolute -bottom-6 -left-6 w-32 h-32 rounded-full bg-white/5 group-hover:scale-125 transition-all duration-500">
                    </div>

                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center mb-6">
                            <i data-lucide="shield-check" class="w-7 h-7 text-white"></i>
                        </div>
                        <span class="text-white/40 text-8xl font-black leading-none select-none">#1</span>
                    </div>

                    <div class="relative z-10 mt-auto">
                        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3">Verified Rental Partners</h2>
                        <p class="text-white/70 text-sm sm:text-base leading-relaxed">
                            Every rental provider on Rentara is screened and verified — so you can book with confidence,
                            every time.
                        </p>
                    </div>
                </div>

                {{-- ITEM 2 — Easy Price Comparison --}}
                <div
                    class="relative rounded-3xl overflow-hidden bg-white border border-gray-100 p-7 sm:p-8 flex flex-col justify-between min-h-[220px] group hover:shadow-xl hover:border-[#0A4088]/20 transition-all duration-300">
                    <div
                        class="absolute top-0 right-0 w-28 h-28 rounded-bl-full bg-[#0A4088]/5 group-hover:bg-[#0A4088]/10 transition-all duration-300">
                    </div>

                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-xl bg-[#0A4088]/10 flex items-center justify-center">
                            <i data-lucide="dollar-sign" class="w-6 h-6 text-[#0A4088]"></i>
                        </div>
                        <span class="text-6xl font-black leading-none select-none"
                            style="color: transparent; -webkit-text-stroke: 2px #E5E7EB;">#2</span>
                    </div>

                    <div class="mt-4">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Easy Price Comparison</h2>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Compare cameras, gear, and vehicles from multiple providers — all in one place.
                        </p>
                    </div>
                </div>

                {{-- ITEM 3 — Fast WhatsApp Booking --}}
                <div
                    class="relative rounded-3xl overflow-hidden bg-white border border-gray-100 p-7 sm:p-8 flex flex-col justify-between min-h-[220px] group hover:shadow-xl hover:border-[#0A4088]/20 transition-all duration-300">
                    <div
                        class="absolute top-0 right-0 w-28 h-28 rounded-bl-full bg-green-50 group-hover:bg-green-100 transition-all duration-300">
                    </div>

                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <i data-lucide="message-circle" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <span class="text-6xl font-black leading-none select-none z-10"
                            style="color: transparent; -webkit-text-stroke: 2px #BBF7D0;">#3</span>
                    </div>

                    <div class="mt-4">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Fast WhatsApp Booking</h2>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Connect with rental providers instantly via WhatsApp and confirm your booking in minutes.
                        </p>
                    </div>
                </div>

                {{-- ITEM 4 — Wide Rental Selection (spans 2 cols on sm+) --}}
                <div
                    class="relative rounded-3xl overflow-hidden bg-[#0A4088]/5 border border-[#0A4088]/10 p-7 sm:p-8 flex flex-col sm:flex-row lg:flex-row items-center gap-6 sm:col-span-2 lg:col-span-2 min-h-[180px] group hover:shadow-xl hover:bg-[#0A4088]/10 transition-all duration-300">
                    <div
                        class="flex-shrink-0 w-16 h-16 rounded-2xl bg-[#0A4088] flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="layers" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Wide Rental Selection</h2>
                            <span class="text-4xl font-black leading-none select-none"
                                style="color: transparent; -webkit-text-stroke: 2px rgba(10, 64, 136, 0.2);">#4</span>
                        </div>
                        <p class="text-gray-500 text-sm sm:text-base leading-relaxed">
                            From cameras and tripods to motorbikes — access a wide variety of gear and vehicles from trusted
                            local Bali partners, all in one platform.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="need-to-know bg-gray-50 py-10 sm:py-14 lg:py-20">
        <div class="need-to-know-wrapper px-6 sm:px-8 md:px-10 lg:px-14 max-w-6xl mx-auto">
            <div class="mb-8 sm:mb-10 lg:mb-12">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-black mb-3 sm:mb-4 lg:mb-6">Need
                    to Know</h1>
                <p class="text-gray-500 text-base sm:text-lg md:text-xl leading-relaxed">Find answers to common questions
                    about renting with Rentara.</p>
            </div>

            <div x-data="{ open: null }" class="space-y-3">

                <!-- Item 1 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button @click="open = open === 1 ? null : 1"
                        class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                        How do I book a rental through Rentara?
                        <i data-lucide="chevron-down" x-bind:class="open === 1 ? 'rotate-180' : ''"
                            class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 flex-shrink-0 ml-2"></i>
                    </button>
                    <div x-show="open === 1" x-transition
                        class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                        You can browse available cameras or vehicles on Rentara and select the item you want. When you click
                        “Book” or “Contact,” you will be connected directly to the rental provider via WhatsApp to confirm
                        availability, dates, and details. Once confirmed, you can proceed with the rental arrangement.
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button @click="open = open === 2 ? null : 2"
                        class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                        How do I book a Photographer/Videographer?
                        <i data-lucide="chevron-down" x-bind:class="open === 2 ? 'rotate-180' : ''"
                            class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 flex-shrink-0 ml-2"></i>
                    </button>
                    <div x-show="open === 2" x-transition
                        class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                        Cancellation policies are determined by individual rental partners. Contact your rental provider
                        directly through WhatsApp to discuss cancellation options. Most providers offer flexible
                        cancellation terms up to 24-48 hours before the rental period begins.
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button @click="open = open === 3 ? null : 3"
                        class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                        Are the rental providers on Rentara verified?
                        <i data-lucide="chevron-down" x-bind:class="open === 3 ? 'rotate-180' : ''"
                            class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 flex-shrink-0 ml-2"></i>
                    </button>
                    <div x-show="open === 3" x-transition
                        class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                        Payment methods vary by rental partner. Common options include bank transfer, e-wallet (GCash,
                        GoPay, OVO), and cash payment upon pickup. Confirm the preferred payment method when contacting the
                        rental provider through WhatsApp.
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button @click="open = open === 4 ? null : 4"
                        class="w-full text-left px-4 sm:px-6 py-3 sm:py-4 font-semibold text-sm sm:text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors">
                        Do I pay through Rentara or the rental provider?
                        <i data-lucide="chevron-down" x-bind:class="open === 4 ? 'rotate-180' : ''"
                            class="w-4 sm:w-5 h-4 sm:h-5 text-gray-500 transition-transform duration-300 flex-shrink-0 ml-2"></i>
                    </button>
                    <div x-show="open === 4" x-transition
                        class="px-4 sm:px-6 py-3 sm:py-4 text-sm sm:text-base text-gray-600 border-t border-gray-200 bg-gray-50 leading-relaxed">
                        Insurance availability depends on the rental partner. We recommend asking about damage protection
                        and insurance options when you contact the provider. Many rental partners offer optional insurance
                        covers for added peace of mind.
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection