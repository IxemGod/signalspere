@include("header")
<title>Contact - SignalSphere</title>
<section class="containerContact">
    <div class="contact">
        <div class="h1Eth2">
            <h1>Besoins d'aide ?</h1>
            <p>Contactez nous ici !</p>
        </div>

        <div class="formulaire">
            <form>
                <div class="NomEtPrénom">
                    <div class="prénom">
                        <label>Prénom</label>
                        <input type="text">
                    </div>
                    
                    <div class="nom">
                        <label>Nom</label>
                        <input type="text">
                    </div>
                </div>
                <br>
                <div class="email">
                    <label>E-mail</label>
                    <input type="email">
                </div>
                <br>
                <div class="object">
                    <label>Objet</label>
                    <input type="text">
                </div>
                <br>
                <div class="message">
                    <label>Message</label>
                    <textarea></textarea>
                </div>

                <button>J'envoie le message</button>
            </form>
        </div>
    </div>
</section>
@include("footer")
