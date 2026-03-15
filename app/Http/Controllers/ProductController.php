<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Product::query()->with('category');
        $products = $query->get();
        
        // Group produk berdasarkan kategori dan limit 4 per kategori
        $groupedProducts = $products->groupBy('category.name')->map(function ($items) {
            return $items->take(4);
        });

        return view("products.index", [
            "title" => "Products",
            "groupedProducts" => $groupedProducts,
            "search" => null,
        ]);
    }

    /**
     * Search products by keyword.
     */
    public function search($keyword)
    {
        $search = urldecode($keyword);

        $query = Product::query()->with('category');

        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%')
                  ->orWhere('harga', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $products = $query->get();
        
        // Group produk berdasarkan kategori dan limit 4 per kategori
        $groupedProducts = $products->groupBy('category.name')->map(function ($items) {
            return $items->take(4);
        });

        return view("products.index", [
            "title" => "Products",
            "groupedProducts" => $groupedProducts,
            "search" => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
