@include("header")
<title>Boutique - SignalSphere</title>
<section class="affichageArticleDansBoutique">

{{ $articles->links() }}


    <div class="container">
        <div class="filtrePrix">
            <p><b>Filtrer par prix</b></p>
            <form action="{{ route('articles.filter') }}" method="GET">
                <div>
                    <label for="min_price">Prix minimum :&nbsp;</label>
                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="0">
                </div>
                <div>
                    <label for="max_price">Prix maximum :</label>
                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="+">

                </div>
                <button type="submit">Filtrer</button>
            </form>

            <div class="separation"></div>

            <ul>
                <li><a href="#"> KENWOOD</a></li>
                <li><a href="#"> BAOFENG</a></li>
                <li><a href="#"> MOTOROLLA</a></li>
                <li><a href="#"> PRESIDENT</a></li>
                <li><a href="#"> YAESEU</a></li>
            </ul>

        </div>

        <div class="listeProduit">
            @foreach ($articles as $article)
            <div class="produit">
                <img src="image/product/{{ $article->pictures }}" alt="" class="imgProduit">
                <p><strong>{{ $article->name }}</strong></p>
                <p class="prix">{{ $article->price }} €</p>

                <a href="/products/{{ $article->id }}">Voir</a>
            </div>
            @endforeach
        </div>
    </div>

    {{ $articles->links() }}
</section>


@include("footer")