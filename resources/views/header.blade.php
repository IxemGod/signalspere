
@vite(['resources/css/app.css','resources/scss/app.scss','resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="alternate icon" class="js-site-favicon" type="image/png" href="http://127.0.0.1:8000/image/Favicon.png">
    <script src="https://kit.fontawesome.com/fcb8c34dd8.js" crossorigin="anonymous"></script>
</head>

<header class="headerOrdinateur">
    <div class="premierbandeau">
        <p>La livraison est OFFERTE dès 49€ d'achat, alors profitez-en !</p>
    </div>

    <nav class="deuxièmebeandeau">
        <a href="http://127.0.0.1:8000/">
            <img src="http://127.0.0.1:8000/image/logo.png">
        </a>
        <a href="/">Accueil</a>
        <a href="/boutique">Boutique</a>
        <a href="#">Code promo</a>
        <a href="/contact">Contact</a>
        <a href="/apropos">A propos</a>

        <div class="searchBar">
            <form method="get" action="{{route('search')}}">
            @csrf
                <input type="text" name="search" placeholder="Rechercher un article">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="EspaceMembrePanier">       
        <a href="/dashboard"><i class="fa-solid fa-user"></i></a>
            <i class="fa-solid fa-cart-shopping" style="cursor: pointer;"></i>
        </div>



    </nav>
</header>

<header class="headerMobile">
    <div class="premierbandeau">
        <p>La livraison est OFFERTE dès 49€ d'achat, alors profitez-en !</p>
    </div>

    <div class="deuxièmebeandeau">

        <div class="logo">
            <a href="http://127.0.0.1:8000">
                <img src="/image/logo.png">
            </a>
        </div>

        <div class="searchBar">
            <form method="get" action="{{route('search')}}">
                @csrf
                <input type="text" name="search" placeholder="Rechercher un article">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <i class="fa-solid fa-cart-shopping"></i>


        <i class="fa-solid fa-bars"></i>
        
        <div class="PanierIconMenu">       
        </div>


        <div class="overlay-menu" id="overlay-menu">
            <div class="overlay-content-menu">
            <a href="/">Accueil</a>
            <a href="/boutique">Boutique</a>
            <a href="#">Code promo</a>
            <a href="/contact">Contact</a>
            <a href="/apropos">A propos</a>
            <a href="/dashboard">Espace Membre</a>
            <p class="closeOverlayMenu"><i class="fa-solid fa-xmark"></i> Fermer</p>
            </div>
        </div>


    </div>
</header>

<script>
    // Fonction pour basculer la visibilité du div cible
    function OuvertureDuMenu() {
        var targetDiv = document.getElementById("overlay-menu");
            targetDiv.style.display = "block";
    }

    // Ajoute un gestionnaire d'événements à tous les éléments avec la classe "toggle"
    var btnMenuOuverture = document.querySelectorAll('.fa-bars');
    btnMenuOuverture.forEach(function(element) {
        element.addEventListener('click', OuvertureDuMenu);
    });


    // Fonction pour basculer la visibilité du div cible
    function FermetureDuMenu() {
        var targetDiv = document.getElementById("overlay-menu");
            targetDiv.style.display = "none";
    }

    // Ajoute un gestionnaire d'événements à tous les éléments avec la classe "toggle"
    var btnMenufermeture = document.querySelectorAll('.closeOverlayMenu');
    btnMenufermeture.forEach(function(element) {
        element.addEventListener('click', FermetureDuMenu);
    });
</script>

<div class="fontGris" id="fontGris"></div>

<div class="overlay-cart" id="overlay-cart">
    <div class="cart">
            <h2>Votre panier</h2>
        @foreach($request->panierFormat as $product)
            <div class="product">
                <div class="img">
                    <a href="/products/{{ $product->id }}">
                        <img src="/image/product/{{ $product->pictures }}"> 
                    </a>
                </div>

                <div class="NameQuantitéPrix">
                    <div class="name">
                        <p>{{ $product->name }}</p>
                    </div>

                    <div class="QuantitéPrix">
                        <p>Qnté: {{ $product->quantity }}</p>
                        <p>Prix: {{ $product->price }}</p>
                    </div>
                </div>
            </div>
            @endforeach
       
    </div>
    
    
    <div class="voirPanierCommander">
        <a class="VoirPanier" href="/panier">Voir le panier</a>
        <a class="commander" href="/commander">Commander</a>
    </div>
</div>


<script>
    // Fonction pour basculer la visibilité du div cible
    function OuvertureDuCart() {
        var overlayDivCart = document.getElementById("overlay-cart");
        var FontgrisDivCart = document.getElementById("fontGris");
        overlayDivCart.style.display = "flex";
        FontgrisDivCart.style.display = "block";
    }

    // Ajoute un gestionnaire d'événements à tous les éléments avec la classe "toggle"
    var btnCartOuverture = document.querySelectorAll('.fa-cart-shopping');
    btnCartOuverture.forEach(function(element) {
        element.addEventListener('click', OuvertureDuCart);
    });


    // Fonction pour basculer la visibilité du div cible
    function FermetureDuCart() {
        var overlayDivCart = document.getElementById("overlay-cart");
        var FontgrisDivCart = document.getElementById("fontGris");
        overlayDivCart.style.display = "none";
        FontgrisDivCart.style.display = "none";

    }

    // Ajoute un gestionnaire d'événements à tous les éléments avec la classe "toggle"
    var btnCartfermeture = document.querySelectorAll('.fontGris');
    btnCartfermeture.forEach(function(element) {
        element.addEventListener('click', FermetureDuCart);
    });</script>

<body>
