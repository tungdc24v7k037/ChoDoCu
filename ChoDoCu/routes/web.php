<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
Route::get('/', function () {
    $categories = Category::all();
    return view('welcome', compact('categories'));
});
Route::get('/categories/{slug}', [CategoryController::class, 'show'])
    ->name('categories.show');
