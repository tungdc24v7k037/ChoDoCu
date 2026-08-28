<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
public function manage(Request $request)
{
    $userId = auth()->id();

    $status = $request->get('status', 'published');

    $allowedStatuses = [
        'published',
        'expired',
        'rejected',
        'pending_payment',
        'draft',
        'pending',
        'hidden',
    ];

    if (!in_array($status, $allowedStatuses)) {
        $status = 'published';
    }

  $listings = Listing::where('user_id', $userId)
    ->where('status', $status)
    ->with('primaryImage')
    ->latest()
    ->paginate(4);

    $counts = Listing::where('user_id', $userId)
        ->selectRaw("
            SUM(status = 'published') as published,
            SUM(status = 'expired') as expired,
            SUM(status = 'rejected') as rejected,
            SUM(status = 'pending_payment') as pending_payment,
            SUM(status = 'draft') as draft,
            SUM(status = 'pending') as pending,
            SUM(status = 'hidden') as hidden
        ")
        ->first();

    return view('news.manage', compact(
        'listings',
        'counts',
        'status'
    ));
}


}