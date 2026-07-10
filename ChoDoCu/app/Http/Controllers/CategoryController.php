<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $listings = $category->listings()
            ->where('status', 'published')
            ->with('primaryImage')
            ->latest()
            ->paginate(12);

        return view('categories.show', compact('category', 'listings'));
    }
}