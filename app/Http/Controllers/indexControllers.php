<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class indexControllers extends Controller
{
    public function index(Request $request)
    {
        $productsPlusVendu = Product::take(5)->get();

        // $productsNouveuté = Product::inRandomOrder()->take(5)->get();

        $categoryId = "icom"; // Remplacez 1 par l'ID de la catégorie spécifique que vous recherchez

        $productsNouveuté = DB::table('products')
            ->join('category', 'products.id', '=', 'category.id_products')
            ->where('category.name', $categoryId)
            ->select('products.*')
            ->take(5)
            ->get();

        foreach ($productsNouveuté as $product) {
            // Parcourir chaque champ du produit
            foreach ($product as $key => $value) {
                // Vérifier si la valeur est une chaîne de caractères et tronquer si nécessaire
                if ($key !== 'pictures' && is_string($value)) {
                    // Tronquer la valeur à 30 caractères
                    $product->{$key} = strlen($value) > 30 ? substr($value, 0, 30) . '...' : $value;
                }
            }
        }

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


        // Afficher le contenu du panier
        // return view('cart', ['cart' => $cart]);

        // Retourner la vue avec les données
        return view('index', compact('productsPlusVendu', 'productsNouveuté', 'panierFormat'));
    }
}
