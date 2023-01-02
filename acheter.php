<?php
session_start();
require_once("./res/php/fonctions.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Achat : HealthyVibe</title>
    <link rel="stylesheet" href="res/css/acheter.css">
    <script src="res/js/script.js"></script>
</head>

<?php
    if (isset($_SESSION['id'])) {
        include './res/php/header.php';
    } else {
        include './res/php/headerVisiteur.php';
    }
    ?>

<body>
    <div id='boxAchat'>
            <p id='description'>Afin de réserver votre casque HealthyVibe en magasin, veuillez renseigner les informations suivantes:</p>
            <form>
                <div class='info'>
                    <legend>Nom</legend>
                    <input type='text'>
                </div>
                <div class='info'>
                    <legend>Prénom</legend>
                    <input type='text'>
                </div>
                <div class='info'>
                    <legend>Mail</legend>
                    <input type='mail'>
                </div>
                <div class='info'>
                    <legend>Tel</legend>
                    <input type='number'>
                </div>

                <div class='info'>
                    <legend>Lieu d'achat</legend>
                    <select name="lieu">
                        <?php
                            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                            $result = $co->query("SELECT * FROM lieuvente");
                            while ($row = $result->fetch_object()) {
                            ?>
                                <option value=""><?php echo $row->lieu; ?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                
                <div class='info'>
                    <a href="CGU.php" id='CGU'>Veuillez consultez les conditions d'utilisation du casque. pour toute réservation faite, nous considérons que vous avez accepté ces conditions. </a>
                </div>

                <input type='submit' value='Réserver' id='boutton'>
            </form>
            <p id='indication'>Vous pourrez créer un compte <strong>HealthyVibe</strong> avec votre numéro de casque qui vous sera fourni à sa réception.</p>
    </div>



    <?php
        include './res/php/footer.php';
        ?>  
</body>
