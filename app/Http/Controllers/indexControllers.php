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

        // Retourner la vue avec les données
        return view('index', compact('request','productsPlusVendu', 'productsNouveuté'));
    }
}
