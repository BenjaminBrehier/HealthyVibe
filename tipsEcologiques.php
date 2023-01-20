<?php
    include './res/php/fonctions.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tips écologiques : HealthyVibe</title>
        <link rel="stylesheet" href="res/css/tipsEcologiques.css">
        <script src="res/js/script.js"></script>
    </head>

    <body>
        <?php
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] instanceof Utilisateur) {
            include './res/php/header.php'; 
        } else {
            include './res/php/headerVisiteur.php';
        }
            ?>
        <section>
            <div class="liens">
                <a href="./index.php">Accueil </a>
                <p>></p>
                <a href="">Tips Ecologiques</a>
            </div>

            <div id='contenu'>
                <div id='partieGauche'>
                    <div id='Slogan'> 
                        <p>Adoptons les bons gestes ! </p>
                    </div>
    
                    <div id="gallerieTips">
                        <?php
                        $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                        $result = $co->query("SELECT * FROM TIPSECO");
                        while ($row = $result->fetch_object()) {
                        ?> 
                        <a href="<?php echo $row->lienVideo?>"class='tips'><?php echo $row->contenu?></a>
                        <?php
                        }
                        ?> 
 
                    </div>
                </div>

                <div id='partieDroite'> 
                    <img src=".\res\img\bitmoji.jpg" id="PhotoDroite">
                </div>
            </div>
        </section>

        <?php
            include './res/php/footer.php';
            ?>

    </body>

</html>
