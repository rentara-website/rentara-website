<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::with(['user', 'product'])->latest()->paginate(15);
        return view('admin.orders.index', [
            'title' => 'Customer Bookings',
            'orders' => $orders
        ]);
    }

    public function updateStatus(Request $request, \App\Models\Order $order)
    {
        $request->validate(['status' => 'required|in:Pending,Deal,Completed,Cancelled']);
        
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated to ' . $request->status);
    }

    public function destroy(\App\Models\Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order record removed.');
    }
}
