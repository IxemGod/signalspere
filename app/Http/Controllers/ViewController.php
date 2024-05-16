<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ViewController extends Controller
{
    public function contact(Request $request)
    {
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
        return view('contact', compact('panierFormat'));
}

public function apropos(Request $request)
{
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
    return view('apropos', compact('panierFormat'));
}
}
