<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
class ProductController extends Controller
{
    public function index(){
        return view('/news/products');
    }
    public function show(string $slug)
{
    $listing = Listing::where('slug', $slug)
        ->where('status', 'published')
        ->with([
            'images',
            'primaryImage',
            'category',
            'user'
        ])
        ->firstOrFail();
     $similarListings = Listing::where('status', 'published')
        ->where('category_id', $listing->category_id)
        ->where('id', '!=', $listing->id)
        ->with([
            'primaryImage',
            'category'
        ])
        ->latest('published_at')
        ->limit(10)
        ->get();

    return view('categories.listings', compact(
        'listing',
        'similarListings'
    ));
    return view('categories.listings', compact(
        'listing',
        'similarListings'
    ));
}
}