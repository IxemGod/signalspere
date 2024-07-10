<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class PanierController extends Controller
{
    public function index(Request $request)
    {
        
        return view('panier', compact("request"));
    }
}
