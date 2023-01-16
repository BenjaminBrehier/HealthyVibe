<?php
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
    exit();
}
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
    <section>
        <div class="liens">
            <a href="./index.php">Accueil </a>
            <p>></p>
            <a href="">Nous contacter</a>
        </div>
        <div id='boxenvoi'>
            <p id='description'>Nous sommes à votre écoute. Veuillez écrire votre message dans l'espace ci-dessous</p>
            <form action= "" method= "POST">
                <input type='text' class='message' max-length="2000" name="message" placeholder="Message">
                <input type='submit' value='Envoyer' id='boutton'>
            </form>
    <?php if (isset($_POST['message'])){
    $dest="healthyvibe.isep@gmail.com";
    $objet="requete client";
    $message= $_POST['message'];
    mail( $dest, $objet, $message);
    echo '<p style="color:green;">le mail a bien été envoyé';
    }?> 
        <p id='indication'> Notre équipe fait de son mieux pour traiter votre demande dans les plus brefs délais. Merci de votre compréhension.</p>
        </div>
    </section>
    <?php
        include './res/php/footer.php';
        ?>
</body>