<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ImageProduct;
use App\Models\Portfolio;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'tags'])->latest()->paginate(10);
        return view('admin.products.index', [
            'title' => 'Manage Products',
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'title' => 'Create Product',
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created product in storage.
     * 
     * This method handles the creation of a new product, including:
     * - Validating incoming request data
     * - Creating the main product record
     * - Processing and optimizing the main featured image
     * - Processing and optimizing optional portfolio images
     * - Storing optional portfolio videos
     * - Associating selected tags
     * 
     * Uses DB transaction to ensure data integrity across multiple tables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:20480',
            'portfolio_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
            'portfolio_videos.*' => 'nullable|mimes:mp4,mov,avi,qt|max:20480', // 20MB limit
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $product = Product::create([
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
                $img = $manager->decode($image->getPathname());
                $img->scale(width: 800); // Resize to max 800px width
                
                $path = 'products/' . $filename;
                \Illuminate\Support\Facades\Storage::disk('public')->put($path, (string) $img->encodeUsingFileExtension($image->getClientOriginalExtension(), quality: 80));
                
                ImageProduct::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }

            // Handle Portfolio Images
            if ($request->hasFile('portfolio_images')) {
                foreach ($request->file('portfolio_images') as $file) {
                    $filename = time() . '_portfolio_' . $file->getClientOriginalName();
                    $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                    $img = $manager->decode($file->getPathname());
                    $img->scale(width: 1200);
                    
                    $path = 'portfolios/' . $filename;
                    \Illuminate\Support\Facades\Storage::disk('public')->put($path, (string) $img->encodeUsingFileExtension($file->getClientOriginalExtension(), quality: 80));
                    
                    Portfolio::create([
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
                    
                    Portfolio::create([
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

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            // Log the error for debugging purposes
            \Illuminate\Support\Facades\Log::error('Product Creation Failed: ' . $e->getMessage());
            
            return back()->withInput()->with('error', 'Failed to create product. Please try again.');
        }
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'title' => 'Edit Product',
            'product' => $product->load(['tags', 'image_product', 'portfolios']),
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
            'portfolio_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
            'portfolio_videos.*' => 'nullable|mimes:mp4,mov,avi,qt|max:20480',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $product->update([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'category_id' => $request->category_id,
            ]);

            // Handle Main Image replacement (if uploaded)
            if ($request->hasFile('product_image')) {
                // Delete old images
                foreach ($product->image_product as $img) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                }

                $image = $request->file('product_image');
                $filename = time() . '_' . $image->getClientOriginalName();
                
                $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                $img = $manager->decode($image->getPathname());
                $img->scale(width: 800);
                
                $path = 'products/' . $filename;
                \Illuminate\Support\Facades\Storage::disk('public')->put($path, (string) $img->encodeUsingFileExtension($image->getClientOriginalExtension(), quality: 80));
                
                ImageProduct::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }

            // Handle Portfolio Images
            if ($request->hasFile('portfolio_images')) {
                foreach ($request->file('portfolio_images') as $file) {
                    $filename = time() . '_portfolio_' . $file->getClientOriginalName();
                    $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                    $img = $manager->decode($file->getPathname());
                    $img->scale(width: 1200);
                    
                    $path = 'portfolios/' . $filename;
                    \Illuminate\Support\Facades\Storage::disk('public')->put($path, (string) $img->encodeUsingFileExtension($file->getClientOriginalExtension(), quality: 80));
                    
                    Portfolio::create([
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
                    
                    Portfolio::create([
                        'product_id' => $product->id,
                        'file_path' => $path,
                        'type' => 'video',
                        'title' => $product->nama_produk . ' Cinematic'
                    ]);
                }
            }

            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }

            // Handle deleting selected portfolios
            if ($request->has('delete_portfolios')) {
                foreach ($request->delete_portfolios as $portfolioId) {
                    $portfolio = Portfolio::find($portfolioId);
                    if ($portfolio && $portfolio->product_id == $product->id) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($portfolio->file_path);
                        $portfolio->delete();
                    }
                }
            }

            \Illuminate\Support\Facades\DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Product Update Failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function destroy(Product $product)
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
