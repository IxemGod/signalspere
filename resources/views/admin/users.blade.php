@include("header");


<section class="AdminListeUsers">
    <div class="containers">
        <h1>Listes des utilisateurs</h1>

        <div class="listeUsers">

        @foreach($listUsers as $user)
            <div class="item">
                <form action="/admin/listeUser/modifstate" method="POST">
                @csrf
                    <img src="image/user/">
                    <div class="info">
                        <p>{{$user->name}}</p>
                        <p>{{$user->email}}</p>
                        <p>{{$user->usertype}}</p>
                        <input type="number" name="id" value="{{$user->id}}" hidden>
                        <input type="text" name="state" value="{{$user->state}}" hidden>
                    </div>
                    @if ($user->state == "true")
                    <button>Désactiver</button>
                    @else
                    <button>Activer</button>
                    @endif
                </form>
            </div>
        @endforeach
        </div>
    </div>
</section>

@include("footer");