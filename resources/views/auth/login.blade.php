@extends('template')

@section('content')
<section class="min-h-screen pt-32 pb-20 flex items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full">
        @if(session('status'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 text-xs font-bold rounded-2xl border border-green-100">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white p-10 rounded-[40px] shadow-2xl shadow-blue-900/5 border border-gray-100">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-gray-900 mb-2">Welcome Back</h1>
                <p class="text-gray-500 text-sm">Sign in to continue to your dashboard</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    @error('email') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2 ml-1">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Password</label>
                        <a href="{{ route('password.request') }}" class="text-[10px] font-black text-[#0A4088] hover:underline">Forgot?</a>
                    </div>
                    <input type="password" name="password" required
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                </div>

                <label class="flex items-center gap-3 ml-1 cursor-pointer group">
                    <input type="checkbox" name="remember" class="sr-only peer">
                    <div class="w-5 h-5 rounded-lg border-2 border-gray-200 peer-checked:bg-[#0A4088] peer-checked:border-[#0A4088] transition-all flex items-center justify-center">
                        <i data-lucide="check" class="w-3 h-3 text-white hidden peer-checked:block transition"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-500 group-hover:text-gray-700 transition">Remember me</span>
                </label>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#0A4088] hover:bg-[#08306b] text-white font-black py-5 rounded-2xl transition shadow-xl shadow-[#0A4088]/30 active:scale-[0.98]">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-[#0A4088] font-black hover:underline ml-1">Sign Up</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
