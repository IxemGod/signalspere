@include("header")
    <title>Espace Client</title>
<section class="indexInfoUserDashboard">

    <nav>
        <a href="#profile">Profil</a>
        <a href="#notifications">Notifications</a>
        <a href="#stats">Statistiques</a>
        <a href="#messages">Messages</a>
        <a href="#settings">Paramètres</a>
        <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Déconnexion</button>
        </form>
    </nav>
        <section id="profile" class="card profile-card">
            <img src="https://via.placeholder.com/100" alt="Photo de profil">
            <div>
                <h2>{{$user->name}}</h2>
                <p>{{$user->email}}</p>
            </div>
        </section>
        <section id="stats" class="card stats">
            <div class="stat">
                <h3>Commande passé :</h3>
                <p>{{$orderCount}}</p>
            </div>
            <div class="stat">
                <h3>Coût total des commandes</h3>
                <p>{{$total_price}} €</p>
            </div>
            <div class="stat">
                <h3>Nombre de produit acheté</h3>
                <p>{{$Nbrproducts}}</p>
            </div>
        </section>

        <section id="settings" class="card">
            <h2>Paramètres</h2>
            <!-- <img src="/image/product/" width="200px"> -->
             <div>

                 <form action="modificationUserClient" method="POST" >
                     @csrf
                     <p><label>Nom & prénom</label>
                     <input type="text" name="name" value="{{$user->name}}" required></p>
                     <p><label>Adresse Mail</label>
                <input type="text" name="email" value="{{$user->email}}" required></p>
                <p><label>Téléphone</label>
                <input type="text" name="phone" value="{{$user->phone}}" required></p>
                <input type="number" name="id" value="{{$user->id}}" hidden>
                @if (session('statusSettings'))
                    <p style="color: {{ session('statusSettings') }};">{{ session('message') }}</p>
                @endif  
                <button>Modifier</button>
            </form>
            
            <form action="modificationPswdClient" method="POST" >
                @csrf
                <p><label>Nouveau mot de passe</label>
                <input type="text" name="newPswd"required></p>
                <p><label>Confirmation du mot de passe</label>
                <input type="text" name="ConfirmPswd" required></p>
                <input type="number" name="id" value="{{$user->id}}" hidden>
                @if (session('statusPswd'))
                    <p style="color: {{ session('statusPswd') }};">{{ session('message') }}</p>
                @endif                
                <button>Modifier</button>
            </form>
        </div>
        </section>
</section>

@include("footer")