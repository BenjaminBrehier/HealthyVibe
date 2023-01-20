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
                    <input type="date" class="date" placeholder='Date de début'>
                    <p class='text'>à</p>
                    <input type="date" class="date" placeholder='Date de fin'>
                    <input type="button" class="enSavoirPlus" name="enSavoirPlus" value="Afficher les statistiques">
                </div>
            </div>
            <div id="partie2-LSV">
            <div id="partie2">

                <div id="graphique">
                    <script>document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('graphique', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Taux de Co2 autour de vous'
            },
            xAxis: {
                categories: ['temps (en heure)']
            },
            yAxis: {
                title: {
                    text: 'taux en Co2'
                }
            },
            series: [{
                name: 'Co2',
                data: [22, 16, 20]
            }]
        });
    });</script></div>
                    <div id="pres">
                        <img class=icone src="./res/img/bouteille-de-gaz.png" alt="idéogramme bouteille de gaz">
                        <p><strong>34%</strong></p>
                    </div>
                    <input type="button" class="btn" value="Tableau">
                </div>

                <div id='savoir'>
                    <h1>Le Saviez-vous ? </h1><br>
                    <hr><br>
                    <p> Le niveau de CO dans l’air est favorisé par une mauvaise ventilation en milieu clos <br><br>Le CO peut provoquer des affections bénignes (vertiges, maux de tête), des problèmes cardiovasculaires ou neurologiques et peut même entrainer des comas ou la mort pour les cas les plus sévères.
                    </p>
                </div>
            </div>
</div>
    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>