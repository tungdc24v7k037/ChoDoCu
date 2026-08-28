<?php

namespace App\Http\Controllers;
use App\Models\User;
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
    public function edit()
{
    $user = auth()->user();

    return view('profile.edit', compact('user'));
}
public function show(User $user)
{
    $listings = $user->listings()
        ->where('status', 'published')
        ->with('primaryImage')
        ->latest()
        ->get();

    return view('profile.show', compact('user', 'listings'));
}
}