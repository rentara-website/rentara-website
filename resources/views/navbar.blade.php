<nav class="fixed top-0 left-0 w-full z-50 navbar-container flex-col px-4 sm:px-6 md:px-10 py-2 shadow-md bg-white">
    <div class="flex items-center justify-between h-14">
        <div class="navbar-logo shrink-0">
            <a href="/">
                <img src="/images/Rentara-removebg-preview1.png" alt="Rentara Logo" class="w-12 sm:w-14 md:w-16">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="navbar-list hidden md:flex items-center gap-4 lg:gap-6 font-semibold text-sm lg:text-base">
            <div class="navbar-items {{ $title === 'Home' ? 'text-white bg-[#0A4088] rounded-full px-3 sm:px-4 py-1.5' : '' }}">
                <a href="/" class="hover:text-[#0A4088] transition">Beranda</a>
            </div>

            <div class="navbar-items {{ $title === 'Products' ? 'text-white bg-[#0A4088] rounded-full px-3 sm:px-4 py-1.5' : '' }}">
                <a href="/products" class="hover:text-[#0A4088] transition">Produk</a>
            </div>

            <div class="navbar-items">
                <a href="{{route('whatsapp.rent') . '?text=Haloo saya ingin bertanya tentang Rentara.'}}" target="_blank"
                   class="hover:text-[#0A4088] transition">
                    Hubungi Kami
                </a>
            </div>

            <div class="flex items-center gap-3 ml-2">
                @auth
                    <a href="/profile" class="text-[#0A4088] font-semibold hover:text-[#08306b] transition text-sm flex items-center gap-1.5">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        {{ auth()->user()->name }}
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="bg-[#0A4088] text-white px-4 py-1.5 rounded-full hover:bg-[#08306b] transition text-xs font-bold shadow-md shadow-[#0A4088]/20">
                            Dashboard
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-red-500 font-semibold hover:text-red-700 transition text-sm flex items-center gap-1.5">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="/login" class="bg-[#0A4088] text-white px-4 py-1.5 rounded-full hover:bg-[#08306b] transition text-xs font-bold shadow-md shadow-[#0A4088]/20">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden flex flex-col gap-1 focus:outline-none">
            <span class="block w-5 h-0.5 bg-[#0A4088] transition"></span>
            <span class="block w-5 h-0.5 bg-[#0A4088] transition"></span>
            <span class="block w-5 h-0.5 bg-[#0A4088] transition"></span>
        </button>

        <button class="hidden md:hidden close-button">
            <i data-lucide="x" class="w-6 h-6 text-[#0A4088]"></i>
        </button>
    </div>

    <div id="mobile-menu" class="hidden md:hidden">
        <div class="flex flex-col gap-0 py-2 text-black text-sm">
            <a href="/" class="py-2.5 border-b border-gray-100 hover:text-[#0A4088] transition">Beranda</a>
            <a href="/products" class="py-2.5 border-b border-gray-100 hover:text-[#0A4088] transition">Produk</a>
            <a href="{{ route('whatsapp.rent') . '?text=Haloo saya ingin bertanya tentang Rentara.' }}" target="_blank"
               class="py-2.5 border-b border-gray-100 hover:text-[#0A4088] transition">
                Hubungi Kami
            </a>

            @auth
                <a href="/profile" class="py-2.5 border-b border-gray-100 hover:text-[#0A4088] transition font-semibold">
                    Profile ({{ auth()->user()->name }})
                </a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="py-2.5 border-b border-gray-100 hover:text-[#0A4088] transition font-semibold">
                        Dashboard
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="py-2.5">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 transition font-semibold text-left w-full">
                        Logout
                    </button>
                </form>
            @else
                <a href="/login" class="py-2.5 text-[#0A4088] hover:text-[#08306b] transition font-semibold">
                    Sign In
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Mobile Navigation Menu -->


<script>
    const menuBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.querySelector('.close-button');
    const menu = document.getElementById('mobile-menu');

    menuBtn?.addEventListener('click', () => {
        menu.classList.remove('hidden');
        menuBtn.classList.add('hidden');
        closeBtn.classList.remove('hidden');
    });

    closeBtn?.addEventListener('click', () => {
        menu.classList.add('hidden');
        menuBtn.classList.remove('hidden');
        closeBtn.classList.add('hidden');
    });
</script>