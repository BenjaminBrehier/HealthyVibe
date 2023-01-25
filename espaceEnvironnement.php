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
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/espaceEnvironnement.css">
    <script src="res/js/script.js"></script>
    <script src="res/js/code/highcharts.js"></script>
</head>

<body>
    <?php
    include './res/php/header.php';
    ?>
    <section>
        <div id="liens">
            <a href="./index.php">Accueil</a>
            <p>></p>
            <a href="./vosDonnees.php">Vos Données</a>
            <p>></p>
            <a href="./espaceEnvironnement.php">Espace Environnement</a>
        </div>

        <div id="spaceHolder">
            <div id='partie1'>
                <div class="bouttontemps">
                    <label for="période">
                        <p class='text'>Choisissez une période</p>
                    </label>
                    <input type="date" class="date" id="dateDebut" onchange="reload('espaceEnv')">
                    <p class='text'>à</p>
                    <input type="date" class="date" id="dateFin" onchange="reload('espaceEnv')">
                </div>
            </div>
            <div id="partie2-LSV">
                <div id="partie2">
                    <div id="graph1">
                        <div id="graphique1">

                        </div>
                        <div class="actu">
                            <div id="pres">
                                <img class=icone src="./res/img/temperature.png" alt="idéogramme bouteille de gaz">
                                <p><strong>34°C</strong></p>
                            </div>
                            <input type="button" class="btn" value="Tableau">
                        </div>
                    </div>
                    <div id="graph2">
                        <div id="graphique2">

                        </div>
                        <div class="actu">
                            <div id="pres">
                                <img class=icone src="./res/img/bouteille-de-gaz.png" alt="idéogramme bouteille de gaz">
                                <p><strong>34%</strong></p>
                            </div>
                            <input type="button" class="btn" value="Tableau">
                        </div>
                    </div>
                </div>

                <div id='savoir'>
                    <h1>Le Saviez-vous ? </h1><br>
                    <hr><br>
                    <p> Le niveau de CO2 dans l’air est favorisé par une mauvaise ventilation en milieu clos <br><br>Le CO2 peut provoquer des affections bénignes (vertiges, maux de tête), des problèmes cardiovasculaires ou neurologiques et peut même entrainer des comas ou la mort pour les cas les plus sévères.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>
<script src="res/js/graph.js"></script>
<script>
    reload("espaceEnv");
</script>

</html>