@extends('admin.layout')

@section('admin_content')
    <div class="max-w-4xl mx-auto pb-20">

        <!-- Header -->
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-gray-900">Create New Order</h1>
                <p class="text-gray-500 mt-1">Manually add a new booking for a customer</p>
            </div>
            <a href="{{ route('admin.orders.index') }}"
                class="text-sm font-bold text-gray-400 hover:text-gray-600 flex items-center gap-2 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Orders
            </a>
        </div>

        <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="bg-white p-8 md:p-10 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="text-xl font-bold text-gray-900 border-b border-gray-50 pb-4">Booking Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Selection -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Customer</label>
                        <select name="user_id" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition appearance-none">
                            <option value="" disabled selected>Select a Customer</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product Selection -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Product</label>
                        <select name="product_id" id="product_id" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition appearance-none">
                            <option value="" disabled selected>Select a Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->harga }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->nama_produk }} - Rp {{ number_format($product->harga, 0, ',', '.') }}/day
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Booking Date -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Start Date &
                            Time</label>
                        <input type="datetime-local" name="booking_date" id="booking_date" value="{{ old('booking_date') }}"
                            required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    </div>

                    <!-- End Date -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">End Date &
                            Time</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                    </div>

                    <!-- Total Price -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Total Price</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-bold">Rp</span>
                            <input type="number" name="total_price" id="total_price" value="{{ old('total_price', 0) }}"
                                required readonly
                                class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-12 pr-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition">
                        </div>
                        <p class="text-[10px] text-gray-400 italic mt-1">* Autogenerated based on days selection. You can
                            still manually adjust.</p>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Order Status</label>
                        <select name="status" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 focus:border-[#0A4088] transition appearance-none text-yellow-600">
                            <option value="Pending" class="text-yellow-600" {{ old('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Deal" class="text-blue-600" {{ old('status') === 'Deal' ? 'selected' : '' }}>Deal /
                                Confirmed</option>
                            <option value="Completed" class="text-green-600" {{ old('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" class="text-red-600" {{ old('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders.index') }}"
                    class="px-8 py-4 bg-white border border-gray-100 text-gray-400 font-bold rounded-2xl hover:bg-gray-50 transition">Cancel</a>
                <button type="submit"
                    class="flex-1 bg-[#0A4088] hover:bg-[#08306b] text-white font-bold py-4 rounded-2xl transition shadow-xl shadow-[#0A4088]/30">
                    Create Order
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSelect = document.getElementById('product_id');
            const startDateInput = document.getElementById('booking_date');
            const endDateInput = document.getElementById('end_date');
            const totalPriceInput = document.getElementById('total_price');

            function calculateTotal() {
                if (!productSelect.value || !startDateInput.value || !endDateInput.value) return;

                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const pricePerDay = parseFloat(selectedOption.dataset.price);

                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);

                if (isNaN(start.getTime()) || isNaN(end.getTime())) return;

                if (end <= start) {
                    totalPriceInput.value = 0;
                    return;
                }

                // Calculate difference in days
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                totalPriceInput.value = diffDays * pricePerDay;
            }

            productSelect.addEventListener('change', calculateTotal);
            startDateInput.addEventListener('change', calculateTotal);
            endDateInput.addEventListener('change', calculateTotal);
        });
    </script>
@endpush