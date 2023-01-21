<?php
include './res/php/fonctions.php';
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
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
            <form action="" method="POST">
                <textarea class="message" name="message" id="" cols="30" rows="10" placeholder="Message"></textarea>
                <input type='submit' value='Envoyer' id='boutton'>
            </form>
            <?php if (isset($_POST['message'])) {
                $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $result = $co->query("INSERT INTO messagedirect(idUtilisateur, idUtilisateur1, date, contenu) VALUES (" . $_SESSION['utilisateur']->getId() . ", 1, '" . date("Y-m-d h:m:s") . "', '" . $_POST['message'] . "')");
                $dest = "healthyvibe.isep@gmail.com";
                $objet = "requete client";
                $message = $_POST['message'];
                mail($dest, $objet, $message);
                echo '<p style="color:green;">Le mail a bien été envoyé';
            } ?>
            <p id='indication'> Notre équipe fait de son mieux pour traiter votre demande dans les plus brefs délais. Merci de votre compréhension.</p>
        </div>
    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>