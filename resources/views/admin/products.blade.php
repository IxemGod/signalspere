@include("header");

<title>Listes des produits</title>

<section class="sectionAdministateurListeProduit">
    
    <div class="container">
        <h1>Liste des produits</h1>
        
        {{ $listProduits->links() }}
         <div class="listProducts">

            @foreach($listProduits as $product)
            <div class="item">
                <img src="/image/product/{{ $product->pictures}}">

                <div class="titlePrice">
                    <p>{{$product->name}}</p>
                    <p>{{$product->price}}€</p>
                </div>

                <button><a href="admin/product/{{$product->id}}">Modifier</a></button>
            </div>

            @endforeach
         </div>
         {{ $listProduits->links() }}
     </div>

</section>



@include("footer");
