<?php 
include './res/php/fonctions.php';
session_start();
?>
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
    if (isset($_SESSION['utilisateur'])) {
        include './res/php/header.php';
    } else {
        include './res/php/headerVisiteur.php';
    }
    ?>
    <section>
        <div class="liens">
            <a href="./index.php">Accueil </a>
            <p>></p>
            <a href="./FAQ.php">FAQ</a>
        </div>

        <div id='contenu'>
            <div id='espaceRecherche'>
                <input type='text' placeholder='Rechercher une question' id='barreRecherche'>
                <div id='listeQuestions'>
                <?php
                    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    $result = $co->query("SELECT * FROM FAQ");
                    while ($row = $result->fetch_object()) {
                    ?> 
                    <ul class="menu1">
                        <li class='QA'><a class='Question'><?php echo $row->question?></a>
                            <ul class='partieReponse'>
                                <li class='Reponse'><?php echo $row->reponse?></li>
                            </ul>
                        </li>
                    </ul>
                    <?php 
                    }
                    ?>

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