@extends('template')

@section('content')
<section class="min-h-screen pt-32 pb-20 flex items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full">
        <div class="bg-white p-10 rounded-[40px] shadow-2xl shadow-blue-900/5 border border-gray-100">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-gray-900 mb-2">Create Account</h1>
                <p class="text-gray-500 text-sm">Join Rentara and start your creative journey</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    @error('name') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    @error('email') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    @error('password') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#0A4088] hover:bg-[#08306b] text-white font-black py-5 rounded-2xl transition shadow-xl shadow-[#0A4088]/30 active:scale-[0.98]">
                        Sign Up Now
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-gray-500">Already have an account? 
                    <a href="{{ route('login') }}" class="text-[#0A4088] font-black hover:underline ml-1">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
