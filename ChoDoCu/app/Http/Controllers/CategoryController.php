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
        ->paginate(10);

    $categories = Category::where('is_active', true)
        ->orderBy('id')
        ->get();

    return view('categories.show', compact(
        'category',
        'listings',
        'categories'
    ));
}
}