<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        $listings = Listing::where('user_id', $user->id)
            ->with('primaryImage')
            ->latest()
            ->get();

        return view('profile.show', compact(
            'user',
            'listings'
        ));
    }
}