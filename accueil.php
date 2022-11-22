<!-- Script pour l'inscription ou connexion de l'utilisateur -->
<?php 
    require_once './res/php/config.php';
    session_start();
    if (isset($_GET['type'])) {
        if ($_GET['type'] == 'inscription') {
            $nom = $_POST['fname'];
            $prenom = $_POST['lname'];
            $dateNaissance = $_POST['DTN'];
            $adresse = "";
            $codePostal = "";
            if (isset($_POST['adresse']))
                $adresse = $_POST['adresse'];
            if (isset($_POST['CP']))
                $codePostal = $_POST['CP'];

            $mail = $_POST['mail'];
            $tel = $_POST['tel'];
            $mdp = $_POST['mdp'];

            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("INSERT INTO UTILISATEUR(nomm, prenom, email, mdp, tel, adresse, codepostal, datenaissance, role, banni) VALUES ('$nom','$prenom','$mail','$mdp','$tel','$adresse',$codePostal,'$dateNaissance',0,0);");
            if (!$result) {
                header("Location: ./inscription.php?reponse=Erreur");
                exit();
            } else {
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
            }
        }
        else if ($_GET['type'] == 'connexion') {
            
        } 
        else {

        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/accueil.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <?php
    include './res/php/header.php';
    ?>
    <section id="presentation">
        <h1>HealthyVibe</h1>
        <div>
            <p>Le nouveau casque économique de bien être</p>
            <a href="" id="acheter">Acheter ></a>
        </div>
        <img src="./res/img/casque.jpg" alt="Image du casque">
    </section>
    <section id="fonctions">

    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>