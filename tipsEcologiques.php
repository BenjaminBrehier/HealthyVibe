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
                        <p>tips2</p>
                    </div>
                    <div class='tips'>
                        <p>tips2</p>
                    </div>
                    <div class='tips'>
                        <p>tips2</p>
                    </div>
                    <div class='tips'>
                        <p>tips2</p>
                    </div>
                    <div class='tips'>
                        <p>tips2</p>
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
