<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\indexControllers;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BoutiqueController;
use Illuminate\Support\Facades\Route;

Route::get('/', [indexControllers::class, 'index']);


Route::get('/boutique', [BoutiqueController::class, 'index'])->name('articles.index');
Route::get('/boutique/filter', [BoutiqueController::class, 'index'])->name('articles.filter');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/politique', function () {
    return view('confidentialite');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
