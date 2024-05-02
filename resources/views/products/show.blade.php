<!-- resources/views/products/show.blade.php -->
@include("header")
<title>{{ $product->name }} - SignalSphere</title>
<section class="DetailArticle">
    <div class="ImageTitreBtn">
        <img src="https://www.gotechnique.com/{{ $product -> pictures }}" alt="{{ $product->name }}">
        <div>
            <h1><strong>{{ $product->name }}</strong></h1>
            <h2><b>{{ $product->price }} €</b> Net</h2>
    
            <p>{{ $product->name }}</p>
    
            <form>
                <input type="number" value="1">
                <button>Ajouter au panier</button>
            </form>
        </div>
    </div>


    <fieldset>
        <legend>Description</legend>
        <p>{{ $product->description }} </p>
    </fieldset>
</section>
    


@include("footer")