<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the user's profile and order history.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('product')->latest('booking_date')->get();

        return view('profile.index', compact('user', 'orders'));
    }
}
