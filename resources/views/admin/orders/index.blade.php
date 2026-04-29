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
                <tbody class="divide-y divide-gray-50 text-xs font-bold">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-5 text-gray-400">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $order->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($order->user->name) }}" class="w-8 h-8 rounded-full border border-gray-100">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900">{{ $order->user->name }}</span>
                                        <span class="text-[10px] text-gray-400 font-medium normal-case">{{ $order->user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-gray-600">{{ $order->product->nama_produk }}</td>
                            <td class="px-8 py-5 text-gray-900">
                                <div>{{ $order->booking_date->format('d M Y, H:i') }}</div>
                                @if($order->end_date)
                                    <div class="text-[10px] text-gray-400 mt-0.5">to {{ $order->end_date->format('d M Y, H:i') }}</div>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-8 py-5">
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" id="form-status-{{ $order->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="document.getElementById('form-status-{{ $order->id }}').submit()"
                                            class="bg-transparent border-none focus:ring-0 p-0 text-[10px] font-black uppercase cursor-pointer
                                            {{ $order->status === 'Completed' ? 'text-green-500' : 
                                               ($order->status === 'Pending' ? 'text-yellow-500' : 
                                               ($order->status === 'Deal' ? 'text-blue-500' : 'text-red-500')) }}">
                                        <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Deal" {{ $order->status === 'Deal' ? 'selected' : '' }}>Deal / Confirmed</option>
                                        <option value="Completed" {{ $order->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition font-bold text-xs" title="Edit">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="m-0" onsubmit="return confirm('Are you sure you want to remove this order record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition font-bold text-xs" title="Delete">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-10 text-center text-gray-400 italic">No bookings found in the system yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $orders->links() }}
        </div>
    </div>

</div>
@endsection
