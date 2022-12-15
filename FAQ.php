<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/FAQ.css">
    <script src="res/js/script.js"></script>
</head>

<body>
<?php
    if (isset($_SESSION['id'])) {
        include './res/php/header.php';
    } else {
        include './res/php/headerVisiteur.php';
    }
    ?>
    <section>
        <div class="liens">
            <a href="./accueil.php">Accueil </a>
            <p>></p>
            <a href="./FAQ.php">FAQ</a>
        </div>

        <div id='contenu'>
            <div id='espaceRecherche'>
                <input type='text' placeholder='Rechercher une question' id='barreRecherche'>
                <div id='listeQuestions'>
                    <ul class="menu1">
                        <li class='QA'><a class='Question'>Comment créer une compte client?</a>
                            <ul class='partieReponse'>
                                <li class='Reponse'>Aller dans l'onglet en haut à droite puis cliquer sur "S'inscrire".<br> Ensuite, remplir le formulaire comme indiqué</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu2">
                        <li class='QA'><a class='Question'>Comment contacter le service client ?</a>
                            <ul class='partieReponse'>
                                <li class='Reponse'>Aller dans l'onglet en haut à droite puis cliquer sur "S'inscrire"</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu3">
                        <li class='QA'><a class='Question'>Quel est le numéro de téléphone de HealthyVibe</a>
                            <ul class='partieReponse'>
                                <li class='Reponse'>Aller dans l'onglet en haut à droite puis cliquer sur</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu4">
                        <li class='QA'><a class='Question'>Est-ce que je peux commander un deuxième casque ?</a>
                            <ul class='partieReponse'>
                                <li class='Reponse'>Aller dans l'onglet en haut à droite puis cliquer sur </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu5">
                        <li class='QA'><a class='Question'>Est-ce que le casque est résistant à l'eau (waterproof)?</a>
                            <ul class='partieReponse'>
                                <li class='Reponse'>Aller dans l'onglet en haut à droite puis cliquer sur </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
    
            <div id='decoImage'>
                <img src="./res/img/casque.jpg" id="casque" alt="casque">
            </div>
        </div>

    </section>

<?php
        include './res/php/footer.php';
        ?>
</body>
</html>