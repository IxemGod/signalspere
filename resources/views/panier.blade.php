@include("header")


<section class="AffichagePanier">
    <div class="container">
        <h1>Votre panier</h1>

        <table>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th></th>
            </th>

            @foreach($request->panierFormat as $product)
            <tr>
                <form method="POST" action="/cart/delete/{{$product->id}}">
                    @csrf

                    <td><img src="/image/product/{{$product->pictures}}"></th>
                    <td>{{$product->name}}</th>
                    <td>{{$product->quantity}}</th>
                    <td>{{$product->total_price}}</th>
                    <td><button type="submit"><i class="fa-solid fa-xmark"></i></button></th>
                </form>
            </tr>
            @endforeach
        </table>
        <a href="/commander" class="validerOrder">Valider la commande</a>
    </div>


</section>



@include("footer")