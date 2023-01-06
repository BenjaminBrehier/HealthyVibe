<?php session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tips écologiques : HealthyVibe</title>
        <link rel="stylesheet" href="res/css/tipsEcologiques.css">
        <script src="res/js/script.js"></script>
    </head>

    <body>
        <?php
        if (isset($_SESSION['id'])) {
            include './res/php/header.php';
        } else {
            include './res/php/headerVisiteur.php';
        }
            ?>
        <section>
            <div class="liens">
                <a href="./index.php">Accueil </a>
                <p>></p>
                <a href="">Tips Ecologiques</a>
            </div>

            <div id='contenu'>
                <div id='partieGauche'>
                    <div id='Slogan'> 
                        <p>Adoptons les bons gestes ! </p>
                    </div>
    
                    <div id="gallerieTips">
                        <div class='tips'>
                            <p>Consommer des produits locaux pour réduire les émissions de CO2</p>
                        </div>
                        <a href="https://www.youtube.com/watch?v=rNwtMO_Hay4"><div class='tips'>
                            <p>Trier vos déchets pour faciliter le recyclage</p>
                        </div></a>
                        <div class='tips' >
                            <p>Favoriser l'utilisation des transports en commun</p>
                        </div>
                        <div class='tips'>
                            <p>Se mettre à la marche ou au vélo pour vos courses</p>
                        </div>
                        <a href="https://www.youtube.com/watch?v=bpUiwa0ei9A"><div class='tips'>
                            <p>Transformer les eaux inutilisées pour le maraîchage  </p>
                        </div></a>
                        <a href="https://www.youtube.com/watch?v=E331tTmy0Hw"><div class='tips'>
                            <p>Diminuer votre consommation d'énergie en utilisant des lampes à basses consommation</p>
                        </div></a>
                    </div>
                </div>
                <div id='partieDroite'> 
                    <img src=".\res\img\bitmoji.jpg" id="PhotoDroite">
                </div>
    
            </div>
        </section>

        <?php
            include './res/php/footer.php';
            ?>

    </body>

</html>
