<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\indexControllers;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommanderController;
use App\Http\Controllers\PanierController;
use Illuminate\Support\Facades\Route;


use App\Http\Middleware\Cart;

Route::get('/', [indexControllers::class, 'index'])->middleware(Cart::class);



Route::get('/boutique', [BoutiqueController::class, 'index'])->name('articles.index')->middleware(Cart::class);


Route::get('/panier', [PanierController::class, 'index'])->name('articles.index')->middleware(Cart::class);


Route::get('/boutique/filter', [BoutiqueController::class, 'index'])->name('articles.filter')->middleware(Cart::class);

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->middleware(Cart::class);

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add')->middleware('web');


Route::post('/cart/delete/{id}', [CartController::class, 'deleteToCart']);


Route::get('/commander', [CommanderController::class, 'show'])->middleware(Cart::class);
Route::post('/commander/validate', [CommanderController::class, 'validate']);


Route::get('/response', function () {
    return view('response');
})->name('response');


Route::get('/contact', function () {
    // Récupérer la variable ajoutée par le middleware
    $panierFormat = request()->panierFormat;

    // Retourner la vue en passant la variable
    return view('contact', compact('panierFormat'));
})->middleware(Cart::class);

Route::get('/apropos', function () {
    // Récupérer la variable ajoutée par le middleware
    $panierFormat = request()->panierFormat;

    // Retourner la vue en passant la variable
    return view('apropos', compact('panierFormat'));
})->middleware(Cart::class);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::get('/politique', function () {
    // Récupérer la variable ajoutée par le middleware
    $panierFormat = request()->panierFormat;

    // Retourner la vue en passant la variable
    return view('confidentialite', compact('panierFormat'));
})->middleware(Cart::class);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('admin/listeProducts', [App\Http\Controllers\AdminController::class, 'indexProducts'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::get('/admin/product/{id}', [App\Http\Controllers\AdminController::class, 'editProduct'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::post('/admin/product/modificationProduct' ,[App\Http\Controllers\AdminController::class, 'confirmModifProduct'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::post('/admin/listeUser/modifstate' ,[App\Http\Controllers\AdminController::class, 'modifState'])
->middleware(['auth', 'verified'])
->name('dashboard');


Route::get('/admin/listeUser' ,[App\Http\Controllers\AdminController::class, 'indexUsers'])
->middleware(['auth', 'verified'])
->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});


require __DIR__.'/auth.php';
