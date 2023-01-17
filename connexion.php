<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/connexion.css">
    <script src="res/js/script.js"></script>
</head>

<body>
<?php
    if (isset($_SESSION['utilisateur']) && ($_SESSION['utilisateur'] instanceof Utilisateur)) {
        include './res/php/header.php';
    } else {
        include './res/php/headerVisiteur.php';
    }
    ?>
    <div class="espaceConnexion">
        <img src="./res/img/logo_black.png" alt="Logo de HealthyVibe" id='logo'>
        <p class="connexion">Connexion</p>
        <div id='barres'>
            <hr>
        </div>

        <form action="./index.php?type=connexion" method="POST">
        <p id="erreur">
            <?php 
            if(isset($_GET['erreur'])) {
                if(isset($_GET['reponse'])) {
                    echo $_GET['reponse'];
                }
                else {
                    echo 'Erreur lors de la connexion. Merci de réessayer ou contacter le support si le problème persiste.';
                }
            } 
            ?></p>
            <div class="champ"> 
                <label for="mail" font-weight=strong >Mail:</label>
                <input type="email" id="mail" name="mail" required>
            </div> 

            
            <div class="champ"> 
                <label for="mdp">Mot de passe:</label>
                <input type="password" id="mdp" name="mdp" required>
            </div> 

            <div class="boutons">
                <div class="boutonConnexion">
                    <input type="button" class="seConnecter" name="seConnecter" value="S'incrire" class="seConnecter">
                </div>

                <div class="boutonConnexion">
                    <input type="submit" class="seConnecter" name="seConnecter" value="Se connecter" class="seConnecter">
                </div>
            </div>

        </form>
    </div>

    <?php
    include './res/php/footer.php';
    ?>



</body>


</html>