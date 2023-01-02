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
            <div id="colonneGauche">

                <div id="calendrier">
                    <table>
                        <tr>
                            <th>L</th>
                            <th>M</th>
                            <th>M</th>
                            <th>J</th>
                            <th>V</th>
                            <th>S</th>
                            <th>D</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <div class="bouttontemps">
                        <input type="button" class="enSavoirPlus" name="enSavoirPlus" value="Semaine" class="enSavoirPlus">
                        <input type="button" class="enSavoirPlus" name="enSavoirPlus" value="Mois" class="enSavoirPlus">
                    </div>
                </div>
            </div>

            <div id="colonneDroite">
                <div id="graph">
                    <img src="./res/img/graph.png" alt="graph1" class='graph1'>
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