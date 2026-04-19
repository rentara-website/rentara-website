<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'    => \App\Models\Order::count(),
            'pending_orders'  => \App\Models\Order::where('status', 'Pending')->count(),
            'deal_orders'     => \App\Models\Order::where('status', 'Deal')->count(),
            'finished_orders' => \App\Models\Order::where('status', 'Completed')->count(),
            'total_revenue'   => \App\Models\Order::where('status', 'Completed')->sum('total_price'),
            'total_users'     => \App\Models\User::count(),
            'total_products'  => \App\Models\Product::count(),
        ];

        $recent_orders = \App\Models\Order::with(['user', 'product'])->latest()->take(5)->get();

        // Monthly Revenue (last 6 months)
        $monthly_revenue = \App\Models\Order::where('status', 'Completed')
            ->selectRaw('SUM(total_price) as revenue, DATE_FORMAT(created_at, "%M") as month')
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'title'           => 'Dashboard Overview',
            'stats'           => $stats,
            'recent_orders'   => $recent_orders,
            'monthly_revenue' => $monthly_revenue,
        ]);
    }
}
