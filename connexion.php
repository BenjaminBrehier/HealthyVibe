<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/connexion.css">
    <script src="res/js/script.js"></script>
</head>

<header>
        <div id="ligneVerte"></div>
        <div class="barre">
            <img src="./res/img/logo.png" alt="Logo de HealthyVibe">

            <h2>Connexion à votre espace HealthyVibe</h2>

            <nav>
                <a href="">Tips ecologiques</a>
                <a href="">FAQ</a>
            </nav>
        </div>

</header>


<body>
    <div class="espaceConnexion">
        <p class="titre">HealthyVibe</p>
        <img src="./res/img/logo_black.png" alt="Logo de HealthyVibe" id='logo'>
        <p class="connexion">Connexion</p>
        <div id='barre'>
            <hr>
        </div>

        <form>
            <div class="champ"> 
                <label for="mail" font-weight=strong >Mail:</label>
                <input type="email" id="mail" name="Adresse mail" required>
            </div> 

            
            <div class="champ"> 
                <label for="mdp">Mot de passe:</label>
                <input type="password" id="mdp" name="mdp" required>
            </div> 


            <div class="boutonConnexion">
                <input type="button" id="seConnecter" name="seConnecter" value="Se connecter" class="seConnecter">
            </div>
        </form>
    </div>

    <?php
    include './res/php/footer.php';
    ?>



</body>


</html>