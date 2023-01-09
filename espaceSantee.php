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
    <title>Espace Santé : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/espaceSantee.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <?php
    include './res/php/header.php';
    ?>
    <section>
        <div id="test">
            <div id="liens">
                <a href="./index.php">Accueil</a>
                <p>></p>
                <a href="./vosDonnees.php">Vos Données</a>
                <p>></p>
                <a href="./espaceSantee.php">Espace Santé</a>
            </div>
        </div>
        <div id="SpaceHolder">
            <div id='partie1'>
                <div class="bouttontemps">
                    <label for="période">
                        <p>Choisissez une période</p>
                    </label>
                    <input type="date" class="date" placeholder='Date de début'>
                    <p>à</p>
                    <input type="date" class="date" placeholder='Date de fin'>
                    <input type="button" class="enSavoirPlus" name="enSavoirPlus" value="Afficher les statistiques">
                </div>
            </div>

            <div id="partie2">
                <div id="graph1">
                    <img class="graph" src="./res/img/graph.png" alt="graph 1">
                    <div id="pres">
                        <img class=icone src="./res/img/temperature.png" alt="idéogramme thermomètre">
                        <p><strong>37°C</strong></p>
                    </div>
                    <input type="button" class="btn" value="Tableau">
                </div>
                <div id="graph2">
                    <img class="graph" src="./res/img/graph.png" alt="graph 2">
                    <div id="pres">
                        <img class=icone src="./res/img/headphones.png" alt="idéogramme casque">
                        <p><strong>79 db</strong></p>
                    </div>
                    <input type="button" class="btn" value="Tableau">
                </div>
                <div id="graph3">
                    <img class="graph" src="./res/img/graph.png" alt="graph 3">
                    <div id="pres">
                        <img class=icone src="./res/img/heart.png" alt="idéogramme coeur">
                        <p><strong>85 BPM</strong></p>
                    </div>
                    <input type="button" class="btn" value="Tableau">
                </div>
            </div>
        </div>
    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>