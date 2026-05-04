<footer class="bg-[#0A4088]">

    {{-- Main Footer --}}
    <div class="footer-main px-6 sm:px-8 md:px-10 lg:px-14 py-12 sm:py-16 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-16">

            {{-- Col 1: Brand --}}
            <div class="flex flex-col gap-5">
                <a href="/">
                    <img src="/images/Rentara-removebg-preview1.png" alt="Rentara Logo" class="w-20 sm:w-24 ">
                </a>
                <p class="text-white/70 text-sm sm:text-base leading-relaxed max-w-xs">
                    Your one-stop platform for cameras, content gear, and creators in Bali. Rent with confidence.
                </p>
                {{-- Social Icons --}}
                <div class="flex items-center gap-4 mt-2">
                    <a href="mailto:" title="Email"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/25 flex items-center justify-center transition-all duration-200">
                        <i data-lucide="mail" class="w-4 h-4 text-white"></i>
                    </a>
                    <a href="{{route('whatsapp.rent') . "?text=Hi Saya ingin bertanya mengenai Rentara."}}" target="_blank" title="WhatsApp"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/25 flex items-center justify-center transition-all duration-200">
                        <i data-lucide="phone" class="w-4 h-4 text-white"></i>
                    </a>
                    <a href="https://www.instagram.com/rentaraa?igsh=MXBnOHl0enRvYmIxMQ==" target="_blank"
                        title="Instagram"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/25 flex items-center justify-center transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white fill-current"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Col 2: Navigation --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-white font-bold text-base sm:text-lg tracking-wide uppercase">Quick Links</h3>
                <ul class="flex flex-col gap-3">
                    <li>
                        <a href="/"
                            class="text-white/70 hover:text-white text-sm sm:text-base transition-colors duration-200 flex items-center gap-2 group">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 text-white/40 group-hover:text-white/80 transition-colors"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/products"
                            class="text-white/70 hover:text-white text-sm sm:text-base transition-colors duration-200 flex items-center gap-2 group">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 text-white/40 group-hover:text-white/80 transition-colors"></i>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{route('whatsapp.rent') . "?text=Hi Saya ingin bertanya mengenai Rentara."}}"
                            target="_blank"
                            class="text-white/70 hover:text-white text-sm sm:text-base transition-colors duration-200 flex items-center gap-2 group">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 text-white/40 group-hover:text-white/80 transition-colors"></i>
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Col 3: Contact Info --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-white font-bold text-base sm:text-lg tracking-wide uppercase">Contact</h3>
                <ul class="flex flex-col gap-4">
                    <li class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="map-pin" class="w-4 h-4 text-white"></i>
                        </div>
                        <span class="text-white/70 text-sm sm:text-base leading-relaxed">Bali, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="phone" class="w-4 h-4 text-white"></i>
                        </div>
                        <a href="https://wa.me/6289519929891" target="_blank"
                            class="text-white/70 hover:text-white text-sm sm:text-base transition-colors duration-200">
                            +62 895-1992-9891
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white fill-current"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </div>
                        <a href="https://www.instagram.com/rentaraa?igsh=MXBnOHl0enRvYmIxMQ==" target="_blank"
                            class="text-white/70 hover:text-white text-sm sm:text-base transition-colors duration-200">
                            @rentaraa
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Divider --}}
    <div class="border-t border-white/10"></div>

    {{-- Copyright Bar --}}
    <div
        class="px-6 sm:px-8 md:px-10 lg:px-14 py-4 sm:py-5 max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 sm:gap-0">
        <p class="text-white/50 text-xs sm:text-sm text-center sm:text-left">
            &copy; {{ date('Y') }} Rentara. All rights reserved.
        </p>
        <p class="text-white/50 text-xs sm:text-sm">
            Made with <span class="text-red-400">🔥</span> by <a class="hover:text-white"
                href="https://github.com/KenJaya270" target="_blank">Ken
                Jayakusuma</a>
        </p>
    </div>

</footer>