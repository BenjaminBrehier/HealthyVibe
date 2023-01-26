<?php
include './res/php/fonctions.php';
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$result = $co->query("SELECT * FROM donnee INNER JOIN capteur ON donnee.idCapteur = capteur.idCapteur INNER JOIN casque ON capteur.idCasque = casque.idCasque WHERE casque.idUtilisateur = ".$_SESSION['utilisateur']->getId()." ORDER BY donnee.idDonnee DESC");
$pouls = "Pas de données";
$temperature = "Pas de données";
$decibel = "Pas de données";
$gaz = "Pas de données";
//! Permet de récupérer les dernières données d'un utilisateur
while ($row = $result->fetch_object()) {
    if ($row->type == "pouls" && $pouls == "Pas de données") {
        $pouls = $row->valeur;
    }
    else if ($row->type == "temperature corporelle" && $temperature == "Pas de données") {
        $temperature = $row->valeur;
    }
    else if ($row->type == "decibel" && $decibel == "Pas de données") {
        $decibel = $row->valeur;
    }
    else if ($row->type == "gaz" && $gaz == "Pas de données") {
        $gaz = $row->valeur;
    }
    if ($pouls != "Pas de données" && $temperature != "Pas de données" && $decibel != "Pas de données" && $gaz != "Pas de données") {
        break;
    }
}
$co->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe : Vos Données</title>
    <link rel="stylesheet" href="res/css/vosDonnees.css">
</head>

<body>
    <?php
    include './res/php/header.php';
    ?>
    <section>
        <div class="liens">
            <a href="./index.php">Accueil </a>
            <p>></p>
            <a href="./vosDonnees.php">Vos Données</a>
        </div>
        <div id="Espace">
            <a class="carre_noir" href="./espaceSantee.php">
                <h1>Espace Santé</h1>
                <div class="carre_blanc">
                    <img class="bordure" src="./res/img/Sante.jpg" alt="image de Santé">
                    <p class="rapport">Rapport statistique détaillé de votre rythme cardiaque,
                        température corporelle et exposition sonore (sonomètre)</p>
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
                        <p><strong><?php echo $pouls ;?> BPM</strong></p>
                    </div>
                    <div>
                        <img class="icone" src="./res/img/temperature.png" alt="image d'un thermomètre">
                        <p><strong><?php echo $temperature ;?> °C</strong></p>
                    </div>
                    <div>
                        <img class="icone" src="./res/img/headphones.png" alt="image d'un casque">
                        <p><strong><?php echo $decibel ;?> dB</strong></p>
                    </div>
                    <div>
                        <img class="icone" src="./res/img/bouteille-de-gaz.png" alt="image d'une bouteille de gaz">
                        <p><strong><?php echo $gaz ;?> ppm</strong></p>
                    </div>
                </div>
            </a>
        </div>


    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>