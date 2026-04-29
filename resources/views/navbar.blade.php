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

            <!-- Navigation Links -->
            <div class="flex items-center gap-4 ml-4">
                @auth
                    <a href="/profile" class="text-[#0A4088] font-bold hover:text-[#08306b] transition text-sm flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        {{ auth()->user()->name }}
                    </a>
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="bg-[#0A4088] text-white px-5 py-2 rounded-full hover:bg-[#08306b] transition text-sm font-bold shadow-md shadow-[#0A4088]/20">Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-red-500 font-bold hover:text-red-700 transition text-sm flex items-center gap-2">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="bg-[#0A4088] text-white px-5 py-2 rounded-full hover:bg-[#08306b] transition text-sm font-bold shadow-md shadow-[#0A4088]/20">Sign In</a>
                @endauth
            </div>
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

            <!-- Mobile Navigation -->
            @auth
                <a href="/profile" class="py-3 border-b border-gray-100 hover:text-[#0A4088] transition font-bold">Profile ({{ auth()->user()->name }})</a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="py-3 border-b border-gray-100 hover:text-[#0A4088] transition font-bold">Dashboard</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="py-3">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 transition font-bold text-left w-full">Logout</button>
                </form>
            @else
                <a href="/login" class="py-3 text-[#0A4088] hover:text-[#08306b] transition font-bold">Sign In</a>
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