@extends('admin.layout')

@section('admin_content')
<div class="space-y-8">
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total Revenue -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center shrink-0">
                <i data-lucide="dollar-sign" class="w-7 h-7 text-green-600"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Revenue</p>
                <h3 class="text-2xl font-black text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center shrink-0">
                <i data-lucide="shopping-cart" class="w-7 h-7 text-[#0A4088]"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Orders</p>
                <h3 class="text-2xl font-black text-gray-900">{{ $stats['total_orders'] }}</h3>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-yellow-50 rounded-2xl flex items-center justify-center shrink-0">
                <i data-lucide="clock" class="w-7 h-7 text-yellow-600"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Pending</p>
                <h3 class="text-2xl font-black text-gray-900">{{ $stats['pending_orders'] }}</h3>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center shrink-0">
                <i data-lucide="package" class="w-7 h-7 text-purple-600"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Products</p>
                <h3 class="text-2xl font-black text-gray-900">{{ $stats['total_products'] }}</h3>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-gray-900">Monthly Revenue</h3>
                <div class="p-2 bg-gray-50 rounded-lg text-xs font-bold text-gray-500">Last 6 Months</div>
            </div>
            <div class="h-[300px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="text-xl font-black text-gray-900 mb-8">Quick Overview</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        <span class="text-sm font-bold text-gray-600">Deal Orders</span>
                    </div>
                    <span class="text-sm font-black text-gray-900">{{ $stats['deal_orders'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="text-sm font-bold text-gray-600">Completed</span>
                    </div>
                    <span class="text-sm font-black text-gray-900">{{ $stats['finished_orders'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                        <span class="text-sm font-bold text-gray-600">Total Users</span>
                    </div>
                    <span class="text-sm font-black text-gray-900">{{ $stats['total_users'] }}</span>
                </div>
            </div>

            <div class="mt-10 p-6 bg-[#0A4088] rounded-2xl text-white">
                <p class="text-xs font-bold text-white/60 uppercase tracking-widest mb-2">Need Help?</p>
                <h4 class="font-bold mb-4">Admin Support</h4>
                <a href="#" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl text-xs font-bold transition">
                    <i data-lucide="life-buoy" class="w-4 h-4"></i>
                    Documentation
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-xl font-black text-gray-900">Recent Orders</h3>
            <a href="{{ url('/admin/orders') }}" class="text-sm font-bold text-[#0A4088] hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-8 py-4">Customer</th>
                        <th class="px-8 py-4">Product</th>
                        <th class="px-8 py-4">Date</th>
                        <th class="px-8 py-4">Amount</th>
                        <th class="px-8 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 uppercase text-xs font-bold">
                    @forelse($recent_orders as $order)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $order->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($order->user->name) }}" class="w-8 h-8 rounded-full border border-gray-100">
                                    <span class="text-gray-900">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-gray-600">{{ $order->product->nama_produk }}</td>
                            <td class="px-8 py-4 text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-8 py-4">
                                @if($order->status === 'Completed')
                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full">Completed</span>
                                @elseif($order->status === 'Pending')
                                    <span class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-full">Pending</span>
                                @elseif($order->status === 'Deal')
                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full">Confirmed</span>
                                @else
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full">{{ $order->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">No recent orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        const labels = {!! json_encode($monthly_revenue->pluck('month')) !!};
        const data = {!! json_encode($monthly_revenue->pluck('revenue')) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['No Data'],
                datasets: [{
                    label: 'Revenue',
                    data: data.length ? data : [0],
                    borderColor: '#0A4088',
                    backgroundColor: 'rgba(10, 64, 136, 0.05)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0A4088',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' },
                        ticks: {
                            font: { weight: 'bold' },
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold' } }
                    }
                }
            }
        });
    });
</script>
@endsection
