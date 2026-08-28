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
Route::get('/categories/{id}/children', [CategoryController::class, 'children'])
    ->name('categories.children');

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

Route::get('/test-cloudinary', function () {
    dd([
        'url' => env('CLOUDINARY_URL'),
        'disk' => config('filesystems.disks.cloudinary'),
    ]);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])
    ->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])
    ->name('profile.show');
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
    Route::post('/createnews', [NewsController::class, 'store'])
        ->name('listings.store');
    Route::get('/manage-listings', [ProductController::class, 'manage'])
    ->name('listings.manage');
    Route::get('/listings/{listing}/edit', [NewsController::class, 'edit'])
        ->name('listings.edit');

    Route::put('/listings/{listing}', [NewsController::class, 'update'])
        ->name('listings.update');

});