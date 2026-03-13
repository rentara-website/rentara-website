@extends('template')

@section('content')
    <div class="hero-section-container mt-10 flex items-center justify-between px-14 py-20">
        <div class="hero-section-left">
            <h1 class="text-[50px] font-bold w-[738px] ">One-Stop Platform for Cameras, Content Gear & Creators in Bali</h1>
            <p class="w-149.5 mt-5 text-[24px] text-gray-500">
                Rent cameras, content gear, and book photographers or videographers in Bali — all in one place. 📸🎥
            </p>
            <button type="button" class="bg-[#0A4088] hover:bg-[#032d63] text-white font-bold py-2 px-4 rounded-full mt-5 flex items-center gap-2 transition duration-300 hover:cursor-pointer">
                Explore Categories
                <x-heroicon-o-arrow-right class="w-3 h-3 text-white"/>
            </button>
        </div>
        
        <div class="hero-section-right">

            <img src="/images/191981921.png" alt="" width="568" >
        </div>
        
    </div>

    <div class="about-us-container bg-[#0A4088] mt-10 flex items-center justify-center">
        <div class="about-us-wrapper px-14 py-10 grid-cols-2 grid w-full">
            <div class="about-us-left">
                <img src="/images/Sandy_Gen-04_Single-081.png" alt="about us image" srcset="" width="405">
            </div>
            <div class="about-us-right">
                <h1 class="text-white text-[64px] font-bold max-w-181.25">All Your Bali Rental Needs in One Place</h1>
                <p class="text-[#d1d1d1] text-[24px] mt-5 w-189.25 font-poppins">
                    Rentara is a Bali platform to rent cameras and content gear, and connect with professional photographers and videographers.
                </p>

                <p class="text-[#fafafa] text-[24px] underline mt-5"> All rental options in one platform?</p>
            </div>
        </div>
    </div>

    <div class="popular-product-container mt-10">
        <div class="popular-product-wrapper px-14 py-10">
            <h1 class="text-center text-[64px] font-extrabold text-black">The Most Popular Rentals in Rentara</h1>

            <div class="popular-product-card-container flex justify-center items-center gap-10">
                <div class="motorbike-card-container group transition">
                    <div class="motorbike-card-wrapper flex bg-[#0A4088] rounded-2xl mt-10 p-10 items-center gap-10 group-hover:cursor-pointer group-hover:bg-[#EDEFEF] group-hover:transition duration-300 transition-all">
                        <div class="desc">
                            <h2 class="text-[24px] font-bold text-white group-hover:text-black transition">Photographer</h2>
                            <p class="text-white text-[16px] w-67 mt-10 group-hover:text-black transition">Discover professional photographers and videographers in Bali to capture your moments and create high-quality content with ease.</p>
                            <a href="" class="text-white font-bold text-[16px] gap-3 flex items-center mt-10 group-hover:text-black transition">
                                Explore More
                                <div class="icon-container group-hover:bg-[#0A4088] rounded-full px-2 py-2 transition duration-300">

                                    <x-heroicon-o-arrow-right class="w-4 h-4 text-white transition"/>

                                </div>
                            </a>

                        </div>

                        <img src="/images/Group312.png" alt="" srcset="" class="hidden group-hover:block transition duration-300">
                    </div>
                </div>
                <div class="motorbike-card-container group transition">
                    <div class="motorbike-card-wrapper flex bg-[#0A4088] rounded-2xl mt-10 p-10 items-center gap-10 group-hover:cursor-pointer group-hover:bg-[#EDEFEF] group-hover:transition duration-300 transition-all">
                        <div class="desc">
                            <h2 class="text-[24px] font-bold text-white group-hover:text-black transition">Videographer</h2>
                            <p class="text-white text-[16px] w-67 mt-10 group-hover:text-black transition">Discover professional videographers in Bali to capture your moments and create high-quality video content with ease.</p>
                            <a href="" class="text-white font-bold text-[16px] gap-3 flex items-center mt-10 group-hover:text-black transition">
                                Explore More
                                <div class="icon-container group-hover:bg-[#0A4088] rounded-full px-2 py-2 transition duration-300">

                                    <x-heroicon-o-arrow-right class="w-4 h-4 text-white transition"/>

                                </div>
                            </a>

                        </div>

                        <img src="/images/Group312.png" alt="" srcset="" class="hidden group-hover:block transition duration-300">
                    </div>
                </div>
                <div class="motorbike-card-container group transition">
                    <div class="motorbike-card-wrapper flex bg-[#0A4088] rounded-2xl mt-10 p-10 items-center gap-10 group-hover:cursor-pointer group-hover:bg-[#EDEFEF] group-hover:transition duration-300 transition-all">
                        <div class="desc">
                            <h2 class="text-[24px] font-bold text-white group-hover:text-black transition">Content Equipment</h2>
                            <p class="text-white text-[16px] w-67 mt-10 group-hover:text-black transition">Rent tripods, lighting, and photography/videography accessories from local rental partners.</p>
                            <a href="" class="text-white font-bold text-[16px] gap-3 flex items-center mt-10 group-hover:text-black transition">
                                Explore More
                                <div class="icon-container group-hover:bg-[#0A4088] rounded-full px-2 py-2 transition duration-300">

                                    <x-heroicon-o-arrow-right class="w-4 h-4 text-white transition"/>

                                </div>
                            </a>

                        </div>

                        <img src="/images/OAYXH40.Jpg" alt="" srcset="" class="hidden group-hover:block transition duration-300" WIDTH="200">
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="why-rentara-container">
        <div class="why-rentara-wrapper px-14 py-10">
            <div class="why-rentara-header">
                <h1 class="text-[64px] font-extrabold text-black">Why Rent with Rentara?</h1>
                <p class="text-gray-500 text-[16px] w-157.75 mt-5">We make renting cameras and vehicles in Bali simple, safe, and convenient. Discover trusted rentals and book with confidence through Rentara.</p>

            </div>

            <div class="card-container">
                <div class="card-wrapper flex items-center justify-center gap-4 mt-10">
                    
                    <div class="card bg-[#0A4088] rounded-2xl p-10 mt-10 max-w-[297px]">
                        <div class="icon-container bg-[#EDEFEF] rounded-full p-2 w-fit">
                            <x-heroicon-o-shield-check class="w-5 h-5 text-[#0A4088]"/>
                        </div>
                        <div class="desc">
                            <h2 class="text-[24px] font-bold text-white mt-2 w-[191px]">Verified Rental Partners</h2>
                            <p class="text-white text-[14px] mt-2 w-[232px]">All rental providers on Rentara are screened and verified to ensure quality, reliability, and trusted service.</p>
                        </div>
                    </div>
                    <div class="card bg-[#0A4088] rounded-2xl p-10 mt-10 max-w-[297px]">
                        <div class="icon-container bg-[#EDEFEF] rounded-full p-2 w-fit">
                            <x-heroicon-o-currency-dollar class="w-5 h-5 text-[#0A4088]"/>
                        </div>
                        <div class="desc">
                            <h2 class="text-[24px] font-bold text-white mt-2 w-[191px]">Easy Price Comparison</h2>
                            <p class="text-white text-[14px] mt-2 w-[232px]">Compare multiple rental options, prices, and vehicle or camera types in one convenient platform.</p>
                        </div>
                    </div>
                    <div class="card bg-[#0A4088] rounded-2xl p-10 mt-10 max-w-[297px]">
                        <div class="icon-container bg-[#EDEFEF] rounded-full p-2 w-fit">
                            <x-heroicon-o-clock class="w-5 h-5 text-[#0A4088]"/>
                        </div>
                        <div class="desc">
                            <h2 class="text-[24px] font-bold text-white mt-2 w-[191px]">Fast WhatsApp Booking</h2>
                            <p class="text-white text-[14px] mt-2 w-[232px]">Contact rental providers instantly and confirm your booking quickly through WhatsApp.</p>
                        </div>
                    </div>
                    <div class="card bg-[#0A4088] rounded-2xl p-10 mt-10 max-w-[297px]">
                        <div class="icon-container bg-[#EDEFEF] rounded-full p-2 w-fit">
                            <x-heroicon-o-hand-thumb-up class="w-5 h-5 text-[#0A4088]"/>
                        </div>
                        <div class="desc">
                            <h2 class="text-[24px] font-bold text-white mt-2 w-[191px]">Wide Rental Selection</h2>
                            <p class="text-white text-[14px] mt-2 w-[232px]">Access a variety of cameras, motorbikes, and vehicles from local Bali rental partners in one place.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="need-to-know bg-gray-50 py-20">
        <div class="need-to-know-wrapper px-14 max-w-6xl mx-auto">
            <div class="mb-12">
                <h1 class="text-[64px] font-extrabold text-black mb-4">Need to Know</h1>
                <p class="text-gray-500 text-[16px] w-189.25">Find answers to common questions about renting with Rentara.</p>
            </div>

            <div x-data="{ open: null }" class="space-y-3">

                <!-- Item 1 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button 
                        @click="open = open === 1 ? null : 1"
                        class="w-full text-left px-6 py-4 font-semibold text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors"
                    >
                        How do I book a rental through Rentara?
                        <svg x-bind:class="open === 1 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 1" x-transition class="px-6 py-4 text-base text-gray-600 border-t border-gray-200 bg-gray-50">
                        You can browse available cameras or vehicles on Rentara and select the item you want. When you click “Book” or “Contact,” you will be connected directly to the rental provider via WhatsApp to confirm availability, dates, and details. Once confirmed, you can proceed with the rental arrangement.
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button 
                        @click="open = open === 2 ? null : 2"
                        class="w-full text-left px-6 py-4 font-semibold text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors"
                    >
                        How do I book a Photographer/Videographer?
                        <svg x-bind:class="open === 2 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 2" x-transition class="px-6 py-4 text-base text-gray-600 border-t border-gray-200 bg-gray-50">
                        Cancellation policies are determined by individual rental partners. Contact your rental provider directly through WhatsApp to discuss cancellation options. Most providers offer flexible cancellation terms up to 24-48 hours before the rental period begins.
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button 
                        @click="open = open === 3 ? null : 3"
                        class="w-full text-left px-6 py-4 font-semibold text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors"
                    >
                        Are the rental providers on Rentara verified?
                        <svg x-bind:class="open === 3 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 3" x-transition class="px-6 py-4 text-base text-gray-600 border-t border-gray-200 bg-gray-50">
                        Payment methods vary by rental partner. Common options include bank transfer, e-wallet (GCash, GoPay, OVO), and cash payment upon pickup. Confirm the preferred payment method when contacting the rental provider through WhatsApp.
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="bg-white rounded-lg border border-gray-200 hover:border-[#0A4088] transition-colors">
                    <button 
                        @click="open = open === 4 ? null : 4"
                        class="w-full text-left px-6 py-4 font-semibold text-base text-gray-900 flex justify-between items-center hover:text-[#0A4088] transition-colors"
                    >
                        Do I pay through Rentara or the rental provider?
                        <svg x-bind:class="open === 4 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 4" x-transition class="px-6 py-4 text-base text-gray-600 border-t border-gray-200 bg-gray-50">
                        Insurance availability depends on the rental partner. We recommend asking about damage protection and insurance options when you contact the provider. Many rental partners offer optional insurance covers for added peace of mind.
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Start Rent Section -->
    {{-- <div class="start-rent mt-12 md:mt-20">
        <div class="start-rent-wrapper px-6 sm:px-8 md:px-14 mx-auto max-w-6xl flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12">
            <div class="start-rent-left w-full md:w-1/2 order-2 md:order-1">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">Start Rent Now!</h1>
                <img src="/images/Sandy_Trv-02_Single-02 1.png" alt="Start renting" class="w-full max-w-md h-auto object-contain">
            </div>

            <div class="start-rent-right w-full md:w-1/2 order-1 md:order-2">
                <div class="form-container shadow-2xl rounded-3xl p-8 md:p-10 bg-white border border-gray-100">
                    <form action="">
                        @csrf
                        <div class="mb-5">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                            <input type="text" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#0A4088] focus:border-transparent transition" name="name" required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" id="phone" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#0A4088] focus:border-transparent transition" required>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#0A4088] focus:border-transparent transition" required>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                            <textarea name="address" id="address" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#0A4088] focus:border-transparent transition h-24 resize-none" placeholder="Enter your address"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-[#0A4088] to-[#062d55] hover:from-[#032d63] hover:to-[#041a33] text-white font-bold py-3 px-4 rounded-lg transition duration-300 hover:shadow-lg transform hover:scale-105">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection