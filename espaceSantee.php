<?php
session_start();
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
    <div id="SpaceHolder">
        <div id='colonneGauche'>
            <div id="liens">
                <a href="./accueil.php?type=connexion">Accueil</a>
                <p>></p>
                <a href="./vosDonnees.php">Vos Données</a> 
            </div>

            <div id="calendrier">
                <table>
                    <tr>
                        <th>L</th><th>M</th><th>M</th><th>J</th><th>V</th><th>S</th><th>D</th>
                    </tr>
                    <tr>
                        <td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td>
                    </tr>
                    <tr>
                        <td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td>
                    </tr>
                    <tr>
                        <td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td>
                    </tr>
                    <tr>
                        <td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td>
                    </tr>
                    <tr>
                        <td>29</td><td>30</td><td>31</td><td></td><td></td><td></td><td></td>
                    </tr>
                </table>

                <div class="bouttontemps">
                    <input type="button" class="enSavoirPlus" name="enSavoirPlus" value="Semaine" class="enSavoirPlus">
                    <input type="button" class="enSavoirPlus" name="enSavoirPlus" value="Mois" class="enSavoirPlus">
                </div>
            </div>
        </div>

        <div id=colonneDroite>
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
                <img  class="graph" src="./res/img/graph.png" alt="graph 3">
                <div id="pres">
                    <img class=icone src="./res/img/heart.png" alt="idéogramme coeur">
                    <p><strong>85 BPM</strong></p>
                </div>
                <input type="button" class="btn" value="Tableau">
            </div>
        </div>
    </div>
    
    </div>
    <?php
    include './res/php/footer.php';
    ?>
</body>
</html>