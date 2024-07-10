<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

use App\Models\Product;

class BoutiqueController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $queryCat = Category::all();
        $listeArticleCategoryReq = array();
        
        if (request()->has('category')) {
    
            foreach($queryCat as $categoryCurrent)
            {
       
                if($categoryCurrent->name ==  strtolower(request('category'))){
                    $listeArticleCategoryReq[] = Product::find($categoryCurrent->id_products);
                }
            }
        }
        else{
            $listeArticleCategoryReq = Product::all();
        }



        // Filter by minimum price
        if (request()->has('min_price')) {
            $prix_min = request('min_price');
            if($prix_min == null)
            {
                $prix_min = 0;
            }
            $query->where('price', '>=', $prix_min);
        }

        // Filter by maximum price
        if (request()->has('max_price')) {
            $prix_max = request('max_price');
            if($prix_max == null)
            {
                $prix_max = 200;
            }
            
            $query->where('price', '<=', $prix_max);
        }

        if(count($listeArticleCategoryReq) == 0)
        {
            $articles = $query;
            // Truncate titles to 10 characters
            foreach ($articles as $product) {
                // Truncate the title if it exists
                if (isset($product->name)) {
                    // Truncate the title to 10 characters
                    $product->name = strlen($product->name) > 35 ? substr($product->name, 0, 35) . '...' : $product->name;
                }
            }
        }
        else{
        $articles = $listeArticleCategoryReq;
        }


        $listecategories = Category::all();
        $ListeCategoryUnique = array();
        foreach($listecategories as $dataOneCategori){
            if(!in_array(strtoupper($dataOneCategori->name), $ListeCategoryUnique) and $dataOneCategori->name != "new")
            {
                $ListeCategoryUnique[] = strtoupper($dataOneCategori->name);
            }
        }

        
        return view('boutique', compact('request','articles' ,'ListeCategoryUnique'));
    }
}
