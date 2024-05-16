<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\indexControllers;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [indexControllers::class, 'index']);


Route::get('/boutique', [BoutiqueController::class, 'index'])->name('articles.index');
Route::get('/boutique/filter', [BoutiqueController::class, 'index'])->name('articles.filter');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add')->middleware('web');

// Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

Route::get('/contact', [ViewController::class, 'contact']);
Route::get('/apropos', [ViewController::class, 'apropos']);


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
