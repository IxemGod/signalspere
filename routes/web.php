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
use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;


use App\Http\Middleware\Cart;
use App\Http\Middleware\InfoUser;

Route::get('/', [indexControllers::class, 'index'])->middleware(Cart::class);
Route::get('/boutique', [BoutiqueController::class, 'index'])->name('articles.index')->middleware(Cart::class);
Route::get('/panier', [PanierController::class, 'index'])->name('articles.index')->middleware(Cart::class);
Route::get('/boutique/filter', [BoutiqueController::class, 'index'])->name('articles.filter')->middleware(Cart::class);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->middleware(Cart::class);
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add')->middleware('web');
Route::post('/cart/delete/{id}', [CartController::class, 'deleteToCart']);
Route::get('/detail/{numeroCommande}', [AdminController::class, 'showOrder'])->middleware(Cart::class);
Route::get('/search', [BoutiqueController::class, 'search'])->middleware(Cart::class)->name('search');
Route::get('/commander', [CommanderController::class, 'show'])->name("commander")->middleware(Cart::class);
Route::post('/commander/validate', [CommanderController::class, 'validate']);
Route::get('/contact', function () {
    $request = request();
    return view('contact', compact("request"));
})->middleware(Cart::class);
Route::get('/apropos', function () {
    $request = request();
    return view('apropos', compact("request"));
})->middleware(Cart::class);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/politique', function () {
    $request = request();
    return view('confidentialite', compact("request"));
})->middleware(Cart::class);
Route::get('/code-promo', function () {
    $request = request();
    return view('promocode', compact("request"));
})->middleware(Cart::class);

Route::get('/mentions-légales', function () {
    $request = request();
    return view('mentionslegales', compact("request"));
})->middleware(Cart::class);

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])
    ->middleware(['auth', 'verified', Cart::class, InfoUser::class])
    ->name('dashboard');
Route::get('admin/listeProducts', [App\Http\Controllers\AdminController::class, 'indexProductsAdmin'])
->middleware(['auth', 'verified', Cart::class]);
Route::get('/admin/product/{id}', [App\Http\Controllers\AdminController::class, 'editProductAdmin'])
->middleware(['auth', 'verified', Cart::class]);
Route::post('/admin/product/modificationProduct' ,[App\Http\Controllers\AdminController::class, 'confirmModifProductAdmin'])
->middleware(['auth', 'verified', Cart::class]);
Route::post('/modificationUserClient' ,[App\Http\Controllers\AdminController::class, 'confirmModifUserClient'])
->middleware(['auth', 'verified', Cart::class]);
Route::post('/modificationPswdClient' ,[App\Http\Controllers\AdminController::class, 'confirmModifMdpClient'])
->middleware(['auth', 'verified', Cart::class]);
Route::post('/admin/listeUser/modifstate' ,[App\Http\Controllers\AdminController::class, 'modifStateAdmin'])
->middleware(['auth', 'verified', Cart::class]);
Route::get('/admin/listeUser' ,[App\Http\Controllers\AdminController::class, 'indexUsersAdmin'])
->middleware(['auth', 'verified', Cart::class]);
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
});
require __DIR__.'/auth.php';
