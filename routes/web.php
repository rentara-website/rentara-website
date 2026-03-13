<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage', [
        "title" => "Home",
    ]);
});

Route::get("/products", function (){
    return view('products.index', [
        "title" => "Products",
    ]);
});
