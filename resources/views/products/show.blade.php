<!-- resources/views/products/show.blade.php -->
@include("header")
<title>{{ $productSolo->name }} - SignalSphere</title>
<section class="DetailArticle">
    <div class="ImageTitreBtn">
        <img src="/image/product/{{ $productSolo -> pictures }}" alt="{{ $productSolo->name }}">
        <div>
            <h1><strong>{{ $productSolo->name }}</strong></h1>
            <h2><b>{{ $productSolo->price }} €</b> Net</h2>
    
            <p>{{ $productSolo->name }}</p>
    
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productSolo->id }}">
                <input type="number" name="quantity" value="1" min="1"> 
                <button>Ajouter au panier</button>
            </form>
        </div>
    </div>


    <fieldset>
        <legend>Description</legend>
        <?php
            echo "$productSolo->description";
        ?>
    </fieldset>
</section>
    

<!-- d -->
@include("footer")