<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    
    <meta charset="UTF-8">
    <title>Nous contacter : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/nousContacter.css">
    <script src="res/js/script.js"></script>
</head>

<body>  
    <?php
    include './res/php/header.php';
    ?> 

    <div id='boxenvoi'>
                <p id='description'>Nous sommes à votre écoute. Veuillez écrire votre message dans l'espace ci-dessous</p>
                <form>
                    <input type='text' class='message' max-length="2000" placeholder="Message">

                    <input type='button' value='Envoyer' id='boutton'>
                </form>
                <p id='indication'> Notre équipe fait de son mieux pour traiter votre demande dans les plus brefs délais. Merci de votre compréhension.</p>
    </div>
    <?php
        include './res/php/footer.php';
        ?>
</body>