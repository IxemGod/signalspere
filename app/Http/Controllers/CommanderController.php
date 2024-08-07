<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\User;
use App\Models\Commande;
use App\Models\Adresse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\ProductCommande;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

 
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
        return view('commander', compact('panierFormat',"request",'totalprice','totalpriceProduct','pricelivraison'));

    }


    public function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD-' . strtoupper(Str::random(10));
        } while (Commande::where('numeroCommande', $orderNumber)->exists());

        return $orderNumber;
    }


    public function validate(Request $request)
    {    
        // try {
       
            
            $code = "red";
            $message = "Vos informations sont incorect";
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

                $code = "red";
                $message = "Vos informations ne sont incorect";
                
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'street' => 'required|string|max:255',
                    'postalcode' => 'required|string|max:11|regex:/^\d+$/',
                    'promocode' => 'nullable|string|max:150', // Le code promo est facultatif
                    'city' => 'required|string|max:150',
                    'email' => 'required|string|email|max:255',
                ]);
                if ($validator->fails())
                {
                    $message = "Vos informations sont incorect !";
                    $code = "red";
                }
                else{
                                    
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

                    $numeroCommande = $this->generateOrderNumber();
                    $commande = new Commande();
                    $commande->date = now(); // Utilisez la date actuelle
                    $commande->numeroCommande = $numeroCommande;
                    $commande->price = $totalprice - $reduction; // Soustraire la réduction du prix total
                    $commande->id_codepromo = $promoCode ? $promoCode->id : null; // Si un code promo a été utilisé, enregistrer son ID
                    
                    if (auth()->check()) {
                        // Si un utilisateur est authentifié, enregistrer son ID
                        $commande->id_user = auth()->user()->id;
                    } else {
                        $userTest = User::where('email', $request->email)->first();

                        if ($userTest) {
                            // Gérer le cas où l'utilisateur existe déjà (par exemple, retourner une erreur)
                            $message =  "L'utilisateur avec l'adresse e-mail $request->email existe déjà.";
                            $code = "red";
                            // return Redirect::route('commander')->with('code', $code)->with('message', $message);
                        } else {
                            // Si aucun utilisateur n'est authentifié, insérer null
                        $user = new User();
                        $user->name = $request->name;
                        $user->email = $request->email;
                        // Générer un mot de passe aléatoire
                        $psw = Str::random(12);
                        // Hasher le mot de passe
                        $hashedPassword = Hash::make($psw);
                        // Stocker le mot de passe hashé dans l'utilisateur
                        $user->password = $hashedPassword;
                        $user->usertype = "user";
                        $user->state = "true";
                        // Enregistrer l'utilisateur
                        $user->save();
                        // Récupérer l'ID de l'utilisateur créé
                        $userId = $user->id;
                        $commande->id_user = $user->id;
                        $message = "Votre commande à été valider";
                        $code = "green";
                        }
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

                    $adresse = new Adresse();
                    $adresse->id_commande = $commande->id;
                    $adresse->street = $request->input('street');
                    $adresse->postalcode = $request->input('postalcode');
                    $adresse->city = $request->input('city');
                    $adresse->save();
                    

                    $message = "Commande validée avec succès !";
                    $code = "green";
        
                }
            $test = "caca";
            return Redirect::route('commander')->with('code', $code)->with('message', $message)->with("test" , $test);
    }
}
