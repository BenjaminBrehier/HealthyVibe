<?php
include './res/php/fonctions.php';
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
}
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$result = $co->query("SELECT * FROM donnee INNER JOIN capteur ON donnee.idCapteur = capteur.idCapteur INNER JOIN casque ON capteur.idCasque = casque.idCasque WHERE casque.idUtilisateur = ".$_SESSION['utilisateur']->getId()." ORDER BY date DESC");
$temperature = "Pas de données";
$gaz = "Pas de données";
$decibel = "Pas de données";
while ($row = $result->fetch_object()) {
    if ($row->type == "temperature extérieure") {
        $temperature = $row->valeur;
    }
    else if ($row->type == "gaz") {
        $gaz = $row->valeur;
    }
    else if ($row->type == "décibel extérieur") {
        $decibel = $row->valeur;
    }
    if ($temperature != "Pas de données" && $gaz != "Pas de données" && $decibel != "Pas de données") {
        break;
    }
}
$co->close();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/espaceEnvironnement.css">
    <script src="res/js/script.js"></script>
    <script src="res/js/code/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
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
            <div id='savoir'>
                <h1>Le Saviez-vous ? </h1><br>
                <hr><br>
                <p> Le niveau de CO2 dans l’air est favorisé par une mauvaise ventilation en milieu clos <br><br>Le CO2 peut provoquer des affections bénignes (vertiges, maux de tête), des problèmes cardiovasculaires ou neurologiques et peut même entrainer des comas ou la mort pour les cas les plus sévères.
                </p>
            </div>
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
                        <div class="actu">
                            <div id="pres">
                                <img class=icone src="./res/img/temperature.png" alt="idéogramme thermomètre">
                                <p><strong><?php echo $temperature ;?>°C</strong></p>
                            </div>
                        </div>
                        <div id="graphique1">

                        </div>
                    </div>
                    <div id="graph3">
                        <div class="actu">
                            <div id="pres">
                                <img class=icone src="./res/img/headphones.png" alt="idéogramme casque">
                                <p><strong><?php echo $decibel ;?> db</strong></p>
                            </div>
                        </div>
                        <div id="graphique3">

                        </div>
                    </div>
                    <div id="graph2">
                        <div class="actu">
                            <div id="pres">
                                <img class=icone src="./res/img/bouteille-de-gaz.png" alt="idéogramme bouteille de gaz">
                                <p><strong><?php echo $gaz ;?> ppm</strong></p>
                            </div>
                        </div>
                        <div id="graphique2">

                        </div>
                    </div>
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