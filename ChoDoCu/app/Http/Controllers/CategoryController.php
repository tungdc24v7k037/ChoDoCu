<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
class CategoryController extends Controller
{

public function index()
{
    $categories = Category::whereNull('parent_id')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $listings = Listing::where('status', 'published')
        ->with(['primaryImage', 'category'])
        ->latest()
        ->paginate(10);

    return view('welcome', compact('categories', 'listings'));
}
public function children($id)
{
    $children = Category::where('parent_id', $id)
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get([
            'id',
            'name'
        ]);

    return response()->json($children);
}
public function show(string $slug)
{
    $category = Category::where('slug', $slug)
        ->where('is_active', true)
        ->with('parent')
        ->firstOrFail();

    // Danh mục con của danh mục hiện tại
    $subCategories = Category::where('parent_id', $category->id)
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    // Chỉ lấy danh mục chính
    $categories = Category::whereNull('parent_id')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    if ($subCategories->isNotEmpty()) {

        // Nếu đang ở danh mục cha
        // VD: Đồ điện tử
        $categoryIds = $subCategories->pluck('id');

        $listings = Listing::whereIn('category_id', $categoryIds)
            ->where('status', 'published')
            ->with('primaryImage')
            ->latest()
            ->paginate(10);

    } else {

        // Nếu đang ở danh mục con
        // VD: iPhone
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