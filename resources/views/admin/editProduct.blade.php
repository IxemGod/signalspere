@include("header");
<title>Edtion du produit</title>
<section class="formulaireAdminModifProduct">
    <form action="modificationProduct" method="POST" >
        @csrf
        <img src="/image/product/{{ $productShow->pictures}}" width="200px">
        <p><label>Titre</label>
        <input type="text" name="name" value="{{$productShow->name}}"></p>
        <p><label>Prix</label>
        <input type="float" name="price" value="{{$productShow->price}}"></p>
        <input type="hidden" name="idProduct" value="{{$productShow->id}}">
    
        <textarea style="width:500px; height:200px;"  name="description">
            {{$productShow->description}}
        </textarea><br>
    
        <button>Modifier</button>
    </form>
</section>
@include("footer");

