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
        // Create demo user data for public access
        $user = (object) [
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'avatar' => null
        ];
        
        // Get sample orders for demo
        $orders = collect([]);

        return view('profile.index', ["title" => "Profile"],  compact('user', 'orders'));
    }
}
