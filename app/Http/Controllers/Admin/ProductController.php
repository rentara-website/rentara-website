<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ImageProduct;
use App\Models\Portfolio;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:20480',
            'portfolio_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
            'portfolio_videos.*' => 'nullable|mimes:mp4,mov,avi,qt|max:20480',
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

            if ($request->hasFile('product_image')) {
                $publicId = $this->uploadToCloudinary($request->file('product_image'), 'rentara/products', 'image');
                ImageProduct::create([
                    'product_id' => $product->id,
                    'image_path' => $publicId,
                ]);
            }

            if ($request->hasFile('portfolio_images')) {
                foreach ($request->file('portfolio_images') as $file) {
                    $publicId = $this->uploadToCloudinary($file, 'rentara/portfolios', 'image');
                    Portfolio::create([
                        'product_id' => $product->id,
                        'file_path' => $publicId,
                        'type' => 'image',
                        'title' => $product->nama_produk . ' Shot'
                    ]);
                }
            }

            if ($request->hasFile('portfolio_videos')) {
                foreach ($request->file('portfolio_videos') as $file) {
                    $publicId = $this->uploadToCloudinary($file, 'rentara/portfolios/videos', 'video');
                    Portfolio::create([
                        'product_id' => $product->id,
                        'file_path' => $publicId,
                        'type' => 'video',
                        'title' => $product->nama_produk . ' Cinematic'
                    ]);
                }
            }

            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
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

            if ($request->hasFile('product_image')) {
                foreach ($product->image_product as $img) {
                    $img->deleteMediaIfCloudinary($img->image_path, 'image');
                    $img->delete();
                }

                $publicId = $this->uploadToCloudinary($request->file('product_image'), 'rentara/products', 'image');
                ImageProduct::create([
                    'product_id' => $product->id,
                    'image_path' => $publicId,
                ]);
            }

            if ($request->hasFile('portfolio_images')) {
                foreach ($request->file('portfolio_images') as $file) {
                    $publicId = $this->uploadToCloudinary($file, 'rentara/portfolios', 'image');
                    Portfolio::create([
                        'product_id' => $product->id,
                        'file_path' => $publicId,
                        'type' => 'image',
                        'title' => $product->nama_produk . ' Shot'
                    ]);
                }
            }

            if ($request->hasFile('portfolio_videos')) {
                foreach ($request->file('portfolio_videos') as $file) {
                    $publicId = $this->uploadToCloudinary($file, 'rentara/portfolios/videos', 'video');
                    Portfolio::create([
                        'product_id' => $product->id,
                        'file_path' => $publicId,
                        'type' => 'video',
                        'title' => $product->nama_produk . ' Cinematic'
                    ]);
                }
            }

            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }

            if ($request->has('delete_portfolios')) {
                foreach ($request->delete_portfolios as $portfolioId) {
                    $portfolio = Portfolio::find($portfolioId);
                    if ($portfolio && $portfolio->product_id == $product->id) {
                        $portfolio->deleteMediaIfCloudinary(
                            $portfolio->file_path,
                            $portfolio->type === 'video' ? 'video' : 'image'
                        );
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
        foreach ($product->image_product as $img) {
            $img->deleteMediaIfCloudinary($img->image_path, 'image');
        }
        foreach ($product->portfolios as $port) {
            $port->deleteMediaIfCloudinary(
                $port->file_path,
                $port->type === 'video' ? 'video' : 'image'
            );
        }

        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }

    protected function uploadToCloudinary($file, string $folder, string $resourceType): string
    {
        $response = Cloudinary::uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
            'resource_type' => $resourceType,
        ]);

        return (string) $response['public_id'];
    }
}
