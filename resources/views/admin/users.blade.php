@include("header");


<section class="AdminListeUsers">
    <div class="container">
        <h1>Listes des utilisateurs</h1>

        <div class="listeUsers">

        @foreach($listUsers as $user)
            <div class="item">
                <a href="#">
                    <img src="">
                    <div class="info">
                        <p>name</p>
                        <p>email</p>
                        <p>phone</p>
                    </div>
                </a>
            </div>
        @endforeach
        </div>
    </div>
</section>


@include("footer");