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
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition font-bold text-xs">
                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    Edit
                </a>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="m-0" onsubmit="return confirm('Are you sure you want to remove this order record?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition font-bold text-xs">
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