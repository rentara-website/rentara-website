<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = \App\Models\Tag::all();
        return view('admin.tags.index', [
            'title' => 'Manage Tags',
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:tags,name']);
        
        \App\Models\Tag::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name)
        ]);

        return back()->with('success', 'Tag created successfully!');
    }

    public function update(Request $request, \App\Models\Tag $tag)
    {
        $request->validate(['name' => 'required|unique:tags,name,' . $tag->id]);
        
        $tag->update([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name)
        ]);

        return back()->with('success', 'Tag updated successfully!');
    }

    public function destroy(\App\Models\Tag $tag)
    {
        $tag->delete();
        return back()->with('success', 'Tag deleted successfully!');
    }
}
