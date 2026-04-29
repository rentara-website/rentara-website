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

    public function create()
    {
        return view('admin.orders.create', [
            'title' => 'Create Order',
            'users' => \App\Models\User::all(),
            'products' => \App\Models\Product::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'booking_date' => 'required|date',
            'end_date' => 'required|date|after:booking_date',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Deal,Completed,Cancelled'
        ]);

        \App\Models\Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'booking_date' => $request->booking_date,
            'end_date' => $request->end_date,
            'total_price' => $request->total_price,
            'status' => $request->status
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(\App\Models\Order $order)
    {
        return view('admin.orders.edit', [
            'title' => 'Edit Order',
            'order' => $order,
            'users' => \App\Models\User::all(),
            'products' => \App\Models\Product::all()
        ]);
    }

    public function update(Request $request, \App\Models\Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'booking_date' => 'required|date',
            'end_date' => 'required|date|after:booking_date',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Deal,Completed,Cancelled'
        ]);

        $order->update([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'booking_date' => $request->booking_date,
            'end_date' => $request->end_date,
            'total_price' => $request->total_price,
            'status' => $request->status
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
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
