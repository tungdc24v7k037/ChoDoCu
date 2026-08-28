<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->get('q', ''));

        $query = Listing::query()
            ->where('status', 'published')
            ->with([
                'primaryImage',
                'category'
            ]);

        if ($keyword !== '') {

            $query->where(function ($q) use ($keyword) {

                $q->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('province', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('district', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($keyword) {
                        $categoryQuery->where(
                            'name',
                            'LIKE',
                            '%' . $keyword . '%'
                        );
                    });

            });
        }

        $listings = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('search.index', compact(
            'listings',
            'keyword',
            'categories'
        ));
    }
}