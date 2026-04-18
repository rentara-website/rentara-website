<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('landingpage', [
        "title" => "Home",
    ]);
});

Route::get("/products", [ProductController::class, 'index']);
Route::get("/product/{product}", [ProductController::class, 'show'])->name('products.show');
Route::get("/portfolio", [PortfolioController::class, 'index']);
