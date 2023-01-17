<?php
include './res/php/fonctions.php';
session_start();
?>

<?php 
    if (isset($_GET['type'])) {
        $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (htmlspecialchars($_GET['type']) == 'commandes') {
            $nom = htmlspecialchars($_POST['fname']);
            $prenom = htmlspecialchars($_POST['lname']);
            $mail=mysqli_escape_string( $co,$_POST["mail"]);
            $tel=mysqli_escape_string($co,$_POST["tel"]);
            $lieu=mysqli_escape_string($co, htmlspecialchars($_POST['lieu']));
            $dateResa=mysqli_escape_string($co,date('y-m-d'));
            echo $nom,$prenom,$mail,$tel,$dateResa, $lieu;
            $result = $co->query("INSERT INTO commandes(Nom,Prenom,Mail,Tel,lieu, DateDeReservation) VALUES('$nom','$prenom','$mail',6768,'$lieu','2003-12-12');");
        }
    }
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
if (isset($_SESSION['utilisateur'])) {
    include './res/php/header.php';
} else {
    include './res/php/headerVisiteur.php';
}
?>

<body>
    <div id='boxAchat'>
        <p id='description'>Afin de réserver votre casque HealthyVibe en magasin, veuillez renseigner les informations suivantes:</p>
        <form action="./acheter.php?type=commandes" method="POST">
            <div class='info'>
                <legend>Nom</legend>
                <input type='text'id='fname' name='fname' required>
            </div>
            <div class='info'>
                <legend>Prénom</legend>
                <input type='text'id='lname' name='lname' required>
            </div>
            <div class='info'>
                <legend>Mail</legend>
                <input type='mail' id='mail' name='mail' required>
            </div>
            <div class='info'>
                <legend>Tel</legend>
                <input type='number' id='tel' name='tel'required>
            </div>

            <div class='info'>
                    <legend>Lieu d'achat</legend>
                    <select name="lieu" id='lieu' required>
                        <?php
                            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                            $result = $co->query("SELECT * FROM lieuvente");
                            while ($row = $result->fetch_object()) {
                        ?>
                            <option value="<?php echo $row->lieu; ?>"><?php echo $row->lieu; ?></option>
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