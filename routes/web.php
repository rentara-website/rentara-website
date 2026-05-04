<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;


use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;

// Authentication Routes
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
// Admin Routes Prefix
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('landingpage', [
        "title" => "Home",
        "productLatest" => Product::latest()->take(3)->get(),
    ]);
});

Route::get("wa.me/6281234567890", function () {
    return redirect("https://wa.me/6281234567890");
})->name('whatsapp.rent');

Route::get("/products", [ProductController::class, 'index']);
Route::get("/product/{product}", [ProductController::class, 'show'])->name('products.show');
Route::get("/portfolio", [PortfolioController::class, 'index']);


// Guest routes (no auth required)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

// Public routes (no auth required)
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


Route::middleware('auth')->group(function () {

    // Email Verification Routes
    Route::get('/email/verify', function () {
        return view('auth.verify-email', ['title' => 'Verify Your Email']);
    })->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/profile');
    })->middleware(['signed'])->name('verification.verify');
    
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

});

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// Admin Routes (Auth & IsAdmin required)
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product Management
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    // Order Management
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [\App\Http\Controllers\Admin\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/edit', [\App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'toggleRole'])->name('users.toggleRole');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Media Library
    Route::get('/media', [\App\Http\Controllers\Admin\MediaController::class, 'index'])->name('media.index');
    Route::delete('/media/image/{image}', [\App\Http\Controllers\Admin\MediaController::class, 'destroyProductImage'])->name('media.destroyImage');
    Route::delete('/media/portfolio/{portfolio}', [\App\Http\Controllers\Admin\MediaController::class, 'destroyPortfolio'])->name('media.destroyPortfolio');

    // Tag Management
    Route::resource('/tags', TagController::class);

    // Category Management
    Route::resource('/categories', CategoryController::class);
});

Route::get('/test-mail', function () {
    Mail::to('kenjayakusuma123@gmail.com')->send(new \App\Mail\TestMail());
    return 'Mail sent to Mailtrap!';
});