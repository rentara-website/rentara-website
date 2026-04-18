<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Portfolio;
use App\Models\Category;

class PortfolioController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Portfolio::with(['category', 'product']);
        $activeCategory = null;

        if ($request->filled('category')) {
            $catSlug = $request->query('category');
            $activeCategory = Category::where('slug', $catSlug)->first();
            
            if ($activeCategory) {
                // Filter by category_id
                $query->where('category_id', $activeCategory->id);
            }
        }

        $portfolios = $query->latest()->get();

        return view('portfolio.index', compact('portfolios', 'activeCategory'));
    }
}
