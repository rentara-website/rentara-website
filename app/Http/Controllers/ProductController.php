<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categorySlug = $request->query('category');
        $tagSlug = $request->query('tag');

        $query = Product::query()->with(['category', 'tags']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        $perPage = $request->get('per_page', 20);
        // $products = $query->paginate($perPage);

        $products = $query->paginate($perPage)->withPath(route('products.index'));

        // Group paginated products by category
        $groupedProducts = $products->groupBy('category.name');

        $data = [
            "title" => "Products",
            "groupedProducts" => $groupedProducts,
            "products" => $products,
            "categories" => Category::all(),
            "tags" => Tag::all(),
            "search" => $search,
            "activeCategory" => $categorySlug,
            "activeTag" => $tagSlug,
        ];

        if ($request->ajax()) {
            return view("products.partials.grid", $data);
        }

        return view("products.index", $data);
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
        $product->load(['category', 'tags']);

        $data = [
            "title" => $product->nama_produk,
            "product" => $product,
        ];

        return view("products.show", $data);
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
