<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Récupérer les données de la requête
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Quantité par défaut est 1

        // Récupérer le panier actuel depuis les cookies
        $cart = json_decode($request->cookie('cart'), true);

        // Ajouter le produit au panier
        if (!isset($cart[$productId])) {
            $cart[$productId] = 0;
        }

        $cart[$productId] += $quantity;

        // Mettre à jour le cookie du panier
        return redirect()->back()->withCookie(cookie('cart', json_encode($cart), 99960));


    }

    public function showCart(Request $request)
    {
        // Récupérer le contenu du panier depuis les cookies
        $cart = json_decode($request->cookie('cart'), true);

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

        // Afficher le contenu du panier
        return view('cart', ['cart' => $cart, 'panierFormat' => $panierFormat]);
    }
}
