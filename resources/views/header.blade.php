
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
        <a href="http://127.0.0.1:8000/">Accueil</a>
        <a href="#">Boutique</a>
        <a href="#">Code promo</a>
        <a href="/contact">Contact</a>
        <a href="#">A propos</a>

        <div class="searchBar">
            <form>
                <input type="text" placeholder="Rechercher un article">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="EspaceMembrePanier">       
            <i class="fa-solid fa-user"></i>
            <i class="fa-solid fa-cart-shopping"></i>
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
                <img src="http://127.0.0.1:8000/image/logo.png">
            </a>
        </div>

        <div class="searchBar">
            <form>
                <input type="text" placeholder="Rechercher un article ">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <i class="fa-solid fa-cart-shopping"></i>


        <i class="fa-solid fa-bars"></i>
        
        <div class="EspaceMembrePanier">       
        </div>


    </div>
</header>

<body>
