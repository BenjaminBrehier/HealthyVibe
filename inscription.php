<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inscription : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/inscription.css">
    <script src="res/js/script.js"></script>
</head>

<header>
        <div id="ligneVerte"></div>
        <div class="barre">
            <img src="./res/img/logo.png" alt="Logo de HealthyVibe">

            <h2>Rejoignez l'aventure HealthyVibe !</h2>

            <nav>
                <a href="">Tips ecologiques</a>
                <a href="">FAQ</a>
            </nav>
        </div>

</header>


<body>

    <p class="titre"> Formulaire d'inscription</p>

    <form>
        <div class="champ">
            <label for="fname">Nom:</label>
            <input type="text" id="fname" name="fname" required>
        </div> 
        <div class="champ">     
            <label for="lname">Prénom:</label>
            <input type="text" id="lname" name="lname" required>
        </div>
        <div class="champ">
            <label for="DTN">Date de naissance:</label>
            <input type="date" id="DTN" name="DTN" required>
         </div> 
        <div class="champ">         
            <label for="adresse">Adresse:</label>
            <input type="text" id="Adresse" name="Adresse">
        </div> 
        <div class="champ"> 
            <label for="CP">Code Postal:</label>
            <input type="number" id="CP" name="CP">
        </div> 
        <div class="champ"> 
            <label for="mail">Mail:</label>
            <input type="email" id="mail" name="Adresse mail" required>
        </div> 
        <div class="champ"> 
            <label for="tel">Tel:</label>
            <input type="number" id="tel" name="Tel">
        </div> 

        <div class="champ"> 
            <label for="mdp">Mot de passe:</label>
            <input type="password" id="mdp" name="mdp" required>
        </div> 

        <div class="checkbox"> 
            <label for="AgeC">Je certifie avoir plus de 15 ans.    </label>
            <input type="checkbox" id="AgeC" required>
        </div> 
        
        <div class="checkbox"> 
            <label for="cguC">Je certifie avoir lu et approuvé les CGU et la politique de confidentialité.    </label>
            <input type="checkbox" id="cguC" required>
        </div>
        <div class="boutonSinscrire">
            <input type="button" id="Sinscrire" name="S'inscrire" value="S'inscrire" class="sinscrire">
        </div>
    </form>

    <?php
        include './res/php/footer.php';
        ?>



</body>


</html>