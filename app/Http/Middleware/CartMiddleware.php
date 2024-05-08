<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class CartMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Récupérer le contenu du panier depuis les cookies
        $cart = json_decode($request->cookie('cart'), true);

        $panierFormat = array();

        foreach($cart as $productId => $quantity)
        {
            $product = Product::find($productId);
            array_push($panierFormat, $product);
        }

        // Mettre le contenu du panier à disposition de toutes les vues
        View::share('cart', $panierFormat);

        return $next($request);
    }
}
