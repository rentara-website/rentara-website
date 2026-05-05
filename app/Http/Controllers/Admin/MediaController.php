<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $productImages = \App\Models\ImageProduct::with('product')->get();
        $portfolios = \App\Models\Portfolio::with('product')->get();

        return view('admin.media.index', [
            'title' => 'Media Library',
            'productImages' => $productImages,
            'portfolios' => $portfolios
        ]);
    }

    public function destroyProductImage(\App\Models\ImageProduct $image)
    {
        $image->deleteMediaIfCloudinary($image->image_path, 'image');
        $image->delete();
        return back()->with('success', 'Image deleted.');
    }

    public function destroyPortfolio(\App\Models\Portfolio $portfolio)
    {
        $portfolio->deleteMediaIfCloudinary(
            $portfolio->file_path,
            $portfolio->type === 'video' ? 'video' : 'image'
        );
        $portfolio->delete();
        return back()->with('success', 'Media deleted.');
    }
}
