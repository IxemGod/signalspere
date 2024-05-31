@include("header");
<title>Validation de la commande</title>

<section class="formulairecommander">
    <div class="container">
        <h1>Validation de votre commande</h1>

        <form action="/commander/validate" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nom et prénom" required>
            <input type="text" name="email" placeholder="Adresse Mail" required>
            <input type="text" name="street" placeholder="N° & nom de rue"required>
            <input type="text" name="postalcode" placeholder="Code Postal" required>
            <input type="text" name="city" placeholder="Ville" required>
            <input type="text" name="promocode" placeholder="Code promo ?">

            <p>Prix commande : {{$totalpriceProduct}}€</p>
            <p>Livraison : +{{$pricelivraison}}€</p>
            <p>Prix total : {{$totalprice}}€</p>

            <button>Valider la commande</button>
        </form>


    </div>
</section>

@include("footer");