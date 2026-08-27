<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [CategoryController::class, 'index'])->name('home');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])
    ->name('categories.show');


Route::get('/login', [AuthController::class, 'index'])
    ->name('login');
    Route::get('/main', [AuthController::class, 'main'])
    ->name('main');




Route::get('/listings/{slug}', [ProductController::class, 'show'])
    ->name('listings.show');

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])
    ->name('profile');
    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat.index');

    Route::post('/chat/start/{listing}', [ChatController::class, 'start'])
        ->name('chat.start');

    Route::get('/chat/{conversation}', [ChatController::class, 'show'])
        ->name('chat.show');

    Route::post('/chat/{conversation}/send', [ChatController::class, 'send'])
        ->name('chat.send');

    Route::get('/createnews', [NewsController::class, 'index'])
    ->name('createnews');
});