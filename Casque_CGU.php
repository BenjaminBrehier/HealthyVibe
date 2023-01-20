<?php
include './res/php/fonctions.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Infinite measures</title>
    <link rel="stylesheet" href="res/css/Casque_CGU.css">
</head>
<body>
    <?php
    if (isset($_SESSION['utilisateur']) && ($_SESSION['utilisateur'] instanceof Utilisateur)) {
        include './res/php/header.php';
    } else {
        include './res/php/headerVisiteur.php';
    }
    ?>
    <h1>HealthyVibe</h1>
    <section id="fonctions">
    <div class="infinites1">
        <div class='info1'>
            <h3>Connexion et appairage</h3>
            <p>HealthyVibe est un casque non-filaire de dernières  générations aux fonctionalités très importantes pour un meilleur cadre de vie.La première chose à faire après avoir déballé votre casque Bluetooth est d'appuyer sur son bouton d'appairage. Une fois que celui-ci clignote, attrappez votre smartphone et activez le Bluetooth dans les paramètres. Votre casque doit apparaître dans la liste, il suffit de cliquer dessus pour lancer la connexion. Non seulement l'apparairage c'est simple, mais en plus, une fois que c'est fait, plus besoin de naviguer dans les menus de votre smartphone. Il suffit simplement d'activer le bluetooth et d'allumer votre casque.
        </div>
        <img src="./res/img/casque.jpg" alt="casque" class="image">
            
    </div> 
    <div class="infinites2">
        <img src="./res/img/casque&charge.jpg" alt="casque" class="image">
        <div class='info2'>
            <h3>Recharge</h3>
            <p>HealthyVibe est casque qui vous permet d'échanger avec votre smartphone  afin de communiquer des données qui vont seront visualisées sur un site web une fois connecté au site. Vous pouvez le recharger avec son cable USB C, ce qui sera très rare à cause de sa longue durée d'autonomie</p>
        </div>
    </div> 

    <div class="infinites1"> 
        <div class='info1'>
            <h3>Données et Usage</h3>
            <p> L'acquisition des données se fait grâce à des capteurs qui sont installés sur le casque. Ainsi ils prennent des mesures sur la qualité de votre milieu (la température, l'humidité, la fréquence cardiaque, le débit sonore et la teneur en monoxyde de carbone) permettant à l'individu d'apprécier son milieu. En plus, vous pouvez user de votre casque pour écoter tous vos fichiers audios et passer des appels avec un . </p>
        </div>
        <img src="./res/img/fonctionnalite_6.jpg" alt="foctionalite6" class="image">
    </div>
    </section> 

    <?php
    include './res/php/footer.php';
    ?>
     
</body>

</html>