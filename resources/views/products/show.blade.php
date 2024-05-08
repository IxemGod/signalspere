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
    
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="1">
                <input type="number" name="quantity" value="1" min="1"> 
                <button>Ajouter au panier</button>
            </form>
        </div>
    </div>


    <fieldset>
        <legend>Description</legend>
        <?php
            echo "$product->description";
        ?>
    </fieldset>
</section>
    


@include("footer")