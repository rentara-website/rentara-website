<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentara Admin - {{ $title ?? 'Dashboard' }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="/images/Rentara-removebg-preview1.png" type="image/x-icon">

</head>
<body class="bg-gray-50 font-poppins antialiased">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0A4088] text-white transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 shadow-2xl">
            
            <!-- Logo Section -->
            <div class="flex items-center justify-between h-20 px-6 bg-[#08306b]">
                <a href="/" class="flex items-center gap-3">
                    <img src="/images/Rentara-removebg-preview1.png" alt="Logo" class="w-12 brightness-0 invert">
                    <span class="text-xl font-black tracking-wider">ADMIN</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-8 px-4 space-y-2 overflow-y-auto h-[calc(100vh-5rem)] pb-10">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-white/40 mb-2">Main Menu</p>
                
                <a href="{{ url('/admin/dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ Request::is('admin/dashboard') ? 'bg-white/10 text-white font-bold border-l-4 border-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/admin/orders') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ Request::is('admin/orders*') ? 'bg-white/10 text-white font-bold border-l-4 border-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    <span>Orders</span>
                </a>

                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-white/40 mb-2 mt-6">Management</p>

                <a href="{{ url('/admin/products') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ Request::is('admin/products*') ? 'bg-white/10 text-white font-bold border-l-4 border-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="package" class="w-5 h-5"></i>
                    <span>Products</span>
                </a>

                <a href="{{ url('/admin/tags') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ Request::is('admin/tags*') ? 'bg-white/10 text-white font-bold border-l-4 border-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="tag" class="w-5 h-5"></i>
                    <span>Tags</span>
                </a>

                <a href="{{ url('/admin/users') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ Request::is('admin/users*') ? 'bg-white/10 text-white font-bold border-l-4 border-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>Users</span>
                </a>

                <a href="{{ url('/admin/media') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ Request::is('admin/media*') ? 'bg-white/10 text-white font-bold border-l-4 border-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="image" class="w-5 h-5"></i>
                    <span>Media Library</span>
                </a>

                <div class="mt-auto pt-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-red-300 hover:bg-red-500/10 hover:text-red-200 transition">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Navbar -->
            <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-6 lg:px-10 shrink-0">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h2 class="text-xl font-bold text-gray-800">{{ $title ?? 'Overview' }}</h2>
                </div>

                <div class="flex items-center gap-6">
                    <div class="hidden sm:flex items-center gap-3 px-4 py-2 bg-gray-50 rounded-full text-sm text-gray-500 border border-gray-100">
                        <div class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.6)]"></div>
                        <span>System Online</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-900 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-[#0A4088] uppercase tracking-wider">Administrator</p>
                        </div>
                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=0A4088&background=EBF4FF' }}" 
                             alt="Avatar" class="w-10 h-10 rounded-full border-2 border-[#0A4088]/10 object-cover">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-10 bg-gray-50/50">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl flex items-center gap-3 shadow-sm">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl flex items-center gap-3 shadow-sm">
                        <i data-lucide="alert-circle" class="w-5 h-5"></i>
                        <span class="font-bold text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('admin_content')
            </main>
        </div>
    </div>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
