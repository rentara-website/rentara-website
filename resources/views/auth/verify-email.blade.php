@extends('template')

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 shadow-xl text-center border border-gray-100">
        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-lucide="mail" class="w-10 h-10 text-[#0A4088]"></i>
        </div>
        
        <h2 class="text-2xl font-black text-gray-900 mb-4">Verify Your Email</h2>
        
        <p class="text-gray-500 mb-6 leading-relaxed">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        </p>

        @if (session('message'))
            <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-xl border border-green-200">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-[#0A4088] hover:bg-[#08306b] text-white font-bold py-3 px-6 rounded-2xl transition-colors shadow-lg shadow-[#0A4088]/30">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-6 rounded-2xl transition-colors">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
