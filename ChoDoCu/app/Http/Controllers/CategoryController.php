<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
class CategoryController extends Controller
{

public function index()
{
    $categories = Category::where('is_active', true)->get();

    $listings = Listing::where('status', 'published')
        ->with(['primaryImage', 'category'])
        ->latest()
        ->paginate(10);

    return view('welcome', compact('categories', 'listings'));
}

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