<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
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
            'deskripsi' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'link_portofolio' => 'nullable|url|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $publicId = $this->uploadToCloudinary($request->file('image'), 'rentara/products', 'image');
                $imagePath = $publicId;
            }

            $product = Product::create([
                'nama_produk' => $request->nama_produk,
                'slug' => \Illuminate\Support\Str::slug($request->nama_produk) . '-' . \Illuminate\Support\Str::random(5),
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi ?? '',
                'link_portofolio' => $request->link_portofolio,
                'image' => $imagePath,
                'category_id' => $request->category_id,
            ]);

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
            'product' => $product->load(['tags']),
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'link_portofolio' => 'nullable|url|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $data = [
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi ?? '',
                'link_portofolio' => $request->link_portofolio,
                'category_id' => $request->category_id,
            ];

            if ($request->hasFile('image')) {
                if ($product->image) {
                    $product->deleteMediaIfCloudinary($product->image, 'image');
                }
                $publicId = $this->uploadToCloudinary($request->file('image'), 'rentara/products', 'image');
                $data['image'] = $publicId;
            }

            $product->update($data);

            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
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
        if ($product->image) {
            $product->deleteMediaIfCloudinary($product->image, 'image');
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

    public function search(Request $request)
    {
        $q = $request->get('q');

        $products = Product::query()
            ->with(['category', 'tags'])
            ->when($q, function ($query) use ($q) {
                $query->where('nama_produk', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%")
                    ->orWhereHas('category', function ($cat) use ($q) {
                        $cat->where('name', 'like', "%{$q}%");
                    })
                    ->orWhereHas('tags', function ($tag) use ($q) {
                        $tag->where('name', 'like', "%{$q}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.products.partials.rows', compact('products'));
    }
}
