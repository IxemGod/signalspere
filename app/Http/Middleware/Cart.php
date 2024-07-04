<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;

class Cart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        
        // Récupérer le contenu du panier depuis les cookies
        $cart = $request->cookie('cart');

        $panierFormat = [];

        // Vérifier si le cookie existe
        if ($cart !== null) {
            $cart = json_decode($cart, true);

            foreach($cart as $productId => $quantity)
            {
                $product = Product::find($productId);
                if ($product) {
                    // Exemple d'utilisation correcte de setAttribute()
                    $product->setAttribute('quantity', $quantity);
                    $product->setAttribute('total_price', $quantity * $product->price);

                    array_push($panierFormat, $product);
                }
            }
        } else {
            // Si le cookie n'existe pas, initialisez le panier comme vide ou avec une autre logique selon vos besoins
            $panierFormat = [];
        }

        $request->panierFormat = $panierFormat;

        return $next($request);
    }
}
