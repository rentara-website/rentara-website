@extends('template')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Profile Header --}}
        <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg border border-gray-100 mb-8 flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-[#0A4088] shrink-0 bg-[#EBF4FF] flex items-center justify-center">
                <span class="text-4xl font-black text-[#0A4088] uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl font-black text-gray-900 mb-2">{{ auth()->user()->name }}</h1>
                <p class="text-gray-500 font-medium">{{ auth()->user()->email }}</p>
                <div class="mt-4 bg-green-100 text-green-800 px-4 py-2 rounded-xl text-sm font-bold w-fit mx-auto md:mx-0 flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    Verified User
                </div>
            </div>
            <div class="flex flex-col gap-3 w-full md:w-auto">
                <a href="/" class="w-full bg-[#0A4088] hover:bg-[#08306b] text-white font-bold py-3 px-6 rounded-2xl transition-colors shadow-lg shadow-[#0A4088]/30 flex items-center justify-center gap-2">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Back to Home
                </a>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-bold py-3 px-6 rounded-2xl transition-colors border border-red-100 flex items-center justify-center gap-2">
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
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                <tr>
                                    <th class="px-6 py-5">Order ID</th>
                                    <th class="px-6 py-5">Product</th>
                                    <th class="px-6 py-5">Booking Date</th>
                                    <th class="px-6 py-5">Total Price</th>
                                    <th class="px-6 py-5">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-sm">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-6 py-4 font-bold text-gray-900">
                                            #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden shrink-0">
                                                    @if($order->product->image_product->isNotEmpty())
                                                        <img src="{{ $order->product->image_product->first()->url }}" alt="{{ $order->product->nama_produk }}" class="w-full h-full object-cover">
                                                    @else
                                                        <i data-lucide="camera" class="w-4 h-4 text-gray-400"></i>
                                                    @endif
                                                </div>
                                                <span class="font-bold text-gray-900">{{ $order->product->nama_produk }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 font-medium">
                                            <div>{{ $order->booking_date->format('d M Y, H:i') }}</div>
                                            @if($order->end_date)
                                                <div class="text-[10px] text-gray-400 mt-0.5">to {{ $order->end_date->format('d M Y, H:i') }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-black text-[#0A4088]">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($order->status === 'Completed')
                                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Completed</span>
                                            @elseif($order->status === 'Pending')
                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Pending</span>
                                            @elseif($order->status === 'Deal')
                                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Deal</span>
                                            @else
                                                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
