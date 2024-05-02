<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class index extends Controller
{
    public function index()
    {
        $products = Product::all();

        // Retourner la vue avec les données
        return view('products.index', compact('products'));
    }
}
