<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inscription : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/inscription.css">
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
    <div class='espaceInscription'>
        <p class="titre"> Formulaire d'inscription</p>

        <form action="./index.php?type=inscription" method="POST">
            <p id="erreur"><?php if(isset($_GET['reponse'])) {echo 'Erreur lors de l\'inscription. Merci de réessayer ou contacter le support si le problème persiste.';} ?></p>
            <div class="champ">
                <label for="fname">Nom:</label>
                <input type="text" id="fname" name="fname" required>
            </div> 
            <div class="champ">     
                <label for="lname">Prénom:</label>
                <input type="text" id="lname" name="lname" required>
            </div>
            <div class="champ">     
                <label for="lname">Username:</label>
                <input type="text" id="uname" name="username" required>
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
                <label for="nCasque">Numéro de casque:</label>
                <input type="number" id="nCasque" name="nCasque" required>
            </div> 


            <div class="champ">
                <?php 
                //! Calculer la date minimal pour que l'utilisateur ait au moins 15 ans
                $date = new DateTime();
                $date->sub(new DateInterval('P15Y'));
                $dateMax = $date->format('Y-m-d');
                ?>
                <label for="DTN">Date de naissance:</label>
                <input type="date" id="DTN" name="DTN" max="<?php echo $dateMax;?>" required>
            </div> 
            <div class="champ">         
                <label for="adresse">Adresse:</label>
                <input type="text" id="Adresse" name="adresse" required>
            </div> 
            <div class="champ"> 
                <label for="CP">Code Postal:</label>
                <input type="number" id="CP" name="CP" required>
            </div>  
            <div class="champ"> 
                <label for="tel">Tel:</label>
                <input type="number" id="tel" name="tel" required>
            </div> 
            
            <div class="checkbox"> 
                <label for="cguC" id="cgutext">Je certifie avoir lu et approuvé les CGU et la politique de confidentialité.    </label>
                <input type="checkbox" id="cguC" required>
            </div>
            <div class="boutonSinscrire">
                <input type="submit" id="Sinscrire" name="S'inscrire" value="S'inscrire" class="sinscrire">
            </div>
        </form>
    </div>

    <?php
        include './res/php/footer.php';
    ?>
</body>


</html>