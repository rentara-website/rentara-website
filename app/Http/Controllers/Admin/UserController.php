<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', [
            'title' => 'User Management',
            'users' => $users
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|hash:sha256',
        ]);

        User::create($request->only('name', 'email', 'password'));

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function toggleRole(User $user)
    {
        // Removed auth check for public access
        if ($user->id === 1) {
            return back()->with('error', 'Cannot modify default admin user.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'User role updated to ' . $user->role);
    }

    public function destroy(User $user)
    {
        // Removed auth check for public access
        if ($user->id === 1) {
            return back()->with('error', 'Cannot delete default admin user.');
        }

        $user->delete();
        return back()->with('success', 'User has been removed.');
    }
}
