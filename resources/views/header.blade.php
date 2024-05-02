
@vite(['resources/css/app.css','resources/scss/app.scss','resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/fcb8c34dd8.js" crossorigin="anonymous"></script>
</head>

<header>
    <div class="premierbandeau">
        <p>La livraison est OFFERTE dès 49€ d'achat, alors profitez-en !</p>
    </div>

    <nav class="deuxièmebeandeau">
        <img src="image/logo.png">
        <a href="/home">Accueil</a>
        <a href="#">Boutique</a>
        <a href="#">Code promo</a>
        <a href="#">Contact</a>
        <a href="#">A propos</a>

        <div class="searchBar">
            <form>
                <input type="text">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="EspaceMembrePanier">       
            <i class="fa-solid fa-user"></i>
            <i class="fa-solid fa-cart-shopping"></i>
        </div>



    </nav>
</header>

<body>
