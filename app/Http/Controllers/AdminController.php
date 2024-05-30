<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
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
            $listProduits = Product::all();
            return view('products', compact('listProduits'));
        }

      

    }
}
