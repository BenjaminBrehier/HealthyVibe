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
                    <div id="graphique1">
                        <!-- Contient le graphique -->
                    </div>
                    <div id="pres">
                        <img class=icone src="./res/img/temperature.png" alt="idéogramme thermomètre">
                        <p><strong><?php echo $temperature ;?> °C</strong></p>
                    </div>
                    <input type="button" class="btn" value="Tableau">
                    <table>
                <tr>
                    <th>température sur la surface de la peau</th>
                    <th>température extérieur</th>
                    <th>date</th>
                </tr>
                <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT valeur, date, type  FROM `donnee` inner join `capteur` on donnee.idCapteur = capteur.idCapteur inner join casque on casque.idCasque = capteur.idCapteur inner join utilisateur on utilisateur.idUtilisateur = casque.idUtilisateur");
            $temperatureCorps = array();
            $temperatureExt = array();
            while ($row = $result->fetch_object()){ 
                if($row->type == 1) {
                    array_push($temperatureCorps, $row->valeur);
                }
                else if ($row->type == 5){
                    array_push($temperatureExt, $row->valeur);
                }
                for ($i = 0; $i < count($temperatureCorps); $i++){
                for ($i = 0; $i < count($temperatureExt); $i++){
            ?>
                <tr>
                <td><?php echo $temperatureCorps[$i]; ?></td>
                    <td><?php echo $temperatureExt[$i]; ?></td>
                    <td><?php echo $row->date; ?></td>
                </tr>
                <?php
            }}}
            ?>
            </table>
                </div>
                <div id="graph2">
                    <div id="graphique2">
                        <!-- Contient le graphique -->
                    </div>
                    <div id="pres">
                        <img class=icone src="./res/img/headphones.png" alt="idéogramme casque">
                        <p><strong><?php echo $decibel ;?> db</strong></p>
                    </div>
                    <input type="button" class="btn" value="Tableau">
                    <table>
                    <tr>
                        <th>niveau sonore dans le casque</th>
                        <th>niveau sonore ambiant</th>
                        <th>date</th>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>37</td>
                        <td>10/12/2020</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>36</td>
                        <td>11/12/2020</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>35</td>
                        <td>12/12/2020</td>
                    </tr>
                </table>
                </div>
                <div id="graph3">
                    <div id="graphique3">
                        <!-- Contient le graphique -->
                    </div>
                    <div id="pres">
                        <img class=icone src="./res/img/heart.png" alt="idéogramme coeur">
                        <p><strong><?php echo $pouls ;?> BPM</strong></p>
                    </div>
                    <input type="button" class="btn" value="Tableau">
                    <table>
                <tr>
                    <th>rythme cardiaque</th>
                    <th>date</th>
                </tr>
                <tr>
                    <td>8</td>
                    <td>10/12/2020</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>11/12/2020</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>12/12/2020</td>
                </tr>
            </table>
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