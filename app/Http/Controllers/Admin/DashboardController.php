<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'Pending')->count(),
            'deal_orders'     => Order::where('status', 'Deal')->count(),
            'finished_orders' => Order::where('status', 'Completed')->count(),
            'total_revenue'   => Order::where('status', 'Completed')->sum('total_price'),
            'total_users'     => User::count(),
            'total_products'  => Product::count(),
        ];

        $recent_orders = Order::with(['user', 'product'])->latest()->take(5)->get();

        // Monthly Revenue (last 6 months)
        $monthly_revenue = Order::where('status', 'Completed')
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
