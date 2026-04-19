@extends('template')

@section('content')
<section class="min-h-screen pt-32 pb-20 flex items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full">
        <div class="bg-white p-10 rounded-[40px] shadow-2xl shadow-blue-900/5 border border-gray-100">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-gray-900 mb-2">New Password</h1>
                <p class="text-gray-500 text-sm">Create a secure new password for your account</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required readonly
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm text-gray-400 focus:outline-none">
                    @error('email') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">New Password</label>
                    <input type="password" name="password" required autofocus
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    @error('password') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#0A4088] hover:bg-[#08306b] text-white font-black py-5 rounded-2xl transition shadow-xl shadow-[#0A4088]/30 active:scale-[0.98]">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
