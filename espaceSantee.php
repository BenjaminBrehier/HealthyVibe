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
$pouls = "Pas de données";
$temperature = "Pas de données";
$decibel = "Pas de données";
while ($row = $result->fetch_object()) {
    if ($row->type == "pouls") {
        $pouls = $row->valeur;
    }
    else if ($row->type == "temperature corporelle") {
        $temperature = $row->valeur;
    }
    else if ($row->type == "decibel") {
        $decibel = $row->valeur;
    }
    if ($pouls != "Pas de données" && $temperature != "Pas de données" && $decibel != "Pas de données") {
        break;
    }
}
$co->close();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Espace Santé : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/espaceSantee.css">
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
                    <input type="date" id="dateDebut" class="date" onchange="reload('espaceSantee')" placeholder='Date de début'>
                    <p>à</p>
                    <input type="date" id="dateFin" class="date" onchange="reload('espaceSantee')" placeholder='Date de fin'>
                </div>
            </div>

            <div id="partie2">
                <div id="graph1">
                    <div id="pres">
                        <img class=icone src="./res/img/temperature.png" alt="idéogramme thermomètre">
                        <p><strong><?php echo $temperature ;?> °C</strong></p>
                    </div>
                    <div id="graphique1">
                        <!-- Contient le graphique -->
                    </div>
                </div>
                <div id="graph2">
                    <div id="pres">
                        <img class=icone src="./res/img/headphones.png" alt="idéogramme casque">
                        <p><strong><?php echo $decibel ;?> db</strong></p>
                    </div>
                    <div id="graphique2">
                        <!-- Contient le graphique -->
                    </div>
                </div>
                <div id="graph3">
                    <div id="pres">
                        <img class=icone src="./res/img/heart.png" alt="idéogramme coeur">
                        <p><strong><?php echo $pouls ;?> BPM</strong></p>
                    </div>
                    <div id="graphique3">
                        <!-- Contient le graphique -->
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
    reload("espaceSantee");
</script>
</html>