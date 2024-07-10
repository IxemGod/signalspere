<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id, Request $request)
    {
        $productSolo = Product::find($id);

        return view('products.show', compact('request','productSolo'));
    }
}
