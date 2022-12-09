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
    include './res/php/header.php';
    ?>

    <div id='contenu'>
        <div id='espaceRecherche'>
            <input type='text' value='Rechercher une question' id='barreRecherche'>
            <div id='listeQuestions'>
                <ul>
                    <li class='Question'>Comment créer une compte client?</li>
                    <li class='Question'>Comment contacter le service client ? </li>
                    <li class='Question'>Quel est le numéro de téléphone de HealthyVibe</li>
                    <li class='Question'>Est-ce que je peux commander un deuxième casque ?</li>
                    <li class='Question'>Est-ce que le casque est résistant à l'eau (waterproof)?</li>
                </ul>
            </div>
        </div>

        <div id='decoImage'>
            <img src="./res/img/casque.jpg" id="casque" alt="casque">
        </div>
    </div>

    </div>



<?php
        include './res/php/footer.php';
        ?>
</body>
</html>