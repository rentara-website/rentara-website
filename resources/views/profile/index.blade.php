@extends('template')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Profile Header --}}
        <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg border border-gray-100 mb-8 flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-[#0A4088] shrink-0">
                <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=0A4088&background=EBF4FF' }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl font-black text-gray-900 mb-2">{{ $user->name }}</h1>
                <p class="text-gray-500 font-medium">{{ $user->email }}</p>
                @if(!$user->hasVerifiedEmail() && !$user->google_id)
                    <div class="mt-4 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-xl text-sm font-bold w-fit mx-auto md:mx-0 flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                        Please check your email to verify your account
                        <form method="POST" action="/email/verification-notification" class="inline">
                            @csrf
                            <button type="submit" class="underline text-[#0A4088] ml-2">Resend Email</button>
                        </form>
                    </div>
                @elseif($user->hasVerifiedEmail() || $user->google_id)
                    <div class="mt-4 bg-green-100 text-green-800 px-4 py-2 rounded-xl text-sm font-bold w-fit mx-auto md:mx-0 flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        Verified
                    </div>
                @endif
            </div>
            <div class="flex flex-col gap-3 w-full md:w-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-2xl transition-colors shadow-lg shadow-red-500/30 flex items-center justify-center gap-2">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- Order History --}}
        <div>
            <h2 class="text-2xl font-black text-[#0A4088] mb-6 flex items-center gap-3">
                <i data-lucide="history" class="w-6 h-6"></i>
                Order History
            </h2>

            @if($orders->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
                    <i data-lucide="shopping-bag" class="w-16 h-16 mx-auto text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-700">No rental history yet</h3>
                    <p class="text-gray-400 mt-2">Start exploring our gear collection and make your first rental.</p>
                    <a href="/products" class="inline-block mt-6 bg-[#0A4088] text-white font-bold py-3 px-8 rounded-2xl hover:bg-[#08306b] transition-colors shadow-lg">Browse Products</a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col sm:flex-row gap-6 items-center hover:shadow-md transition-shadow">
                            <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden shrink-0">
                                @if($order->product->image_product->isNotEmpty())
                                    <img src="{{ Str::startsWith($order->product->image_product->first()->image_path, 'http') ? $order->product->image_product->first()->image_path : asset('storage/' . $order->product->image_product->first()->image_path) }}" alt="{{ $order->product->nama_produk }}" class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="camera" class="w-8 h-8 text-gray-400"></i>
                                @endif
                            </div>
                            <div class="flex-1 w-full text-center sm:text-left">
                                <h3 class="text-lg font-bold text-gray-900">{{ $order->product->nama_produk }}</h3>
                                <p class="text-sm font-bold text-gray-400 mt-1">Booked for: {{ $order->booking_date->format('d M Y, H:i') }}</p>
                                
                                <div class="mt-3 flex items-center justify-center sm:justify-start gap-4 flex-wrap">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-full border border-gray-200">
                                        ID: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                    
                                    @if($order->status === 'Completed')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Completed</span>
                                    @elseif($order->status === 'Pending')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Pending</span>
                                    @elseif($order->status === 'Deal')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Confirmed / Deal</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">{{ $order->status }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-full sm:w-auto text-center sm:text-right border-t sm:border-t-0 p-4 sm:p-0 border-gray-100">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Price</p>
                                <p class="text-xl font-black text-[#0A4088]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
