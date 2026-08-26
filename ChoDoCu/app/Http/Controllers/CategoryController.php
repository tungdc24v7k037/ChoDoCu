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
        ->with('parent')
        ->firstOrFail();

    $subCategories = Category::where('parent_id', $category->id)
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $categories = Category::where('is_active', true)
        ->whereNull('parent_id')
        ->orderBy('sort_order')
        ->get();

    if ($subCategories->isNotEmpty()) {

     
        $categoryIds = $subCategories->pluck('id');

        $listings = Listing::whereIn('category_id', $categoryIds)
            ->where('status', 'published')
            ->with('primaryImage')
            ->latest()
            ->paginate(10);

    } else {

      
        $listings = $category->listings()
            ->where('status', 'published')
            ->with('primaryImage')
            ->latest()
            ->paginate(10);
    }

    return view('categories.show', compact(
        'category',
        'subCategories',
        'listings',
        'categories'
    ));
}
}