<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('landingpage', [
        "title" => "Home",
    ]);
});

Route::get("/products", [ProductController::class, 'index']);
Route::get("/products/search/{keyword}", [ProductController::class, 'search']);
