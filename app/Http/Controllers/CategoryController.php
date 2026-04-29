<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count_total = Category::get()->count();
        return view('admin.categories.index', [
            "title" => "Categories",
            "categories" => Category::all(),
            "categories_count" => $count_total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create', [
            "title" => "Add Category",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        $category = Category::create($request->only('name', 'slug'));

        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->route('admin.categories.index')->with('failed', 'An error occurred while creating the category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        
        return view('admin.categories.show', [
            "title" => "Category Details",
            "category" => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.show', [
            "title" => "Category Details",
            "category" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|
            unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->only('name', 'slug'));


        if ($category->wasChanged()) {
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        }else if (!$category->wasChanged()) {
            return redirect()->route('admin.categories.index')->with('success', 'No changes were made to the category.');

        }else{
            return redirect()->route('admin.categories.index')->with('failed', 'An error occurred while updating the category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
