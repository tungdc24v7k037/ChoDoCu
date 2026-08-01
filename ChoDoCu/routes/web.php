<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
Route::get('/', [CategoryController::class, 'index'])->name('home');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])
    ->name('categories.show');


Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::get('/createnews', [NewsController::class, 'index'])
    ->name('createnews');