<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="UTF-8">
    <title>Mon profil : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/Mon_profil.css">
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
    <div class='espaceProfil'>
        <p class="titre"> Mon profil</p>

        <form action="./accueil.php?&type=inscription" method="POST">
            <p id="erreur"><?php if(isset($_GET['reponse'])) {echo 'Erreur lors de l\'inscription. Merci de réessayer ou contacter le support si le problème persiste.';} ?></p>
            <div class ="champ">
            <input type="file" name="fileToUpload" id="fileToUpload">
                 <input type="submit" id="Modifier mon profil" name="Modifier mon profil" value="Modifier mon profil" class= "S'inscrire" >

            </div>
            <div class="champ">
                <label for="fname">Nom:</label>
                <input type="text" id="fname" name="fname" required>
            </div> 
            <div class="champ">     
                <label for="lname">Prénom:</label>
                <input type="text" id="lname" name="lname" required>
            </div>
            <div class="champ"> 
                <label for="mail">Mail:</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div class="champ"> 
                <label for="mdp">Mot de passe:</label>
                <input type="password" id="mdp" name="mdp" required>
            </div> 

            <div class="champ">
                <label for="DTN">Date de naissance:</label>
                <input type="date" id="DTN" name="DTN" required>
            </div> 
            <div class="champ">         
                <label for="adresse">Adresse:</label>
                <input type="text" id="Adresse" name="adresse">
            </div> 
            <div class="champ"> 
                <label for="CP">Code Postal:</label>
                <input type="number" id="CP" name="CP">
            </div>  
            <div class="champ"> 
                <label for="tel">Tel:</label>
                <input type="number" id="tel" name="tel">
            </div> 

            <div class="boutonSinscrire">
                <input type="submit" id="Sinscrire" name="S'inscrire" value="Modifier" class="sinscrire">
                <input type="submit" id="Sinscrire" name="S'inscrire" value="Annuler" class="sinscrire">
            </div>

        </form>
    </div>

    <?php
        include './res/php/footer.php';
    ?>
</body>
</html>