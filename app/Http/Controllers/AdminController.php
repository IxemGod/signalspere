<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Commande;
use App\Models\ProductCommande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user" and $user->state == "true")
        {
            $orderCount = Commande::where('id_user', $user->id)->count();
            $orders = Commande::where('id_user', $user->id)->get();
            $total_price = 0.00;
            $Nbrproducts = 0;
            foreach($orders as $order){
                $total_price = $total_price + $order->price;
                $products = ProductCommande::where('id_command', $order->id)->get();
                foreach( $products as $product)
                {
                    $Nbrproducts = $Nbrproducts + $product->quantity;
                }
            }     
            $panierFormat = $request->panierFormat;
            $message = $request->message;
            return view('dashboard', compact("panierFormat", "user", "orderCount", "total_price", "Nbrproducts", "message"));
        }
        elseif($user->usertype == "admin" and $user->state == "true"){
            $panierFormat = $request->panierFormat;
            return view('admin.dashboard', compact("panierFormat"));
        }
        else{
            $panierFormat = $request->panierFormat;
            return view('auth.login', compact("panierFormat"));
        }
    }

    public function indexProductsAdmin(Request $request)
    {

        $user = Auth::user();

        if($user->usertype == "user")
        {
            $panierFormat = $request->panierFormat;
            return view('dashboard', compact("panierFormat"));
        }
        elseif($user->state != "true"){
            $panierFormat = $request->panierFormat;
            return view('auth.login', compact("panierFormat"));
            
        }
        else{
            $listProduits = Product::paginate(60);
            $panierFormat = $request->panierFormat;
            return view('admin.products', compact('listProduits', 'panierFormat'));
        }
    }

    public function editProductAdmin($id, Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            $panierFormat = $request->panierFormat;
            return view('dashboard', compact("panierFormat"));
        }
        elseif($user->state != "true"){
            $panierFormat = $request->panierFormat;
            return view('auth.login', compact("panierFormat"));
            
        }
        else{
            $productShow = Product::find($id);
            $panierFormat = $request->panierFormat;
            return view('admin.editProduct', compact('productShow', 'panierFormat'));
        }
    }
    public function confirmModifProductAdmin(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            $panierFormat = $request->panierFormat;
            return view('dashboard', compact("panierFormat"));
        }
        elseif($user->state != "true"){
            $panierFormat = $request->panierFormat;
            return view('auth.login', compact("panierFormat"));
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                // Ajoutez d'autres règles de validation si nécessaire
            ]);

            if ($validator->fails()) {
                $status = "red";
                $message = "Les informations sont incorects.";
            }
            else{
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
                $panierFormat = $request->panierFormat;
                $status = "green";
                $message = "Les informations ont été modifié";
            }
            
            return view('admin.editProduct', compact('productShow', 'panierFormat'))->with('statusEditProduct', $status)->with('message', $message);;
        }
    }

    public function indexUsersAdmin(Request $request)
    {

        $user = Auth::user();

        if($user->usertype == "user")
        {
            $panierFormat = $request->panierFormat;
            return view('dashboard', compact("panierFormat"));
        }
        elseif($user->state != "true"){
            $panierFormat = $request->panierFormat;
            return view('auth.login', compact("panierFormat"));
            
        }
        else{

            $listUsers = User::where('id', '!=', $user->id)->get();
            $panierFormat = $request->panierFormat;
            return view('admin.users', compact('listUsers', 'panierFormat'));
        }
    }

    public function modifStateAdmin(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            $panierFormat = $request->panierFormat;
            return view('dashboard', compact("panierFormat"));
        }
        elseif($user->state != "true"){
            $panierFormat = $request->panierFormat;
            return view('auth.login', compact("panierFormat"));
            
        }
        else{
            if($request->state == "true"){
                $stateChage = "false";
            }
            else{
                $stateChage = "true";
            }
            $request->validate([
                'state' => 'required|string|max:11'
                // Ajoutez d'autres règles de validation si nécessaire
            ]);
            $user = User::findOrFail($request->id);
            $user->state = $stateChage;
            $user->save();
            $listUsers = User::where('id', '!=', $user->id)->get();
            $panierFormat = $request->panierFormat;
            return view('admin.users', compact('listUsers', 'panierFormat'));
        }
    }  


    public function confirmModifUserClient(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "admin")
        {
            $panierFormat = $request->panierFormat;
            return view('admin.dashboard', compact("panierFormat"));
        }
        elseif($user->state != "true"){
            $panierFormat = $request->panierFormat;
            return view('auth.login', compact("panierFormat"));    
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/^[0-9]{10}$/',
            ]);


            if ($validator->fails()) {
                $status = "red";
                $message = "Vos informations sont incorects.";
            }
            else{
                $users = User::findOrFail($request->id);
                $users->name = $request->input('name');
                $users->email = $request->input('email');
                $users->phone = $request->input('phone');
                $users->save();
                $status = "green";
                $message = "Vos informations ont été modifiés";
            }
            return Redirect::route('dashboard')->with('statusSettings', $status)->with('message', $message);

        }
    }

    public function confirmModifMdpClient(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "admin")
        {
            $panierFormat = $request->panierFormat;
            return view('admin.dashboard', compact("panierFormat"));
        }
        elseif($user->state != "true"){
            $panierFormat = $request->panierFormat;
            return view('auth.auth.login', compact("panierFormat"));
            
        }
        else{
            $validator = Validator::make($request->all(), [
                'newPswd' => 'required|string|min:8|max:255',
                'ConfirmPswd' => 'required|string|min:8|max:255'
            ]);
            if ($validator->fails()) {
                $status = "red";
                $message = "Votre mot de passe doit faire entre 8 et 255 caractères.";

            }
            else{

                if($request->newPswd == $request->ConfirmPswd)
                {
                    $password = Hash::make($request->ConfirmPswd);
                    $users = User::findOrFail($request->id);
                    $users->password = $password;
                    $users->save();
                    $status = "green";
                    $message = "Votre mot de passe à été modifié.";
                }
                else{
                    $status = "red";
                    $message = "Vos deux mot de passes ne se correspondent pas.";   
                }
            }
            return Redirect::route('dashboard')->with('statusPswd', $status)->with('message', $message);

        }
    }
    
}
  