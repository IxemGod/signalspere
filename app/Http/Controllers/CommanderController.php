<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Commande;
use App\Models\ProductCommande;


class CommanderController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->cookie('cart');

        $panierFormat = [];

        // Vérifier si le cookie existe
        if ($cart !== null) {
            $cart = json_decode($cart, true);

            $totalpriceProduct = 0;

            foreach($cart as $productId => $quantity)
            {
                $product = Product::find($productId);
                if ($product) {
                    // Exemple d'utilisation correcte de setAttribute()
                    $product->setAttribute('quantity', $quantity);
                    $totalpriceProduct = $totalpriceProduct + $quantity * $product->price;
                    $product->setAttribute('total_price', $quantity * $product->price);

                    array_push($panierFormat, $product);
                }
            }

            $pricelivraison =  ((5*$totalpriceProduct)/100);
            $pricelivraison = round($pricelivraison, 2);

            $totalprice = $totalpriceProduct+$pricelivraison;
        } else {
            // Si le cookie n'existe pas, initialisez le panier comme vide ou avec une autre logique selon vos besoins
            $panierFormat = [];
        }
        return view('commander', compact('panierFormat','totalprice','totalpriceProduct','pricelivraison'));

    }


    public function validate(Request $request)
    {    
        try {
            $cart = $request->cookie('cart');

                $panierFormat = [];

                // Vérifier si le cookie existe
                if ($cart !== null) {
                    $cart = json_decode($cart, true);

                    $totalpriceProduct = 0;

                    foreach($cart as $productId => $quantity)
                    {
                        $product = Product::find($productId);
                        if ($product) {
                            // Exemple d'utilisation correcte de setAttribute()
                            $product->setAttribute('quantity', $quantity);
                            $totalpriceProduct = $totalpriceProduct + $quantity * $product->price;
                            $product->setAttribute('total_price', $quantity * $product->price);

                            array_push($panierFormat, $product);
                        }
                    }
                    
                    $pricelivraison =  ((5*$totalpriceProduct)/100);
                    $pricelivraison = round($pricelivraison, 2);

                    $totalprice = $totalpriceProduct+$pricelivraison;
                } else {
                    // Si le cookie n'existe pas, initialisez le panier comme vide ou avec une autre logique selon vos besoins
                    $panierFormat = [];
                }
                
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'street' => 'required|string|max:255',
                    'postalcode' => 'required|string|max:11',
                    'promocode' => 'nullable|string|max:150', // Le code promo est facultatif
                    'city' => 'required|string|max:150',
                    'email' => 'required|string|email|max:255',
                ]);
                
                // Vérification de l'existence et du calcul de la réduction du code promo
                $reduction = 0;
                $promoCode = null; // Initialiser à null
                if ($request->filled('promocode')) {
                    $promoCode = PromoCode::where('code', $request->promocode)->first();
                    if ($promoCode) {
                        // Le code promo existe, calculer la réduction en pourcentage
                        $reduction = ($promoCode->reduction / 100) * $totalprice; // Supposons que $totalPrice contient le prix total
                    }
                }
            
                // Création d'une nouvelle commande
                $commande = new Commande();
                $commande->date = now(); // Utilisez la date actuelle
                $commande->price = $totalprice - $reduction; // Soustraire la réduction du prix total
                $commande->id_codepromo = $promoCode ? $promoCode->id : null; // Si un code promo a été utilisé, enregistrer son ID
                
                if (auth()->check()) {
                    // Si un utilisateur est authentifié, enregistrer son ID
                    $commande->id_user = auth()->user()->id;
                } else {
                    // Si aucun utilisateur n'est authentifié, insérer null
                    $commande->id_user = null;
                }

                $commande->save();
                
                // Insérer les détails de la commande dans la table product_commande
                foreach ($panierFormat as $product) {
                    $product = Product::find($product->id);
                    if ($product) {
                        $productCommande = new ProductCommande();
                        $productCommande->id_command = $commande->id;
                        $productCommande->id_product = $product->id; // Supposons que $product->id contient l'ID du produit
                        $productCommande->quantity = $product->quantity; // Supposons que $product->quantity contient la quantité du produit
                        $productCommande->save();
                    }
                }

                $message = "Commande validée avec succès !";
                $code = "success";
            
            // En cas de succès, rediriger vers la vue response avec un message
            return view('response', compact('panierFormat','code','message'));
        } catch (\Exception $e) {
            $message = "Quelque chose s'est mal passé";
            $code = "error";
            // En cas d'erreur, rediriger vers la page précédente avec un message d'erreur
            return view('response', compact('panierFormat','code','message'));
        }
    }
}
