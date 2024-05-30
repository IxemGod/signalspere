<form action="modification" method="POST">
    @csrf
    <img src="/image/product/{{ $product->pictures}}" width="200px"><br>
    <label>Titre</label>
    <input type="text" name="name" value="{{$product->name}}"><br>
    <label>Prix</label>
    <input type="float" name="price" value="{{$product->price}}"><br>
    <input type="hidden" name="idProduct" value="{{$product->id}}€"><br>

    <textarea style="width:500px; height:200px;"  name="description">
        {{$product->description}}
    </textarea><br>

    <button>Modifier</button>
</form>
