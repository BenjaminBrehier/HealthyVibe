<?php
//! Page de reservation d'un casque
include './res/php/fonctions.php';
session_start();
?>

<?php 
    if (isset($_GET['type'])) {
        //! Insertion d'une commande
        $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (htmlspecialchars($_GET['type']) == 'commandes') {
            $nom = mysqli_escape_string($co, htmlspecialchars($_POST['fname']));
            $prenom = mysqli_escape_string($co, htmlspecialchars($_POST['lname']));
            $mail=mysqli_escape_string($co, htmlspecialchars($_POST['mail']));
            $tel=mysqli_escape_string($co, htmlspecialchars($_POST['tel']));
            $lieu=mysqli_escape_string($co, htmlspecialchars($_POST['lieu']));
            $dateResa=mysqli_escape_string($co,date('y-m-d'));
            $result = $co->query("INSERT INTO commande(Nom,Prenom,Mail,Tel,lieu, DateDeReservation) VALUES('$nom','$prenom','$mail',$tel, (SELECT idLieu FROM lieuvente WHERE lieu = '$lieu'),'$dateResa');");
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
if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] instanceof Utilisateur) {
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
                            //! Récupération des différents lieux de vente
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
                    <a href="Casque_CGU.php" id='CGU'>Veuillez consultez les conditions d'utilisation du casque. pour toute réservation faite, nous considérons que vous avez accepté ces conditions. </a>
                </div>

                <input type='submit' value='Réserver' id='boutton'>
        </form>
    </div>
    <p class ="indication">Vous pourrez créer un compte <strong>HealthyVibe</strong> avec votre numéro de casque qui vous sera fourni à sa réception
        et consulter ses cas d'utilisation du casque et ses fonctionalités ici:<a href= "Casque_CGU.php" class ="casque"><strong>Usage du casque</strong></a>
    </p>
    



    <?php
    include './res/php/footer.php';
    ?>
</body>