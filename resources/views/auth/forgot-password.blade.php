@extends('template')

@section('content')
<section class="min-h-screen pt-32 pb-20 flex items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full">
        <div class="bg-white p-10 rounded-[40px] shadow-2xl shadow-blue-900/5 border border-gray-100">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-gray-900 mb-2">Reset Password</h1>
                <p class="text-gray-500 text-sm">Enter your email to receive a password reset link</p>
            </div>

            @if(session('status'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 text-[10px] font-black uppercase tracking-widest rounded-2xl border border-green-100 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    @error('email') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#0A4088] hover:bg-[#08306b] text-white font-black py-5 rounded-2xl transition shadow-xl shadow-[#0A4088]/30 active:scale-[0.98]">
                        Send Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <a href="{{ route('login') }}" class="text-sm font-black text-gray-400 hover:text-[#0A4088] transition flex items-center justify-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
