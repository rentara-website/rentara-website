<nav class="navbar-container flex-col px-6 sm:px-8 md:px-14 py-3 shadow-lg bg-white relative z-40">
    <div class="flex items-center justify-between">

        <div class="navbar-logo">
            <a href="/">

                <img src="/images/Rentara-removebg-preview1.png" alt="Rentara Logo" class="w-16 sm:w-20">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="navbar-list hidden md:flex items-center gap-6 lg:gap-10 font-bold text-base md:text-lg">
            <div
                class="navbar-items {{$title === 'Home' ? 'text-white bg-[#0A4088] rounded-full px-4 sm:px-6 lg:px-7 py-2' : ''}}">
                <a href="/" class="hover:text-[#0A4088] transition">Home</a>
            </div>
            <div
                class="navbar-items {{$title === 'Products' ? 'text-white bg-[#0A4088] rounded-full px-4 sm:px-6 lg:px-7 py-2' : ''}}">
                <a href="/products" class="hover:text-[#0A4088] transition">Products</a>
            </div>
            <div class="navbar-items">
                <a href="https://wa.me/6281938092473?text=Haloo saya ingin bertanya tentang Rentara. " target="_blank"
                    class="hover:text-[#0A4088] transition">Contact Us</a>
            </div>

            @guest
                <div class="flex items-center gap-4 ml-4">
                    <a href="{{ route('login') }}" class="text-[#0A4088] hover:text-[#08306b] transition text-sm font-bold">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-[#0A4088] text-white px-5 py-2 rounded-full hover:bg-[#08306b] transition text-sm font-bold shadow-md shadow-[#0A4088]/20">Sign Up</a>
                </div>
            @endguest

            @auth
                <div class="relative ml-4" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 focus:outline-none">
                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=0A4088&background=EBF4FF' }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="w-10 h-10 rounded-full border-2 border-[#0A4088]/20 object-cover">
                        <span class="text-sm font-bold text-gray-700 hidden lg:block">{{ Auth::user()->name }}</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl py-2 z-50">
                        
                        <a href="{{ route('profile') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <i data-lucide="user" class="w-4 h-4 text-[#0A4088]"></i>
                            Profile
                        </a>

                        @if(Auth::user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#0A4088]"></i>
                                Dashboard
                            </a>
                        @endif

                        <div class="border-t border-gray-50 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden flex flex-col gap-1.5 focus:outline-none">

            <span class="block w-6 h-0.5 bg-[#0A4088] transition"></span>
            <span class="block w-6 h-0.5 bg-[#0A4088] transition"></span>
            <span class="block w-6 h-0.5 bg-[#0A4088] transition"></span>

        </button>

        <button class="hidden md:hidden close-button">
            <i data-lucide="x" class="size-12 text-[#0A4088]"></i>

        </button>

    </div>
    <div id="mobile-menu" class="hidden md:hidden ">
        <div class="flex flex-col gap-0 py-2 text-black">

            <a href="/" class="py-3 border-b border-gray-100 hover:text-[#0A4088] transition">Home</a>
            <a href="/products" class="py-3 border-b border-gray-100 hover:text-[#0A4088] transition">Products</a>
            <a href="https://wa.me/6281938092473?text=Haloo saya ingin bertanya tentang Rentara." target="_blank" class="py-3 hover:text-[#0A4088] transition">Contact Us</a>

            @guest
                <a href="{{ route('login') }}" class="py-3 border-b border-gray-100 hover:text-[#0A4088] transition font-bold">Sign In</a>
                <a href="{{ route('register') }}" class="py-3 hover:text-[#0A4088] transition font-bold">Sign Up</a>
            @endguest

            @auth
                <a href="{{ route('profile') }}" class="py-3 border-b border-gray-100 hover:text-[#0A4088] transition flex items-center gap-2">
                    <i data-lucide="user" class="w-4 h-4 text-[#0A4088]"></i> Profile
                </a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ url('/admin/dashboard') }}" class="py-3 border-b border-gray-100 hover:text-[#0A4088] transition flex items-center gap-2">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#0A4088]"></i> Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="py-3 flex">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-600 font-bold flex items-center gap-2">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </button>
                </form>
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