@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Rental Bookings</h1>
            <p class="text-gray-500 text-sm mt-1">Review, confirm, and manage all incoming rental orders from customers.</p>
        </div>
        <a href="{{ route('admin.orders.create') }}" class="inline-flex items-center gap-2 bg-[#0A4088] hover:bg-[#08306b] text-white px-6 py-3 rounded-2xl font-bold transition shadow-lg shadow-[#0A4088]/20">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Add Order
        </a>
    </div>

    @if(session('success'))
        <div class="mt-2 bg-green-400 px-2 py-2 rounded-lg w-full">
            <p class="text-white">{{ session('success') }}</p>
        </div>
    @elseif(session('error'))
        <div class="mt-2 bg-red-400 px-2 py-2 rounded-lg w-full">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div class="relative w-full md:max-w-md">
            <i data-lucide="search" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            <input
                type="text"
                id="order-search"
                placeholder="Cari order, customer, produk, status..."
                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 bg-white"
            >
        </div>

        <div class="shrink-0 p-3 bg-blue-50 rounded-2xl text-[10px] font-bold text-[#0A4088] uppercase tracking-widest border border-blue-100">
            Total Orders: {{ $orders->total() }}
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-8 py-5">Order ID</th>
                        <th class="px-8 py-5">Customer</th>
                        <th class="px-8 py-5">Product</th>
                        <th class="px-8 py-5">Booking Date</th>
                        <th class="px-8 py-5">Total</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="orders-table-body" class="divide-y divide-gray-50 text-xs font-bold">
                    @include('admin.orders.partials.rows', ['orders' => $orders])
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $orders->links() }}
        </div>
    </div>

</div>
@endsection
