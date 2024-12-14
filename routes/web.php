<?php

use App\Http\Controllers\PublicationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SphereController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('publications', PublicationController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('spheres', SphereController::class);
    Route::resource('authors', AuthorController::class);
});

require __DIR__.'/auth.php';
