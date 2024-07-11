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
            
            $message = $request->message;

            return view('dashboard', compact("request", "user", "orderCount", "total_price", "Nbrproducts", "message", "orders"));
        }
        elseif($user->usertype == "admin" and $user->state == "true"){
            
            return view('admin.dashboard', compact("request"));
        }
        else{
            
            return view('auth.login', compact("request"));
        }
    }

    public function indexProductsAdmin(Request $request)
    {

        $user = Auth::user();

        if($user->usertype == "user")
        {
            
            return view('dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));
            
        }
        else{
            $listProduits = Product::paginate(60);
            
            return view('admin.products', compact('request','listProduits'));
        }
    }

    public function editProductAdmin($id, Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            
            return view('dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));
            
        }
        else{
            $productShow = Product::find($id);
            
            return view('admin.editProduct', compact('request','productShow'));
        }
    }
    public function confirmModifProductAdmin(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            
            return view('dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));
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
                
                $status = "green";
                $message = "Les informations ont été modifié";
            }
            
            return view('admin.editProduct', compact('request','productShow'))->with('statusEditProduct', $status)->with('message', $message);;
        }
    }

    public function indexUsersAdmin(Request $request)
    {

        $user = Auth::user();

        if($user->usertype == "user")
        {
            
            return view('dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));
            
        }
        else{

            $listUsers = User::where('id', '!=', $user->id)->get();
            
            return view('admin.users', compact('request','listUsers'));
        }
    }

    public function modifStateAdmin(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "user")
        {
            
            return view('dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));
            
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
            
            return view('admin.users', compact('request', 'listUsers'));
        }
    }  


    public function confirmModifUserClient(Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "admin")
        {
            
            return view('admin.dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));    
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
            
            return view('admin.dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));
            
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

    public function showOrder($idCommande, Request $request)
    {
        $user = Auth::user();
        if($user->usertype == "admin")
        {
            
            return view('admin.dashboard', compact("request"));
        }
        elseif($user->state != "true"){
            
            return view('auth.login', compact("request"));
            
        }
        else{
            // dd($numerocommande);
            $order = Commande::find($idCommande);

            if($order->id_user == $user->id)
            {

                $products = ProductCommande::where("id_command", $idCommande)->get();
                
                // dd($products);
                $productsliste = [];
                foreach($products as $product){
                    $productInfo = Product::find($product->id_product);
                    $data = [
                        'quantity' => $product->quantity,
                        'name' => $productInfo->name,
                        'pictures' => $productInfo->pictures,
                        'price' => $productInfo->price,
                        'id' => $productInfo->id
                    ];
                    $productsliste[] = $data;
                }
                return view('order', compact("request", "order","productsliste"));
            }
            else{
                return view('auth.login', compact("request"));
            }

        }
    }
    
}
  