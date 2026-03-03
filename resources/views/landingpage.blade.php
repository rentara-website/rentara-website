@extends('template')

@section('content')
    <div class="hero-section-container mt-10 flex items-center justify-between px-14">
        <div class="hero-section-left">
            <h1 class="text-[64px] font-bold w-106.5 leading-24">Premium Rental in Bali</h1>
            <p class="w-149.5 mt-5 text-[24px] text-gray-500">
                Rent Cameras & Vehicles in Bali Easily and Safely Discover trusted camera and motorbike rentals in Bali from verified local providers — all in one convenient platform.
            </p>
            <button type="button" class="bg-[#0A4088] hover:bg-[#032d63] text-white font-bold py-2 px-4 rounded-full mt-5 flex items-center gap-2 transition duration-300 hover:cursor-pointer">
                Explore Categories
                <x-heroicon-o-arrow-right class="w-3 h-3 text-white"/>
            </button>
        </div>
        
        <div class="hero-section-right">

            <img src="/images/509261.png" alt="" width="268" class="relative z-10 right-40">
            <img src="/images/191981921.png" alt="" width="351" class="relative z-20 bottom-14">
        </div>
        
    </div>

    <div class="about-us-container bg-[#0A4088] mt-10 flex items-center justify-center">
        <div class="about-us-wrapper px-14 py-10 flex items-center justify-between w-full">
            <div class="about-us-left">
                <img src="/images/Sandy_Gen-04_Single-081.png" alt="about us image" srcset="" width="405">
            </div>
            <div class="about-us-right">
                <h1 class="text-white text-[64px] font-bold max-w-181.25">All Your Bali Rental Needs in One Place</h1>
                <p class="text-[#d1d1d1] text-[24px] mt-5 w-189.25 font-poppins">
                    Rentara is a Bali rental that helps you find and book cameras, motorbikes, and content equipment from trusted local rental providers quickly and easily.
                </p>

                <p class="text-[#fafafa] text-[24px] underline mt-5"> All rental options in one platform?</p>
            </div>
        </div>
    </div>

    <div class="popular-product-container mt-10">
        <div class="popular-product-wrapper px-14 py-10">
            <h1 class="text-center text-[64px] font-extrabold text-black">The Most Popular Rentals in Rentara</h1>

            <div class="popular-product-card-container flex justify-center items-center gap-10">
                
                <div class="motorbike-card-container bg-[#0A4088] rounded-2xl mt-10 px-10 py-10 flex items-center gap-10">
                    <div class="motorbike-card-wrapper flex flex-col items-stretch">
                        <h2 class="text-[32px] font-bold text-white group-hover:text-black transition">Motorbikes</h2>
                        <p class="text-white text-[16px] w-67 mt-10 group-hover:text-black transition">Discover daily and weekly motorbike rentals to explore Bali conveniently and affordably</p>
                        <a href="" class="text-white font-bold text-[16px] gap-3 flex items-center mt-10">

                            Explore More
                            <x-heroicon-o-arrow-right class="w-4 h-4 text-white group-hover:bg-[#0A4088] group-hover:rounded-full  transition"/>

                        </a>
                    </div>
                </div>
                <div class="motorbike-card-container group transition">
                    <div class="motorbike-card-wrapper flex bg-[#0A4088] rounded-2xl mt-10 px-10 py-10 items-center gap-10 group-hover:cursor-pointer group-hover:bg-[#EDEFEF] group-hover:transition duration-300">
                        <div class="desc">
                            <h2 class="text-[32px] font-bold text-white group-hover:text-black transition">Motorbikes</h2>
                            <p class="text-white text-[16px] w-67 mt-10 group-hover:text-black transition">Discover daily and weekly motorbike rentals to explore Bali conveniently and affordably</p>
                            <a href="" class="text-white font-bold text-[16px] gap-3 flex items-center mt-10 group-hover:text-black transition">
                                Explore More
                                <div class="icon-container group-hover:bg-[#0A4088] rounded-full px-2 py-2 transition duration-300">

                                    <x-heroicon-o-arrow-right class="w-4 h-4 text-white transition"/>

                                </div>
                            </a>

                        </div>

                        <img src="/images/Group31.png" alt="" srcset="" class="hidden group-hover:block transition duration-300">
                    </div>
                </div>
                <div class="motorbike-card-container bg-[#0A4088] rounded-2xl mt-10 px-10 py-10 flex items-center gap-10">
                    <div class="motorbike-card-wrapper flex flex-col items-stretch">
                        {{-- <img src="/images/Group31.png" alt="" srcset=""> --}}
                        <h2 class="text-[32px] font-bold text-white">Motorbikes</h2>
                        <p class="text-white text-[16px] w-67 mt-10">Discover daily and weekly motorbike rentals to explore Bali conveniently and affordably</p>
                        <a href="" class="text-white font-bold text-[16px] gap-3 flex items-center mt-10">

                            Explore More
                            <x-heroicon-o-arrow-right class="w-4 h-4 text-white"/>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection