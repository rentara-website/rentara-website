<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::with(['category', 'tags'])->latest()->paginate(10);
        return view('admin.products.index', [
            'title' => 'Manage Products',
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'title' => 'Create Product',
            'categories' => \App\Models\Category::all(),
            'tags' => \App\Models\Tag::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'portfolio_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'portfolio_videos.*' => 'nullable|mimes:mp4,mov,avi,qt|max:20480', // 20MB limit
            'tags' => 'nullable|array'
        ]);

        $product = \App\Models\Product::create([
            'nama_produk' => $request->nama_produk,
            'slug' => \Illuminate\Support\Str::slug($request->nama_produk) . '-' . \Illuminate\Support\Str::random(5),
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'category_id' => $request->category_id,
        ]);

        // Handle Main Image (ImageProduct)
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Optimization with Intervention Image 4.x
            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $img = $manager->read($image);
            $img->scale(width: 800); // Resize to max 800px width
            
            $path = 'products/' . $filename;
            \Illuminate\Support\Facades\Storage::disk('public')->put($path, (string) $img->encodeByExtension(quality: 80));
            
            \App\Models\ImageProduct::create([
                'product_id' => $product->id,
                'image_path' => $path
            ]);
        }

        // Handle Portfolio Images
        if ($request->hasFile('portfolio_images')) {
            foreach ($request->file('portfolio_images') as $file) {
                $filename = time() . '_portfolio_' . $file->getClientOriginalName();
                $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                $img = $manager->read($file);
                $img->scale(width: 1200);
                
                $path = 'portfolios/' . $filename;
                \Illuminate\Support\Facades\Storage::disk('public')->put($path, (string) $img->encodeByExtension(quality: 80));
                
                \App\Models\Portfolio::create([
                    'product_id' => $product->id,
                    'file_path' => $path,
                    'type' => 'image',
                    'title' => $product->nama_produk . ' Shot'
                ]);
            }
        }

        // Handle Portfolio Videos
        if ($request->hasFile('portfolio_videos')) {
            foreach ($request->file('portfolio_videos') as $file) {
                $path = $file->store('portfolios/videos', 'public');
                
                \App\Models\Portfolio::create([
                    'product_id' => $product->id,
                    'file_path' => $path,
                    'type' => 'video',
                    'title' => $product->nama_produk . ' Cinematic'
                ]);
            }
        }

        // Handle Tags
        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(\App\Models\Product $product)
    {
        return view('admin.products.edit', [
            'title' => 'Edit Product',
            'product' => $product->load(['tags', 'image_product', 'portfolios']),
            'categories' => \App\Models\Category::all(),
            'tags' => \App\Models\Tag::all()
        ]);
    }

    public function update(Request $request, \App\Models\Product $product)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array'
        ]);

        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'category_id' => $request->category_id,
        ]);

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(\App\Models\Product $product)
    {
        // Delete related media files
        foreach ($product->image_product as $img) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($img->image_path);
        }
        foreach ($product->portfolios as $port) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($port->file_path);
        }

        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}
