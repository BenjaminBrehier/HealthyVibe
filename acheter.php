<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Achat : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/acheter.css">
    <script src="res/js/script.js"></script>
</head>

<header>
        <div id="ligneVerte"></div>
        <img src="./res/img/logo.png" alt="Logo de HealthyVibe">
        <nav>
            <a href="./tipsEcologiques.php">Tips ecologiques</a>
            <a href="./FAQ.php">FAQ</a>
            <a href="./connexion.php" id="co">Se connecter</a>
            <a href="./inscription.php" id="inscrire">S'inscrire</a>
        </nav>
</header>

<body>
    <div id='boxAchat'>
            <p id='description'>Afin de réserver votre casque HealthyVibe en magasin, veuillez renseigner les informations suivantes:</p>
            <form>
                <div class='info'>
                    <legend>Nom</legend>
                    <input type='text'>
                </div>
                <div class='info'>
                    <legend>Prénom</legend>
                    <input type='text'>
                </div>
                <div class='info'>
                    <legend>Mail</legend>
                    <input type='mail'>
                </div>

                <input type='button' value='Commander' id='boutton'>
            </form>
            <p id='lieu'>Lieu d'achat du casque: <Address>10 Rue de Vanves, 92130 Issy-les-Moulineaux, France</address> </p>
            <p id='indication'>Vous pourrez créer un compte <strong>HealthyVibe</strong> avec votre numéro de casque qui vous sera fourni à sa réception.</p>
    </div>



    <?php
        include './res/php/footer.php';
        ?>  
</body>
