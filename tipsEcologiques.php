<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tips écoloogiques : HealthyVibe</title>
        <link rel="stylesheet" href="res/css/tipsEcologiques.css">
        <script src="res/js/script.js"></script>
    </head>

    <body>
        <?php
            include './res/php/header.php';
            ?>
        <div id='contenu'>
            <div id='partieGauche'>
                <div id='Slogan'> 
                    <p>Adoptons les bons gestes ! </p>
                </div>

                <div id="gallerieTips">
                    <div class='tips'>
                        <p>Manger</p>
                    </div>
                    <div class='tips'>
                        <p>Faîtes le tri de vos déchets pour faciliter le recyclage</p>
                    </div>
                    <div class='tips'>
                        <p>Utiliser plu les transports en commun</p>
                    </div>
                    <div class='tips'>
                        <p>Se mettre à la marche ou au vélo pour vos courses</p>
                    </div>
                    <div class='tips'>
                        <p>Transformer les eaux inutilisées pour le maraîchage  </p>
                    </div>
                    <div class='tips'>
                        <p>Dimunuons notre consommation d'énergie en usant des lampes à basses consommation</p>
                    </div>
                </div>
            </div>
            <div id='partieDroite'> 
                <img src=".\res\img\bitmoji.jpg" id="PhotoDroite">
            </div>

        </div>





        <?php
            include './res/php/footer.php';
            ?>

    </body>

</html>