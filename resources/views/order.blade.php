@include("header")
<section class="detailCommande">
    <h2>Détail de votre commande</h2>

    <p>Coût total de la commande : {{$order->price}} €</p>
    <p>{{$order->date}} </p>
    <table>
        <thdead>
            <tr>
                <!-- <td></td> -->
                <td colspan="2">Produit</td>
                <td>Prix Unitaire</td>
                <td>Quantité</td>
            </tr>
        </thdead>

        <tbody>
            @foreach($productsliste as $product)
                <tr>
                    <td><img src="/image/product/{{$product['pictures']}}"></td>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['price']}}</td>
                    <td>{{$product['quantity']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</section>
@include("footer")