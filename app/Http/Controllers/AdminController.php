<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        if($user->usertype == "user")
        {
            return view('dashboard');
        }
        else{
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


            return view('admin.dashboard', compact("panierFormat"));
        }

      

    }

    public function indexProducts(Request $request)
    {

        $user = Auth::user();

        if($user->usertype == "user")
        {
            return view('dashboard');
        }
        else{
            $listProduits = Product::paginate(60);



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
            return view('admin.products', compact('listProduits', 'panierFormat'));
        }
    }

    public function editProduct($id, Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            return view('dashboard');
        }
        else{
            $productShow = Product::find($id);
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
            return view('admin.editProduct', compact('productShow', 'panierFormat'));
        }
    }
    public function confirmModifProduct(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            return view('dashboard');
        }
        else{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                // Ajoutez d'autres règles de validation si nécessaire
            ]);
            
            // Trouver le produit par son ID
            $productShow = Product::findOrFail($request->idProduct);
    
            // Mettre à jour les informations du produit
            $productShow->name = $request->input('name');
            $productShow->price = $request->input('price');
            $productShow->description = $request->input('description');
            // Mettre à jour d'autres champs si nécessaire
            
            // Sauvegarder les modifications
            $productShow->save();

            $productShow = Product::find($request->idProduct);



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
            return view('admin.editProduct', compact('productShow', 'panierFormat'));
        }
    }



    public function indexUsers(Request $request)
    {

        $user = Auth::user();

        if($user->usertype == "user")
        {
            return view('dashboard');
        }
        else{
            $listUsers = User::all();

            dd($listUsers);
            
            


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
            return view('admin.users', compact('listUsers', 'panierFormat'));
        }
    }

    public function editUser($id, Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            return view('dashboard');
        }
        else{
            $product = Product::find($id);
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
            return view('admin.editUser', compact('product', 'panierFormat'));
        }
    }
    public function confirmModifUser(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            return view('dashboard');
        }
        else{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                // Ajoutez d'autres règles de validation si nécessaire
            ]);
            
            // Trouver le produit par son ID
            $product = Product::findOrFail($request->idProduct);
    
            // Mettre à jour les informations du produit
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            // Mettre à jour d'autres champs si nécessaire
            
            // Sauvegarder les modifications
            $product->save();



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
            return view('admin.editUser', compact('product', 'panierFormat'));
        }
    }
}
