@include("header")
<title>Accueil - SignalSphere</title>
<section class="section1Index" style='background-image: url("image/section1Index.png");'>
    <div class="fond">


        <div class="container">
            <h1>Télécomunication</h1>
            <p>PMR446, Talki Walki ...</p><br>
            <a hrefx="#" class="decouvrir">Découvrir notre sélection</a>
        </div>

    </div>

</section>


    <div class="fondListeProduit">
        <div class="container">
            <div class="listeProduit">
                <h2>Les plus vendu</h2>
                @foreach ($productsPlusVendu as $article)
                <div class="produit">
                    <img src="image/product/{{ $article->pictures }}" alt="">
                    <p><strong>{{ $article->name }}</strong></p>
                    <p class="prix">{{ $article->price }} €</p>
                    <a href="/products/{{ $article->id }}">Voir</a>
                </div>
                @endforeach
            </div>
        
        </div>
    </div>


    <div class="Apropos">
        <div class="container">
            <div class="text">
                <h2>Bienvenu sur SignalSphere !</h2>
                <p>Chez SignalSphere, nous comprenons l'importance de rester connecté, que ce soit lors de vos aventures en plein air, de vos missions professionnelles ou simplement lors de vos escapades quotidiennes. C'est pourquoi nous sommes fiers de vous présenter une gamme exclusive de talkies-walkies portatifs, conçus pour répondre à vos besoins de communication les plus exigeants.</p>
                <p>Chez SignalSphere, nous nous engageons à offrir à nos clients une expérience d'achat exceptionnelle. Notre équipe de spécialistes est là pour répondre à toutes vos questions et vous guider dans le choix du talkie-walkie idéal pour vos besoins spécifiques. De plus, avec notre service de livraison rapide et fiable, vous pouvez commencer à profiter de votre nouveau talkie-walkie en un rien de temps.</p>
            </div>
            <img class="imgApropos" src="image/indexSection1Apropos.png">
        </div>
    </div>

    <div class="fondListeProduit">
        <div class="container">
            <div class="listeProduit">
                <h2>Nouveauté</h2>
                @foreach ($productsNouveuté as $article)
                <div class="produit">
                    <img src="image/product/{{ $article->pictures }}" alt="" class="imgProduit">
                    <p><strong>{{ $article->name }}</strong></p>
                    <p class="prix">{{ $article->price }} €</p>

                    <a href="/products/{{ $article->id }}">Voir</a>
                </div>
                @endforeach
            </div>
        
        </div>
    </div>

</body>
@include("footer")