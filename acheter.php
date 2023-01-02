<?php
session_start();
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

            <input type='submit' value='Réserver' id='boutton'>
        </form>
        <p id='lieu'>Lieu d'achat du casque:
        <Address>10 Rue de Vanves, 92130 Issy-les-Moulineaux, France</address>
        </p>
        <p id='indication'>Vous pourrez créer un compte <strong>HealthyVibe</strong> avec votre numéro de casque qui vous sera fourni à sa réception.</p>
    </div>



    <?php
    include './res/php/footer.php';
    ?>
</body>