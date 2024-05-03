<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

class BoutiqueController extends Controller
{
    public function index()
    {
        $query = Product::query();

        // Filter by minimum price
        if (request()->has('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }

        // Filter by maximum price
        if (request()->has('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        $articles = $query->paginate(60); // Paginate with 10 items per page

        // Truncate titles to 10 characters
        foreach ($articles as $product) {
            // Truncate the title if it exists
            if (isset($product->name)) {
                // Truncate the title to 10 characters
                $product->name = strlen($product->name) > 35 ? substr($product->name, 0, 35) . '...' : $product->name;
            }
        }
        return view('boutique', compact('articles'));
    }
}
