<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="res/css/vosDonnees.css">
</head>

<body>
    <?php 
    include './res/php/header.php';
    ?>
    <section id= "Espace">
        <a class="carre_noir" href="./espaceSantee.php">
            <h1>Espace Santé</h1>
            <div class="carre_blanc">
                <img class="bordure" src="./res/img/Sante.jpg" alt="image de Santé">
                <p class="rapport">Rapport statistique détaillé de votre rythme cardiaque,
                    température corporelle et exposition sonore (décibelmètre)</p>
            </div>
        </a>  

        <a class="carre_noir" href="./espaceEnvironnement.php">
            <h1>Espace Environnement</h1>
            <div class="carre_blanc">
                <img class="bordure" src="./res/img/environnement.jpg" alt="image d'environnement">
                <p class="rapport">Rapport statistique détaillé de l'exposition 
                    au gaz toxique et au monoxyde de carbone </p>
            </div>
        </a>     
        
        <a class="carre_noir" href="#">
            <h1>Données actuelles</h1>
            <div class="carre_blanc">
                <div>
                    <img class="icone" src="./res/img/heart.png" alt="image d'un coeur">
                    <p><strong>78 BPM<strong></p>
                </div>
                <div>
                    <img class="icone" src="./res/img/temperature.png" alt="image d'un thermomètre">
                    <p><stronf>36.8 °C<strong></p>
                </div>
                <div>
                    <img class="icone" src="./res/img/headphones.png" alt="image d'un casque">
                    <p><strong>81 dB<strong></p>
                </div>
                <div>
                    <img class="icone" src="./res/img/bouteille-de-gaz.png" alt="image d'une bouteille de gaz">
                    <p><strong>837 ppm<strong></p>
                </div>
                </div>
            </div>
        </a>  

    </section>
    <?php 
    include './res/php/footer.php';
    ?>
</body>

</html>