@include("header")
<title>Tableau de bord</title>
<section class="sectionAdministrateur">

    <div class="container">
        <h1>Tableau de bord Administrateur</h1>

        <div class="listeOption">
            <p>Que voulez-vous faire ?</p>
                <ul>
                    <li><a href="admin/listeUser">Géré les comptes utilisateurs</a></li>
                    <li><a href="admin/listeProducts">Géré les produits</a></li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Déconnexion</button>
                    </form>

                </ul>
        </div>

    </div>
</section>


@include("footer")